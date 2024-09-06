@extends('layouts.backend_master')
@section('title','Create Category')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Category Management</h1>
        <!-- Your content goes here -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create category
                <a class="btn btn-primary" href="{{route('backend.category.index')}}">List</a>
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('backend.category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter title" value="{{ old('title') }}">
                        @include('backend.includes.form_element_error', ['field' => 'title'])
                    </div>
                    <div class="form-group">
                        <label for="rank">Rank</label>
                        <input type="number" name="rank" class="form-control" placeholder="Enter rank" value="{{ old('rank') }}">
                        @include('backend.includes.form_element_error', ['field' => 'rank'])
                    </div>
                    <div class="form-group">
                        <label for="icon_file">Icon</label>
                        <input type="file" name="icon_file" class="form-control">
                        @include('backend.includes.form_element_error', ['field' => 'icon_file'])
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="radio" name="status" value="1"> Active
                        <input type="radio" name="status" value="0" checked> Deactive
                        @include('backend.includes.form_element_error', ['field' => 'status'])
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Create">
                        <input type="reset" class="btn btn-danger" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
