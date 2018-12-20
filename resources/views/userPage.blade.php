@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <a class="btn btn-outline-dark" href="/home/">Back to Home</a><br><br>
            <div class="card">
                <div class="card-header">
                    <h1 style="display:inline-block;">User</h1>
                </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">cari</span>
                            </div>
                            <input type="text" class="form-control" id="nameSearch" placeholder="ketikan nama user" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <table class="table" id="tableOri">
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
                        <table class="table" id="tableSearch" style="display:none">
                            <thead>
                                <tr>
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="search-tbody">

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
@endsection
@section('javascript')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // function checkSearch(){
    //     var tableSearch = document.getElementById("tableSearch");
    //     var tableOri = document.getElementById("tableOri");

    //     setTimeout(checkSearch, 2500);
    // }
    // checkSearch();
    document.getElementById("nameSearch").addEventListener("keyup", searchUser);
    function searchUser(){
        var tableSearch = document.getElementById("tableSearch");
        var tableOri = document.getElementById("tableOri");
        $( "#search-tbody" ).empty();
        if(document.getElementById("nameSearch").value.length == 0){
            tableOri.style.display = "";
            tableSearch.style.display = "none";
            $('.pagination').css('display','');
        }else{
            tableOri.style.display = "none";
            tableSearch.style.display = "";
            $('.pagination').css('display','none');
            var someUrl = "/api/search/"+document.getElementById("nameSearch").value;
            $.ajax({
                type:"GET",
                url: someUrl,
                success: function(data) {
                    $.each(data, function(index, element) {
                        if(element.avatar != null && element.avatar.substr(0, 4) != "http"){
                            imageCheck = '<td><img class="img-thumbnail" width="70" src="/img/avatar/'+ element.avatar +'" ></td>';
                        }else{
                            imageCheck = '<td><img class="img-thumbnail" width="70" src="'+ element.avatar +'" ></td>';
                        }
                        var html = '<tr>'+imageCheck+'<td>'+ element.name +'</td><td>'+ element.email +'</td><td>'+ element.phone +'</td><td><a href="/user/edit/'+ element.id +'" class="btn btn-dark">edit</a></td></tr>'
                        $('#search-tbody').append(html);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                },
                dataType: "json"
            });
        }
    }
});
</script>
@endsection
