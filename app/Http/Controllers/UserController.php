<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\User;

class UserController extends Controller{
  

    public function userlist()
    {
        try{
            $datas = User::all();
            return view('user.userlist',compact('datas'));
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Oops,something wrong !');
        }
    }

    public function useradd()
    {
            $datas = User::all();
            return view('user.add');
    }

    

    public function userstore(Request $req)
    {
        try{
            $data = $req->all();
            User::create($data);
            return redirect()->route('user.list');
         }catch(\Exception $e){
             return $e;
            return redirect()->back()->withError('something wrong !');
        }
    }

}
