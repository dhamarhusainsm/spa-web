@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <a class="btn btn-outline-dark" href="/home/">Back to Home</a><br><br>
            <div class="card">
                <div class="card-header"> <h1>User</h1></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Avatar</th>
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
                                    <td>
                                    @if (substr($user->avatar, 0, 4)!="http")
                                    <img class="img-thumbnail" width="50" src="/img/avatar/{{ $user->avatar }}" alt="">
                                    @else
                                    <img class="img-thumbnail" width="50" src="{{ $user->avatar }}" alt="">
                                    @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <a href="/user/edit/{{$user->id}}" class="btn btn-dark">edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(#btnBlock).click(function(){
    alert("Block User ?");
});
</script>
@endsection
