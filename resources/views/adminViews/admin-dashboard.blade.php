<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Music Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
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

</div>
</body>
</html>
