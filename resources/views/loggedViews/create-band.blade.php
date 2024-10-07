@extends('layouts.master')

@section('title', 'Add New Band')

@section('content')
    <h1 class="text-center mb-4">Add New Band</h1>
    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('bands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Band Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter band name" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Band Image</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Add Band</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Admin Dashboard</a>
        </div>
    </form>
@endsection
