@extends('layouts.main')

@section('title')
    Data Kegiatan
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
                <h4 class="card-title">Kelola Kegiatan {{ session('monthName') }} {{ session('yearName') }}</h4>
                <h6>{{ \App\Models\Field::getField(auth()->user()->field_id) }}</h6>
                <div class="clearfix"></div>
            </div>
            <table id="tableProgram2" class="table table-bordered  ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Status</th>
                        <th>Kinerja Fisik</th>
                        <th>Kinerja Indikator</th>
                        <th>Kinerja Keuangan</th>
                        <th colspan=1>
                            <center>Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $program)
                        <tr style="background-color: #ededed; ">
                            <td colspan="8">
                                <label> Program : {{ $program->program_name }}</label>
                            </td>
                        </tr>

                        @if ($activities->count() > 0)
                            @foreach ($activities->toQuery()->where('program_id', $program->id)->get() as $activity)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $activity->activity_name }}</td>
                                    <td>{!! App\Models\User::getStatusLabel(\App\Models\ActivityOutcome::countPhysicalPerformance($activity->id)) !!}
                                    <td class="text-center">
                                        {{ \App\Models\ActivityOutcome::countPhysicalPerformance($activity->id) }}%</td>
                                    <td class="text-center">
                                        {{ \App\Models\ActivityOutcome::countIndicatorPerformance($activity->id) }}%</td>
                                    <td class="text-center">
                                        {{ \App\Models\Activity::countActivityFinance($activity->id)['performance'] }}%
                                    </td>
                                    <td>
                                        <a href="/kegiatan/{{ $activity->id }}/manage-kegiatan"
                                            class="btn btn-sm btn-success">Manage</a>


                                        <button data-toggle="modal" data-target="#editActivityModal"
                                            data-name="{{ $activity->activity_name }}" data-id="{{ $activity->id }}"
                                            class="btn btn-sm btn-warning btn-edit">Edit</button>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#deleteActivityModal"
                                            class="btn btn-sm btn-danger btn-delete"
                                            data-id="{{ $activity->id }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach

                </tbody>
            </table>
            <hr>
            {{-- @if (session('month') >= date('m')) --}}
            <button class="btn btn-primary " style="float:right" id="btnTambahPeriode" data-toggle="modal"
                data-target="#addActivityModal"> <i class="fa fa-plus"></i>
                Tambah Kegiatan</button>
            {{-- @endif --}}
            <hr>
        </div>
    </div>

    <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Kegiatan</h4>
                </div>
                <form action="/kegiatan" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Pilih Program</label>
                            <select name="program_id" id="" class="form-control">
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Nama Kegiatan</label>
                            <input type="text" name="activity_name" class="form-control" required>
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

    <div class="modal fade" id="editActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Kegiatan</h4>
                </div>
                <div class="modal-body">
                    <form id="formEditActivity" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="" class="form-label">Nama Kegiatan</label>
                            <input type="text" name="activity_name" id="activity_name" class="form-control" required>
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
    <div class="modal fade" id="deleteActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Delete Kegiatan</h4>
                </div>
                <form id="formDeleteActivity" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Anda yakin akan menghapus kegiatan yang dipilih?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script>
        // $("#tableProgram2").dataTable({
        //     "autoWidth": false,
        //     info: false,
        //     lengthChange: false
        // });

        $('#btnTambahPeriode').on('click', function() {
            $('#addProgramModel').modal('show');
        })

        $(document).on('click', '.btn-edit', function() {
            $('#formEditActivity').prop('action', '/kegiatan/' + $(this).attr('data-id'));
            $('#activity_name').val($(this).attr('data-name'));
        })

        $(document).on('click', '.btn-delete', function() {
            $('#formDeleteActivity').prop('action', '/kegiatan/' + $(this).attr('data-id'));
        })
    </script>
@endsection
