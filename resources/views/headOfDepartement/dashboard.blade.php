@extends('layouts.main')

@section('title')
    Dashboard
@endsection

@section('sidebar')
    @include('layouts.headOfDepartement-sidebar')
@endsection

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h5>Total Program</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content ">
                    <div style="text-align: center; margin-bottom: 17px;">
                        <h1 style=" line-height: 110px;"> {{ $programs->count() }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h5>Total Kegiatan</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content ">
                    <div style="text-align: center; margin-bottom: 17px;">
                        <h1 style=" line-height: 110px;"> {{ $activities->count() }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h5>Total Sub Kegiatan</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content ">
                    <div style="text-align: center; margin-bottom: 17px;">
                        <h1 style=" line-height: 110px;"> {{ $subActivities->count() }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h5>Total Anggaran</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content ">
                    <div style="text-align: center; margin-bottom: 17px;">
                        <h3 style=" line-height: 110px;" class="green"> Rp{{ number_format($totalBudget, 0, '', '.') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h5>Total Realisasi Anggaran</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content ">
                    <div style="text-align: center; margin-bottom: 17px;">
                        <h3 style=" line-height: 110px;" class="green">
                            Rp{{ number_format($totalRealization, 0, '', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h5>Bulan & Tahun</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content ">
                    <div style="text-align: center; margin-bottom: 17px;">
                        <h3 style=" line-height: 110px;"> <i class="fa fa-calendar"></i>
                            {{ session('monthName') . ' ' . session('yearName') }}</h3>
                    </div>
                </div>
            </div>
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
