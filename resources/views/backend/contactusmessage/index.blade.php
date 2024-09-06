@extends('layouts.backend_master')
@section('title', 'Contact Messages')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Contact Us Messages</h1>
        
        <!-- Flash Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Messages</h6>
            </div>
            <div class="card-body">
                @include('backend.includes.flash_message')
                <table class="table table-bordered">
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                    @forelse($messages as $message)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>{{ $message->message }}</td>
                            <td>
                                <form style="display: inline-block" method="POST" action="{{ route('backend.contactusmessage.destroy', $message->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"><span class="text-danger">No messages found</span></td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
