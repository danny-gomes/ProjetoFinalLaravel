@extends('layouts.master')

@section('title', 'Edit Album | Music Hub')

@section('content')
    <h1>Edit Album</h1>

    <div class="back-btn">
        <a href="{{ route('albums.index') }}" class="btn">Back to Album List</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('albums.update', $album->id) }}" method="POST" enctype="multipart/form-data" class="album-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Album Name:</label>
            <input type="text" id="name" name="title" value="{{ $album->title }}" required>
        </div>

        <div class="form-group">
            <label for="releaseDate">Release Date:</label>
            <input type="date" id="releaseDate" name="release_date" value="{{ \Carbon\Carbon::parse($album->release_date)->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="band_id">Select Band:</label>
            <select id="band_id" name="band_id" required>
                <option value="">-- Select a Band --</option>
                @foreach($bands as $band)
                    <option value="{{ $band->id }}" {{ $album->band_id == $band->id ? 'selected' : '' }}>
                        {{ $band->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Album Cover Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <small>Leave blank if you don't want to change the image.</small>
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Update Album</button>
        </div>
    </form>
@endsection
