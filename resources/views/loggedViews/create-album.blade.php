@extends('layouts.master')

@section('title', 'Create Album | Music Hub')

@section('content')
    <h1>Create Album</h1>
    <p>Fill out the form below to add a new album.</p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Album Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="releaseDate">Release Date:</label>
            <input type="date" id="releaseDate" name="release_date" required>
        </div>
        <div class="form-group">
            <label for="band_id">Select Band:</label>
            <select id="band_id" name="band_id" required>
                <option value="">-- Select a Band --</option>
                @foreach($bands as $band)
                    <option value="{{ $band->id }}">{{ $band->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Album Cover Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Add Album</button>
        </div>
    </form>

    <div class="back-link">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Admin Dashboard</a>
    </div>
@endsection
