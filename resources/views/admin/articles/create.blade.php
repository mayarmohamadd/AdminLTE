@extends('admin.partials.main-layout')
@section('title', 'Create Article')
@section('Page', 'Create New Article')
@section('main-page', 'Create New Article')

@section('body')
<form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="images">Images</label>
        <input type="file" name="images[]" id="images" class="form-control" multiple> 
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection
