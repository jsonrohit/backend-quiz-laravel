<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Question;
use Exception;

class QuizController extends Controller{
  

    public function index()
    {
        try{
            $tests = Question::all();
            return view('test.index',compact('tests'));
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Oops,something wrong !');
        }
    }

    public function questionEdit($id=null)
    {
        try{
            $item = '';
            if($id){
                $item = Question::whereId($id)->first();
            }
            return view('test.add',compact('item'));
         }catch(Exception $e){
             return $e;
            return redirect()->back()->withError('something wrong !');
        }
    }

    public function questionAdd(Request $request){
        try{
            if(empty($request->get('id'))){
                $data = $request->all();
                unset($data['_token']);
                Question::create($data);
                return redirect()->route('index')->withSuccess('Question Added Successfully');
            }else{
                $data = $request->all();
                unset($data['_token']);
                Question::where('id',$request->get('id'))->update($data);
                return redirect()->route('index')->withSuccess('Question Added Successfully');
            }
              
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->withError('Oops,something wrong !');
        }
    }

   
    
}
