<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SlugController;
use App\Models\SystemInfo;
use App\Models\Contact_us;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set("Asia/Dhaka");

class SettingController extends Controller
{
    public function system_info()
    {
        $row = SystemInfo::where('id', 1)->first();
        return view('admin.pages.settings.system-info', compact('row'));
    }

    public function system_info_update(Request $request)
    {
        $this->validate($request,[
            'system_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'system_name' => 'required|max:255|string',
            'email' => 'required|email|max:255|string',
            'phone' => 'required',
            'address' => 'required|max:255|string'
        ]);

        try {

            $system_logo = $request->old_system_logo;
            if(request()->hasFile('system_logo') ){
                $to_store_name = app('App\Http\Controllers\Admin\SlugController')->making_slug($request->system_name); //give a unique name that will be the stored file name
                $file = $request->file('system_logo'); // orginal file
                $to_store_folder_path = 'system-info'; //path to store the file
                $type = 'update'; //store or update
                $old_file_path = $request->old_system_logo; // old_file_path woulb be null or request variable
    
                $image = app('App\Http\Controllers\Admin\ImageController')->image($to_store_name, $file, $to_store_folder_path, $type, $old_file_path); 
                //declare controller top like use App\Http\Controllers\ImageController;
    
                $system_logo = $image;
            }

            // $this->buildXMLHeader();
            DB::beginTransaction(); //transaction start
            $data = SystemInfo::where('id', 1)->first();
            $data->system_logo = $system_logo;
            $data->system_name = $request->system_name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->facebook_link = $request->facebook_link;
            $data->twitter_link = $request->twitter_link;
            $data->instagram_link = $request->instagram_link;
            $data->passing_percentage = $request->passing_percentage;
            $data->save();
            DB::commit(); //transaction end

            if ($data) {
                return redirect()->back()->with('success', 'Data Updated successfully');
            }else{
                return redirect()->back()->with('error','Upps!! Something Error.');
            }
        } 
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function contact_us()
    {
        $datas = Contact_us::all();
        return view('admin.pages.settings.contact_us', compact('datas'));
    }
}
