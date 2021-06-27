@extends('main')

@section('content')

    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Penilaian</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif
        <!-- Content Row -->
        {{-- <div class="container-fluid"> --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Jawaban Tugas</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Jawaban</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach ($matkul as $item)
                                    @foreach ($item["mahasiswa"] as $mhs)
                                    <tr>
                                        <td><?= $i++?></td>
                                        <td><?= $mhs->nama?></td>
                                        <td><?= $mhs->nim?></td>
                                        <td><a href="/jawabanKuis/{{$id}}/{{$mhs->nim}}" target="_blank">Link</a></td>
                                        <td class="text-center">
                                            <?php $cek = false; ?>
                                            @foreach ($nilai as $jawab)
                                                @if ($jawab->id_mhs == $mhs->nim)
                                                    {{$jawab->nilai}}
                                                    <?php $cek = true; ?>
                                                    @break 
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @if (!$cek)
                                                <button data-toggle="modal" data-target="#exampleModal" data-val="{{$mhs->nim}}" type="button" class="btn btn-info btn-sm"><i class="fas fa-file-import"></i> Nilai</button>
                                            @endif
                                        </td>
                                    </tr>     
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nilai Kuis</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="/nilaiKuis/{{$id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="nim" value="" id="simpanId" style="display: none">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Nilai</span>
                        </div>
                        <input type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="nilai">
                    </div>
                
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Nilai</button>
            </div>
            </form>
        </div>
        </div>
    </div>

@endsection

@section('script')

    $(document).ready(function() {
        $('#dataTable').DataTable();
    } );

    $('#exampleModal').on('show.bs.modal', function (event) {
        var myVal = $(event.relatedTarget).data('val');
        $(this).find("#simpanId").val(myVal);
    });
  
@endsection
