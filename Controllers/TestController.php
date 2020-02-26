<?php

namespace App\Http\Controllers;

use DB;
use App\Test;
use App\Answer;
use App\Result;
use App\Question;
use App\QuestionType;
use App\QuestionChoice;
use App\QuestionHeading;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct(){
         $this->middleware('auth',['except' => ['demo']]);
    }
    
    public function demo(){
    
        // return abort(404);
        $questions = [];
        $test = Test::with('types.headings.questions.options')->where('slug','qxxx4vc2kg000gc4004g4ok848kcksc')->get()->toArray();        
        foreach ($test as $value) {            
            foreach ($value['types'] as $type) {
                if($type['section'] == 'w')
                    $questions['w'] = $type;
                elseif ($type['section'] == 'l')
                    $questions['l'] = $type;
                elseif ($type['section'] == 'r')
                    $questions['r'] = $type;
            }
        }        
        krsort($questions);
        $test[0]['types'] = $questions;        
        return view('test.demo_final',compact('test'));
    }

    public function index(){
        // return abort(404);
    	$questions = [];
    	$test = Test::with('types.headings.questions.options')->where('slug','qxxx4vc2kg000gc4004g4ok848kcksc')->get()->toArray();        
        foreach ($test as $value) {            
            foreach ($value['types'] as $type) {
                if($type['section'] == 'w')
                    $questions['w'] = $type;
                elseif ($type['section'] == 'l')
                    $questions['l'] = $type;
                elseif ($type['section'] == 'r')
                    $questions['r'] = $type;
            }
        }        
        krsort($questions);
        $test[0]['types'] = $questions;        
        return view('test.demo_final',compact('test'));
    }

    public function show($slug) {
        $questions = [];
        $test = Test::with('types.headings.questions.options')->where('slug',$slug)->get()->toArray();        
        foreach ($test as $value) {            
            foreach ($value['types'] as $type) {
                if($type['section'] == 'w')
                    $questions['w'] = $type;
                elseif ($type['section'] == 'l')
                    $questions['l'] = $type;
                elseif ($type['section'] == 'r')
                    $questions['r'] = $type;
            }
        }        
        krsort($questions);
        $test[0]['types'] = $questions;        
        return view('test.demo_final',compact('test'));
        // $questions = [];
        // $data = Test::with('types.questions.options')->where('slug',$slug)->get()->toArray();
        // if(!empty($data)){
        //     foreach ($data as $test) {
        //         foreach($test['types'] as $question){
        //             if($question['section'] == 'w')
        //                 $questions['w'] = $question;
        //             elseif ($question['section'] == 'l')
        //                 $questions['l'] = $question;
        //             elseif ($question['section'] == 'r')
        //                 $questions['r'] = $question;
        //         }
        //     }
        //     $data[0]['types'] = $questions;
        //     return view('test.index',compact('data'));
        // }
        // return abort(404);
    }

    public function store(Request $request){
    	// Take an empty array which holds the value of test which submit by the user
        // dump($request->all());
    	$test_qus_arr = [];
        $integer_keys = [];
        $string_keys = [];
        $paragraph_arr = [];
    	$db_arr = [];
        $user_id = $request->user_id;
        $test_id = $request->test_id;
        //Get all questiions and set into new array
    	foreach ($request->all() as $key => $value) {
            if (strpos($key, 'paragraph') !== false){
                $id = substr($key, strpos($key, "_") + 1);
                $paragraph_arr[$id] = $value;
            }
            else{
                $id = substr($key, strpos($key, "_") + 1);                 
                $test_qus_arr[$id] = $value;
            }    
    	}
        unset($test_qus_arr['token'],$test_qus_arr['id']);        
        // push string and integer keys in different array
        foreach ($test_qus_arr as $key => $value) {
            if(is_int($key)){
                $integer_keys[$key] = $value;
            }
            else{
                $id = substr($key, strpos($key, "_") + 1);
                $array_key = explode('_',$key);                 
                $string_keys[$array_key[0]][] = $value;
            }
        }          
        // Now get the all questions with their answers from the Database
        $test = Test::with('types.headings.questions')->where('id',$request->test_id)->first()->toArray();
        foreach ($test['types'] as $types) {            
            foreach ($types['headings'] as $heading) {
                foreach($heading['questions'] as $question){
                    $db_arr[$question['id']] = $question['answer_key'];
                }
            }
        }
        
        // Combine integer_keys and string_keys array
        $user_test_array = $integer_keys + $string_keys;
        // convert which key has array into string
        foreach ($user_test_array as $key => $value) {
            if(is_array($user_test_array[$key])){
                $user_test_array[$key] = implode('|',$value);
            }
        }
        ksort($user_test_array);
        // dump('user test array');
        // dump($user_test_array);
        ksort($db_arr);    
        dump('Database array : ');         
        dump($db_arr);
        $total_qus = count($db_arr);
        // dump('Total Questions : '.$total_qus);
        // dump('compare both array and get difference');

        $result = array_diff_assoc($db_arr, $user_test_array);        
        $wrong_answers = count($result);
        dump('total Question = '.$total_qus);
        dump('Wrong Answer = '.$wrong_answers);
        dump('Your score = '.($total_qus - $wrong_answers));

        $final_score = array(
                            'test_id'=>$test_id,
                            'user_id'=>$user_id,
                            'score'=>$total_qus - $wrong_answers
                        );
        dump($final_score);

        if(Result::create($final_score))
            dump('user Score upload');
        $answer = [];
        foreach ($paragraph_arr as $key => $value) {            
            $data['question_id'] = $key;
            $data['answer'] = $value;
            $data['user_id'] = $user_id;
            $data['test_id'] = $test_id;

            if(Answer::create($data)){
                dump('check Database paragraph answer submit');
            }
            array_push($answer, $data);
        }
        exit;    	
    }

    public function testList(){
        // $tests = Test::latest()->paginate();\
        $tests = Test::with('types.headings.questions.options')->latest()->paginate();
        // dd($tests);
        return view('test.testList',compact('tests'));
    }

    public function addTest(Request $request){        
        $slug = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 50 /*create string with 50 characters*/);
        $time = $request->hrs.':'.$request->mins;
        $test = Test::create([
                        'name'=>$request->name,
                        'time'=>$time,
                        'slug'=>$slug,
                    ]);
        for($i=1;$i<=3;$i++) {
            if($i == 1){
                $data = array(
                            'test_id'=>$test->id,
                            'type'=>'a',
                            'section'=>'l',
                        );                
            }
            elseif($i == 2){
                $data = array(
                            'test_id'=>$test->id,
                            'type'=>'t',
                            'section'=>'r',
                        );                
            }
            elseif($i == 3){
                $data = array(
                            'test_id'=>$test->id,
                            'type'=>'t',
                            'section'=>'w',
                        );                
            }
            QuestionType::Create($data);
        }
        return redirect()->route('test.testList')->with('success','Test Add successfully');
    }

    public function create() {
        return view('test.create');
    }
}
