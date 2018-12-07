@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <a class="btn btn-outline-dark" href="/teraphis/">Back To list</a><br><br>
            <div class="card">
                <div class="card-header">
                    <div class="float-md-right">
                      <a class="btn btn-outline-danger" data-toggle="modal" data-target="#modalDelete">Delete</a>
                        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Hapus Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h1>Yakin ingin menghapus <b>{{ $teraphis->nama }}</b> ?</h1>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <a href="#" class="btn btn-danger">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => 'teraphis/update', 'method' => 'POST', 'files' => true]) !!}
                    {{ Form::token() }}
                    <input type="hidden" name="id" value="{{ $teraphis->id }}">
                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Isikan nama product" value="{{ $teraphis->nama }}">
                    </div>
                    <div class="form-group">
                      <label for="selectHari">Hari Libur</label><br>
                      <select id="selectTime" class="form-control" name="libur">
                          <option selected="selected" value="Senin">Senin</option>
                          <option value="Selasa">Selasa</option>
                          <option value="Rabu">Rabu</option>
                          <option value="Kamis">Kamis</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label>Spesialis</label><br>
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
</div>
@endsection
