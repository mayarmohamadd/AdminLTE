@extends('admin.partials.main-layout')
@section('title', 'show Article')
@section('body')
    <div class="container">
        <h1>{{ $article->title }}</h1>
        <p>{{ $article->content }}</p>

        @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" width="200">
        @endif

        <p>Category: {{ $article->category->name }}</p>
        <p>Author: {{ $article->user->name }}</p>
    </div>
@endsection
