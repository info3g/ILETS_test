@extends('layouts.admin.admin_layout')
<!-- Load content from app.blade.php file from app folder-->
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success notification notification-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">User Test</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php

?>
<div class="container-fluid">  
    <form action="{{route('result.store')}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="mark" class="col-sm-1 text-right control-label col-form-label">Marks</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="paragraph_score" name="paragraph_score" required>
                <input type="hidden" name="user_id" value="{{$results[0]['user_id']}}">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-success btn-sm m-t-5" id="div_count">Submit</button>
            </div>
        </div>
    </form>  
    @foreach($results as $result)  
    <div class="row">
        <div class="col-md-12">
            <h4>{!!$result['heading']!!}</h4>
        </div>
        <div class="col-md-6 p-3">
            <h5>{{$result['answer']}}</h5>
        </div>
        <?php // dump($result); ?>        
    </div>
    @endforeach    
</div>
@endsection