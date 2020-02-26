<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $blogs = blogs::all();
         return view('cms.blog.blog', compact('blogs'));
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
         $validatedData = $request->validate([
            'heading' => 'required|max:255',
            'image' => 'required',
            'description' => 'required',
        ]);
         if($request->image){
                $imagename=$this->imageUploadPost($request->image);
                $validatedData['image']=$imagename;
            }
        $blog = Blogs::create($validatedData);
   
        return redirect('/blogs')->with('success', 'Blog is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function show(Blogs $blogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogs $blogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

         $validatedData = $request->validate([
            'heading' => 'required|max:255',
            'description' => 'required',
        ]);
         if($request->image || $request->old_image){            
            if($request->image){
                $imagename=$this->imageUploadPost($request->image);
                $validatedData['image']=$imagename;
            }else{
                $validatedData['image']=$request->old_image;

            }
        }
        $blog = Blogs::whereId($id)->update($validatedData);
   
        return redirect('/blogs')->with('success', 'Blog is successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogs = Blogs::findOrFail($id);
        $blogs->delete();

        return redirect('/blogs')->with('success', 'Blog is successfully deleted');
    }

    public function imageUploadPost($image) {
        $imageName = time().'.'.$image->extension();  
        $image->move(public_path('uploads/cms/'), $imageName);
        return $imageName;   
    } 
}
