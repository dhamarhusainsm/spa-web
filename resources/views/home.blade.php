@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List User</div>

                <div class="card-body">
                <ul class="list-group">
                @foreach($users as $user)
                    <li class="list-group-item">{{ $user -> name }}</li>
                @endforeach
                </ul>
                </div>
            </div>
            <button type="button" class="btn btn-primary" style="margin-top: 10px; float: right;">More ...</button>
        </div>
    </div>
</div>
@endsection
