@extends('layouts.app')

@section('content')
<div>
    <a href="{{ route('posts.create') }}">+ New Post</a>
    @foreach ($posts as $post)
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
        <a href="{{ route('posts.edit', $post) }}">Edit</a>
        <form action="{{ route('posts.destroy', $post) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endforeach
</div>
@endsection