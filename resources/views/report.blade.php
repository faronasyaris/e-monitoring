@extends('layouts.main')

@section('title')
    Laporan
@endsection

@section('sidebar')
    @include('layouts.headOfDivision-sidebar')
@endsection

@section('content')
    @include('sweetalert::alert')
    @include('layouts.notif')


    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4 class="card-title">Pilih Jenis Laporan</h4>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <select name=""id="jenis" class="form-control">
                    <option disabled selected>Pilih Laporan</option>
                    <option value="program">Laporan Program</option>
                    <option value="kegiatan">Laporan Kegiatan</option>
                    <option value="subKegiatan">Laporan Sub Kegiatan</option>
                </select>
            </div>
            <button class="btn btn-primary mt-2" id="report" style="float: right">Pilih</button>

        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel tile">
            <div class="x_title">
                <h5>Bulan & Tahun Laporan</h5>
                <div class="clearfix"></div>
            </div>
            <div class="x_content ">
                <div style="text-align: center">
                    <h3 style=" line-height: 55px;"> <i class="fa fa-calendar"></i>
                        {{ session('monthName') . ' ' . session('yearName') }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h5>Hasil</h5>
                <div class="clearfix"></div>
            </div>
            @if (Request::get('report') == 'program')
                <table id="tableProgram" class="table table-striped table-bordered d-flex">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center" style="  vertical-align: middle;">No</th>
                            <th rowspan="2" class="text-center" style="  vertical-align: middle;">Program</th>
                            <th colspan="3" class="text-center" style="  vertical-align: middle;">Keuangan</th>
                            <th rowspan="2" class="text-center" style="  vertical-align: middle;">Fisik %</th>
                            <th rowspan="2" class="text-center" style="  vertical-align: middle;">Kinerja Indikator %
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">Anggaran</th>
                            <th class="text-center">Realisasi</th>
                            <th class="text-center">Kinerja%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programs as $program)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $program->program_name }}</td>
                                <td>Rp{{ number_format(\App\Models\Program::countProgramFinance($program->id)['totalBudget'], 0, '', '.') }}
                                </td>
                                <td>Rp{{ number_format(\App\Models\Program::countProgramFinance($program->id)['totalFinance'], 0, '', '.') }}
                                </td>
                                <td>{{ \App\Models\Program::countProgramFinance($program->id)['performance'] }}%</td>
                                <td>{{ \App\Models\ProgramOutcome::countPhysicalPerformance($program->id) }}%</td>
                                <td>{{ \App\Models\ProgramOutcome::countIndicatorPerformance($program->id) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif(Request::get('report') == 'kegiatan')
                <table id="tableProgram" class="table table-striped table-bordered d-flex">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center" style="  vertical-align: middle;">No</th>
                            <th rowspan="2" class="text-center" style="  vertical-align: middle;">Kegiatan</th>
                            <th colspan="3" class="text-center" style="  vertical-align: middle;">Keuangan</th>
                            <th rowspan="2" class="text-center" style="  vertical-align: middle;">Fisik %</th>
                            <th rowspan="2" class="text-center" style="  vertical-align: middle;">Kinerja Indikator %
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">Anggaran</th>
                            <th class="text-center">Realisasi</th>
                            <th class="text-center">Kinerja%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $activity->activity_name }}</td>
                                <td>Rp{{ number_format(\App\Models\Activity::countActivityFinance($activity->id)['totalBudget'], 0, '', '.') }}
                                </td>
                                <td>Rp{{ number_format(\App\Models\Activity::countActivityFinance($activity->id)['totalFinance'], 0, '', '.') }}
                                </td>
                                <td>{{ \App\Models\Activity::countActivityFinance($activity->id)['performance'] }}%</td>
                                <td>{{ \App\Models\ActivityOutcome::countPhysicalPerformance($activity->id) }}%</td>
                                <td> {{ \App\Models\ActivityOutcome::countIndicatorPerformance($activity->id) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif(Request::get('report') == 'subKegiatan')
                <table id="tableProgram" class="table table-striped table-bordered d-flex">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center" style="  vertical-align: middle;">No</th>
                            <th rowspan="2" class="text-center" style="  vertical-align: middle;">Sub Kegiatan</th>
                            <th colspan="3" class="text-center" style="  vertical-align: middle;">Keuangan</th>
                            <th rowspan="2" class="text-center" style="  vertical-align: middle;">Fisik %</th>
                        </tr>
                        <tr>
                            <th class="text-center">Anggaran</th>
                            <th class="text-center">Realisasi</th>
                            <th class="text-center">Kinerja%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subActivities as $subActivity)
                            @php
                                $plotSubActivity = $subActivity->getPlotting->first();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subActivity->sub_activity_name }}</td>
                                <td>Rp{{ number_format($plotSubActivity->budget, 0, '', '.') }}
                                </td>
                                <td>Rp{{ number_format($plotSubActivity->finance_realization, 0, '', '.') }}
                                </td>
                                <td>{{ \App\Models\PlottingSubActivity::countFinancePerformance($plotSubActivity) }}%</td>
                                <td> {{ \App\Models\SubActivityOutput::countIndicatorPerformance($subActivity->id) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <hr>
            @if (!empty(Request::get('report')))
                <form action="/report/download" method="post">
                    @csrf
                    <input type="hidden" value="{{ Request::get('report') }}" name="report">
                    <button class="btn btn-primary" style="float: right"> <i class="fa fa-print"></i> Cetak</button>
                </form>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).on('click', '#report', function() {
            window.location.replace("/report?report=" + $('#jenis').val());
        })
    </script>
@endsection
