@extends('main')

@section('content')

    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Kelas {{$data_matkul['nama']}}</h1>


            <?php 
                if(session('user') != 0){
                    $date = date("Y-m-d"); 
                    $weekday = date('N', strtotime($date));
                    $hari = $data_matkul['hari'] - 1;
                

                // echo $jam_akhir;
                // echo $hari;
                    if($hari == $weekday){
                        $jam = time();
                        $jam_mulai = strtotime($data_matkul['jamAwal']);
                        $jam_akhir = date("H:i", strtotime('+15 minutes', $jam_mulai));

                        if($jam > $jam_akhir && $jam < $jam_mulai){
                            echo '<a href="/absen/'.$data_matkul['id'].'" class="btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> Hadir</a>';
                        }
                    }
                }
                
            ?>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <?php if(session('user') == 2){ ?>
            @foreach ($kuis as $item)
                <?php 
                    date_default_timezone_set('Asia/Jakarta');
                    $now = date("Y-m-d H:i:s");
                    $jam_mulai = $item->tanggal;
                    $jam_akhir = date("Y-m-d H:i:s", strtotime('+15 minutes', strtotime($jam_mulai)));
                    // var_dump($now);
                    // var_dump($jam_mulai);
                    // var_dump($jam_akhir);
                    if($now < $jam_akhir && $now > $jam_mulai){
                        echo '<a href="/mulaiKuis/'.$item->id.'" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Mulai kuis</a>
            <br>
            <br>';
                    }
                ?>
            @endforeach
        <?php } ?>


        <div class="btn-group mb-3" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary" onclick="btnTugas()">Tugas</button>
            <button type="button" class="btn btn-secondary" id="btnJurnal()" onclick="btnJurnal()">E-Jurnal</button>
            <button type="button" class="btn btn-secondary" id="btnMateri()" onclick="btnMateri()">E-Materi</button>
            <button type="button" class="btn btn-secondary" id="btnVideo()" onclick="btnVideo()">E-Video</button>
            <button type="button" class="btn btn-secondary" id="btnKuis()" onclick="btnKuis()">Kuis</button>
        </div>
        <br>
        @if (session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif

        @if (session('danger'))
            <div class="alert alert-danger">
                {{session('danger')}}
            </div>
        @endif
        <!-- Content Row -->
        {{-- <div class="container-fluid"> --}}
            <div class="card shadow mb-4" id="TableJurnal" style="display: none">
                
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">e-Jurnal</h6>
                </div>
                <div class="card-body">
                    <?php if(session('user') < 2){ ?>
                    <a href="/addLibrary/{{$id}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-2"><i
                        class="fas fa-download fa-sm text-white-50"></i> Tambah library</a>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-bordered  dT" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align : center; width: 5%">No</th>
                                    <th style="text-align : center">Judul</th>
                                    <th style="text-align : center">Tipe</th>
                                    <th style="text-align : center; width: 10%">File</th>
                                    <th style="text-align : center">Tanggal Upload</th>
                                    <?php if(session('user') < 2){ ?>
                                    <th style="text-align : center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach ($jurnal as $item)
                                    <tr>
                                        <td><?= $i++?></td>
                                        <td><?= $item->judul?></td>
                                        <td><?= $item->mytipe->tipe ?></td>
                                        <td style="text-align : center">
                                            @if ($item->tipe != 3)
                                                <a href="{{URL::to('library/'.$item->file)}}" target="_blank" type="button" class="btn btn-success btn-sm"><i class="fas fa-file-download"></i></a></td>
                                            @else
                                            <a href="{{$item->file}}" target="_blank" type="button" class="btn btn-success btn-sm"><i class="fab fa-youtube"></i></a></td>
                                            @endif
                                        <td><?= $item->created_at ?></td>
                                        <?php if(session('user') < 2){ ?>
                                        <td style="text-align : center">
                                            <!-- {{-- <a href="editLibrary/{{$item->id}}" type="button" class="btn btn-outline-success"><i class="fas fa-edit"></i></a> --}}
                                            <a href="/deleteLibrary/{{$item->id}}" type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a> -->
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="/editLibrary/{{$item->id}}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="/deleteLibrary/{{$item->id}}" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>     
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4" id="TableMateri" style="display: none">
                
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">e-Materi</h6>
                </div>
                <div class="card-body">
                    <?php if(session('user') < 2){ ?>
                    <a href="/addLibrary/{{$id}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-2"><i
                        class="fas fa-download fa-sm text-white-50"></i> Tambah library</a>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-bordered  dT" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align : center; width: 5%">No</th>
                                    <th style="text-align : center">Judul</th>
                                    <th style="text-align : center">Tipe</th>
                                    <th style="text-align : center; width: 10%">File</th>
                                    <th style="text-align : center">Tanggal Upload</th>
                                    <?php if(session('user') < 2){ ?>
                                    <th style="text-align : center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach ($materi as $item)
                                    <tr>
                                        <td><?= $i++?></td>
                                        <td><?= $item->judul?></td>
                                        <td><?= $item->mytipe->tipe ?></td>
                                        <td style="text-align : center">
                                            @if ($item->tipe != 3)
                                                <a href="{{URL::to('library/'.$item->file)}}" target="_blank" type="button" class="btn btn-success btn-sm"><i class="fas fa-file-download"></i></a></td>
                                            @else
                                            <a href="{{$item->file}}" target="_blank" type="button" class="btn btn-success btn-sm"><i class="fab fa-youtube"></i></a></td>
                                            @endif
                                        <td><?= $item->created_at ?></td>
                                        <?php if(session('user') < 2){ ?>
                                        <td style="text-align : center">
                                            <!-- {{-- <a href="editLibrary/{{$item->id}}" type="button" class="btn btn-outline-success"><i class="fas fa-edit"></i></a> --}}
                                            <a href="/deleteLibrary/{{$item->id}}" type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a> -->
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="/editLibrary/{{$item->id}}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="/deleteLibrary/{{$item->id}}" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>     
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4" id="TableVideo" style="display: none">
                
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">e-Video</h6>
                </div>
                <div class="card-body">
                    <?php if(session('user') < 2){ ?>
                    <a href="/addLibrary/{{$id}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-2"><i
                        class="fas fa-download fa-sm text-white-50"></i> Tambah library</a>
                        <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-bordered dT" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align : center; width: 5%">No</th>
                                    <th style="text-align : center">Judul</th>
                                    <th style="text-align : center">Tipe</th>
                                    <th style="text-align : center; width: 10%">File</th>
                                    <th style="text-align : center">Tanggal Upload</th>
                                    <?php if(session('user') < 2){ ?>
                                    <th style="text-align : center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach ($video as $item)
                                    <tr>
                                        <td><?= $i++?></td>
                                        <td><?= $item->judul?></td>
                                        <td><?= $item->mytipe->tipe ?></td>
                                        <td style="text-align : center">
                                            @if ($item->tipe != 3)
                                                <a href="{{URL::to('library/'.$item->file)}}" target="_blank" type="button" class="btn btn-success btn-sm"><i class="fas fa-file-download"></i></a></td>
                                            @else
                                            <a href="{{$item->file}}" target="_blank" type="button" class="btn btn-success btn-sm"><i class="fab fa-youtube"></i></a></td>
                                            @endif
                                        <td><?= $item->created_at ?></td>
                                        <?php if(session('user') < 2){ ?>
                                        <td style="text-align : center">
                                            <!-- {{-- <a href="editLibrary/{{$item->id}}" type="button" class="btn btn-outline-success"><i class="fas fa-edit"></i></a> --}}
                                            <a href="/deleteLibrary/{{$item->id}}" type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a> -->
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="/editVideo/{{$item->id}}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="/deleteLibrary/{{$item->id}}" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>     
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4" id="TableTugas">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Tugas</h6>
            </div>
                <div class="card-body">
                    <?php if(session('user') < 2){ ?>
                    <a href="/addTugas/{{$id}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-2"><i
                        class="fas fa-download fa-sm text-white-50"></i> Tambah tugas</a>
                        <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-bordered  dT" id="dataTugas" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tipe</th>
                                    <th>Tugas</th>
                                    <th>Deadline</th>
                                    <th>Soal</th>
                                    @if (session('user') == 2)
                                        <th>Nilai</th>
                                    @endif
                                    {{-- <?php if(session('user') < 2){ ?> --}}
                                    <th>Aksi</th>
                                    {{-- <?php } ?> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach ($tugas as $item)
                                    <tr>
                                        <td><?= $i++?></td>
                                        <td><?= $item->tipeTugas->tipe?></td>
                                        <td><?= $item->judul?></td>
                                        <td><?= $item->deadline?></td>
                                        <td class="text-center"><a type="button" class="btn-sm btn-success" href="{{URL::to('tugas/'.$item->file)}}" target="_blank"><?= $item->soal ?><i class="fas fa-file-download"></i></a></td>
                                        
                                        <?php if(session('user') < 2){ ?>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="/detailJawab/{{$id}}/{{$item->id}}" type="button" class="btn btn-info btn-sm"><i class="far fa-calendar-check"></i></a>
                                                <a href="/editTugas/{{$item->id}}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="/deleteTugas/{{$item->id}}" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td >
                                        <?php }else{ ?>
                                            <td class="text-center">
                                                @foreach ($jawaban as $jawab)
                                                    @if ($jawab->id_tugas == $item->id)
                                                        {{$jawab->nilai}}
                                                        @break
                                                    @else
                                                        
                                                    @endif
                                                @endforeach
                                            
                                            </td>
                                            <td class="text-center">
                                                
                                                <?php $cek = false; ?>
                                                @foreach ($jawaban as $jawab)
                                                    @if ($jawab->id_tugas == $item->id)
                                                        <?php $cek=true; ?>
                                                        <?php $file = $jawab->file ?>
                                                        @break
                                                        {{-- @if ($jawab->file != null)
                                                            <a type="button" class="btn-sm btn-primary" href="{{URL::to('jawab_tugas/'.$jawab->file)}}" target="_blank"><i class="fas fa-file-download"></i></a>
                                                            @break
                                                        @endif --}}
                                                        {{-- @elseif(date('Y-m-d H:i:s') > $item->deadline)
                                                            <p style="color: red"><i class="fas fa-times-circle"></i> Terlambat</p> 
                                                        @else
                                                            <button data-toggle="modal" data-target="#exampleModal" data-val="{{$item->id}}" type="button" class="btn btn-info btn-sm"><i class="fas fa-file-import"></i> Kumpulkan</button>
                                                        @endif --}}
                                                    @endif

            
                                                    {{-- @if ($jawab->id_tugas == $item->id)
                                                        <a type="button" class="btn-sm btn-primary" href="{{URL::to('jawab_tugas/'.$jawab->file)}}" target="_blank"><i class="fas fa-file-download"></i></a>
                                                        @break
                                                    @elseif (date('Y-m-d H:i:s') > $item->deadline)
                                                        <p style="color: red"><i class="fas fa-times-circle"></i> Terlambat</p> 
                                                        @break                                        
                                                    @else
                                                        <button data-toggle="modal" data-target="#exampleModal" data-val="{{$item->id}}" type="button" class="btn btn-info btn-sm"><i class="fas fa-file-import"></i> Kumpulkan</button>
                                                    @endif    --}}
                                                @endforeach

                                                @if ($cek)
                                                    <a type="button" class="btn-sm btn-primary" href="{{URL::to('jawab_tugas/'.$file)}}" target="_blank"><i class="fas fa-file-download"></i></a>
                                                @else
                                                    @if(date('Y-m-d H:i:s') > $item->deadline)
                                                        <p style="color: red"><i class="fas fa-times-circle"></i> Terlambat</p> 
                                                    @else
                                                        <button data-toggle="modal" data-target="#exampleModal" data-val="{{$item->id}}" type="button" class="btn btn-info btn-sm"><i class="fas fa-file-import"></i> Kumpulkan</button>
                                                    @endif
                                                @endif
                                                <!-- <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="" type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                    <a href="" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                                </div> -->
                                            </td>
                                        <?php } ?>
                                    </tr>     
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4" id="TableKuis" style="display: none">
                
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kuis</h6>
                </div>
                <div class="card-body">
                    <?php if(session('user') < 2){ ?>
                    <a href="/addKuis/{{$id}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-2"><i
                        class="fas fa-download fa-sm text-white-50"></i> Tambah Kuis</a>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-bordered dT" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align : center; width: 5%">No</th>
                                    <th style="text-align : center">Kuis</th>
                                    {{-- <th style="text-align : center">Status</th> --}}
                                    @if (session('user') == 2)
                                        <th style="text-align : center">Tanggal</th>
                                        <th style="text-align : center">Nilai</th>
                                    @else
                                        <th style="text-align : center">Jadwal</th>
                                        <th style="text-align : center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; $x=0; ?>
                                @foreach ($kuis as $item)
                                    <tr>
                                        <td><?= $i++?></td>
                                        <td><?= $item->kuis?></td>
                                        {{-- <td><?= $item->status ?></td> --}}
                                        @if (session('user') == 2)
                                            <td><?= $item->tanggal ?></td>
                                            <td style="text-align : center"><?= $nilai[$x++] ?></td>
                                        @else
                                            <td><?= $item->tanggal ?></td>
                                            <td style="text-align : center">
                                                <!-- {{-- <a href="editLibrary/{{$item->id}}" type="button" class="btn btn-outline-success"><i class="fas fa-edit"></i></a> --}}
                                                <a href="/deleteLibrary/{{$item->id}}" type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a> -->
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="/nilaiKuis/{{$id}}/{{$item->id}}" type="button" class="btn btn-warning btn-sm"><i class="far fa-calendar-check"></i></a>
                                                    <a href="/detailKuis/{{$item->id}}" type="button" class="btn btn-info btn-sm"><i class="far fa-calendar-check"></i></a>
                                                    <a href="/editKuis/{{$id}}/{{$item->id}}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                    <a href="/deleteKuis/{{$item->id}}" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </td>
                                        @endif
                                        {{-- <td style="text-align : center">
                                            @if ($item->tipe != 3)
                                                <a href="{{URL::to('library/'.$item->file)}}" target="_blank" type="button" class="btn btn-success btn-sm"><i class="fas fa-file-download"></i></a>
                                            @else
                                            <a href="{{$item->file}}" target="_blank" type="button" class="btn btn-success btn-sm"><i class="fab fa-youtube"></i></a>
                                            @endif
                                        </td> --}}
                        
                                        
                                    </tr>     
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
  
            <?php if(session('user') < 2){ ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  dT" id="tableMahasiswa" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach ($data_matakuliah as $item)
                                    @foreach ($item["mahasiswa"] as $mhs)
                                    <tr>
                                        <td><?= $i++?></td>
                                        <td><?= $mhs->nim?></td>
                                        <td><?= $mhs->nama?></td>
                                    </tr>     
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

       

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kumpulkan Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="/jawabTugas" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input style="display: none" name="id" value="" id="simpanId">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="file">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Kumpulkan</button>
                </div>
                </form>
            </div>
            </div>
        </div>
    {{-- </div> --}}

@endsection

@section('script')
 
        $(document).ready(function() {
            $('.dT').DataTable();
        } );

        function btnTugas() {
            document.getElementById("TableTugas").style.display = "block";
            document.getElementById("TableMateri").style.display = "none";
            document.getElementById("TableVideo").style.display = "none";
            document.getElementById("TableJurnal").style.display = "none";
            document.getElementById("TableKuis").style.display = "none";
            
        }

        function btnMateri() {
            document.getElementById("TableTugas").style.display = "none";
            document.getElementById("TableMateri").style.display = "block";
            document.getElementById("TableVideo").style.display = "none";
            document.getElementById("TableJurnal").style.display = "none";
            document.getElementById("TableKuis").style.display = "none";
        }

        function btnVideo() {
            document.getElementById("TableTugas").style.display = "none";
            document.getElementById("TableMateri").style.display = "none";
            document.getElementById("TableVideo").style.display = "block";
            document.getElementById("TableJurnal").style.display = "none";
            document.getElementById("TableKuis").style.display = "none";
        }

        function btnJurnal() {
            document.getElementById("TableTugas").style.display = "none";
            document.getElementById("TableMateri").style.display = "none";
            document.getElementById("TableVideo").style.display = "none";
            document.getElementById("TableJurnal").style.display = "block";
            document.getElementById("TableKuis").style.display = "none";
        }

        function btnKuis() {
            document.getElementById("TableTugas").style.display = "none";
            document.getElementById("TableMateri").style.display = "none";
            document.getElementById("TableVideo").style.display = "none";
            document.getElementById("TableJurnal").style.display = "none";
            document.getElementById("TableKuis").style.display = "block";
        }

        $('#exampleModal').on('show.bs.modal', function (event) {
            var myVal = $(event.relatedTarget).data('val');
            $(this).find("#simpanId").val(myVal);
        });


@endsection

