@extends('admin.partials.main-layout')
@section('title', 'Create Categories')
@section('body')
<h1>Create New Category</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection
