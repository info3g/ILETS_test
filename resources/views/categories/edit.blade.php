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
                Update Categories
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
                <form method="post" action="{{ route('categories.update', $category->id) }}">
                    <div class="form-group">
                        @csrf
                        @method('PATCH')
                        <label for="name">Professionals:</label>
                        <input type="text" class="form-control" name="profession_name" value="{{ $category->profession_name }}"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection