@extends('main')

@section('content')

    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">List Daftar Hadir</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>
        <!-- Content Row -->
        {{-- <div class="container-fluid"> --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List Daftar Hadir</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach ($data_mhs as $item)
                                    <tr>
                                        <td><?= $i++?></td>
                                        <td><?= $item->nama?></td>
                                        <td><?= $item->nim?></td>
                                        <td>
                                            <?php $cek = false; ?>
                                            @foreach ($absensi as $x)
                                                @if ($x->id_user == $item->nim)
                                                    <?php 
                                                        $cek = true;
                                                        break; 
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if ($cek)
                                                Hadir
                                            @else
                                                Tidak Hadir
                                            @endif
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

@endsection

@section('script')
    <script>
        $(document).ready(function() {
        $('#dataTable').DataTable();
    } );
    </script>
@endsection
