@extends('layouts.app')  <!-- Extend the app.blade.php layout -->

@section('content')  <!-- Define content section that will be injected into app.blade.php -->

<div class="container">
    <h2>Create User</h2>
    <!-- Updated form with Bootstrap styling -->
    <form method="POST" action="{{ route('postToWordPress') }}">
            @csrf <!-- CSRF token for form security -->
            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Post Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>

        <!-- Optional: Add success or error message -->
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif
    
</div>

@endsection 



