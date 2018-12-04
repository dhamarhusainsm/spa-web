@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <a class="btn btn-outline-dark" href="/user/">Back To list</a><br><br>
        <br><br>
            <div class="card">
                <div class="card-header">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/user/block/{{ $user->id }}" type="button" class=" float-right btn btn-danger btn-outline-danger">
                            @if ($user->role!=0)
                            Block
                            @else
                            Unblock
                            @endif
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => 'user/edit', 'method' => 'POST', 'files' => true]) !!}
                    {{ Form::token() }}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <center>
                        @if (substr($user->avatar, 0, 4)!="http")
                            <img class="img-thumbnail" src="/img/avatar/{{ $user->avatar }}" alt="">
                        @else
                            <img class="img-thumbnail" src="{{ $user->avatar }}" alt="">
                        @endif
                    </center>
                    <br>
                    <div class="form-group">
                        <input name="avatar" type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Isikan nama user" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Isikan Email"
                            value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Isikan no hp"
                            value="{{ $user->phone }}">
                    </div>
                    <div>
                        <a href="../" class="btn btn-outline-info">Batal</a>
                        <button type="submit" class="btn btn-warning">Simpan</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection
