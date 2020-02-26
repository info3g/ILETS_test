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
        <p>{{$message}}</p>
    </div>
@endif
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="col-11 text-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('test.testList')}}">Test</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Test Section</li>
                    </ol>
                </nav>
            </div>   
            <a href="{{route('heading.add',$id)}}" class="btn btn-success btn-sm float-right m-b-10">Add Heading</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>                   
                    <th scope="col">Heading</th>
                    <th scope="col">Note</th>                
                    <th scope="col">Type</th>                
                    <th scope="col">Created</th>
                    <th scope="col">Action</th>
                    <!-- <th scope="col">Delete</th> -->
                </tr>
            </thead>
            <tbody class="customtable">
                @foreach($headings as $heading)                
                <tr>
                    <td> {{$heading->heading}}</td>
                    <td>{!!$heading->note!!}</td>
                	<td>
                        @if($heading->question_type == 'm')
                            MCQ
                        @elseif($heading->question_type == 't')
                            TEXT
                        @elseif($heading->question_type == 'c')
                            CHECK BOX
                        @elseif($heading->question_type == 'p')
                            PARAGRAPH
                        @endif
                    </td>
                    <td> {{date("F jS, Y", strtotime($heading->created_at))}} </td>
                    <td>                                                            
                        @if($heading->questions->isEmpty())
                            <a class="btn btn-sm btn-success" href="{{route('question.add',$heading->id)}}">Add Questions</a>         
                        @else
                            <a class="btn btn-sm btn-primary" href="{{route('question.list',$heading->id)}}">View</a>
                        @endif
                        <a class="btn btn-sm btn-warning" href="{{route('heading.edit',$heading->id)}}">Edit Note</a>
                    </td>
                    <!-- <td>
                        <form action="{{ route('type.destroy',$heading->id) }}" method="POST">
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
    // $(function () {
    //         $('#uploadfile').on('submit', function (e) {
    //             e.preventDefault();
    //             console.log($(this).attr('action'));                
    //             $.ajax({
    //                 type: 'post',              
    //                 url:$(this).attr('action'),      
    //                 data: $('#uploadfile').serialize(),
    //                 success: function () {
    //                   alert('form was submitted');
    //                 }
    //             });
    //         });
    //     });
</script>
@endsection