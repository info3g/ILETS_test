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
	    <form class="form-horizontal" action="{{route('question.store')}}" method="post">
	    	@csrf
	        <div class="card-body">
	        	<div class="form-group row">
                    <label class="col-md-3 m-t-15 text-right">Select Question Type</label>
                    <div class="col-md-2">
                        <select class="select2 form-control custom-select" id="option" style="width: 100%; height:36px;" name="type" required>
                            <option value="">Select</option>                            
                            <option value="t">TEXT</option>                                                       
                            <option value="m">MCQ</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 m-t-15 text-right">Select Question Section</label>
                    <div class="col-md-2">
                        <select class="select2 form-control custom-select" id="option" style="width: 100%; height:36px;" name="section" disabled required>
                        	@if($data['section'] == 'w')
                            <!-- <option value="">Select</option> -->
                            <option value="w" selected="selected">Writting</option>
                            @elseif($data['section'] == 'r')
                            <option value="r" selected="selected">Reading</option>
                            @elseif($data['section'] == 'l')
                            <option value="l" selected="selected">listening</option>
                            @endif
                        </select>
                    </div>
                </div>                
	            <!-- <h4 class="card-title">Personal Info</h4> -->	            
	            <div class="form-group row">
	                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Question</label>
	                <div class="col-sm-6">
	                    <textarea class="form-control" style="min-height: 100px;" name="question" required></textarea>
	                </div>
	            </div>
	            @if($data['section'] != 'w')
	            <div class="form-group row">
                    <label for="mark" class="col-sm-3 text-right control-label col-form-label">Answer key</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="mark" name="answer_key" required>
                    </div>
                </div>
                @endif
	            <div class="row">
	            	<div class="col-md-9">
						<button class="add_field_button btn btn-sm btn-success float-right m-b-10">Add Option</button>
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
	            	<input type="hidden" name="div_count" id="count">
                    <input type="hidden" class="form-control" name="question_type_id" value="{{$data['id']}}">
	                <button type="submit" class="btn btn-success float-right m-b-20" id="div_count">Submit</button>
	            </div>
	        </div>	        
	    </form>
	</div>
</div>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript">	
	$(document).ready(function() {
		var max_fields      = 10; //maximum input boxes allowed
		var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID
		var count_div		= $("#div_count");
		var x = 0; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="form-group row"><label for="option" class="col-sm-3 text-right control-label col-form-label">'+x+' Option</label><div class="col-sm-6"><input type="text" name="option'+x+'" class="form-control" id="option" placeholder="Enter option '+ x +'" required></div><a href="#" class="remove_field "><i class="mdi mdi-delete"></i>Remove</a></div>'); //add input box
			}			
		});

		function createDiv(){
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="form-group row"><label for="option" class="col-sm-3 text-right control-label col-form-label">'+x+' Option</label><div class="col-sm-6"><input type="text" name="option'+x+'" class="form-control" id="option" placeholder="Enter option '+ x +'" required></div></div>'); //add input box
			}
		}

		$(count_div.click(function(e){			
			console.log('count div');
			// document.getElementById("div_count").value = $(".input_fields_wrap > div").length;
			if($(".input_fields_wrap > div").length > 1)
				$("#count").val($(".input_fields_wrap > div").length);
		}));
		
		$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		});


		$('#option').on('change', function(){
	    	var demovalue = $(this).val(); 
	    	if(demovalue === 'm'){
	    		$(".add_field_button").show();
	    		$(".input_fields_wrap").show();
	    		createDiv();
	    	}

	    	if((demovalue === 't') || (demovalue == '')){
	    		$(".add_field_button").hide();
	    		$(".input_fields_wrap").empty();
	    		x = 0;
	    	}
	        
	    });	     
	});	
</script>
@endsection