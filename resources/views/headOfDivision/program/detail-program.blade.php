@extends("layouts.main")

@section('title')
Data Program
@endsection

@section('sidebar')
@include('layouts.headOfDivision-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-md-12 col-sm-12 col-xs-12">
@include('layouts.notif')
<a href="/program"> < Kembali</a>
    <div class="x_panel" style="margin-top:10px">
        <div class="x_title">
            <h4 class="card-title">Manage Program (Rincian Outcome)</h4>
            <div class="clearfix"></div>
        </div>
        <table id="tableProgram" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Deskripsi</th>
                    <th>Satuan</th>
                    <th>Target</th>
                    <th>
                        <center>Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($program->getProgramIndicator as $indicator)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$indicator->description}}</td>
                  <td>{{$indicator->unit}}</td>
                  <td>{{$indicator->progress}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <button class="btn btn-primary " style="float:right"> <i class="fa fa-user-plus"></i> Tambah Outcome</button>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h4 class="card-title">Manage Kegiatan</h4>
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
            </tbody>
        </table>
        <hr>
        <a href="/program/{{$program->id}}/tambah-kegiatan" class="btn btn-primary " style="float:right"> <i class="fa fa-user-plus"></i> Tambah Kegiatan</a>
    </div>
</div>

@endsection

@section('js')
<script>
      $("#tableProgram").dataTable({
        "autoWidth": false,
        info: false,
        lengthChange: false
    });
    
    $("#tableProgram2").dataTable({
        "autoWidth": false,
        info: false,
        lengthChange: false
    });
    $('#btnTambahPeriode').on('click',function(){
        $('#addProgramModel').modal('show');
    })
</script>
@endsection
