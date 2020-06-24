@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="h1">User Management</p>
            <hr>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9"><h4>Data User</h4></div>
                        <div class="col-md-3">
                            <div class="float-right">
                            <a href="{{ route('insert-user') }}" type="button" class="btn btn-primary">Insert</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <a href="/edit-user/{{ $user->id }}" type="button" class="btn btn-success">Edit</a>
                                    <a href="/delete-user/{{ $user->id }}" type="button" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection