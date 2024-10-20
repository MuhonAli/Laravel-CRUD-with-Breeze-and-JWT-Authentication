@extends('layouts.app')  <!-- Extend the app.blade.php layout -->

@section('content')  <!-- Define content section that will be injected into app.blade.php -->

<div class="container mt-5">
    <h2 class="text-center mb-4">WordPress Posts</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Button to create a new post -->
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('createPostForm') }}" class="btn btn-primary">Create New Post</a>
    </div>

    <!-- Table to display posts -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post['id'] }}</td>
                <td>{{ $post['title']['rendered'] }}</td>
                <td>
                    <a href="{{ route('viewPost', ['id' => $post['id']]) }}" class="btn btn-info">View</a>
                    <a href="{{ route('editPost', ['id' => $post['id']]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('deletePost', ['id' => $post['id']]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection  <!-- End of content section -->
