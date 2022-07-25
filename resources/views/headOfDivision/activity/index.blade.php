@extends("layouts.main")

@section('title')
Data Kegiatan
@endsection

@section('sidebar')
@include('layouts.headOfDivision-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-md-12 col-sm-12 col-xs-12">
@include('layouts.notif')
    <div class="x_panel">
        <div class="x_title">
            <h4 class="card-title">Kelola Kegiatan</h4>
            <h6>{{\App\Models\Field::getField(auth()->user()->field_id)}}</h6>
            <div class="clearfix"></div>
        </div>
        <table id="tableProgram2" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Indikator</th>
                    <th>Satuan Target</th>
                    <th>Capaian</th>
                    <th>
                        <center>Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $program)
                <tr>
                    <td colspan='6'>
                        <h5>{{$program->program_name}}</h5>
                    </td>
                </tr>
                @foreach($program->getActivity as $activity)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$activity->name}}</td>
                    <td>{{$activity->activity_goal_indicator}}</td>
                    <td>{{$activity->activity_unit_target}}</td>
                    <td class="text-center">0</td>
                    <td class="text-center"><a href="#" class="btn btn-sm btn-success">Manage</a></td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
        <hr>
    </div>
</div>
@endsection

@section('js')
<script>
    $("#tableProgram2").dataTable({
        "autoWidth": false,
        info: false,
        lengthChange: false
    });

    $('#btnTambahPeriode').on('click', function() {
        $('#addProgramModel').modal('show');
    })
</script>
@endsection