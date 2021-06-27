@extends('main')

@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profil</h1>
            <?php if(session('user') == 2){ ?>
                <a href="/raport/{{session('nim')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> e-Raport</a>
            <?php } ?>

            <?php if(session('user') == 0){ ?>
                <a href="ubahProfil" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Ubah Profil</a>
            <?php } ?>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
            </div>
            <div class="container mt-3 mb-3" >
                <div class="row">
                    <div class="col-3">
                        @if (session('thumbnail')==null)
                        <img class="img-profile rounded-circle" src="{{ asset('img/avatar.jpg') }}" style="width: 100%">
                    @else
                        <?php $link_foto = str_replace('\/', '/', session('thumbnail')); ?>
                        <img class="img-profile rounded-circle" src="https://api.unira.ac.id/{{$link_foto}}" style="width: 100%">
                    @endif
                    </div>
                    <div class="col-9">
                        {{-- <img class="img-profile rounded-circle" src="https://api.unira.ac.id/{{$link_foto}}" style="width: 20%"> --}}
                        <table class="table table-striped">
                            <tbody>
                              <tr>
                                @if (session('user') == 2)
                                    <td style="width: 10%">NIM</td>
                                    <td style="width: 5%">:</td>
                                    <td>{{session('nim')}}</td>
                                @elseif(session('user') == 1)
                                    <td style="width: 10%">NIS</td>
                                    <td style="width: 5%">:</td>
                                    <td>{{session('nim')}}</td>
                                @else
                                    <td style="width: 10%">Username</td>
                                    <td style="width: 5%">:</td>
                                    <td>{{session('data')->username}}</td>
                                @endif
                                
                              </tr>
                              <tr>
                                <td style="width: 10%">Nama</td>
                                <td style="width: 5%">:</td>
                                <td>{{session('nama')}}</td>
                              </tr>
                              <tr>
                                <td style="width: 10%">Alamat</td>
                                <td style="width: 5%">:</td>
                                <td>{{session('alamat')}}</td>
                              </tr>
                            </tbody>
                          </table>  
                    </div>
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
