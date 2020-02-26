<?php

namespace App\Http\Controllers;

use File;
use App\Test;
use App\QuestionType;
use App\QuestionHeading;
use Illuminate\Http\Request;

class QuestionHeadingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }
     
    public function index($id) {
        $headings = QuestionHeading::with('questions')->where('question_type_id',$id)->paginate();        
        return view('heading.index',compact('headings'))->with('id',$id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null) {        
        $heading = QuestionHeading::orderBy('id', 'desc')->where('question_type_id',$id)->first();
        $qus_type = QuestionType::where('id',$id)->first();            
        if($heading != null)
            $data = array('id'=>$id,'to'=>$heading['question_to'],'section'=>$qus_type->section);
        else
            $data = array('id'=>$id,'to'=>0,'section'=>$qus_type->section);
        return view('heading.create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)    
    {            
        if($request->file('file') !== null) {
            $file = $request->file('file');                
            $path = public_path().'/Header_images/';
            if(!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $name=time().'.'.$file->getClientOriginalExtension();         
            $file->move($path,$name);
            $name = '/Header_images/'.$name;
            $image = array('image'=>$name);
        }        
        $heading = 'Question from '.$request->question_from.'-'.$request->question_to;               
        if(isset($image))
            $request->request->add(['heading'=>$heading,'image'=>$name]);
        else
            $request->request->add(['heading'=>$heading]);
        if(QuestionHeading::create($request->all()))
            return redirect()->route('heading.list',$request->question_type_id)->with('success','Question added successfully');
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
        $heading = QuestionHeading::find($id);
        return view('heading.edit',compact('heading'));
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
        $heading = QuestionHeading::where('id', $id)->first();
        if(QuestionHeading::where('id', $id)->update(array('note' => $request->note))){
            return redirect()->route('heading.list',$heading->question_type_id);
        }
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

    public function updateImage($id) {
        $heading = QuestionHeading::find($id);  
        return view('heading.updateimage',compact('heading'));
    }

    public function uploadImage(Request $request,$id) {        
        $file = $request->file('file');        
        $path = public_path().'/Header_images/';
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $name=time().'.'.$file->getClientOriginalExtension();         
        $file->move($path,$name);
        $name = '/Header_images/'.$name;
        $image = array('image'=>$name);
        if(QuestionHeading::where('id', $id)->update($image)) {
            return redirect()->route('heading.list',$request->question_type_id);
        }
    }
}
