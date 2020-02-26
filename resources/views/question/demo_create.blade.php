@extends('layouts.admin.admin_layout')
@section('content')
<style type="text/css">
	.add_field_button,
	.input_fields_wrap{
		/*display: none;*/
	}
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
	  -webkit-appearance: none; 
	  margin: 0; 
	}
</style>
<link rel="stylesheet" type="text/css" href="{{asset('/simditor/site/assets/styles/simditor.css')}}" />
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
            @for($i=$data->question_from;$i<=$data->question_to;$i++)
	        <div class="card-body">
	        	<div class="form-group row">
	        		<input type="hidden" name="type" value="{{$data->question_type}}">
	        		<input type="hidden" name="from" value="{{$data->question_from}}">
	        		<input type="hidden" name="to" value="{{$data->question_to}}">
                    <label class="col-md-3 m-t-15 text-right">Question Type</label>
                    <div class="col-md-3">                    	
                        <select class="select2 form-control custom-select" id="option" style="width: 100%; height:36px;" name="type" disabled="disabled">
                        	@if($data->question_type == 'm')
                            	<option value="m">MCQ</option>
                            @elseif($data->question_type == 't')
                            	<option value="t">TEXT</option>
                            @elseif($data->question_type == 'c')
                            	<option value="t">CHECK BOX</option>
                        	@elseif($data->question_type == 'p')
                            	<option value="p">PARAGRAPH HEADING</option>
                            @endif
                        </select>
                    </div>
                </div>                	                
	            <div class="form-group row">
	                <label for="cono1" class="col-md-3 col-lg-3 col-sm-12 text-right control-label col-form-label">Question</label>
	                <div class="col-md-6 col-lg-6 col-sm-12">
	                    <!-- <textarea class="form-control" style="min-height: 100px;" name="question_{{$i}}" required></textarea> -->
	                    <!-- <textarea id="editor{{$i}}" class="editor" style="height: 250px;" name="question_{{$i}}" required></textarea> -->
                            <textarea id="editor{{$i}}" name="question_{{$i}}" required></textarea>
                        <!-- </div> -->
	                </div>
	            </div>
	            
                @if($data->question_type == 'm' || $data->question_type == 't' || $data->question_type == 'p')
	            <div class="form-group row">
                    <label for="mark" class="col-md-3 col-lg-3 col-sm-12 text-right control-label col-form-label">Answer key</label>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <input type="text" class="form-control" id="mark" name="answer_key_{{$i}}" required>
                    </div>
                </div>
				@endif		
                
	            <div class="row">
	            	<div class="col-md-9">
	            		@if($data->question_type == 'm')
						<button type="button" class="add_field_button btn btn-sm btn-success float-right m-b-10 field_mcq" id="{{$i}}">Add Option</button>
						@elseif($data->question_type == 'c')
						<button type="button" class="add_field_button btn btn-sm btn-success float-right m-b-10 field_checkbox" id="{{$i}}">Add Checkbox Option</button>
						@endif
					</div>
				</div>		
				<!-- <input type="hidden" class="form-control" name="serial_no_{{$i}}" value="{{$i}}"> -->
				<div class="input_fields_wrap_{{$i}}">					                   	
				</div>	
	        </div>	        
	        <hr>
	        @endfor
            <div class="card-body">            	
                <input type="hidden" class="form-control" name="question_heading_id" value="{{$data->id}}">
                <button type="submit" class="btn btn-success float-right m-b-20" id="div_count">Submit</button>
            </div>
	    </form>
	</div>
</div>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous">  	
</script>
<script type="text/javascript" src="{{asset('simditor/site/assets/scripts/module.js')}}"></script>
<script type="text/javascript" src="{{asset('simditor/site/assets/scripts/hotkeys.js')}}"></script>
<script type="text/javascript" src="{{asset('simditor/site/assets/scripts/uploader.js')}}"></script>
<script type="text/javascript" src="{{asset('simditor/site/assets/scripts/simditor.js')}}"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		var x = 0; //initlal text box count
		$(".field_mcq").click(function() {
			var max_fields      = 100; //maximum input boxes allowed
			var wrapper = $(".input_fields_wrap_"+this.id); //Fields wrapper
			console.log('Question Id of the div is '+this.id);
			if(x < max_fields){ //max input box allowed
				x++; //text box increment				
				$(wrapper).append('<div class="form-group row"><label for="option" class="col-sm-3 text-right control-label col-form-label">'+x+' Option</label><div class="col-sm-6"><input type="text" name="option_'+this.id+'_'+x+'" class="form-control" id="option" placeholder="Enter option '+ x +'"required></div><a href="#" class="remove_field "><i class="mdi mdi-delete"></i>Remove</a></div>'); //add input box
			}

			$(wrapper).on("click",".remove_field", function(e){ // user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); x--;
				console.log('Value of x after removing div '+x);
			});
		});

		$(".field_checkbox").click(function() {
			var max_fields      = 100; //maximum input boxes allowed
			var wrapper = $(".input_fields_wrap_"+this.id); //Fields wrapper
			console.log('Question Id of the div is '+this.id);
			if(x < max_fields){ //max input box allowed
				x++; //text box increment				
				$(wrapper).append('<div class="form-group row"><label class="col-md-3"></label><div class="col-md-9"><div class="custom-control custom-checkbox mr-sm-2"><input type="checkbox" class="custom-control-input" id="customControlAutosizing_'+x+'" name="checkbox_'+this.id+'_'+x+'"><label class="custom-control-label" for="customControlAutosizing_'+x+'"><input type="text" name="option_'+this.id+'_'+x+'" class="form-control" id="option_1" placeholder="Enter option" style="width:276%;" required></label></div></div></div>'); //add input box
			}

			$(wrapper).on("click",".remove_field", function(e){ // user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); x--;
				console.log('Value of x after removing div '+x);
			});
		});
	});

	<?php for($i=$data->question_from;$i<=$data->question_to;$i++) { ?>
		var id = '#editor' + <?php echo $i; ?>;

	    var editor = new Simditor({
	  		textarea: $(id)
		  	//optional options
		});
	<?php } ?>
</script>
@endsection