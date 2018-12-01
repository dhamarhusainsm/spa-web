@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-md-center">
<div class="col-xs-7 col-md-7 col-sm-7">
        <a class="btn btn-outline-dark" href="/home/">Back To home</a><br><br>
        <br><br>
    <div class="card">
        <div class="card-header">
            <h1>Available Time</h1>
        </div>
        <div class="card-body">
        <hr>
            {!! Form::open(['url' => 'date', 'method' => 'POST', 'files' => true]) !!}
            {{ Form::token() }}
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" required name="date" id="date" class="form-control">
            </div>
            <div class="form-group">
                <label for="time">Jam</label>
                <select id="selectTime" class="form-control" name="time" id="time">
                    <option selected="selected" value="08:00:00">08:00</option>
                    <option value="09:00:00">09:00</option>
                    <option value="10:00:00">10:00</option>
                    <option value="11:00:00">11:00</option>
                    <option value="12:00:00">12:00</option>
                    <option value="13:00:00">13:00</option>
                    <option value="14:00:00">14:00</option>
                    <option value="15:00:00">15:00</option>
                    <option value="16:00:00">16:00</option>
                </select>
            </div>
            <div class="form-group">
                <label for="descReason">Alasan</label>
                <textarea name="description" class="form-control" id="reason" rows="5" placeholder="Alasan Tutup" required></textarea>
            </div>
            <center><button type="submit" id="oke" class="btn btn-primary" style="width:240px;">Oke</button></center>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center" style="margin-top:10px;">
                    <h2 id="txtDate" style="display:inline; margin-right:30px;"></h2>
                    <h2 id="txtTime" style="display:inline;"></h2>
                    </div>
                </div>
                </div>
            </div>
            {!! Form::close() !!}
            <br><br>
            <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">date</th>
                        <th scope="col">status</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                    <tr>
                        <th scope="row">{{$result->id}}</th>
                        <td>{{$result->date}}</td>
                        <td>tidak tersedia</td>
                        <td>{{ $result->reason }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#date').on('input',function(){
        var valu = $('#date').val();
        $('#txtDate').html(valu);
    });
     $('#selectTime').change(function(){
         var valu = $('#selectTime').val();
         $('#txtTime').html(valu);
    });
});
</script>
@endsection
