@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <a class="btn btn-outline-dark" href="/teraphis">Back To list</a><br><br>
            <div class="card">
                <div class="card-header">
                    <h4>Teraphis baru</h4>
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => 'teraphis', 'method' => 'POST']) !!}
                    {{ Form::token() }}
                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Isikan nama teraphis" value="">
                    </div>
                    <div class="form-group">
                        <label for="selectHari">Hari Libur</label><br>

                        <select id="selectTime" class="form-control" name="libur">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                        </select>
                    </div>

                    <div class="form-group">
                      @foreach($products as $product)
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" name="spesialis[]" class="custom-control-input" id="{{ $product->name }}" value="{{ $product->name }}">
                        <label class="custom-control-label" for="{{ $product->name }}">{{ $product->name }}</label>
                      </div>
                      @endforeach

                    </div>

                    <div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning">Simpan</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
