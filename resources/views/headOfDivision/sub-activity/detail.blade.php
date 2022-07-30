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
                    <h2>Deskripsi Sub Kegiatan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="panel-body">
                    <h3 class="green"><i class="fa fa-list-alt"></i> Sub Kegiatan</h3>
                    <p>{{$sub->name}}</p>
                    <br>
                    <div class="project_detail">
                    <p class="title">Indikator</p>
                      <p>{{$sub->indicator}}</p>
                    <p class="title">Satuan</p>
                      <p>{{$sub->unit_target}}</p>
                      <p class="title">Target</p>
                      <p>{{$sub->target}} {{$sub->unit_target}}</p>
                      <p class="title">Progress</p>
                      <p>0%</p>
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

                <h4>Submission File</h4>
                <table class="table table-striped projects tableProgram2" id="tableProgram2" style="margin-top:10px">
                  <thead>
                    <tr>
                      <th style="width: 1%">#</th>
                      <th style="width: 20%">Judul</th>
                      <th>Pelaksana</th>
                      <th>Tanggal Upload</th>
                      <th>Status</th>
                      <th style="width: 20%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>
                <h4>Rincian Output</h4>
                <a href="" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Tambah Output</a>
                <table class="table table-striped projects tableProgram2" id="" style="margin-top:10px">
                  <thead>
                    <tr>
                      <th style="width: 1%">#</th>
                      <th style="width: 20%">Deskripsi</th>
                      <th style="width: 20%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sub->getSubActivityOutput as $activity)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$activity->description}}</td>
                            <td>
                    <a href="" class="btn btn-sm btn-warning">Edit</a>
                    <a href="" class="btn btn-sm btn-danger">Delete</a>

                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>

                <h4>Pelaksana</h4>
                <a href="" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Tambah Pelaksana</a>
                <table class="table table-striped projects tableProgram2" id="tableProgram2" style="margin-top:10px">
                  <thead>
                    <tr>
                      <th style="width: 1%">#</th>
                      <th style="width: 20%">Pelaksana</th>
                      <th style="width: 20%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sub->getSubActivityWorker as $worker)
                        <td>{{$loop->iteration}}</td>
                        <td>{{$worker->getUser->name}}</td>
                        <td>
                    <a href="" class="btn btn-sm btn-danger">Delete</a>
                        </td>
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
        $(".tableProgram2").dataTable({
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