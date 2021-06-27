@extends('main')

@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">e-Raport</h1>
            <a href="/cetak/{{$id}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> e-Raport</a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">e-Raport Mahasiswa NIM {{$id}}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Matakuliah</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach ($matkul as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item["nama"]}}</td>
                                    <td>
                                        <?php 
                                            $total_tugas = 0;    
                                        ?>
                                        @foreach ($tugas as $t)
                                            <?php 
                                                $rata2 = 0;
                                            ?>
                                            @if ($t->id_kelas == $item["id_kelas"])
                                                @foreach ($nilai as $n)
                                                    @if ($n->id_tugas == $t->id)
                                                        <?php $rata2 = $rata2 + $n->nilai ?>
                                                    @endif
                                                @endforeach
                                                <?php 
                                                    $total_tugas = $total_tugas + 1; 
                                                ?>
                                            @endif
          
                                        @endforeach
                                        @if ($total_tugas != 0)
                                            <?php 
                                                $nilai_akhir = $rata2/$total_tugas;
                                            ?>
                                            {{round($nilai_akhir, 3)}}
                                        @else
                                            0     
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
@endsection

{{-- @section('script')
    <script>
        $(document).ready(function() {
        $('#dataTable').DataTable();
    } );
    </script>
@endsection --}}
