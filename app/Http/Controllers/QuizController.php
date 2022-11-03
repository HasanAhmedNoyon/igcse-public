<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\MCQ;
use App\Models\Lecture;
use App\Models\SystemInfo;
use Auth;
use DB;

class QuizController extends Controller
{
    public function quiz_store(Request $request, $id)
    {

        try{

            $mcqs = MCQ::select('id','answer')->where('lecture_id', $id)->get()->keyBy('id');

            // dd($mcqs);
            $c = count($mcqs);
            $user_answers_array = array_fill(0, $c, 0);
            $correct_answers = array_fill(0, $c, 0);
            $total_correct = 0;
            $total_wrong = 0;
            // return $user_answers_array;

            foreach ($request->mcq_ids as $key => $mcq_id) {
                if ($request->user_answers[$key] == $mcqs[$mcq_id]->answer) {
                    $user_answers_array[$key] = $request->user_answers[$key];
                    $total_correct++;
                }
                else{
                    $user_answers_array[$key] = $request->user_answers[$key];
                    $total_wrong++;
                }
                $correct_answers[$key] = $mcqs[$mcq_id]->answer;
            }

            DB::beginTransaction(); //transaction start
    
            $data = Result::where('user_id', Auth::user()->id)->where('lecture_id', $id)->first();
            if (empty($data)) {
                $data = New Result;
            }
            $data->user_id = Auth::user()->id;
            $data->lecture_id = $id;
            $data->mcq_ids = implode(', ', $request->mcq_ids);
            $data->user_answers = implode(', ', $request->user_answers);
            $data->correct_answers = implode(', ', $correct_answers);
            $data->total_correct = $total_correct;
            $data->total_wrong = $total_wrong;

            $total_question = $total_correct + $total_wrong;
            $get_percentage = ($total_correct/$total_question)*100;
            $system_info_passing_percentage = SystemInfo::select('passing_percentage')->first();

            $data->status = $get_percentage >= $system_info_passing_percentage->passing_percentage ? 1 : 0;
            $data->slug = Lecture::where('id', $id)->first()->slug;
            $data->save();
    
            DB::commit(); //transaction end
    
            return redirect()->route('user.result', [$data->slug])->with('success','Exam Successfully Done.');

        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function result($slug)
    {
        $data = Result::where('slug', $slug)->first();
        return view('user.pages.result',
            [
                'lecture' => Lecture::where('id', $data->lecture_id)->first(),
                'data' => $data
            ]
        );
    }
}
