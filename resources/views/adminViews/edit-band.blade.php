<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Band | Music Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bands.css') }}">
</head>
<body>
<div class="container">
    <h1>Edit Band</h1>

    <div class="back-btn">
        <a href="{{ route('bands.index') }}" class="btn">Back to Bands List</a>
    </div>

    <form action="{{ route('bands.update', $band->id) }}" method="POST" enctype="multipart/form-data" class="album-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Band Name:</label>
            <input type="text" id="name" name="name" value="{{ $band->name }}" required>
        </div>

        <div class="form-group">
            <label for="image">Band Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <small>Current image:</small>
            <img src="{{ asset('storage/' . $band->image) }}" alt="{{ $band->name }}" style="width: 100px; height: auto; margin-top: 10px;">
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Update Band</button>
        </div>
    </form>
</div>
</body>
</html>
