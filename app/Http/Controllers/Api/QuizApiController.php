<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\SubmitQuiz;

class QuizApiController extends Controller
{
    public function getQuestion($user_id){
        try{
            $datas = SubmitQuiz::where('user_id',$user_id)->where('date',date('Y-m-d'))->first();
            if(empty($datas)){
                $data = Question::where('date',date('Y-m-d'))->take(3)->get();
                return response()->json(['status_code'=>200,'datas'=>$data]);
            }else{
                    return response()->json(['status_code'=>400,'datas'=>'New Quiz Not found']);
            }
        }catch(\Excaption $e){
            return response()->json(['status_code'=>400,'datas'=>'Something Went Wrong.']);
        }
    }

    public function userQuizSubmit(Request $request,$user_id = 1){
        try{
            $questions =  $request->all();
            foreach ($questions as $key => $question) {
                $insertResponse[] = [
                    'user_id'    => $user_id,
                    'qustion'    => $question['qustion'],
                    'option_a'    => $question['option_a'],
                    'option_b'       => $question['option_b'],
                    'option_c'   => $question['option_c'],
                    'answer'   => $question['answer'],
                    'date'     => $question['date'],
                    'useranswer'     => $question['useranswer'],
                    'getCoin'     => $question['getCoin'],
                    'testId'     => $question['testId'],
                ];
            }
            SubmitQuiz::insert($insertResponse);
            return response()->json(['status_code'=>200,'datas'=>'Quiz Submit Sucessfully']);
        }catch(\Excaption $e){
            return response()->json(['status_code'=>400,'datas'=>'Something Went Wrong.']);
        }
    }

    public function getResult($testId,$user_id){
        try{
                $total = SubmitQuiz::where('testId',$testId)->where('user_id',$user_id)->count();
                $right = SubmitQuiz::where('testId',$testId)->where('user_id',$user_id)->whereColumn('submitquiz.answer','submitquiz.useranswer')->count();
                $coin = SubmitQuiz::where('testId',$testId)->where('user_id',$user_id)->whereColumn('submitquiz.answer','submitquiz.useranswer')->sum('submitquiz.getCoin');
                $worng = SubmitQuiz::where('testId',$testId)->where('user_id',$user_id)->whereColumn('submitquiz.answer','!=','submitquiz.useranswer')->count();
                return response()->json(['status_code'=>200,'total'=>$total,'right'=>$right,'coin'=>$coin,'worng'=>$worng]);
        }catch(\Excaption $e){
            return response()->json(['status_code'=>400,'datas'=>'Something Went Wrong.']);
        }
    }

}
