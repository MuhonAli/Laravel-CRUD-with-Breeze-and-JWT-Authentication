@extends('layouts.app')  <!-- Extend the app.blade.php layout -->

@section('content')  <!-- Define content section that will be injected into app.blade.php -->

<div class="container mt-5">
        <h2 class="text-center mb-4">{{ $post['title']['rendered'] }}</h2>

        <div class="card">
            <div class="card-body">
                <p class="card-text">{!! $post['content']['rendered'] !!}</p>
            </div>
        </div>

        <a href="{{ route('wordpressPosts') }}" class="btn btn-secondary mt-4">Back to Posts</a>
    </div>

@endsection  <!-- End of content section -->



