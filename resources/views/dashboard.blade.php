@extends('layouts.main')

@section('container')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Dashboard -->
    <div class="row">

        <!-- Evidence Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cnt_user }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Evidence Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Gejala</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cnt_gejala }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fingerprint fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Penyakit </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cnt_penyakit }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-lightbulb fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Kasus </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cnt_kasus }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-search fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-8 mb-4">
            <!-- Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Riwayat diagnosa sistem pakar</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Diagnosa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_kasus as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date_format($item->created_at, 'd/m/Y') }}</td>
                                    <td>{{ $item->pasien->nama }}</td>
                                    <td>{{ $item->penyakit->nama }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success">Chart Case Diagnosis</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2 text-center d-flex flex-row align-items-center justify-content-between">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<!-- Page level custom scripts -->
<script src="{{ asset('assets/js/chart.js')}}"></script>
<script>
    const ctx = document.getElementById('myPieChart');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                @foreach($data_penyakit as $item)
                "{{ $item->nama }}",
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($data_penyakit as $item)
                        {{ $cnt_kasus_crt->where('penyakit_id',$item->id)->count() }},
                    @endforeach
                ],
                backgroundColor: [
                    '#00b115',
                    '#00a56f',
                    '#009b8b',
                    '#0099ad',
                    '#008fa3',
                    '#006ca3',
                ],
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            }]
        }
    });
</script>
@endsection