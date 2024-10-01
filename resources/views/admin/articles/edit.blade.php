@extends('admin.partials.main-layout')
@section('title', 'Edit Article')
@section('Page', 'Edit Article')
@section('main-page', 'Edit Article')
@section('body')

<form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $article->title) }}">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content" class="form-control">{{ old('content', $article->content) }}</textarea>
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
