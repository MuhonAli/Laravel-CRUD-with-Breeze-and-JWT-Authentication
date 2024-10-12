@extends('layouts.app')  <!-- Extending the app layout -->

@section('content')  <!-- Define the content section -->

<div class="container">
    <h1 class="my-4">Edit User</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit form -->
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password (Leave blank if not changing)</label>
            <input type="password" name="password" class="form-control">
        </div>
<br>
        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to User List</a>
    </form>
</div>

@endsection  <!-- End of content section -->
