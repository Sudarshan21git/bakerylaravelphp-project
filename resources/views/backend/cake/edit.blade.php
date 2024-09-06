@extends('layouts.backend_master')
@section('title', 'Edit Cake Item')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Cake Item</h1>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                Edit Cake Item
            </div>
            <div class="card-body">
                @include('backend.includes.flash_message')
                <form action="{{ route('backend.cake.update', $cake->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="cakeName">Cake Name</label>
                        <input type="text" class="form-control" id="cakeName" name="name" value="{{ old('name', $cake->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="cakeCategory">Category</label>
                        <select class="form-control" id="cakeCategory" name="category_id" required>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $cake->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cakePrice">Price</label>
                        <input type="number" step="0.01" class="form-control" id="cakePrice" name="price" value="{{ old('price', $cake->price) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="cakeImage">Image</label>
                        <input type="file" class="form-control" id="cakeImage" name="cake_image">
                        @if ($cake->img)
                        <img src="{{ asset('assets/images/CakeItems/' . $cake->img) }}" width="50" height="50">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Update Cake Item</button>
                    <a href="{{ route('backend.cake.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
