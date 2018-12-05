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
                    <!-- {!! Form::open(['url' => 'product/update', 'method' => 'POST', 'files' => true]) !!}
                    {{ Form::token() }} -->
                    <input type="hidden" name="id" value="{{ $teraphis->id }}">
                    <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Isikan nama product" value="{{ $teraphis->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Libur</label>
                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="5">{{ $teraphis->libur }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="note">Ruangan</label>
                        <textarea name="note" class="form-control" id="note" rows="3">{{ $teraphis->ruangan }}</textarea>
                    </div>
                    <div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning">Simpan</button>
                        </div>
                    </div>
                    <!-- {!! Form::close() !!} -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
