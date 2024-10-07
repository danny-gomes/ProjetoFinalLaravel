<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Hub | Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <div class="container">
        <h1>Welcome to Music Hub</h1>
        <p>Discover your favorite bands and albums. Login to explore!</p>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('checkLogin') }}">
            @csrf
            <div class="form-group">
                <label for="username">Email</label>
                <input type="email" id="username" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn login">Login</button>
        </form>

        <div class="account-links">
            <a href="{{ route('login.addUserView') }}" class="btn">Create Account</a>
            <a href="" class="btn">Recover Password</a>
        </div>

        <div class="music-theme">
            <i class="fas fa-music" style="font-size: 50px; margin-right: 10px;"></i>
            <i class="fas fa-guitar" style="font-size: 50px;"></i>
        </div>
    </div>
</body>
</html>
