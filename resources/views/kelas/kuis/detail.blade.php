@extends('main')

@section('content')

    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Kuis</h1>
            <a href="/addSoal/{{$id}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus-square fa-sm text-white-50"></i> Tambah Soal</a>
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
                    <h6 class="m-0 font-weight-bold text-primary">Data soal kuis</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th style="width: 50%">Soal</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($soal as $item)
                                <tr>
                                    <td><?= $i++?></td>
                                    <td><?= $item->soal?></td>
                                    <td><?= $item->waktu?> menit</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            {{-- <a href="/detailKuis/{{$item->id}}" type="button" class="btn btn-info btn-sm"><i class="far fa-calendar-check"></i></a> --}}
                                            <a href="/editSoal/{{$id}}/{{$item->id}}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="/deleteSoal/{{$item->id}}" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}

    <div class="container-fluid">

@endsection

@section('script')
    <script>
        $(document).ready(function() {
        $('#dataTable').DataTable();
    } );
    </script>
@endsection
