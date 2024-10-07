@extends('layouts.master')

@section('title', 'Edit Band | Music Hub')

@section('content')
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
@endsection
