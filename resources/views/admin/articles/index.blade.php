@extends('admin.partials.main-layout')
@section('title', 'Articles')
@section('body')
<div class="d-flex justify-content-between mb-3">
    <h1>Articles</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary">Create New Article</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Category</th>
            <th>Author</th>
            <th>Image</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $article->title }}</td>
            <td>{{ $article->category->name }}</td>
            <td>{{ $article->user->name }}</td>
            <td>
                @if ($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" width="100">
                @else
                    <span>No image</span>
                @endif
            </td>

            <td>{{ $article->created_at->format('Y-m-d') }}</td>
            <td>
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $articles->links() }}
@endsection
