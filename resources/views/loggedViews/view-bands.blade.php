@extends('layouts.master')

@section('title', 'Manage Bands | Music Hub')

@section('content')
    <h1>Manage Bands</h1>

    <div class="back-btn">
        <a href="{{ route('dashboard') }}" class="btn">Back to Dashboard</a>
    </div>

    @foreach($bands as $band)
        <div class="band-card">
            <img src="{{ asset('storage/' . $band->image) }}" alt="{{ $band->name }}" class="band-image">
            <div class="band-info">
                <h2>{{ $band->name }}</h2>
                <p>Albums Produced: {{ $band->albums_count }}</p>
            </div>

            <div class="band-actions">
                @if (Auth::check())
                    <a href="{{ route('bands.edit', $band->id) }}" class="btn">Edit</a>
                @endif
                <a href="{{ route('albums.index', ['band_id' => $band->id]) }}" class="btn">View Albums</a>
                @if (Auth::check() && Auth::user()->role == 'admin')
                    <form action="{{ route('bands.destroy', $band->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach

    @if($bands->isEmpty())
        <p>No bands found. Please add some!</p>
    @endif
@endsection
