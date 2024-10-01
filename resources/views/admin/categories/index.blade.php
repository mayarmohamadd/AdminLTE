@extends('admin.partials.main-layout')

@section('title', 'Categories')
@section('Page', 'Categories')
@section('main-page', 'Categories')

@section('body')
<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
            <td>{{ $category->name }}</td>
            <td>
                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="d-flex justify-content-center">
    {{ $categories->links('vendor.pagination.simple-bootstrap-4') }}
</div>


@endsection
