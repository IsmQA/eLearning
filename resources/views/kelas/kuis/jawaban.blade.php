@extends('main')

@section('content')

    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Jawaban Kuis {{$nim}}</h1>
            
        </div>
        <!-- Content Row -->
        {{-- <div class="container-fluid"> --}}
            <form method="post" action="/jawabanKuis" enctype="multipart/form-data">
                @csrf
                <?php $i = 0; ?>
                @foreach ($soal as $item)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{$item->soal}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleFormControlInput1"></label>
                            <input name="soal[]" value="{{$item->id}}" style="display: none">
                            <textarea class="summernote" id="summernote" name="jawaban[]" rows="10" disabled>{{$jawaban[$i++]}}</textarea> 
                        </div>
                    </div>
                </div>
                @endforeach
                <button type="submit" class="btn btn-success btn-sm mt-3">Simpan</button>
            </form>
        </div>
    {{-- </div> --}}

@endsection

@section('script')
    $(document).ready(function() {
      $('.summernote').summernote({
        height: "300px",
        styleWithSpan: false
      });
    }); 

@endsection