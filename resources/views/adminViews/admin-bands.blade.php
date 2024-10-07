<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bands | Music Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bands.css') }}">
</head>
<body>
<div class="container">
    <h1>Manage Bands</h1>

    <div class="back-btn">
        <a href="{{ route('admin.dashboard') }}" class="btn">Back to Admin Dashboard</a>
    </div>

    @foreach($bands as $band)
        <div class="band-card">
            <img src="{{ asset('storage/' . $band->image) }}" alt="{{ $band->name }}" class="band-image">
            <div class="band-info">
                <h2>{{ $band->name }}</h2>
                <p>Albums Produced: {{ $band->albums_count }}</p>
            </div>
            <div class="band-actions">
                <a href="{{ route('bands.edit', $band->id) }}" class="btn">Edit</a>
                <a href="{{ route('albums.index', ['band_id' => $band->id]) }}" class="btn">View Albums</a>
                <form action="{{ route('bands.destroy', $band->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
    @endforeach

    @if($bands->isEmpty())
        <p>No bands found. Please add some!</p>
    @endif
</div>
</body>
</html>
