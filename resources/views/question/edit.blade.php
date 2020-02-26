@extends('layouts.admin.admin_layout')
@section('content')
<?php
// dump($question);
?>
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
	    <form class="form-horizontal" action="{{route('question.update',$question->id)}}" method="post">
	    	@csrf
	    	@method('PUT')  
	        <div class="card-body">
	        	<div class="form-group row">
                    <label class="col-md-3 m-t-15 text-right">Select Question Type</label>
                    <div class="col-md-3">
                        <select class="select2 form-control custom-select" id="option" style="width: 100%; height:36px;" name="type" required>
                        	@if($question->type == 'm')	                            
	                            <option value="m" selected="selected">MCQ</option>
	                        @elseif($question->type == 't')	                        	
	                            <option value="t" selected="selected">TEXT</option>
	                        @elseif($question->type == 'c')
	                        	<option value="c" selected="selected">CHECK BOX</option>
                    	 	@elseif($question->type == 'p')
	                        	<option value="c" selected="selected">PARAGRAPH HEADING</option>
	                        @endif
                        </select>
                    </div>
                </div>                
                </div>                
	            <!-- <h4 class="card-title">Personal Info</h4> -->	            
	            <div class="form-group row">
	                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Question</label>
	                <div class="col-sm-6">
	                    <textarea id="editor" class="form-control" name="question" required>{{$question->question}}</textarea>
	                </div>
	            </div>
	            @if($question->type == 'm' || $question->type == 't' || $question->type == 'p')
	            <div class="form-group row">
                    <label for="mark" class="col-sm-3 text-right control-label col-form-label">Answer key</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="mark" name="answer_key" value="{{$question->answer_key}}" required>
                        <input type="hidden" name="id" value="{{$question->id}}" required>
                    </div>
                </div>
                @endif
	            <div class="row">
	            	<div class="col-md-9">
						<!-- <button type="button" class="add_field_button btn btn-sm btn-success float-right m-b-10">Add Option</button> -->
					</div>
				</div>
				<div class="input_fields_wrap">					
					<?php $count=1; ?>
					@foreach($question->options as $option)
					<!-- when question type checkbox -->
					@if($question->type == 'c')
					<div class="form-group row">
					    <label class="col-md-3"></label>
					    <div class="col-md-9">
					        <div class="custom-control custom-checkbox mr-sm-2">
					        	<input type="checkbox" class="custom-control-input" id="customControlAutosizing_{{$count}}" name="checkbox_{{$option->id}}">
				        		<label class="custom-control-label" for="customControlAutosizing_{{$count}}">
				        			<input type="text" name="option_{{$option->id}}" class="form-control" id="option_1" placeholder="Enter option" style="width:276%;" value="{{$option->option}}" required>
				        		</label>
				        	</div>
					    </div>
					</div>
					@else
					<!-- When question another type insted of check box -->
					<div class="form-group row">
	                    <label for=" option{{$count}}" class="col-sm-3 text-right control-label col-form-label">Next Option</label>
	                    <div class="col-sm-6">
	                        <input type="text" class="form-control" id="option{{$count}}" name="option{{$count}}" value="{{$option->option}}" placeholder="Enter option">
	                    </div>
	                    <a href="#" class="remove_field "><i class="mdi mdi-delete"></i>Remove</a>
	                </div>
	                @endif
	                <?php $count++; ?>
	                @endforeach			                
	                <div class="jquery_div">
	                </div>
				</div>	
	        </div>
	        <div class="border-top">
	            <div class="card-body">
	            	<input type="hidden" name="div_count" id="count">
	            	<input type="hidden" name="question_heading_id" value="{{$question->question_heading_id}}">
	                <button type="submit" class="btn btn-success float-right m-b-20" id="div_count">Update</button>
	            </div>
	        </div>	        
	    </form>
	</div>
</div>
<script src="{{ asset('admin/dist/js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{asset('simditor/site/assets/scripts/module.js')}}"></script>
<script type="text/javascript" src="{{asset('simditor/site/assets/scripts/hotkeys.js')}}"></script>
<script type="text/javascript" src="{{asset('simditor/site/assets/scripts/uploader.js')}}"></script>
<script type="text/javascript" src="{{asset('simditor/site/assets/scripts/simditor.js')}}"></script>
<script type="text/javascript">	
	$(document).ready(function() {
		<?php 
			if($question->type == 't'){ ?>
				$(".add_field_button").hide();
		<?php	}
		?>
		var max_fields      = 10; //maximum input boxes allowed
		var wrapper   		= $(".jquery_div"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID
		var count_div		= $("#div_count");
		var x = <?php echo ($count-1); ?> //initlal text box count
		$(add_button).click(function(e){ //on add input button click

			console.log(<?php  echo $count; ?>);
			console.log('create div when click on button');			
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="form-group row"><label for="option" class="col-sm-3 text-right control-label col-form-label">Next Option</label><div class="col-sm-6"><input type="text" name="option'+x+'" class="form-control" id="option" placeholder="Enter option" required></div></div>'); //add input box
			}			
		});

		function createDiv(){			
			console.log('create div when change dropdown');
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="form-group row"><label for="option" class="col-sm-3 text-right control-label col-form-label">'+x+' Option</label><div class="col-sm-6"><input type="text" name="option'+x+'" class="form-control" id="option" placeholder="Enter option '+ x +'" required></div></div>'); //add input box
			}
		}

		$(count_div.click(function(e){			
			console.log('count div');			
			// document.getElementById("div_count").value = $(".input_fields_wrap > div").length;
			if($(".input_fields_wrap > div").length > 1)
				$("#count").val(($(".input_fields_wrap > div").length - 1) + $(".jquery_div > div").length);
		}));
		
		$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
			e.preventDefault(); 
			$(this).parent('div').remove(); x--;
		});
		$(".input_fields_wrap").on("click",".remove_field", function(e){ //user click on remove text
			e.preventDefault(); 
			$(this).parent('div').remove(); x--;
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
	    		$(".input_fields_wrap").hide();
	    	}	        
	    });

	    var id = '#editor';

	    var editor = new Simditor({
	  		textarea: $(id)
		  	//optional options
		});
	});	
</script>
@endsection