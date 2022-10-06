<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SlugController;
use App\Models\Chapter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        if ($type == 'all') {
            $datas = Chapter::all();
        }else if($type == 'active'){
            $datas = Chapter::where('status', 1)->get();
        }else {
            $datas = Chapter::where('status', 0)->get();
        }
        
        return view('admin.pages.chapter-management.index',
            [
                'datas' => $datas
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.chapter-management.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        // $this->validate($request, [
        //     'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        //     'title' => 'required|max:255|string',
        //     'description' => 'nullable|string',
        // ]);

        try {

            $slug = app('App\Http\Controllers\Admin\SlugController')->making_slug($request->title);

            $icon = '';
            if(request()->hasFile('icon') ){
                $to_store_name = $slug; //give a unique name that will be the stored file name
                $file = $request->file('icon'); // orginal file
                $to_store_folder_path = 'chapters-icon'; //path to store the file
                $type = 'store'; //store or update
                $old_file_path = ''; // old_file_path woulb be null or request variable
    
                $image = app('App\Http\Controllers\Admin\ImageController')->image($to_store_name, $file, $to_store_folder_path, $type, $old_file_path); 
                //declare controller top like use App\Http\Controllers\ImageController;
    
                $icon = $image;
            }

            $data = New Chapter;
            $data->icon = $icon;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->slug = $slug;
            $data->save();

            if ($data) {
                return redirect()->back()->with('success', 'Data Inserter successfully');
            }else{
                return redirect()->back()->with('error','Upps!! Something Error.');
            }
        }catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.pages.chapter-management.edit',
            [
                'data' => Chapter::find($id)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'title' => 'required|max:255|string',
            'description' => 'nullable|string',
        ]);

        try {

            $slug = app('App\Http\Controllers\Admin\SlugController')->making_slug($request->title);

            $icon = $request->old_icon;
            if(request()->hasFile('icon') ){
                $to_store_name = $slug; //give a unique name that will be the stored file name
                $file = $request->file('icon'); // orginal file
                $to_store_folder_path = 'chapters-icon'; //path to store the file
                $type = 'update'; //store or update
                $old_file_path = $request->old_icon; // old_file_path woulb be null or request variable
    
                $image = app('App\Http\Controllers\Admin\ImageController')->image($to_store_name, $file, $to_store_folder_path, $type, $old_file_path); 
                //declare controller top like use App\Http\Controllers\ImageController;
    
                $icon = $image;
            }

            $data = Chapter::find($id);
            $data->slug = $data->title == $request->title ? $data->slug : $slug;
            $data->icon = $icon;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->save();

            if ($data) {
                return redirect()->back()->with('success', 'Data Updated successfully');
            }else{
                return redirect()->back()->with('error','Upps!! Something Error.');
            }
        }catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status_change($id)
    {
        $row = Chapter::find($id);
        if ($row->status == 1) {
            $row->status = 0;
        }elseif ($row->status == 0) {
            $row->status = 1;
        }
        $row->save();
        return redirect()->back()->with('success', 'Data Updated successfully!');
    }
}
