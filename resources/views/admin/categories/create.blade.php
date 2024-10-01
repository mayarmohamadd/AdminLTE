@extends('admin.partials.main-layout')
@section('title', 'Create Categories')
@section('Page', 'Create Categories')
@section('main-page', 'Create Categories')

@section('body')

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
