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
                        <li class="breadcrumb-item"><a href="{{route('test.testList')}}">Test</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Test Section</li>
                    </ol>
                </nav>
            </div>
            <!-- <a href="{{route('type.add',$id)}}" class="btn btn-success btn-sm float-right m-b-10">Add Section</a> -->
        </div>
    </div>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>                    
                    <th scope="col">Section</th>
                    <th scope="col">Created</th>
                    <th scope="col">Action</th>
                    <!-- <th scope="col">Delete</th> -->
                </tr>
            </thead>
            <tbody class="customtable">
                @foreach($qus_types as $type)                
                <tr>                  
                    <td>
                        @if($type->section == 'w')
                            <a href="{{route('heading.list',$type->id)}}">Writing</a>
                        @elseif($type->section == 'r')
                            <a href="{{route('heading.list',$type->id)}}">Reading</a>
                        @elseif($type->section == 'l')
                            <a href="{{route('heading.list',$type->id)}}">Listening</a>
                        @endif
                    </td>                    
                    <td> {{date("F jS, Y", strtotime($type->created_at))}} </td>
                    <td style="width: 45%">                                    
                        <!-- <a class="btn btn-sm btn-warning" href="{{route('type.edit',$type->id)}}">Edit</a> -->                                                
                        <!-- <a class="btn btn-sm btn-success" href="{{route('question.add',$type->id)}}">Add Questions</a> -->
                        <a class="btn btn-sm btn-success" href="{{route('heading.add',$type->id)}}">Add Heading</a>
                        @if($type->section == 'r')
                            <a class="btn btn-sm btn-warning" href="{{route('question.addContent',$type->id)}}">Paragraph</a>                            
                        @elseif($type->section == 'l')
                            <!-- <a class="btn btn-sm btn-warning" href="{{route('question.addContent',$type->id)}}">Upload Audio</a> -->
                            
                            <a class="link" data-toggle="collapse" href="#Toggle-1" aria-expanded="false" aria-controls="Toggle-1">
                                <span >Upload Audio</span>
                            </a>
                            <div id="Toggle-1" class="collapse multi-collapse">
                                <form class="form-horizontal" id="uploadfile" action="{{route('type.upload',$type->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf                                    
                                    <div class="card-body">                                                                
                                        <div class="custom-file mb-3 col-sm-6">
                                            <input type="file" class="custom-file-input" id="customFile" name="files[]" multiple onchange="javascript:updateList()">
                                            <input type="hidden" name="test_id" value="{{$id}}">
                                            <label class="custom-file-label" for="customFile">Upload Audio</label>
                                            
                                            <div id="fileList">                                                
                                            </div>
                                        </div>
                                        <div class="card-body">                 
                                            <button type="submit" class="btn btn-success" id="div_count">upload</button>
                                        </div>
                                    </div>          
                                </form>
                            </div>
                        @endif
                    </td>
                    <!-- <td>
                        <form action="{{ route('type.destroy',$type->id) }}" method="POST">
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
    updateList = function() {
        var input = document.getElementById('customFile');
        var output = document.getElementById('fileList');
        output.innerHTML = '<ul>';
        for (var i = 0; i < input.files.length; ++i) {
            output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
        }
        output.innerHTML += '</ul>';
    }
</script>
@endsection