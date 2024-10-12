@extends('layouts.app')  <!-- Extend the app.blade.php layout -->

@section('content')  <!-- Define content section that will be injected into app.blade.php -->

<div class="container">
    <h1 class="my-4">Users List</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Link to create a new user -->
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New User</a>

    <!-- Users Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <!-- Delete Form -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection  <!-- End of content section -->
