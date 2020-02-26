@extends ('layouts.admin.admin_layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add Folder inside view</h2>
            </div>            
        </div>
    </div>
    @if ($message = Session::get('error'))
        <div class="alert alert-block notification notification-error"> 
            <!-- <a class="close" data-dismiss="alert" href="#">×</a> -->
            <h4 class="alert-heading">Error!</h4>
            {{$message}}
        </div>  
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-block notification notification-success"> 
            <!-- <a class="close" data-dismiss="alert" href="#">×</a> -->
            <h4 class="alert-heading">Success!</h4>
            {{$message}}
        </div>  
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('create.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Folder name:</strong>
                    <input type="text" name="folder_name" class="form-control" placeholder="Enter Folder name">
                </div>
            </div>            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Add Folder</button>
            </div>
        </div>
    </form> 
</div>
@endsection