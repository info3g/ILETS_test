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
<?php //dump($data['types']); exit;?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="col-11 text-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('test.testList')}}">Test</a></li>
                        <li class="breadcrumb-item"><a href="">Section</a></li>
                        
                    </ol>
                </nav>
            </div>
            <!-- <a href="{{route('question.add',4)}}" class="btn btn-success btn-sm float-right m-b-10">Add Question</a> -->
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
                    <th scope="col">Question</th>
                    <!-- <th scope="col">Answer</th> -->
                    <th scope="col">Type</th>
                    <!-- <th scope="col">Section</th> -->
                    <th scope="col">Created</th>
                    <th scope="col">Action</th>
                    <!-- <th scope="col">Delete</th> -->
                </tr>
            </thead>
            <tbody class="customtable">
            	@foreach($data['questions'] as $question)                                
                <tr>
                    <!-- <th>
                        <label class="customcheckbox">
                            <input type="checkbox" class="listCheckbox" />
                            <span class="checkmark"></span>
                        </label>
                    </th> -->
                    <td>{!!$question->question!!}</td>
                    <!-- <td>{{$question->answer_key}}</td> -->
                    <td style="width: 20%">                        
                        @if($question->type == 'm')
                            <a class="link" data-toggle="collapse" href="#Toggle-{{$question->id}}" aria-expanded="false" aria-controls="Toggle-{{$question->id}}">                              
                                <span >MCQ
                                <i class="mdi mdi-pocket"></i></span>
                            </a>
                            <div id="Toggle-{{$question->id}}" class="collapse multi-collapse">
                                <ul class="p-l-0">
                                    @foreach($question->options as $option)
                                    <li>{{$option->option}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            TEXT
                        @endif
                    </td>                    
                   <!--  <td>
                        @if($question->section == 'w')
                            Writing
                        @elseif($question->section == 'r')
                            Reading
                        @elseif($question->section == 'l')
                            Listining
                        @endif
                    </td>  -->                   
                    <td> {{date("F jS, Y", strtotime($question->created_at))}} </td>
                    <td>                                    
                        <a class="btn btn-sm btn-warning" href="{{route('question.edit',$question->id)}}">Edit</a>
                    </td>
                    <!-- <td>
                        <form action="{{ route('question.destroy',$question->id) }}" method="POST">
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