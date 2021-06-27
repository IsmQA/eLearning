@extends('main')

@section('content')

    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Kuis</h1>
            
        </div>
        <!-- Content Row -->
        {{-- <div class="container-fluid"> --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Kuis</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="/editKuis/{{$id}}/{{$kuis->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Kuis</label>
                          <input type="text" class="form-control" name="kuis" value="{{$kuis->kuis}}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Jadwal Kuis</label>
                            <input type="date" class="form-control datetimepicker" name="tanggal" value="{{date('Y-m-d',strtotime($kuis->tanggal))}}" required> 
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Waktu</label>
                            <input type="time" class="form-control datetimepicker" name="waktu" value="{{date('H:s',strtotime($kuis->tanggal))}}" required> 
                        </div>
                        <button type="submit" class="btn btn-success btn-sm mt-3">Simpan</button>
                      </form>
                </div>
            </div>
        </div>
    {{-- </div> --}}

@endsection