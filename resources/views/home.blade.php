@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">User</div>
                    <div class="card-body" class="">
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
                                        <td><a href="/user/{{$user->id}}" class="btn btn-primary">Info</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="/user">More</a>
                    </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking</div>
                <div class="card-body" class="">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">order</th>
                                <th scope="col">date</th>
                                <th scope="col">status</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ $bookings }} --}}
                            @foreach ($bookings as $booking)
                            <tr>
                                    <th scope="row">{{$booking->id}}</th>
                                    <td>{{ infoUser($booking->user_id)->name }}</td>
                                    <td>
                                        @foreach (explode(',', $booking->order) as $item)
                                            {{ infoProduct($item)->name }},
                                        @endforeach
                                    </td>
                                    <td>{{$booking->date}}</td>
                                    <td>{{$booking->status}}</td>
                                    <td><a href="/booking/{{$booking->id}}" class="btn btn-primary">Info</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="/booking">More</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
