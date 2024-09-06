@extends('layouts.backend_master')
@section('title','Edit Category')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Category Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Category
                <a class="btn btn-primary" href="{{route('backend.category.create')}}">Create</a>
                <a class="btn btn-primary" href="{{route('backend.category.index')}}">List</a>
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('backend.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                  
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter title" value="{{ $category->title }}">
                        @include('backend.includes.form_element_error', ['field' => 'title'])
                    </div>
                    <div class="form-group">
                        <label for="rank">Rank</label>
                        <input type="number" name="rank" class="form-control" placeholder="Enter rank" value="{{ $category->rank }}">
                        @include('backend.includes.form_element_error', ['field' => 'rank'])
                    </div>
                    <div class="form-group">
                        <label for="icon_file">Icon</label>
                        <input type="file" name="icon_file" class="form-control">
                        @include('backend.includes.form_element_error', ['field' => 'icon_file'])
                        <img src="{{ asset('assets/images/category/' . $category->icon) }}" width="100px" height="100px" alt="">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="radio" name="status" value="1" {{ $category->status == 1 ? 'checked' : '' }}> Active
                        <input type="radio" name="status" value="0" {{ $category->status == 0 ? 'checked' : '' }}> Deactive
                        @include('backend.includes.form_element_error', ['field' => 'status'])
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Update">
                        <input type="reset" class="btn btn-danger" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
