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
<?php
// dump($data);
?>
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
<?php 
    
if($data['to'] >= 1){
    $to = $data['to']+1;
}
else{
    $to = 1;    
}
?>
<div class="container-fluid">	
	<div class="card">
	    <form class="form-horizontal" action="{{route('heading.store')}}" method="post" enctype="multipart/form-data">
	    	@csrf
	        <div class="card-body">	
                @if($data['section'] != 'w')
	        	<div class="form-group row">
	        		<label for="mark" class="col-sm-3 text-right control-label col-form-label">Question From</label>                    
                    <div class="col-md-1">
                        <select class="select2 form-control custom-select" id="from" style="width: 100%; height:36px;" name="question_from" >
                            <!-- <option value="">Select</option>                             -->
                            @for($i=$to;$i<=$to;$i++)
                            	<option value="{{$i}}">{{$i}}</option>                                                       
                            @endfor
                        </select>
                    </div>
                    <label for="mark" class="col-sm-1 text-center control-label col-form-label">To</label>                    
                    <div class="col-md-1">
                        <select class="select2 form-control custom-select" id="to" style="width: 100%; height:36px;" name="question_to" required>
                            @for($i=$to;$i<=50;$i++)
                            	<option value="{{$i}}">{{$i}}</option>                                                       
                            @endfor                            
                        </select>
                    </div>
	        	</div>
                @endif
	        	<div class="form-group row">
                    <label class="col-md-3 m-t-15 text-right">Select Question Type</label>
                    <div class="col-md-3">
                        <select class="select2 form-control custom-select" id="option" style="width: 100%; height:36px;" name="question_type" required>
                            @if($data['section'] != 'w')
                                <option value="">Select</option>                            
                                <option value="t">FILL IN BLANKS</option>                                                       
                                <option value="m">MCQ</option>
                                <option value="c">CHECK BOX</option>
                                <option value="p">PARAGRAPH HEADING</option>
                            @else
                                <option value="t">TEXT</option>                                                       
                            @endif
                        </select>
                    </div>
                </div>           	            
                <div class="form-group row">                    
                    <label class="col-md-3 text-right">File Upload</label>
                    <div class="col-md-4">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="validatedCustomFile">
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>                    
                </div>
                <div class="form-group row">
                	<label for="mark" class="col-sm-3 text-right control-label col-form-label">Note</label>
                	<div class="col-md-9">
                		<textarea id="editor" name="note" required></textarea>    
                	</div>
                </div>
                <div class="form-group row form-group row">                    
                    <div class="col-sm-6">                        
                        <input type="hidden" class="form-control" name="question_type_id" value="{{$data['id']}}">
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

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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
    $('#validatedCustomFile').on('change',function(){        
        var fileName = $(this).val();
        var imageName = fileName.split("\\");
        $(this).next('.custom-file-label').html(imageName[2]);
    })
</script>	
@endsection