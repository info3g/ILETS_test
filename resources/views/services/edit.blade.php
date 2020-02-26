@extends('default')
@section('content')
<style>
    .uper {
    margin-top: 40px;
    }
</style>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="card uper">
            <div class="card-header">
                Update Services
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
                <form method="post" action="{{ route('services.update', $service->category_id) }}">
                    <div class="form-group">
                        @csrf
                        @method('PATCH')
                        <label for="name">id:</label>
                        <input type="text" class="form-control" name="category_id" value="{{ $service->category_id}}"/>
                    </div>
                    <div class="form-group">
                        <label for="name">Service Name :</label>
                        <input type="text" class="form-control" name="service_name" value="{{ $service->service_name }}"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Service</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection