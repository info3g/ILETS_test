@extends('layouts.admin.admin_layout')
<!-- Load content from app.blade.php file from app folder-->
@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success notification notification-success">
        <h4 class="alert-heading">Success!</h4>
        <p>{{ $message }}</p>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-success notification notification-error">
        <h4 class="alert-heading">Error!</h4>
        <p>{{ $message }}</p>
    </div>
@endif
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="col-11 text-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Test</li>
                    </ol>
                </nav>
            </div>
            <a href="{{route('test.create')}}" class="btn btn-success btn-sm float-right m-b-10">Add Test</a>
        </div>
    </div>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <!-- <th>
                        <label class="customcheckbox m-b-20">
                            <input type="checkbox" id="mainCheckbox" />
                            <span class="checkmark"></span>
                        </label>
                    </th> -->
                    <th scope="col">Test</th>
                    <th scope="col">Time</th>                    
                    <th scope="col">Slug</th>                    
                    <th scope="col">Created</th>
                    <!-- <th scope="col">Action</th> -->
                    <!-- <th scope="col">Delete</th> -->
                </tr>
            </thead>
            <tbody class="customtable">
                @foreach($tests as $test)                                
                <tr>
                    <!-- <th>
                        <label class="customcheckbox">
                            <input type="checkbox" class="listCheckbox" />
                            <span class="checkmark"></span>
                        </label>
                    </th> -->
                    <td>
                        <a href="{{route('type.list',$test->id)}}" >
                        {{$test->name}}</a>
                    </td>                    
                    <td>{{$test->time}}</td>                                    
                    <td>{{$test->slug}}</td>                                    
                    <td> {{date("F jS, Y", strtotime($test->created_at))}} </td>
                    <!-- <td>                                     -->
                    <!-- <a class="btn btn-sm btn-warning" href="{{route('test.edit',$test->id)}}">Edit</a> -->
                        <!-- <a class="btn btn-sm btn-success" href="{{route('type.add',$test->id)}}">Add Type</a> -->
                    <!-- </td> -->
                    <!-- <td>
                        <form action="{{ route('test.destroy',$test->id) }}" method="POST">
                            @csrf
                            @method('DELETE')                 
                            <button type="submit" class="btn btn-sm btn-default"><i class="mdi mdi-delete" aria-hidden="true"></i>
                            Delete</button> 
                        </form>
                    </td> -->
                </tr>                
                @endforeach               
            </tbody>
        </table>
    </div>
</div>
@endsection