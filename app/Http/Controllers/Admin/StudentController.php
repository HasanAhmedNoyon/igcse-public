<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.pages.student-management.index',
            [
                'datas' => User::all()
            ]
        );
    }

    public function details($id)
    {
        $data = User::find($id);
        return view('admin.pages.student-management.details',
            [
                'data' => $data,
                'results' => Result::select('user_id', 'lecture_id', 'mcq_ids', 'total_correct', 'total_wrong')
                            ->with('lecture')
                            ->where('user_id', $id)->get(),
            ]
        );
    }
}
