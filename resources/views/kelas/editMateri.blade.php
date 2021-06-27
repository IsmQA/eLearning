@extends('main')

@section('content')

    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Library</h1>
            
        </div>
        <!-- Content Row -->
        {{-- <div class="container-fluid"> --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Library</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="/editLibrary/{{$library->id}}"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Judul</label>
                          <input type="text" class="form-control" name="judul" value="{{$library->judul}}" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Tipe Library</label>
                          <select class="form-control" id="tipe_library" name="tipe" disabled required>
                            <option value="">-Pilih tipe library-</option>
                            @foreach ($tipe as $item)
                                <option value="{{$item->id}}" <?php if($library->tipe == $item->id){ echo 'selected';} ?>>{{$item->tipe}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group" id="file_input">
                            <label for="exampleFormControlFile1">Upload File</label>
                            <br>
                            <a href="{{URL::to('library/'.$library->file)}}" target="_blank">{{$library->file}}</a> | <label><input type="checkbox" value="true" name="cek"> Ganti</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                        {{-- <div class="form-group" id="link_input" style="display: none">
                            <label for="exampleFormControlInput1">Link Video</label>
                            <input type="url" class="form-control" name="link">
                          </div> --}}
                        <button type="submit" class="btn btn-success btn-sm mt-3">Simpan</button>
                      </form>
                </div>
            </div>
        </div>
    {{-- </div> --}}

@endsection

@section('script')

$(document).ready(function() {
    $('select').on('change', function() {
        
        if(this.value != 3){
            $('#file_input').show();
            $('#link_input').hide();
        }else{
            $('#file_input').hide();
            $('#link_input').show();
        }

        if(this.value == ""){
            $('#file_input').hide();
            $('#link_input').hide();
        }
      });
    
});
    
@endsection
