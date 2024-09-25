@extends('admin.partials.main-layout')
@section('title', 'Edit Category')
@section('body')
<h1>Edit Category</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
