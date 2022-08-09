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
  <a href="javascript:void(0)" onclick="history.back()">
    < Kembali</a>
      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_content">
              <div class="col-md-3 col-sm-3  ">
                <section class="panel">
                  <div class="x_title">
                    <h2>Deskripsi Kegiatan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="panel-body">
                    <h3 class="green"><i class="fa fa-list-alt"></i> Kegiatan</h3>
                    <p>{{$activity->name}}</p>
                    <br>
                    <div class="project_detail">
                    <p class="title">Indikator</p>
                      <p>{{$activity->activity_goal_indicator}}</p>
                    <p class="title">Satuan</p>
                      <p>{{$activity->activity_unit_target}}</p>
                      <p class="title">Jumlah Sub Kegiatan</p>
                      <p>{{$activity->getSubActivity->count()}}</p>
                      <p class="title">Progress Kegiatan</p>
                      <p>0</p>
                      <p class="title">Status Kegiatan</p>
                      <p>On Progress</p>
                    </div>
                    <br />
                    <br />
                    <div class="text-center mtop20">
                      <a href="#" class="btn btn-sm btn-warning">Edit</a>
                      <a href="#" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                  </div>
                </section>
              </div>
              <div class="col-md-9 col-sm-9  ">
                <h4> Manage Sub Kegiatan</h4>
                <a href="/kegiatan/{{$activity->id}}/tambah-sub-kegiatan" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Tambah Sub Kegiatan</a>

                <table class="table table-striped projects table-bordered" id="tableProgram2" style="margin-top:10px">
                  <thead>
                   
                    <tr>
                      <th style="width: 1%">#</th>
                      <th style="width: 40%">Sub Kegiatan</th>
                      <th>Satuan</th>
                      <th>Target</th>
                      <th>Capaian</th>
                      <th style="width: 5%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($activity->getSubActivity as $subActivity)
                    <tr>
                      <td>#</td>
                      <td>
                        <p>{{$subActivity->name}}</p>
                      </td>
                      <td>
                        <a href="javascript:void(0)">{{$subActivity->unit_target}}</a>
                      </td>
                      <td>{{$subActivity->target}} {{$subActivity->unit_target}}</td>
                      <td class="project_progress">
                        0
                      </td>
                      <td>
                        <a href="/sub-kegiatan/{{$subActivity->id}}/manage-sub-kegiatan" class="btn btn-success btn-sm"> Manage </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection

      @section('js')
      <script>
        $("#tableProgram2").dataTable({
          "autoWidth": false,
          info: false,
          lengthChange: false,
          searching : false,
        });

        $('#btnTambahPeriode').on('click', function() {
          $('#addProgramModel').modal('show');
        })
      </script>
      @endsection