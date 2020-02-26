@extends('default')
@section('content')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="card-header">
            Add Sub Service
        </div>
        <div class="card-body">
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
            <form method="post" action="{{ route('sub_services.store') }}">
                  @csrf
                <div class="form-group">
                    @csrf
                    <label for="name">Service Name :</label>
                    <input type="text" class="form-control" name="service_name"/>
                    <input type="hidden" class="form-control" name="category_id" value="36"/>
                </div>

                <button type="submit" class="btn btn-primary">Create Sub Service</button>
            </form>
        </div>
    </div>
</div>
@endsection