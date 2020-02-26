@extends('layouts.admin.admin_layout')

@section('content')
<?php
// dump($heading['question_type_id']);
?>
<div class="container">    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <form class="p-t-20 p-b-40" action="{{ route('heading.uploadImage',$heading->id) }}" method="POST" enctype="multipart/form-data">
        @csrf   
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <center><img id="blah" src="{{asset($heading->image)}}" style="width: auto;max-height: 350px;"></center>
                </div>
            </div>
        </div>
        <div class="form-group row">                    
            <label class="col-md-3 text-right m-b-0 p-t-10">File Upload</label>
            <div class="col-md-6">
                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="validatedCustomFile">
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                </div>
            </div> 
            <div class="col-xs-12 col-sm-2 col-md-2 text-center">
                    <input type="hidden" name="question_type_id" value="{{$heading['question_type_id']}}">
                    <button type="submit" class="btn btn-primary">Update</button>
            </div>                   
        </div>        
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $('#validatedCustomFile').on('change',function(){        
        var fileName = $(this).val();
        var imageName = fileName.split("\\");
        $(this).next('.custom-file-label').html(imageName[2]);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }    
    $("#validatedCustomFile").change(function(){
        readURL(this);
    });
</script>
@endsection('content')