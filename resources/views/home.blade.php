@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-10">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="user-tab" data-toggle="pill" href="#users-tab" role="tab" aria-controls="users-tab" aria-selected="true">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="booking-tab" data-toggle="pill" href="#bookings-tab" role="tab" aria-controls="bookings-tab" aria-selected="false">Bookings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/date" >Atur Jadwal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/product" >Produk Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/price" >Price Management</a>
          </li>
        </ul>
      </div>
  </div>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="users-tab" role="tabpanel" aria-labelledby="users-tab">
      <div class="row justify-content-center">
          <div class="col-md-10">
              <div class="card">
                  <div class="card-header"><h1>User Management</h1></div>
                  <div class="card-body" class="">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">E-mail</th>
                                  <th scope="col">Phone</th>
                                  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              {{-- {{ $bookings }} --}}
                              @foreach ($users as $key => $user)
                                <tr @if($user->created_at->format('Y-m-d') == date('Y-m-d')) style="color: #44bd32;" @endif>
                                    <th scope="row">{{++$key}}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{$user->phone}}</td>
                                    <td><a class="btn btn-dark" style="width:120px;" href="/user/edit/{{$user->id}}">Info</a></td>
                                </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                  <div class="card-footer">
                      <a style="font-weight:bold;font-size:23px;"  href="/user">More</a>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="tab-pane fade" id="bookings-tab" role="tabpanel" aria-labelledby="bookings-tab">
      <div class="row justify-content-center">
          <div class="col-md-10">
              <div class="card">
                  <div class="card-header"><h1>Booking Management</h1></div>
                  <div class="card-body" class="">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">name</th>
                                  <th scope="col">order</th>
                                  <th scope="col">date</th>
                                  <th scope="col">status</th>
                                  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              {{-- {{ $bookings }} --}}
                              @foreach ($bookings as $key => $booking)
                              <tr @if($booking->created_at->format('Y-m-d') == date('Y-m-d')) style="color:#18dcff;" @elseif($booking->status == "cancel") style="color:#e84118" @endif>
                                  <th scope="row">{{++$key}}</th>
                                  <td>{{ DB::table('users')->where('id',$booking->user_id)->first()->name }}</td>
                                  <td>{{$booking->order}}</td>
                                  <td>{{$booking->date}}</td>
                                  <td>{{$booking->status}}</td>
                                  <td><a class="btn btn-dark" style="width:120px;" href="/booking/{{$booking->id}}">Info</a></td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                  <div class="card-footer">
                      <a style="font-weight:bold;font-size:23px;" href="/booking">More</a>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
  <br>
</div>
@endsection
