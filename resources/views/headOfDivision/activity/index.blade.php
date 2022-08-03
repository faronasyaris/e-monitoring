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
        <table id="tableProgram2" class="table jambo_table table-bordered ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Satuan Target</th>
                    <th>Jumlah Target</th>
                    <th class="text-center">Capaian</th>
                    <th>
                        <center>Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $program)
                <tr>
                    <th colspan='6' style="background-color: rgba(0,0,0,.05)">
                        <h5>{{$program->program_name}}</h5>
                    </th>
                </tr>
                @foreach($program->getActivity as $activity)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$activity->name}}</td>
                    <td>{{$activity->activity_unit_target}}</td>
                    <td class="">{{$activity->activity_unit_target == 'persen' ? '100%' : $activity->getSubActivity->sum('target').' dokumen' }}</td>
                    <td class="text-center">0</td>
                    <td class="text-center"><a href="/kegiatan/{{$activity->id}}/manage-kegiatan" class="btn btn-sm btn-success">Manage</a></td>
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