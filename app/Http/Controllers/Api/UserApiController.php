<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserApiController extends Controller
{
    public function login(Request $req){
        try{
                $data = User::where('email',$req->get('email'))->where('password',$req->get('password'))->first();
                if(!empty($data)){
                    if($data->login_date != date('Y-m-d')){
                        $tatalCoin = $data->total_coin+1;
                        User::where('id',$data->id)->update(['total_coin'=>$tatalCoin,'login_date'=>date('Y-m-d')]);
                        $data = User::where('email',$req->get('email'))->where('password',$req->get('password'))->first();
                        return response()->json(['status_code'=>200,'datas'=>$data]);
                    }else{
                        return response()->json(['status_code'=>200,'datas'=>$data]);
                    }
                    
                }
                return response()->json(['status_code'=>400]);
           
        }catch(\Excaption $e){
            return response()->json(['status_code'=>400,'datas'=>'Something Went Wrong.']);
        }
    }

    public function updateCoin(Request $req){
        try{
        //    return $req->all();
            $user_id = $req->get('user_id');
            $coin = $req->get('coin');            
                $data = User::where('id',$user_id)->first();
                if(!empty($data)){
                        $tatalCoin = $data->total_coin+$coin;
                        User::where('id',$user_id)->update(['total_coin'=>$tatalCoin]);
                        $data = User::where('id',$user_id)->first();
                        return response()->json(['status_code'=>200,'datas'=>$data]);
                    }
                return response()->json(['status_code'=>400]);
           
        }catch(\Excaption $e){
            return response()->json(['status_code'=>400,'datas'=>'Something Went Wrong.']);
        }
    }
    

}
