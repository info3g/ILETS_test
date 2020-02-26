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
                        <h4 class="card-title">Services</h4>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-warning mb-4" data-toggle="modal" data-target="#inlineForm">
                                    Add Service
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade text-xs-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
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
                                                            <label for="issueinput5">Service</label>
                                                            <select id="" name="service_id" class="form-control" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Service">
                                                                @foreach($services as $service)
                                                                <option value="{{$service->id}}">{{$service->service_name}}</option>
                                                                @endforeach   
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Service:</label>
                                                            <input type="text" class="form-control" name="name" required/>
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
                                        <th>Profession</th>
                                        <th>Service</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sub_services as $sub_service)
                                    <tr>
                                        <td>{{$sub_service->id}}</td>
                                        <td>
                                            @foreach($services as $service)
                                            @if($service->id == $sub_service->service_id)
                                            {{$service->service_name}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>{{$sub_service->name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inlineForm_{{$sub_service->id}}">Edit
                                            </button>
                                            <div class="modal fade text-xs-left" id="inlineForm_{{$sub_service->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Update Service</label>
                                                        </div>
                                                        <form method="post" action="{{ route('sub_services.update', $sub_service->id) }}">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="form-group">
                                                                        <label for="issueinput5">Services</label>
                                                                        <select id="" name="service_id" class="form-control" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Services">
                                                                        @foreach($services as $service)
                                                                        <option value="{{$service->id}}" {{ ($service->id == $sub_service->service_id) ? 'selected="selected"' : ''}}>{{$service->service_name}}</option>
                                                                        @endforeach   
                                                                        </select>
                                                                    </div>
                                                                    <label for="name">Services:</label>
                                                                    <input type="text" class="form-control" name="name" value="{{$sub_service->name }}"/>
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
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#inlineForm2_{{$sub_service->id}}">
                                            Delete
                                            </button>
                                            <div class="modal fade text-xs-left" id="inlineForm2_{{$sub_service->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Delete Service</label>
                                                        </div>
                                                        <form method="post" action="{{ route('sub_services.destroy', $sub_service->id)}}">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <div class="form-group">
                                                                    @method('DELETE')                                  
                                                                    <label> Do you really want to delete this service?</label>
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