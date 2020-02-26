<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sub_service;
use App\Service;

class Sub_servicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_services = Sub_service::all();
        $services = Service::all();
       
        return view('sub_services.index', compact('sub_services','services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sub_services.create');
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

            'service_id' => '|integer',
            'name' => 'required|max:255'
        ]);
        $sub_service = Sub_service::create($validatedData);
   
        return redirect('/sub_services')->with('success', 'Sub Service is successfully saved');
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
       $sub_service = Sub_service::findOrFail($id);
       $service = Service::findOrFail($id);
       

     return view('sub_services.edit', compact('Sub_service','service'));
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
         $validatedData = $request->validate([
            'service_id' => 'integer',
            'name' => 'required|max:255'
        ]);
        Sub_service::whereId($id)->update($validatedData);

        return redirect('/sub_services')->with('success', 'Sub Service is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_service =Sub_service::findOrFail($id);
        $sub_service->delete();

        return redirect('/sub_services')->with('success', 'Sub Service is successfully deleted');
    }
}
