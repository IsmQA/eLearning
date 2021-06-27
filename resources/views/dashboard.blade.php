@extends('main')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>
        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Dosen</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$tot_dosen}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Mahasiswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$tot_mhs}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->


            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Jumlah Kelas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$tot_matkul}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-8">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Rata-rata nilai mahasiswa masing-masing kelas</h6>
                        <div class="dropdown no-arrow">
                            {{-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a> --}}
                                {{-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div> --}}
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myChart" style="width:100%;max-width:100%; max-height : 100%"></canvas>
                            {{-- <canvas id="myAreaChart"></canvas> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Jumlah mahasiswa perkelas</h6>
                        <div class="dropdown no-arrow">
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2" style="justify-content: center">
                            <canvas id="myPieChart" style="width:100%;max-width:100%; max-height : 100%;"></canvas>
                            {{-- <canvas id="myPieChart"></canvas> --}}
                        </div>
                        
                    </div>
                </div>
            </div>  

            <!-- Pie Chart -->
            
        </div>

        <div class="row">
            
        </div>

        <!-- Content Row -->
        

    </div>
    @endsection
    
@section('script')
    var matkul = <?php echo json_encode($matkul)?>;
    var terisi = <?php echo json_encode($terisi)?>;
    var rata2 = <?php echo json_encode($rata2)?>;
    var warna = <?php echo json_encode($warna)?>;

    var xValues = matkul;
    var yValues = rata2;
    var barColors = warna;

    new Chart("myChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: barColors,
            data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
            display: true,
            text: "Nilai Rata-rata Kelas"
        },
        scales: {
            xAxes: [{
                ticks: {
                    display: false
                }
            }]
        }
    }
    });

    

    var xValues1 = matkul;
    var yValues1 = terisi;
    var barColors1 = warna;

    new Chart("myPieChart", {
    type: "doughnut",
    data: {
        labels: xValues1,
        datasets: [{
        backgroundColor: barColors1,
        data: yValues1
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "Jumlah Mahasiswa Setiap Kelas"
        }
    }
    });
@endsection