<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Question;

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
    public function testDelete($slug)
    {
        try{
            $this->test->where("slug",$slug)->delete();
            return redirect()->back()->withSuccess('Successfully deleted !');
         }catch(Exception $e){
            return redirect()->back()->withError('something wrong !');
        }
    }
    public function testView($slug=null)
    {
        try{
            if($slug){
                $test = $this->test->findBySlug($slug);
                if($test->is_schedule){
                    // $test->start_date_time = date('Y-m-d h:i',$test->start_date_time);
                    // $test->end_date_time = date('d-m-Y h:i',$test->end_date_time);
                }
                $subjects = $this->subject->where('course_id',$test->courseId)->get();
            }
            else
            {
                $test = NULL;
                $subjects= [];
            }
            $cources = $this->course->get();
            return view('admin::test.view',compact('cources','slug','test','subjects'));
         }catch(Exception $e){
            return redirect()->back()->withError('something wrong !');
        }
    }

    public function fetchSubjects(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $subjects = $this->subject->where('course_id',$data['courseId'])->get();
            $options = '<option value=""> -- Select Course -- </option>';
            foreach ($subjects as $key => $subject) {
                $options .= '<option value="'.$subject->id.'"> '.$subject->name.' </option>';
            }
            $resp = ['status'=>true,'msg'=>'','subjects'=>$options];
        }
        else
            $resp = ['status'=>false,'msg'=>'Invalid request'];
        die(json_encode($resp));
    }

    public function testUpdate($slug=null,Request $request)
    {
        $data = $request->all();
        // die(print_r($data));
        $validator = Validator::make($data, [
            'title' => 'required',
            'courseId' => 'required',
            'subjectId' => 'required',
            'totalMarks' => 'required',
            'duration' => 'required',
        ]);
        if ($validator->fails()) {
            return \Redirect::back()->withInput()->withError($validator->errors());
        }
        try{

            $data = $request->all();
            unset($data['_token']);
            if((int)$data['is_schedule']){
                $data['start_date_time'] = strtotime($data['start_date_time']);
                $data['end_date_time'] = strtotime($data['end_date_time']);
            }
            else
            {
                $data['end_date_time'] = NULL;
                $data['end_date_time'] = NULL;

            }
            if($request->slug){
                $this->test->where('slug',$request->slug)->update($data);
                return redirect()->route('test_listing')->withSuccess('Successfully Updated Test');
            }
            else{
                $this->test->create($data);
                return redirect()->route('test_listing')->withSuccess('Successfully Added Test');
            }
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Oops,something wrong !');
        }
    }


    public function question($id){
        try {
            $questions = $this->question->where('testId',$id)->orderBy('id','asc')->get();
            $test = $this->test->where('id',$id)->first();
            return view('admin::test.question',compact('questions','test'));    
        } catch (\Exception $e) {
            return redirect()->back()->withError('Oops,something wrong !');
        }

    }

    public function questionEdit($id){
       try {
            $question = $this->question->where('id',$id)->first();
            // die(print_r($question));
            return view('admin::test.edit',compact('question','id'));    
        } catch (\Exception $e) {
            return redirect()->back()->withError('Oops,something wrong !');
        } 
    }

    public function questionDelete($id){
        try{
            $this->question->where("id",$id)->delete();
            return redirect()->back()->withSuccess('Successfully deleted !');
         }catch(Exception $e){
            return redirect()->back()->withError('something wrong !');
        }
    }

    public function questionEditPost(Request $request){
        if($request->method()=='POST'){
            $data = $request->all();
            $validator = Validator::make($data, [
                'id' => 'required',
                'question' => 'required',
                'optionA' => 'required',
                'optionB' => 'required',
                'optionC' => 'required',
                'optionD' => 'required',
                'answer' => 'required',
            ]);
            if ($validator->fails()) {
                return \Redirect::back()->withInput()->withError($validator->errors());
            }
            try {
                unset($data['_token']);
                $question = $this->question->where('id',$data['id'])->update($data);
                return redirect()->route('test-question',[$data['testId']])->withSuccess('Question Updates Successfully');  
            } catch (\Exception $e) {
                return redirect()->back()->withError('something wrong !');
            }
        }
    }

    public function questionAdd($slug,Request $request){
        try{
            $test = $this->test->findBySlug($slug);
            if($request->method()=='POST'){
                $data = $request->all();
                $validator = Validator::make($data, [
                    'question' => 'required',
                    'optionA' => 'required',
                    'optionB' => 'required',
                    'optionC' => 'required',
                    'optionD' => 'required',
                    'answer' => 'required',
                ]);
                if ($validator->fails()) {
                    return \Redirect::back()->withInput()->withError($validator->errors());
                }

                $data['testId'] = $test->id;
                $data['courseId'] = $test->courseId;
                $data['subjectId'] = $test->subjectId;
                unset($data['_token']);
                $this->question->create($data);
                return redirect()->route('test-question',[$test->id])->withSuccess('Question Added Successfully');
            }
            return view('admin::test.addquestion',compact('test'));    
        } catch (\Exception $e) {
            return redirect()->back()->withError('Oops,something wrong !');
        }
    }

    public function questionAddByExcel($slug, Request $request){
        // dd('ddd');
        try{

            $test = $this->test->findBySlug($slug);
            if(!empty($test->id)){
                if($request->hasFile('excelFile')){
                    $path = $request->file('excelFile')->getRealPath();
                    $data = Excel::load($path, function($reader) {})->get();
                    if(!empty($data) && $data->count()){
                        $insert = [];
                        // echo '<pre>';
                        // die(print_r($data->toArray()));
                        foreach ($data->toArray() as $key => $value) {

                            if(count($value)){

                                // foreach ($value as $v) {

                                    // $insert[] = $v;
                                    if(!empty($value['question']) AND !empty($value['optiona']) AND !empty($value['optionb']) AND !empty($value['optionc']) AND !empty($value['optiond']) AND !empty($value['answer'])){
                                    
                                    $insert[] = [
                                        'testId' => $test->id,
                                        'courseId' =>$test->courseId,
                                        'subjectId' =>$test->subjectId,
                                        'question' => $value['question'], 
                                        'optionA' => $value['optiona'],
                                        'optionB' => $value['optionb'],
                                        'optionC' => $value['optionc'],
                                        'optionD' => $value['optiond'],
                                        'answer' => $value['answer'],
                                        'description' => $value['explanation']
                                    ];

                                }
                            }
                        }
                        // die(print_r($insert));
                        if(count($insert)){
                            $this->question->insert($insert);
                            return redirect()->route('test-question',[$test->id])->withSuccess('Questions have been addedd Successfully.');
                        }
                        else
                        {
                          return redirect()->route('test-question',[$test->id])->withError('No questions found in the excel file');  
                        }
                        
                    }
                    else
                        return redirect()->route('test-question',[$test->id])->withError('Excel File is Empty');
                }
                else
                    return redirect()->route('test-question',[$test->id])->withError('No Excel File uploaded');
            }
            else
            {
                return redirect()->route('test-question',[$test->id])->withError('Invalid Test Identification');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withError('Oops,something wrong !');
        }
        
    }

    public function questionExportByExcel($id){
    	try{

            $test = $this->test->whereId($id)->first();
            if(!empty($test->id)){
            	$questions = $this->question->where('testId',$test->id)->orderBy('id','asc')->get();
                if($questions->count()){
                	// $data = [];
                	$data =
                	[ 
                		0 => [
	                		'Question',
	                		'OptionA',
	                		'OptionB',
	                		'OptionC',
	                		'OptionD',
	                		'Answer',
	                		'Explanation'
	                	]
                	];
                	foreach ($questions as $question) {
                    	$data [] = [
                    		$question->question,
                    		$question->optionA,
                    		$question->optionB,
                    		$question->optionC,
                    		$question->optionD,
                    		$question->answer,
                    		$question->description,
                    	];
                    }

                    return Excel::create($test->slug, function($excel) use($data){
                    	$excel->sheet('questions', function($sheet) use ($data)
				        {
				            $sheet->cell('A1:G1',function($cell)
				            {
				                $cell->setAlignment('center');
				                $cell->setFontWeight('bold');
				            });
				            $sheet->fromArray($data, null, 'A1', false, false);
                    	});

                    })->download('xlsx');   
                }
                else
                    return redirect()->route('test-question',[$test->id])->withError('No Questions found');
            }
            else
            {
                return redirect()->route('test-question',[$test->id])->withError('Invalid Test Identification');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withError('Oops,something wrong !');
        }
    }

    
}
