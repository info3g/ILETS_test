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
            <h4 class="page-title">Users</h4>
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
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Email verification</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th scope="col">Created</th>
                </tr>
            </thead>
            <tbody class="customtable">
            	@foreach($users as $user)
                <tr>
                    <!-- <th>
                        <label class="customcheckbox">
                            <input type="checkbox" class="listCheckbox" />
                            <span class="checkmark"></span>
                        </label>
                    </th> -->
                    <td>   
                        <a href="{{route('result.testlist',$user->id)}}">{{$user->name}}</a>                        
                    </td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->verified ? 'Verified' : 'Not verified' }}</td>
                    <td>{{$user->status ? 'Activate' : 'Deactivate' }}</td>
                    <td>
                        @if($user->status == 0)
                            <a class="btn btn-sm btn-success" href="{{route('dashboard.active',$user->id)}}">Activate</a>
                        @else
                            <a class="btn btn-sm btn-danger" href="{{route('dashboard.deactive',$user->id)}}">Deactivate</a>
                        @endif
                    </td>
                    <td>                    	
						{{date("F jS, Y", strtotime($user->created_at))}}
                    </td>
                </tr>
                @endforeach               
            </tbody>
        </table>
    </div>
	</div>
@endsection