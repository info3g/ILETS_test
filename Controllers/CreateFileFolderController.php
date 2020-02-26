<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;

class CreateFileFolderController extends Controller
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
        return view('create.index');
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
    public function store(Request $request)
    {
        $folder_name = $request->get('folder_name');
        $path = resource_path().'/views/'.$folder_name;
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
            File::put($path.'/index.blade.php','<h2>hello index page</h2>');
            File::put($path.'/create.blade.php','<h2>hello create page</h2>');
            File::put($path.'/edit.blade.php','<h2>hello edit page</h2>');
            return redirect()->route('create.index')
                        ->with('success','Folder Created with CRUD files');
        }
        else{
         return redirect()->route('create.index')->with('error','Folder already exsist');
        }
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
