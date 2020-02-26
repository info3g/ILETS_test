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
<div class="container-fluid">	
	<div class="card">
	    <form class="form-horizontal" action="{{route('type.store')}}" method="post" enctype="multipart/form-data">
	    	@csrf
	        <div class="card-body">
	        	<div class="form-group row">
                    <label class="col-md-3 m-t-15 text-right">Type</label>
                    <div class="col-md-2">
                        <select class="select2 form-control custom-select" id="option1" style="width: 100%; height:36px;" name="type" required>                                                    
                            <option value="t" selected="selected">TEXT</option>                             
                            <option value="a">AUDIO</option>                             
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 m-t-15 text-right">Select Section</label>
                    <div class="col-md-2">
                        <select class="select2 form-control custom-select" id="option2" style="width: 100%; height:36px;" name="section" required>                                                    
                            <!-- <option value="">Select</option> -->
                            <option value="w">Writting</option>
                            <option value="r">Reading</option>
                            <option value="l">Listening</option>
                        </select>
                    </div>
                </div>                
	            <!-- <h4 class="card-title">Personal Info</h4> -->	            
	            <div class="form-group row" id="question_writing">	            	
	                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Title</label>
	                <div class="col-md-3">	                    
	                    <input class="form-control" type="text" name="question" placeholder="Enter title">
	                </div>
	            </div>
	            <div class="form-group row" id="question_reading">	            	
	                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Paragraph</label>
	                <div class="col-sm-6">
	                    <textarea class="form-control" style="min-height: 100px;" name="question"></textarea>
	                </div>
	            </div>
	            <div class="form-group row" id="media">
	                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Upload Audio</label>
	                <div class="col-sm-6">
	                    <input type="file" name="files[]" multiple>
	                </div>
	            </div>
	            <div class="form-group row">                    
                    <div class="col-sm-6">                        
                        <input type="hidden" class="form-control" name="test_id" value="{{$id}}">
                    </div>
                </div>
                <div class="form-group row">	                   	
                	<div class="col-md-12 d-flex justify-content-center">
                		<textarea id="editor" name="question" placeholder="Balabala" autofocus></textarea>    
                	</div>
                </div>
				<div class="input_fields_wrap">
					<!-- <div class="form-group row">
	                    <label for=" option1" class="col-sm-3 text-right control-label col-form-label">1 Option</label>
	                    <div class="col-sm-6">
	                        <input type="text" class="form-control" id="option_1" name="option1" placeholder="Enter option 1">
	                    </div>
	                </div> -->
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
	$(document).ready(function() {
		$('#option2 option[value="l"]').hide();
		$("#media").hide();		
		$("#question_reading").hide();
		$('#option1').on('change', function(){
			var type_value = $(this).val();			
			if(type_value === 'a'){				
				$("#question_writing").hide();
				$('#option2 option[value="w"]').hide();
				$('#option2 option[value="r"]').hide();
				$('#option2 option[value="l"]').show();
				$("#question_reading").hide();
				$("#option2").val("l").change();
			}
			else if(type_value === 't'){				
				$('#option2 option[value="w"]').show();
				$('#option2 option[value="r"]').show();
				$('#option2 option[value="l"]').hide();
				$("#option2").val("w").change();
			}
		});

		$('#option2').on('change', function(){
			var section = $(this).val();
			if(section === 'l'){				
				$("#media").show();
			}
			else {
				$("#question").show();
				$("#media").hide();
			}
		});
		$('#option2').on('change', function(){
			var section = $(this).val();
			if(section === 'r'){
				$("#question_reading").show();
				$("#question_writing").hide();
			}
			else {
				$("#question_reading").hide();
				$("#question_writing").show();
			}
		});
	});
	var editor = new Simditor({
  		textarea: $('#editor')
	  	//optional options
	});

</script>	
@endsection