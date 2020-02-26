@extends('layouts.admin.admin_layout')
@section('content')
<style type="text/css">
	.add_field_button,
	.input_fields_wrap{
		display: none;
	}
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
	  -webkit-appearance: none; 
	  margin: 0; 
	}
</style>
<link rel="stylesheet" type="text/css" href="{{asset('/simditor/site/assets/styles/simditor.css')}}" />
<!-- <script type="text/javascript" src="[script path]/jquery.min.js"></script> -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="col-11 text-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Question</li>
                    </ol>
                </nav>
            </div>	           
        </div>
    </div>
</div>
<?php //dump($data['id']); ?>
<div class="container-fluid">	
	<div class="card">
	    <form class="form-horizontal" action="{{route('type.store')}}" method="post">
	    	@csrf
	        <div class="card-body">	           	            
                <div class="form-group row">	                   	
                	<div class="col-md-12">
                		<textarea id="editor" name="question" autofocus>{{$data->question}}</textarea>    
                	</div>
                </div>				
                
                <div class="form-group row form-group row">                    
                    <div class="col-sm-6">                        
                        <input type="hidden" class="form-control" name="id" value="{{$data['id']}}">
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

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('simditor/site/assets/scripts/module.js')}}"></script>
<script type="text/javascript" src="{{asset('simditor/site/assets/scripts/hotkeys.js')}}"></script>
<script type="text/javascript" src="{{asset('simditor/site/assets/scripts/uploader.js')}}"></script>
<script type="text/javascript" src="{{asset('simditor/site/assets/scripts/simditor.js')}}"></script>
<script type="text/javascript">		
	var editor = new Simditor({
  		textarea: $('#editor')
	  	//optional options
	});
</script>	
@endsection