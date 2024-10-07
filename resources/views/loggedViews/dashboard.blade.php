@extends('layouts.master')

@section('title', 'Admin Dashboard | Music Hub')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (Auth::user()->role == 'admin')
        <h1>Admin Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }}! Manage bands and albums below.</p>
        <div class="admin-actions">
            <a href="{{ route('bands.create') }}" class="btn">Add Band</a>
            <a href="{{ route('albums.create') }}" class="btn">Add Album</a>
        </div>

        <div class="admin-actions">
            <a href="{{ route('bands.index') }}" class="btn">Manage Bands</a>
            <a href="{{ route('albums.index') }}" class="btn">Manage Albums</a>
        </div>
    @else
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>Explore the available bands and albums below.</p>
        <div class="user-actions">
            <a href="{{ route('bands.index') }}" class="btn">View Bands</a>
            <a href="{{ route('albums.index') }}" class="btn">View Albums</a>
        </div>
    @endif

    <div class="logout-action">
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn">Logout</button>
        </form>
    </div>
@endsection
