@extends('layouts.main')

@section('title')
    Data Sub Kegiatan
@endsection

@section('sidebar')
    @include('layouts.headOfDivision-sidebar')
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('layouts.notif')
        <div class="x_panel">
            <div class="x_title">
                <h4 class="card-title">Kelola Sub Kegiatan {{ session('monthName') }} {{ session('yearName') }}</h4>
                <h6>{{ \App\Models\Field::getField(auth()->user()->field_id) }}</h6>
                <div class="clearfix"></div>
            </div>
            <table id="tableProgram2" class="table table-bordered  ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Kinerja Fisik</th>
                        <th>Kinerja Indikator</th>
                        <th>Kinerja Keuangan</th>
                        <th colspan=3>
                            <center>Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $program)
                        <tr style="background-color: #9abcc3; color:white ">
                            <td colspan="8">
                                <label> Program : {{ $program->program_name }}</label>
                            </td>
                        </tr>
                        @foreach ($activities as $activity)
                            <tr style="background-color: #8fc7db; color:white ">
                                <td colspan="8">
                                    <label> Kegiatan : {{ $activity->activity_name }}</label>
                                </td>
                            </tr>
                            @if ($activities->count() > 0)
                                @foreach ($activities->toQuery()->where('program_id', $program->id)->get() as $activity)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $activity->activity_name }}</td>
                                        <td>0</td>
                                        <td> {{ \App\Models\ActivityOutcome::countIndicatorPerformance($activity->id) }}%
                                        </td>
                                        <td>0</td>
                                        <td class="text-center">
                                            <a href="/kegiatan/{{ $activity->id }}/manage-kegiatan"
                                                class="btn btn-sm btn-success">Manage</a>

                                        </td>
                                        <td class="text-center">
                                            <a href="/kegiatan/{{ $activity->id }}/manage-kegiatan"
                                                class="btn btn-sm btn-warning">Edit</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="/kegiatan/{{ $activity->id }}/manage-kegiatan"
                                                class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    @endforeach

                </tbody>
            </table>
            <hr>
            {{-- @if (session('month') >= date('m')) --}}
            <button class="btn btn-primary " style="float:right" id="btnTambahPeriode" data-toggle="modal"
                data-target="#addActivityModal"> <i class="fa fa-plus"></i>
                Tambah Sub Kegiatan</button>
            {{-- @endif --}}
            <hr>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#tableKegiatan").dataTable({
            "autoWidth": false,
            info: false,
            lengthChange: false
        });

        $('#btnTambahPeriode').on('click', function() {
            $('#addProgramModel').modal('show');
        })
    </script>
@endsection
