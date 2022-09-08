@extends('layouts.main')

@section('title')
    Data Program
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
                    <h4 class="card-title">Program {{ session('monthName') }} {{ session('yearName') }}</h4>
                    <h6>{{ $field->name }}</h6>
                    <div class="clearfix"></div>
                </div>
                <table id="tableProgram" class="table table-striped jambo_table table-bordered d-flex tableProgram">
                    <thead>
                        <tr>
                            <th max-widht="5%" class="text-center">No</th>
                            <th max-widht="5%" class="text-center">Nama Program</th>
                            <th>Status</th>
                            <th widht="15%" class="text-center">Kinerja Fisik</th>
                            <th widht="15%" class="text-center">Kinerja Indikator</th>
                            <th widht="15%" class="text-center">Kinerja Keuangan</th>
                            <th widht="25%" colspan=1>
                                <center>Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programs->where('field_id', $field->id) as $program)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $program->program_name }}</td>
                                <td>{!! App\Models\User::getStatusLabel(\App\Models\ProgramOutcome::countPhysicalPerformance($program->id)) !!}
                                <td class="text-center">
                                    {{ \App\Models\ProgramOutcome::countPhysicalPerformance($program->id) }}%
                                </td>
                                <td class="text-center">
                                    {{ \App\Models\ProgramOutcome::countIndicatorPerformance($program->id) }}%
                                </td>
                                <td class="text-center">
                                    {{ \App\Models\Program::countProgramFinance($program->id)['performance'] }}%
                                </td>
                                <td class="text-center">
                                    <a href="/program/{{ $program->id }}/manage-program"
                                        class="btn btn-sm btn-success">Manage</a>

                                </td>
                            </tr>
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
