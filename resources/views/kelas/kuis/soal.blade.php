@extends('main')

@section('content')

    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Soal</h1>
            
        </div>
        <!-- Content Row -->
        {{-- <div class="container-fluid"> --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Soal</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="/addSoal/{{$id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Soal</label>
                          <input type="text" class="form-control" name="soal">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Waktu</label>
                            <input type="number" class="form-control" name="waktu" placeholder="Dalam menit ...">
                          </div>
                        <button type="submit" class="btn btn-success btn-sm mt-3">Simpan</button>
                      </form>
                </div>
            </div>
        </div>
    {{-- </div> --}}

@endsection