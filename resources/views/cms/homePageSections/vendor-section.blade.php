@extends('default')
@section('content')
<style>
    .uper {
    margin-top: 5px;
    }
</style>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="uper">
            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}  
            </div>
            <br />
            @endif
            <div class="content-body">
                <!-- Basic Tables start -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card">
                    
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <br />
                                    @endif 
                                    @if(!empty($sections))
                                    <form class="form" action="{{route('updateSections', $sections['id'])}}" method="POST" enctype="multipart/form-data" id="vendorSection">
                                        @csrf
                                        @method('PUT')                                           
                                     @else
                                    <form class="form" action="{{route('submit')}}" method="POST" enctype="multipart/form-data" id="vendorSection">
                                        @csrf 
                                     @endif
                                        <div class="form-body">
                                            <h4 class="form-section">Vendor Section</h4>
                                            <div class="form-group">
                                                <label for="companyName">Title</label>
                                                <input type="text" id="work_title" class="form-control" placeholder="Title" name="title" value="{{ isset($sections['title']) ? $sections['title'] : ''}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="projectinput8">Description</label>
                                                <textarea id="editor1" rows="5" class="form-control" name="description" placeholder="Description" >{{ isset($sections['description']) ? $sections['description'] : ''}}</textarea>
                                            </div>
                                            <input type="hidden" name="route_name" value="vendor-section">
                                        </div>
                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1">
                                            <i class="icon-cross2"></i> Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                            <i class="icon-check2"></i> Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection