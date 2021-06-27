@extends('main')

@section('content')

    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Dosen</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>
        <!-- Content Row -->
        {{-- <div class="container-fluid"> --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Dosen</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Ijazah Terakhir</th>
                                    <th>Alamat</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach ($data_dokar as $item)
                                <tr>
                                    <td><?= $i++?></td>
                                    <td><?= $item->nama?></td> 
                                    <td><?= $item->nis?></td> 
                                    <td><?= $item->ijazahTerakhir?></td> 
                                    <td><?= $item->alamat?></td> 
                                    {{-- <td><a href="" type="button" class="btn btn-info btn-sm">Detail</a></td> --}}
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
