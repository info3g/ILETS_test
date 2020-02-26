<?php

namespace App\Http\Controllers;

use File;
use App\QuestionType;
use Illuminate\Http\Request;

class QuestionTypesController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index($id=null){
    	$qus_types = QuestionType::latest()->paginate();
    	return view('questiontype.index',compact('qus_types'));
    }

    public function create($id){        
    	return view('questiontype.create')->with('id',$id);
    }

    public function store(Request $request){
        // dd($request->all());
        if(QuestionType::where('id', $request->id)->update(array('question' => $request->question)))
            return redirect()->route('type.list',QuestionType::where('id', $request->id)->first()->toArray()['test_id'])->with('success','Added successfully');
        /*$audio=array();
        $test_id = $request->test_id;        
        $path = public_path().'/Audio/'.$test_id;
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        if($files=$request->file('files')){            
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move($path,$name);
                $audio[]=$name;
            }
        }
        $request->request->add(['media'=>implode("|",$audio)]); 
        // dd($request->all())             ;
    	QuestionType::create($request->all());
    	return redirect()->route('type.list',$test_id)->with('success','Added successfully');*/
    }

    public function list($id){
    	$qus_types = QuestionType::latest()->where('test_id',$id)->paginate();
    	return view('questiontype.index',compact('qus_types'))->with('id',$id);
    }

    public function addContent($id){
        $question_type = QuestionType::where('id',$id)->first();        
        $data = ['id'=>$question_type->id,'section'=>$question_type->section];
        return view('questiontype.content')->with('data',$question_type);
    }

    public function uploadContent(Request $request, $id){
        $test_id = $request->test_id;        
        $path = public_path().'/Audio/'.$test_id;
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        } 
        $audio = [];
        if($files=$request->file('files')){            
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move($path,$name);
                $audio[]=$name;
            }
        }
        $request->request->add(['media'=>implode("|",$audio)]); 
        // dd($request->all());
        if(QuestionType::where('id', $id)->update(['media'=>implode("|",$audio)])) {
            $question_type = QuestionType::where('id', $id)->get();            
            return redirect()->route('type.list',$test_id)->with('success','Added successfully');
        }
    }
}
