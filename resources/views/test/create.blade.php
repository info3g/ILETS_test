@extends('layouts.admin.admin_layout')
@section('content')
<style type="text/css">
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
	  -webkit-appearance: none; 
	  margin: 0; 
	}
</style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="col-11 text-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('test.testList')}}">Test</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Test</li>
                    </ol>
                </nav>
            </div>	           
        </div>
    </div>
</div>
<div class="container-fluid">	
	<div class="card">
	    <form class="form-horizontal" action="{{route('test.addTest')}}" method="post">
	    	@csrf
	        <div class="card-body">	        	                                   
	            <div class="form-group row">
	                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Test Name</label>
	                <div class="col-sm-6">
	                    <input class="form-control" name="name" required>
	                </div>
	            </div>
	            <div class="form-group row">
                    <label for="mark" class="col-sm-3 text-right control-label col-form-label">Time</label>
                    <div class="row col-sm-6">
                        <input type="number" id="mark" class="form-control col-sm-1" name="hrs" value="01" placeholder="hrs" required>
                        <input type="number" class="form-control col-sm-1" name="mins" value="00" placeholder="min" required>
                    </div>
                </div>	            		
	        </div>	             
	        <div class="border-top">
	            <div class="card-body">
	                <button type="submit" class="btn btn-success float-right m-b-20" id="div_count">Submit</button>
	            </div>
	        </div>	        
	    </form>
	</div>
</div>
@endsection