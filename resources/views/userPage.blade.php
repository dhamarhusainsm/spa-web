@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"> <h1>User</h1></div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Image</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ $bookings }} --}}
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->avatar }}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    <a href="/user/edit/{{$user->id}}" class="btn btn-warning">edit</a>&nbsp;&nbsp;&nbsp;
                                    @if ($user->role != 0)
                                    <a href="/user/block/{{$user->id}}" class="btn btn-danger">block</a>
                                    @else
                                    <a href="/user/unblock/{{$user->id}}" class="btn btn-danger">unblock</a>
                                    @endif
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
