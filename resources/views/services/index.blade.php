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
                        <h4 class="card-title">Professions</h4>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-warning mb-4" data-toggle="modal" data-target="#inlineForm">
                                    Add Profession
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade text-xs-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
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
                                                            <label for="issueinput5">Professional</label>
                                                            <select id="" name="category_id" class="form-control" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Professional">
                                                                @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->profession_name}}</option>
                                                                @endforeach   
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Profession:</label>
                                                            <input type="text" class="form-control" name="service_name" required/>
                                                            {{--  <input type="hidden" class="form-control" name="category_id" value="{{$category->id}}" /> --}}
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
                                        <th>Professional</th>
                                        <th>Profession</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                    <tr>
                                        <td>{{$service->id}}</td>
                                        <td>
                                            @foreach($categories as $category)
                                            @if($category->id == $service->category_id)
                                            {{$category->profession_name}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>{{$service->service_name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inlineForm_{{$service->id}}">Edit
                                            </button>
                                            <div class="modal fade text-xs-left" id="inlineForm_{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Update Profession</label>
                                                        </div>
                                                        <form method="post" action="{{ route('services.update', $service->id) }}">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="form-group">
                                                                        <label for="issueinput5">Professional</label>
                                                                        <select id="" name="category_id" class="form-control" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Professional">
                                                                        @foreach($categories as $category)
                                                                        <option value="{{$category->id}}" {{ ($category->id == $service->category_id) ? 'selected="selected"' : ''}}>{{$category->profession_name}}</option>
                                                                        @endforeach   
                                                                        </select>
                                                                    </div>
                                                                    <label for="name">Professions:</label>
                                                                    <input type="text" class="form-control" name="service_name" value="{{$service->service_name }}"/>
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
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#inlineForm2_{{$service->id}}">
                                            Delete
                                            </button>
                                            <div class="modal fade text-xs-left" id="inlineForm2_{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Delete Service</label>
                                                        </div>
                                                        <form method="post" action="{{ route('services.destroy', $service->id)}}">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <div class="form-group">
                                                                    @method('DELETE')                                  
                                                                    <label> Do you really want to delete this profession?</label>
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
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#inlineForm3_{{$service->id}}">
                                            Add Service
                                            </button>
                                            <div class="modal fade text-xs-left" id="inlineForm3_{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Add Service</label>
                                                        </div>
                                                        <form method="post" action="{{ route('sub_services.store') }}">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">                                                                    
                                                                    <label for="name">Service:</label>
                                                                    <input type="text" class="form-control" name="name" required/>
                                                                    <input type="hidden" class="form-control" name="service_id" value="{{$service->id}}" required/>
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