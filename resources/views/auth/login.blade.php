@extends('layouts.app')  <!-- Extend the app.blade.php layout -->

@section('content')  <!-- Define content section that will be injected into app.blade.php -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Login') }}</div>

                <div class="card-body">
                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                            <label class="form-check-label" for="remember_me">
                                {{ __('Remember me') }}
                            </label>
                        </div>

                        <!-- Forgot Password & Submit Button -->
                        <div class="d-flex justify-content-between align-items-center">
                            @if (Route::has('password.request'))
                                <a class="text-sm text-muted" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <button type="submit" class="btn btn-primary">
                                {{ __('Log in') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
