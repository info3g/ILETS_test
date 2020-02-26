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
                    <div class="card-header cat-heading">
                        <h4 class="card-title">Professionals</h4>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-warning mb-4" data-toggle="modal" data-target="#inlineForm">
                                    Add Professional
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade text-xs-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">Add Professional</label>
                                                </div>
                                                <form method="post" action="{{ route('categories.store') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">                                                                    
                                                            <label for="name">Professionals:</label>
                                                            <input type="text" class="form-control" name="profession_name" required/>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" class="btn btn-outline-success" value="Add">
                                                        <input type="submit" class="btn btn-outline-danger" data-dismiss="modal" value="Close">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body collapse in">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Professionals</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->profession_name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inlineForm_{{$category->id}}">Edit
                                            </button>
                                            <div class="modal fade text-xs-left" id="inlineForm_{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Update Professional</label>
                                                        </div>
                                                        <form method="post" action="{{ route('categories.update', $category->id) }}">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <label for="name">Professionals:</label>
                                                                    <input type="text" class="form-control" name="profession_name" value="{{$category->profession_name }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" class="btn btn-outline-success" value="Update">
                                                                <input type="submit" class="btn btn-outline-danger" data-dismiss="modal" value="Close">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#inlineForm2_{{$category->id}}">
                                            Delete
                                            </button>
                                            <div class="modal fade text-xs-left" id="inlineForm2_{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Delete Category</label>
                                                        </div>
                                                        <form method="post" action="{{ route('categories.destroy', $category->id)}}">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <div class="form-group">
                                                                    @method('DELETE')                                  
                                                                    <label> Do you really want to delete this professional?</label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" class="btn btn-outline-warning" value="Delete">
                                                                <input type="submit" class="btn btn-outline-danger" data-dismiss="modal" value="Close">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#inlineForm3_{{$category->id}}">
                                            Add Profession
                                            </button>
                                            <div class="modal fade text-xs-left" id="inlineForm3_{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">Add Profession</label>
                                                </div>
                                                <form method="post" action="{{ route('services.store') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">                                                                    
                                                            <label for="name">Profession:</label>
                                                            <input type="text" class="form-control" name="service_name" required/>
                                                            <input type="hidden" class="form-control" name="category_id" value="{{$category->id}}" required/>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" class="btn btn-outline-success" value="Add">
                                                        <input type="submit" class="btn btn-outline-danger" data-dismiss="modal" value="Close">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection