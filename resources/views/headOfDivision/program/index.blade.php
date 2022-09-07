@extends('layouts.main')

@section('title')
    Data Program
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
                <h4 class="card-title">Kelola Program {{ session('monthName') }} {{ session('yearName') }}</h4>
                <h6>{{ \App\Models\Field::getField(auth()->user()->field_id) }}</h6>
                <div class="clearfix"></div>
            </div>
            <table id="tableProgram" class="table table-striped jambo_table table-bordered d-flex">
                <thead>
                    <tr>
                        <th max-widht="5%" class="text-center">No</th>
                        <th widht="5%" class="text-center">Nama Program</th>
                        <th>Status</th>
                        <th widht="15%" class="text-center">Kinerja Fisik</th>
                        <th widht="15%" class="text-center">Kinerja Indikator</th>
                        <th widht="15%" class="text-center">Kinerja Keuangan</th>
                        <th widht="23%" colspan=1>
                            <center>Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $program)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $program->program_name }}</td>
                            <td>{!! App\Models\User::getStatusLabel(\App\Models\ProgramOutcome::countPhysicalPerformance($program->id)) !!}

                            <td class="text-center">
                                {{ \App\Models\ProgramOutcome::countPhysicalPerformance($program->id) }}%
                            </td>
                            <td class="text-center">
                                {{ \App\Models\ProgramOutcome::countIndicatorPerformance($program->id) }}%
                            </td>
                            <td class="text-center">
                                {{ \App\Models\Program::countProgramFinance($program->id)['performance'] }}%
                            </td>
                            </td>
                            <td>
                                <a href="/program/{{ $program->id }}/manage-program"
                                    class="btn btn-sm btn-success">Manage</a>

                                <a href="javascript:void(0)" data-target="#editProgramModal" data-toggle="modal"
                                    data-id="{{ $program->id }}" data-name="{{ $program->program_name }}"
                                    class="btn btn-sm btn-warning btn-edit">Edit</a>
                                <a href="javascript:void(0)" data-target="#deleteProgramModal" data-toggle="modal"
                                    data-id="{{ $program->id }}" class="btn btn-sm btn-danger btn-delete">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            @if (auth()->user()->role != 'Kepala Dinas')
                <button class="btn btn-primary " style="float:right" id="btnTambahPeriode"> <i class="fa fa-plus"></i>
                    Tambah Program</button>
            @endif
        </div>
    </div>


    <div class="modal fade" id="addProgramModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
    <div class="modal fade" id="editProgramModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Program</h4>
                </div>
                <form id="formEditProgram" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Program</label>
                            <input type="text" name="program_name" id="program_name" class="form-control" required>
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
    <div class="modal fade" id="deleteProgramModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Delete Program</h4>
                </div>
                <form id="formDeleteProgram" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Anda yakin akan menghapus program yang dipilih?</p>
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
        // $("#tableProgram").dataTable({
        //     autoWidth: false,
        //     info: false,
        //     lengthChange: false
        // });

        $(document).on('click', '#btnTambahPeriode', function() {
            $('#addProgramModel').modal('show');
        })

        $(document).on('click', '.btn-edit', function() {
            $('#formEditProgram').prop('action', '/program/' + $(this).attr('data-id'));
            $('#program_name').val($(this).attr('data-name'));
        })

        $(document).on('click', '.btn-delete', function() {
            $('#formDeleteProgram').prop('action', '/program/' + $(this).attr('data-id'));
        })
    </script>
@endsection
