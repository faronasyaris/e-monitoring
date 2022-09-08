@extends('layouts.main')

@section('title')
    Data Kegiatan
@endsection

@section('sidebar')
    @include('layouts.headOfDepartement-sidebar')
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('layouts.notif')
        @foreach ($fields as $field)
            <div class="x_panel">
                <div class="x_title">
                    <h4 class="card-title">Kegiatan {{ session('monthName') }} {{ session('yearName') }}</h4>
                    <h6>{{ $field->name }}</h6>
                    <div class="clearfix"></div>
                </div>
                <table id="tableProgram2" class="table table-bordered tableProgram ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Status</th>
                            <th>Kinerja Fisik</th>
                            <th>Kinerja Indikator</th>
                            <th>Kinerja Keuangan</th>
                            <th colspan=1>
                                <center>Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programs->where('field_id', $field->id) as $program)
                            <tr style="background-color: #ededed; ">
                                <td colspan="8">
                                    <label> Program : {{ $program->program_name }}</label>
                                </td>
                            </tr>
                            @if ($activities->count() > 0)
                                @foreach ($activities->toQuery()->where('program_id', $program->id)->get() as $activity)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $activity->activity_name }}</td>
                                        <td>{!! App\Models\User::getStatusLabel(\App\Models\ActivityOutcome::countPhysicalPerformance($activity->id)) !!}

                                        <td class="text-center">
                                            {{ \App\Models\ActivityOutcome::countPhysicalPerformance($activity->id) }}%</td>
                                        <td class="text-center">
                                            {{ \App\Models\ActivityOutcome::countIndicatorPerformance($activity->id) }}%
                                        </td>
                                        <td class="text-center">
                                            {{ \App\Models\Activity::countActivityFinance($activity->id)['performance'] }}%
                                        </td>
                                        <td class="text-center">
                                            <a href="/kegiatan/{{ $activity->id }}/manage-kegiatan"
                                                class="btn btn-sm btn-success">Manage</a>

                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        @endforeach

                    </tbody>
                </table>

            </div>
        @endforeach
    </div>
@endsection

@section('js')
    <script>
        $(".tableProgram").dataTable({
            "autoWidth": false,
            info: false,
            lengthChange: false
        });
    </script>
@endsection
