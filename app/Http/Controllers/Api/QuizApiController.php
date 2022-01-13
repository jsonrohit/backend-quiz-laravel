<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuizApiController extends Controller
{
    public function getQuestion(){
        try{
            $data = Question::where('date',date('Y-m-d'))->take(3)->get();
            return response()->json(['status_code'=>200,'datas'=>$data]);
        }catch(\Excaption $e){
            return response()->json(['status_code'=>400,'datas'=>'Something Went Wrong.']);
        }
    }

    public function qusAnswer($id,$ans){
        try{
            $data = Question::where('id',$id)->where('answer',$ans)->first();
            if(!empty($data)){
                $answer = true;
            }else{
                $answer = false;
            }
            return response()->json(['status_code'=>200,'datas'=>$answer]);
        }catch(\Excaption $e){
            return response()->json(['status_code'=>400,'datas'=>'Something Went Wrong.']);
        }
    }
}
