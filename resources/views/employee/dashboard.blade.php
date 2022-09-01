@extends('layouts.main')

@section('title')
    Dashboard
@endsection

@section('sidebar')
    @include('layouts.employee-sidebar')
@endsection

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-12">
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
        <div class="col-md-6 col-sm-6 col-xs-12">
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

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h5>Total Anggaran</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content ">
                    <div style="text-align: center; margin-bottom: 17px;">
                        <h1 style=" line-height: 110px;" class="green">
                            Rp{{ number_format($totalBudget, 0, '', '.') }}
                            </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <h5>Total Realisasi Anggaran</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content ">
                    <div style="text-align: center; margin-bottom: 17px;">
                        <h1 style=" line-height: 110px;" class="green">
                            Rp{{ number_format($totalRealization, 0, '', '.') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('js')
@endsection
