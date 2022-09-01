@extends('layouts.main')

@section('title')
    Dashboard
@endsection

@section('sidebar')
    @include('layouts.secretary-sidebar')
@endsection

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel tile">
            <div class="x_title">
                <h3>Dashboard</h3>
                <div class="clearfix"></div>
            </div>
            <div class="row tile_count">
                <div class="col-md-4 col-sm-12 col-xs-12 tile_stats_count text-center mt-2">
                    <span class="count_top"><i class="fa fa-calendar"></i> Tanggal Hari Ini</span>
                    <div class="count green">
                        <h4 class="mt-2">
                            {{ date('d F Y') }}</h4>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12 tile_stats_count text-center mt-2">
                    <span class="count_top"><i class="fa fa-user"></i> Total User</span>
                    <div class="count">{{ $users->count() }}</div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12 tile_stats_count text-center mt-2">
                    <span class="count_top"><i class="fa fa-calen"></i> Total Periode</span>
                    <div class="count">{{ $period->count() }}</div>
                </div>

            </div>
            <div class="clearfix"></div>
            <hr>
            <table id="tableProgram" class="table table-striped jambo_table table-bordered d-flex">
                <thead>
                    <tr>
                        <th max-widht="5%" class="text-center">No</th>
                        <th max-widht="5%" class="text-center">Nama Bidang</th>
                        <th widht="15%" class="text-center">Jumlah User</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Bidang Pemanfaatan dan Pengendalian Sumberdaya Perikanan</td>
                        <td>{{ $users->where('field_id', 1)->count() }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Bidang Produksi, Prasarana dan Sarana Peternakan</td>
                        <td>{{ $users->where('field_id', 2)->count() }}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            Bidang Kesehatan Hewan, Ikan, Kesmavet dan P2HP</td>
                        <td>{{ $users->where('field_id', 3)->count() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        chartDashboard('penyuluhan_fieldstaff', '#455C73');
        chartDashboard('pemetaan_fieldstaff', '#3498DB');
        chartDashboard('penyusunanModel_fieldstaff', '#9B59B6');
        chartDashboard('pendampingan_fieldstaff', '#26B99A');
        chartDashboard('penyusunanData_fieldstaff', '#BDC3C7');

        function chartDashboard(id, warna) {

            if (typeof($.fn.easyPieChart) === 'undefined') {
                return;
            }
            // console.log('chartDashboard');

            $('#' + id).easyPieChart({
                easing: 'easeOutElastic',
                delay: 3000,
                barColor: warna,
                trackColor: '#eceff3',
                scaleColor: false,
                lineWidth: 20,
                trackWidth: 16,
                lineCap: 'butt',
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent) + "%");
                }
            });

        };
    </script>
@endsection


@section('js')
@endsection
