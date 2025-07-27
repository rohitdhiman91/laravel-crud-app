@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Post</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div>
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required>
        </div><br>

        <div>
            <label for="content">Content:</label><br>
            <textarea id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
        </div><br>

        <button type="submit">Create Post</button>
    </form>
</div>
@endsection
