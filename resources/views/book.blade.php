@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <a class="btn btn-outline-dark" href="/home/">Back To home</a><br><br>
            <div class="card">
                <div class="card-header"> <h1>Booking</h1></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Order</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php setlocale(LC_TIME, "IND"); ?>
                            @foreach($bookings as $key => $booking)
                                <tr @if($booking->created_at->format('Y-m-d') == date('Y-m-d')) style="color:#18dcff;" @elseif($booking->status == "cancel") style="color:#e84118" @endif>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ DB::table('users')->where('id',$booking->user_id)->first()->name }}</td>
                                    <td>{{ DB::table('products')->where('id',$booking->order)->first()->name }}</td>
                                    <td>{{ strftime("%A, %B %d %Y. %H:%M", strtotime($booking->date)) }}</td>
                                    <td>{{ $booking->status}}</td>
                                    <td>
                                        <a class="btn btn-outline-dark" href="/booking/{{$booking->id}}">Info</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                {{$bookings -> links()}}
            </div>
        </div>
    </div>
</div>
@endsection
