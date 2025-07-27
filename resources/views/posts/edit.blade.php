@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Post</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>
        </div><br>

        <div>
            <label for="content">Content:</label><br>
            <textarea id="content" name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
        </div><br>

        <button type="submit">Update Post</button>
    </form>
</div>
@endsection
