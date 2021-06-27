@extends('main')

@section('content')

    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Kelas</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>
        <!-- Content Row -->
        {{-- <div class="container-fluid"> --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Terisi</th>
                                    <th>Hari</th>
                                    <th>Jam Awal</th>
                                    <th>Jam Akhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach ($data_matakuliah as $item)
                                    @if (session('user') == 2)
                                        @foreach ($matkul as $x)
                                            @if ($x['id_kelas'] == $item['id'])
                                                <tr>
                                                    <td><?= $i++?></td>
                                                    <td><?= $item["nama"]?></td>
                                                    <td><?= $item["terisi"]?></td>
                                                    <td><?= hari($item["hari"])?></td>
                                                    <td><?= $item["jamAwal"]?></td>
                                                    <td><?= $item["jamAkhir"]?></td>
                                                    <td><a href="/kelas/<?= $item["id"]?>" type="button" class="btn btn-info btn-sm">Detail</a></td>
                                                </tr>
                                            @endif  
                                        @endforeach
                                    @else
                                        <tr>
                                            <td><?= $i++?></td>
                                            <td><?= $item["nama"]?></td>
                                            <td><?= $item["terisi"]?></td>
                                            <td><?= hari($item["hari"])?></td>
                                            <td><?= $item["jamAwal"]?></td>
                                            <td><?= $item["jamAkhir"]?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="/kelas/<?= $item["id"]?>" type="button" class="btn btn-info btn-sm">Detail</a>
                                                    <a href="/dftrHadir/<?= $item["id"]?>" type="button" class="btn btn-success btn-sm">Daftar Hadir</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                
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
