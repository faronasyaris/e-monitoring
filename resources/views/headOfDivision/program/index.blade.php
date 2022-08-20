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
            <table id="tableProgram" class="table table-striped jambo_table table-bordered ">
                <thead>
                    <tr>
                        <th widht="10%">Kode Program</th>
                        <th widht="20%">Nama Program</th>
                        <th widht="15%">Kinerja Fisik</th>
                        <th widht="15%">Kinerja Indikator</th>
                        <th widht="15%">Kinerja Keuangan</th>
                        <th widht="15%  ">
                            <center>Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $program)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $program->program_name }}</td>
                            <td class="text-center"></td>
                            <td>
                                {{ \App\Models\ProgramOutcome::countIndicatorPerformance($program->id) }}%
                            </td>
                            <td class="text-center"></td>
                            <td class="text-center">
                                <a href="/program/{{ $program->id }}/manage-program"
                                    class="btn btn-sm btn-success">Manage</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            {{-- @if (session('month') >= date('m')) --}}
            <button class="btn btn-primary " style="float:right" id="btnTambahPeriode"> <i class="fa fa-plus"></i>
                Tambah Program</button>
            {{-- @endif --}}
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
@endsection

@section('js')
    <script>
        $("#tableProgram").dataTable({
            "autoWidth": false,
            info: false,
            lengthChange: false
        });

        $('#btnTambahPeriode').on('click', function() {
            $('#addProgramModel').modal('show');
        })
    </script>
@endsection
