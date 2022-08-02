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
    <a href="/program">
        < Kembali</a>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3  ">
                                <section class="panel">
                                    <div class="x_title">
                                        <h2>Deskripsi Program</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class="green"><i class="fa fa-clipboard"></i> Program</h3>

                                        <p>{{$program->program_name}}</p>
                                        <br />

                                        <div class="project_detail">

                                            <p class="title">Kinerja Indikator</p>
                                            <p>0%</p>
                                            <p class="title">Jumlah Kegiatan</p>
                                            <p>0</p>
                                            <p class="title">Progress Kegiatan</p>
                                            <p>0%</p>
                                        </div>
                                        <br />
                                        <br />
                                        <div class="text-center mtop20">
                                            <a href="#" id="editProgramButton" data-id='{{$program->id}}' data-name='{{$program->program_name}}' class="btn btn-sm btn-warning">Edit Nama</a>
                                            <a href="#" id="deleteProgramButton" data-id='{{$program->id}}' class="btn btn-sm btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-9 col-sm-9  ">
                                <h4>Manage Program (Rincian Outcome)</h4>
                                <button class="btn btn-primary btn-sm "> <i class="fa fa-plus"></i> Tambah Outcome</button>
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
                                <h4>Manage Kegiatan</h4>
                                <a href="/program/{{$program->id}}/tambah-kegiatan" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Tambah Kegiatan</a>
                                <table id="tableProgram2" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Satuan Target</th>
                                            <th>Jumlah Target</th>
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
                                            <td>{{$activity->activity_unit_target}}</td>
                                            <td></td>
                                            <td class="text-center">0</td>

                                            <td class="text-center"><a href="/kegiatan/{{$activity->id}}/manage-kegiatan" class="btn btn-sm btn-success">Manage</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal edit program --}}
            <div class="modal fade" id="editProgramModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Edit Program</h4>
                        </div>
                        <form method="post" id="editProgramForm">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="" class="form-label">Nama Program</label>
                                    <input type="text" id="program_name" name="program_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- modal confirm delete program --}}
            <div class="modal fade" id="deleteProgramModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Apakah Anda Yakin ?</h4>
                        </div>
                        <div class="modal-body">
                            Data yang dihapus tidak dapat dikembalikan!!
                        </div>
                        <div class="modal-footer">
                            <button type="button" style="display: inline" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form style="display: inline" id="deleteProgramForm" method="POST">
                                @method('delete')
                                @csrf
                                <button style="display: inline" button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>


@endsection

@section('js')
<script>
    $("#tableProgram").dataTable({
        "autoWidth": false,
        info: false,
        lengthChange: false,
        searching : false,
    });

    $("#tableProgram2").dataTable({
        "autoWidth": false,
        info: false,
        lengthChange: false,
        searching : false,
    });
    $('#btnTambahPeriode').on('click', function() {
        $('#addProgramModel').modal('show');
    })

    $(document).on('click', '#editProgramButton', function(){
        $('#editProgramModal').modal('show');
        $('#program_name').val($(this).attr('data-name'));
        var data_id = $(this).attr('data-id');
        var url = '/program/' + data_id;
        $('#editProgramForm').attr('action', url);
    });

    $(document).on('click', '#deleteProgramButton', function(){
        $('#deleteProgramModal').modal('show');
        var data_id = $(this).attr('data-id');
        var url = '/program/' + data_id;
        $('#deleteProgramForm').attr('action', url);
    });
</script>
@endsection