@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <a class="btn btn-outline-dark" href="/booking/">Back To list</a><br><br>
            <div class="card">
                <div class="card-header">
                    <div class="float-md-right">
                        @if ($booking->status == "pending")
                            <a href="#" class="btn btn-outline-warning" style="cursor:default;">
                                Pending
                            </a>
                        @elseif($booking->status == "diterima")
                            <a href="#" class="btn btn-outline-success" style="cursor:default;">
                                Diterima
                            </a>
                        @else
                            <a href="#" class="btn btn-outline-danger" style="cursor:default;">
                                Cancel
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        value="{{ infoUser($booking->user_id)->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Order</label>
                            <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        value="{{ infoProduct($booking->order)->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Date</label>
                            <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        value="{{ $booking->date }}">
                        </div>
                        @if ($booking->status == "diterima" )
                            <p align="center" class="text-black-50">Pembookingan telah diterima</p>
                        @elseif($booking->status == "cancel")
                        <p align="center" class="text-red-50">Pembookingan telah dibatalkan</p>
                        @else
                        <center>
                            <a class="btn btn-outline-danger" data-toggle="modal" data-target="#modalCancel">Batalkan</a>
                            <div class="modal fade" id="modalCancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <label for="pesan" class="col-form-label" style="float: left;">Pesan:</label>
                                    <textarea name="pesan" class="form-control" id="pesan" placeholder="Pesan kenapa pesanan dibatalkan"></textarea>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <a href="/booking/cancel/{{ $booking->id }}" class="btn btn-danger">Cancel</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <a href="/booking/done/{{ $booking->id }}" class="btn btn-outline-success">Diterima</a>
                        </center>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
