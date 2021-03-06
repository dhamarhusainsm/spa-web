@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <a class="btn btn-outline-dark" href="/product/">Back To list</a><br><br>
            <div class="card">
                <div class="card-header">
                    <h4>Product baru</h4>
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => 'product', 'method' => 'POST', 'files' => true]) !!}
                    {{ Form::token() }}
                    <br>
                    <div class="form-group">
                        <input name="image" required type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Isikan nama product" value="">
                    </div>
                    <div class="form-group">
                        <label for="time">Category</label>
                        <select id="selectTime" class="form-control" name="cat" id="cat">
                            <option value="package_treatment">Package Treatment</option>
                            <option value="ala_carte_treatment">Ala Carte Treatment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Deskripsi</label>
                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea type="text" name="note" class="form-control" id="note"
                            placeholder="Isikan Ketentuan yang Harus Dibawa Pelanggan" rows="3"></textarea>
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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection
