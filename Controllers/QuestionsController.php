<?php
namespace App\Http\Controllers;

use DB;
use App\Question;
use App\QuestionType;
use App\QuestionChoice;
use App\QuestionHeading;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('options')->latest()->paginate();
        return view('question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null) {

        $data = QuestionHeading::where('id',$id)->first();           
        return view('question.demo_create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {        
        $heading = QuestionHeading::where('id',$request->question_heading_id)->first();    
        // Save check box type questions            
        if($request->type == 'c'){
            $questions = [];           
            for ($i=$request->from; $i <=$request->to; $i++) {
                $arr_result=[];
                $items = [];
                foreach ($request->all() as $key => $value) {                    
                    $exp_key = explode('_', $key);                    
                    if($exp_key[0] == 'option'){
                        if($exp_key[1] == $i){                            
                            $arr_result[$i][] = $value;
                        }
                    }
                    if($exp_key[0] == 'checkbox'){
                        if($exp_key[1] == $i) {
                            $changed_value = str_replace("checkbox","option",$key);
                            foreach ($request->all() as $key => $value) {
                                if($changed_value == $key ){
                                   array_push($items,$value);
                                }
                            }
                        }
                    }
                }                
                $qus = 'question_'.$i; // get question
                $ans = 'answer_key_'.$i; // get answer
                if(is_string($i))
                    $i = (int)$i;
                $data = [
                        'question'=>$request->$qus,
                        'answer_key'=>$request->$ans,
                        'type'=>$request->type,
                        'serial_no'=>$i,
                        'question_heading_id'=>$request->question_heading_id,
                        'options'=>$arr_result,
                        'items'=>$items
                        ];
                array_push($questions, $data);
            }
                
            foreach ($questions as $question) {
                $question['answer_key'] = implode('|', $question['items']);
                unset($question['items']);
                $qus = Question::create($question);
                if($qus) {            
                    foreach ($question['options'] as $option) {                    
                        foreach ($option as $value) {
                            $option_array = ['option'=>$value,'question_id'=>$qus->id];                        
                            QuestionChoice::create($option_array);
                        }
                    }                
                }                
            }
        }

        // Save MCQ type questions
        if($request->type == 'm') {            
            $questions = [];        
            for ($i=$request->from; $i <=$request->to; $i++) {                 
                $arr_result=[];
                foreach ($request->all() as $key => $value) {                    
                    $exp_key = explode('_', $key);                    
                    if($exp_key[0] == 'option'){
                        if($exp_key[1] == $i){                            
                            $arr_result[$i][] = $value;
                        }
                    }
                }
                $qus = 'question_'.$i; // get question
                $ans = 'answer_key_'.$i; // get answer
                if(is_string($i))
                    $i = (int)$i;
                $data = [
                        'question'=>$request->$qus,
                        'answer_key'=>$request->$ans,
                        'type'=>$request->type,
                        'serial_no'=>$i,
                        'question_heading_id'=>$request->question_heading_id,
                        'options'=>$arr_result
                        ];
                array_push($questions, $data);
            }                                
            foreach ($questions as $question) {            
                $qus = Question::create($question);
                if($qus) {            
                    foreach ($question['options'] as $option) {                    
                        foreach ($option as $value) {
                            $option_array = ['option'=>$value,'question_id'=>$qus->id];                            
                            QuestionChoice::create($option_array);                            
                        }
                    }                    
                }                
            }
        } 

        // Save input type questions
        if($request->type == 't' || $request->type == 'p') {
            for ($i=$request->from; $i <=$request->to; $i++) {
                $question = 'question_'.$i;
                $answer_key = 'answer_key_'.$i;
                Question::create([
                    'question'=>$request->$question,
                    'answer_key'=>$request->$answer_key,
                    'type'=>$request->type,
                    'question_heading_id'=>$request->question_heading_id,
                    'serial_no'=>$i
                ]); 
            }            
        } 

        return redirect()->route('heading.list',$heading->question_type_id)->with('success','Question update successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $question = Question::with('options')->find($id);
        return view('question.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question) {  
        if($request->type == 'm'){            
            $question->update([
                'id'=>$request->id,
                'question'=>$request->question,
                'answer_key'=>$request->answer_key,
                'type'=>$request->type,
                'section'=>$request->section
            ]);
            DB::table('question_choices')->where('question_id', '=', $request->id)->delete();
            $div_count = $request->div_count;
            for($i=1;$i<=$div_count;$i++)  {
                $opt = 'option'.$i;
                QuestionChoice::create([
                    'question_id'=>$question->id,
                    'option'=>$request->$opt
                ]);
            }
            return redirect()->route('question.list',$request->question_heading_id)->with('success','Question update successfully');
        }
        else {
            // this part done
            $question->update([
                'id'=>$request->id,
                'question'=>$request->question,
                'answer_key'=>$request->answer_key,
                'type'=>$request->type,
                'section'=>$request->section
            ]);
            return redirect()->route('question.list',$request->question_heading_id)->with('success','Question update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question) {
        $id = $question->id;
        if($question->delete()){
            if(DB::table('question_choices')->where('question_id', '=', $id)->delete()){
                return redirect()->route('question.index')->with('success','Question Delete successfully');
            }
            return redirect()->route('question.index')->with('success','Question Delete successfully');
        }
        return redirect()->route('question.index')->with('error','Unable to delete record');
    }

    public function list($id){
        $questions = Question::with('options')->where('question_heading_id',$id)->latest()->paginate();
        $type = QuestionType::where('id',$id)->get()->toArray();
        $data = ['types'=>$type,'questions'=>$questions];
        return view('question.index',compact('data'));
    }   
}
