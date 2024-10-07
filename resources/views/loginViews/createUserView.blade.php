@extends('layouts.master')

@section('title', 'Music Hub | Create Account')

@section('content')
    <h1>Create Your Account</h1>
    <p>Join Music Hub and discover your favorite bands and albums.</p>

    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.registerUser') }}">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Create a password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
        </div>

        <button type="submit" class="btn login">Create Account</button>
    </form>

    <div class="account-links">
        <a href="{{ route('login') }}" class="btn">Already have an account? Login</a>
    </div>
@endsection
