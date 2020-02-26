@extends('default')
@section('content')
<style>
    .uper {
    margin-top: 40px;
    }
</style>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="card-header">
            Add Categories
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
            <form method="post" action="{{ route('categories.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Professionals:</label>
                    <input type="text" class="form-control" name="profession_name"/>
                </div>
                <button type="submit" class="btn btn-primary">Create Category</button>
            </form>
        </div>
    </div>
</div>
@endsection