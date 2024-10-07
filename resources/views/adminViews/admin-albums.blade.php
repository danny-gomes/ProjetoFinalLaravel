<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Albums | Music Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bands.css') }}">
</head>
<body>
<div class="container">
    <h1>Manage Albums</h1>

    <div class="back-btn">
        <a href="{{ route('admin.dashboard') }}" class="btn">Back to Admin Dashboard</a>
    </div>

    <div class="search-container">
        <form action="{{ route('albums.index') }}" method="GET">
            <input type="text" name="search" placeholder="Search by band name..." value="{{ request()->get('search') }}" required>
            <button type="submit" class="btn">Search</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($albums->isEmpty())
        <p>No albums found. Please add some!</p>
    @else
        @foreach($albums as $album)
            <div class="band-card">
                <img src="{{ asset('storage/' . $album->image) }}" alt="{{ $album->title }}" class="band-image">
                <div class="band-info">
                    <h2>{{ $album->title }}</h2>
                    <p>Release Date: {{ \Carbon\Carbon::parse($album->release_date)->format('F j, Y') }}</p>
                    <p>Band: {{ $album->band->name }}</p>
                </div>
                <div class="band-actions">
                    <a href="{{ route('albums.edit', $album->id) }}" class="btn">Edit</a>
                    <form action="{{ route('albums.destroy', $album->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
</body>
</html>
