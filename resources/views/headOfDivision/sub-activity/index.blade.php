@extends('layouts.main')

@section('title')
    Data Sub Kegiatan
@endsection

@section('sidebar')
    @include('layouts.headOfDivision-sidebar')
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('layouts.notif')
        <div class="x_panel">
            <div class="x_title">
                <h4 class="card-title">Kelola Sub Kegiatan {{ session('monthName') }} {{ session('yearName') }}</h4>
                <h6>{{ \App\Models\Field::getField(auth()->user()->field_id) }}</h6>
                <div class="clearfix"></div>
            </div>
            <table id="tableProgram2" class="table table-bordered  ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sub Kegiatan</th>
                        <th>Kinerja Fisik</th>
                        <th>Kinerja Indikator</th>
                        <th>Kinerja Keuangan</th>
                        <th>Jumlah Dana</th>
                        <th colspan=3>
                            <center>Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $program)
                        <tr style="background-color: #9abcc3; color:white ">
                            <td colspan="9">
                                <label> Program : {{ $program->program_name }}</label>
                            </td>
                        </tr>
                        @foreach ($activities->toQuery()->where('program_id', $program->id)->get() as $activity)
                            <tr style="background-color: #8fc7db; color:white ">
                                <td colspan="9">
                                    <label> Kegiatan : {{ $activity->activity_name }}</label>
                                </td>
                            </tr>
                            @if ($sub_activities->where('activity_id', $activity->id)->count() >= 1)
                                @foreach ($sub_activities->toQuery()->where('activity_id', $activity->id)->get() as $sub_activity)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sub_activity->sub_activity_name }}</td>
                                        <td>0</td>
                                        <td> 0%
                                        </td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td class="text-center">
                                            <a href="/sub-kegiatan/{{ $activity->id }}/manage-sub-kegiatan"
                                                class="btn btn-sm btn-success">Manage</a>

                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#editSubActivityModal" class="btn btn-sm btn-warning">Edit</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#deleteSubActivityModal"
                                                class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    @endforeach

                </tbody>
            </table>
            <hr>
            {{-- @if (session('month') >= date('m')) --}}
            <button class="btn btn-primary " style="float:right" id="btnTambahPeriode" data-toggle="modal"
                data-target="#addSubActivityModal"> <i class="fa fa-plus"></i>
                Tambah Sub Kegiatan</button>
            {{-- @endif --}}
            <hr>
        </div>
    </div>

    <div class="modal fade" id="addSubActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Sub Kegiatan</h4>
                </div>
                <form action="/sub-kegiatan" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Pilih Program</label>
                            <select name="program_id" id="program" class="form-control" required>
                                <option disabled selected>Pilih Program</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Pilih Kegiatan</label>
                            <select name="activity_id" id="activity" class="form-control" disabled required>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Nama Sub Kegiatan</label>
                            <input type="text" name="activity_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Dana Sub Kegiatan</label>
                            <input type="number" min="0" name="budget" class="form-control" required>
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
    </div>

    <div class="modal fade" id="editSubActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Sub Kegiatan</h4>
                </div>
                <div class="modal-body">
                    <form action="/sub-kegiatan" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label">Nama Sub Kegiatan</label>
                            <input type="text" name="activity_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Dana Sub Kegiatan</label>
                            <input type="number" min="0" name="budget" class="form-control" required>
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

    <div class="modal fade" id="deleteSubActivityModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Delete Sub Kegiatan</h4>
                </div>
                <form action="/program" method="post">
                    @csrf
                    <div class="modal-body">
                        <p>Anda yakin akan menghapus Sub Kegiatan yang dipilih?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#tableKegiatan").dataTable({
            "autoWidth": false,
            info: false,
            lengthChange: false
        });

        $('#btnTambahPeriode').on('click', function() {
            $('#addProgramModel').modal('show');
        })

        $(document).on('change', '#program', function() {
            $.get(`/program/${$(this).val()}/getActivity`, function(data) {
                $('#activity').removeAttr('disabled');
                $.each(data.data, function(index) {
                    $("#activity").append(new Option(data.data[index].activity_name, data.data[
                        index].id));
                })
            });
        });

        $(document).on('hidden.bs.modal', '#addSubActivityModal', function() {

        })
    </script>
@endsection
