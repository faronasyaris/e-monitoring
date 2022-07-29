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
<a href="history.back()">
        < Kembali</a>
<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage Kegiatan</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <p class="text-center">Simple table with project listing with progress and editing options</p>
                    <center><button class="btn btn-primary btn-sm">Tambah Sub Kegiatan</button></center>
                    <!-- start project list -->
                    <table class="table table-striped projects " style="margin-top:10px">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Sub Kegiatan</th>
                          <th>Pelaksana</th>
                          <th>Satuan</th>
                          <th>Target</th>
                          <th>Progress</th>
                          <th>Status</th>
                          <th style="width: 20%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>#</td>
                          <td>
                            <a>Pesamakini Backend UI</a>
                            <br />
                            <small>Created 01.01.2015</small>
                          </td>
                          <td>
                            <ul class="list-inline">
                              <li>
                                <img src="images/user.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="images/user.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="images/user.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="images/user.png" class="avatar" alt="Avatar">
                              </li>
                            </ul>
                          </td>
                          <td>0</td>
                          <td>0</td>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57"></div>
                            </div>
                            <small>57% Complete</small>
                          </td>
                          <td>
                            <button type="button" class="btn btn-success btn-xs">Success</button>
                          </td>
                          <td>
                            <a href="#" class="btn btn-success btn-sm"> Manage </a>
                            
                          </td>
                        </tr>
            
                      </tbody>
                    </table>
                    <!-- end project list -->

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
        lengthChange: false
    });

    $('#btnTambahPeriode').on('click', function() {
        $('#addProgramModel').modal('show');
    })
</script>
@endsection