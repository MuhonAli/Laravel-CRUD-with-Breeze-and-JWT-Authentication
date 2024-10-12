@extends('layouts.app')  <!-- Extend the app.blade.php layout -->

@section('content')  <!-- Define content section that will be injected into app.blade.php -->

<div class="container">
    <h2>Create User</h2>
    <!-- Updated form with Bootstrap styling -->
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create User</button>
    </form>
</div>

@endsection  <!-- End of content section -->



