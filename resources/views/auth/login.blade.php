@extends('auth.layouts.main')
@section('title', 'Login | ' . config('app.name'))
@section('content')
    <h4 class="mb-2">Welcome to {{ config('app.name') }}! 👋</h4>
    <p class="mb-4">Please sign-in to your account and start the adventure</p>

    @if (session('message'))
        <div class="alert alert-danger">{{ session('message') }}</div>
    @endif

    <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                placeholder="Enter your username" autofocus value="{{ old('username') }}" />
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember_me" @checked(old('remember_me'))
                    name="remember_me" value="true" />
                <label class="form-check-label" for="remember_me"> Remember Me </label>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
        </div>
    </form>

    <p class="text-center">
        <span>New on our platform?</span>
        <a href="{{ route('register') }}">
            <span>Create an account</span>
        </a>
    </p>
    </div>
    </div>
@endsection
