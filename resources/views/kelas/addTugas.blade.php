@extends('main')

@section('content')

    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Tugas</h1>
            
        </div>
        <!-- Content Row -->
        {{-- <div class="container-fluid"> --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tugas</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="/addTugas/{{$id}}"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Tugas</label>
                          <input type="text" class="form-control" name="tugas">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Tipe Tugas</label>
                          <select class="form-control" id="tipe_library" name="tipe" required>
                            <option value="">-Pilih tipe tugas-</option>
                            @foreach ($tipe_tugas as $item)
                                <option value="{{$item->id}}">{{$item->tipe}}</option> 
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload File</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Deadline</label>
                            <input type="date" class="form-control datetimepicker" name="tanggal" required> 
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Waktu</label>
                            <input type="time" class="form-control datetimepicker" name="waktu" required> 
                        </div>
                        <button type="submit" class="btn btn-success btn-sm mt-3">Simpan</button>
                      </form>
                </div>
            </div>
        </div>
    {{-- </div> --}}

@endsection