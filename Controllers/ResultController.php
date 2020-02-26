<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;
use App\Answer;
use App\Test;
use App\QuestionHeading;

class ResultController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $answers = Answer::where('user_id',$id)->get()->toArray();
        $results = [];
        foreach($answers as $answer){
            $test = Test::where('id',$answer['test_id'])->first()->toArray();
            $heading = QuestionHeading::where('id',$answer['question_id'])->first()->toArray();
            $data = array(
                        'test'=>$test['name'],
                        'heading'=>$heading['note'],
                        'answer'=>$answer['answer'],
                        'user_id'=>$id
                    );
            array_push($results,$data);
        }        
        return view('answer.index',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $result = Result::where('user_id',$request->user_id)->first()->toArray();        
        $total_score = $result['score'] + $request->paragraph_score;
        if(Result::where('user_id', $request->user_id)->update(array('paragraph_score' => $request->paragraph_score,'total_score'=>$total_score))){
            dd('check database');
        }   
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
