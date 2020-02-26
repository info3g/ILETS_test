@extends('layouts.admin.admin_layout')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('/simditor/site/assets/styles/simditor.css')}}" />
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="col-11 text-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('question.index')}}">Questions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Question</li>
                    </ol>
                </nav>
            </div>	           
        </div>
    </div>
</div>
<div class="container-fluid">	
	<div class="card">
	    <form class="form-horizontal" action="{{route('heading.update',$heading->id)}}" method="post">
	    	@csrf
	    	@method('PUT')  
	        <div class="form-group row">            	
            	<div class="col-md-12">
            		<textarea id="editor" name="note" required>{{$heading->note}}</textarea>            		
            	</div>
            </div>	       
            <div class="card-body">            	
                <button type="submit" class="btn btn-success float-right m-b-20" id="div_count">Update</button>
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
	$(function() {
	    $("#from").change(function() {
	        var first_dd_value = $(this).val();
	        $("#to").empty();
	        wrapper = $("#to");
	        first_dd_value = first_dd_value; 
	        for(i=first_dd_value;i<=60;i++){
	        	$(wrapper).append('<option value="'+i+'">'+i+'</option>');
	        }
	    });
	});
</script>	
@endsection