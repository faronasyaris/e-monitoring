@extends("layouts.main")

@section('title')
Sub Kegiatan
@endsection

@section('sidebar')
@include('layouts.employee-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-md-12 col-sm-12 col-xs-12">
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
                                            <p class="title">Program</p>
                                            <p>{{$sub->indicator}}</p>
                                            <p class="title">Kegiatan</p>
                                            <p>{{$sub->indicator}}</p>
                                            <hr>
                                            <p class="title">Indikator</p>
                                            <p>{{$sub->indicator}}</p>
                                            <p class="title">Satuan</p>
                                            <p>{{$sub->unit_target}}</p>
                                            <p class="title">Target</p>
                                            <p>{{$sub->target}} {{$sub->unit_target}}</p>
                                            <p class="title">Progress</p>
                                            <p>0%</p>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-9 col-sm-9  ">
                                @include('layouts.notif')
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
                                        @foreach($sub->getSubActivitySubmission as $submission)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$submission->title}}</td>
                                                <td>{{$submission->getWorker->name}}</td>
                                                <td>{{date('d F Y',strtotime($submission->created_at))}}</td>
                                                <td>{{\App\Models\SubActivitySubmission::getStatusLabel($submission->status)}}</td>
                                                <td>
                                                   @if($submission->status == 0)<button class="btn btn-sm btn-danger">Batalkan</button> @endif
                                                    <button class="btn btn-sm btn-success">Lihat File</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <h4>Rincian Output</h4>
                                <table class="table table-striped projects tableProgram2" id="" style="margin-top:10px">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">#</th>
                                            <th style="width: 20%">Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sub->getSubActivityOutput as $activity)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$activity->description}}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <h4>Submit Progress</h4>
                                <form  method="post" action="/sub-kegiatan/submit-progress" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{$sub->id}}" name="id" required>
                                <div class="form-group">
                                    <label for="">Judul</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">File</label>
                                    <input type="file" name="file" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" style="float:right">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>


<div class="modal fade" id="addProgramModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Tambah Program</h4>
            </div>
            <form action="/program" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="form-label">Nama Program</label>
                        <input type="text" name="program_name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('css')
<!-- Dropzone.js -->
<link href="{{asset('vendors/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet">
@endsection
@section('js')
<!-- Dropzone.js -->
<script src="{{asset('vendors/dropzone/dist/min/dropzone.min.js')}}"></script>
<script>
    $("#tableProgram").dataTable({
        "autoWidth": false,
        info: false,
        lengthChange: false
    });
</script>
@endsection