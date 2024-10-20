@extends('layouts.app')  <!-- Extend the app.blade.php layout -->

@section('content')  <!-- Define content section that will be injected into app.blade.php -->

<div class="container mt-5">
        <h2 class="text-center mb-4">Edit WordPress Post</h2>

        <!-- Form to update post -->
        <form method="POST" action="{{ route('updatePost', ['id' => $post['id']]) }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post['title']['rendered'] }}" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Post Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ $post['content']['rendered'] }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Post</button>
        </form>
    </div>

@endsection  <!-- End of content section -->



