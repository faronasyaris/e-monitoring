@extends('layouts.main')

@section('title')
    Data Program
@endsection

@section('sidebar')
    @include('layouts.headOfDivision-sidebar')
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-percent"></i> Kinerja Fisik</span>
            <div class="count"> {{ \App\Models\ProgramOutcome::countPhysicalPerformance($program->id) }}%</div>

        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-percent"></i> Kinerja Indikator</span>
            <div class="count">
                {{ \App\Models\ProgramOutcome::countIndicatorPerformance($program->id) }}%
            </div>

        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-percent"></i> Kinerja Keuangan</span>
            <div class="count">{{ \App\Models\Program::countProgramFinance($program->id)['performance'] }}%</div>

        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-plus-square"></i> Jumlah Indikator</span>
            <div class="count">{{ $program->getOutcome->count() }}</div>

        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-money"></i> Anggaran Program</span>
            <div class="count green">
                <h4>Rp{{ number_format(\App\Models\Program::countProgramFinance($program->id)['totalBudget'], 0, '', '.') }}
                </h4>
            </div>

        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-money"></i> Realisasi Keuangan</span>
            <div class="count green">
                <h4>Rp{{ number_format(\App\Models\Program::countProgramFinance($program->id)['totalFinance'], 0, '', '.') }}
                </h4>
            </div>

        </div>

    </div>
    @include('layouts.notif')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Deskripsi Program</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x-content">
                <table>
                    <tr>
                        <td><b>Nama Program</b></td>
                        <td>&nbsp;:&nbsp; </td>
                        <td>{{ $program->program_name }}</td>
                    </tr>
                    <tr>
                        <td><b>Dibuat Oleh</b></td>
                        <td> &nbsp;:&nbsp;</td>
                        <td>{{ @$program->getUser->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Outcome Program</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x-content">
                <table id="tableTahapan" class="table table-striped table-bordered tableProgram">
                    <thead>
                        <tr>
                            <th width="4%">No</th>
                            <th width="20%">Deskripsi</th>
                            <th width="10%">Satuan</th>
                            <th width="8%">Target</th>
                            <th width="8%">Capian</th>
                            <th width="8%">Kinerja</th>
                            @if (auth()->user()->role != 'Kepala Dinas')
                                <th width="22%">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($program_outcomes as $outcome)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $outcome->program_outcome_name }}</td>
                                <td>{{ $outcome->getPlotting->where('month', session('month'))->first()->unit }}</td>
                                <td>{{ $outcome->getPlotting->where('month', session('month'))->first()->target }}</td>
                                <td>{{ $outcome->getPlotting->where('month', session('month'))->first()->achievment }}
                                </td>
                                <td>
                                    {{ \App\Models\PlottingProgramOutcome::countOutcomePerformance($outcome->getPlotting->where('month', session('month'))->first()->id) }}%
                                </td>
                                @if (auth()->user()->role != 'Kepala Dinas')
                                    <td>
                                        <button class="btn btn-sm btn-success btnTambahCapaian"
                                            data-id="{{ $outcome->getPlotting->where('month', session('month'))->first()->id }}"
                                            data-deskripsi="{{ $outcome->program_outcome_name }}">Tambah
                                            Capaian</button>
                                        <button class="btn btn-sm btn-warning btn-edit"
                                            data-target="#editProgramOutcomeModal" data-toggle="modal"
                                            data-id="{{ $outcome->id }}" data-name="{{ $outcome->program_outcome_name }}"
                                            data-unit="{{ $outcome->getPlotting->where('month', session('month'))->first()->unit }}"
                                            data-targetOutcome="{{ $outcome->getPlotting->where('month', session('month'))->first()->target }}">Edit</button>
                                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $outcome->id }}"
                                            data-target="#deleteProgramOutcomeModal" data-toggle="modal">Delete</button>
                                    </td>
                                @endif

                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <hr>
                {{-- @if (session('month') >= date('m')) --}}
                @if (auth()->user()->role != 'Kepala Dinas')
                    <button class="btn btn-primary btn-sm " style="float:right" data-toggle="modal"
                        data-target="#addProgramOutcomeModal"> <i class="fa fa-plus"></i>
                        Tambah Outcome</button>
                @endif
                {{-- @endif --}}

            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Histori Penambahan Capaian</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x-content">
                <table id="tableHistoriTahapan" class="table table-striped table-bordered tableProgram">
                    <thead>
                        <tr>
                            <th width="14%">Tanggal Input</th>
                            <th width="19%">Nama Outcome</th>
                            <th width="15%">Jumlah Capaian</th>
                            <th width="15%">File Bukti</th>
                            @if (auth()->user()->role != 'Kepala Dinas')
                                <th width="12%">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                            <tr>
                                <td>{{ date('d F Y', strtotime($history->date)) }}</td>
                                <td>{{ $history->getOutcomeProgram->program_outcome_name }}</td>
                                <td>{{ $history->achievment }}</td>
                                <td>
                                    @if (empty($history->file))
                                        -
                                    @else
                                        <a href="{{ asset('/evidence/' . $history->file) }}"><i class="fa fa-download"></i>
                                            Donwload File</a>
                                    @endif
                                </td>
                                @if (auth()->user()->role != 'Kepala Dinas')
                                    <td>
                                        <button class="btn btn-sm btn-danger btnCancelAchievment"
                                            data-id="{{ $history->id }}">Batalkan</button>
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- modal tambah outcome --}}
    <div class="modal fade" id="addProgramOutcomeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Outcome Program</h4>
                </div>
                <form action="/programOutcome" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $program->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Outcome</label>
                            <input type="text" name="description" class="form-control" required
                                placeholder="Nama Outcome">
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Satuan</label>
                            <input type="text" name="unit" class="form-control" required placeholder="Satuan">
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Target</label>
                            <input type="number" min=0 step=".01" name="target" class="form-control" required
                                placeholder="Target">
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
    <div class="modal fade" id="editProgramOutcomeModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Outcome Program</h4>
                </div>
                <form id="formEditOutcome" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Outcome</label>
                            <input type="text" id="edit_outcome_name" name="outcome_name" class="form-control"
                                required placeholder="Nama Outcome">
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Satuan</label>
                            <input type="text" id="outcome_unit" name="unit" class="form-control" required
                                placeholder="Satuan">
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Target</label>
                            <input type="number" id="outcome_target" min=0 name="target" class="form-control" required
                                placeholder="Target">
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
    {{-- modal tambah capaian --}}
    <div class="modal fade" id="addAchievmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Capaian</h4>
                </div>
                <form id="formAchievment" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Outcome</label>
                            <input type="text" id="outcome_name" name="program_name" class="form-control" required
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Jumlah Capaian</label>
                            <input type="number" step=".01" min=0 id="achievment" name="achievment"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Bukti (Optional)</label>
                            <input type="file" id="evidence" name="evidence" class="form-control">
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

    <div class="modal fade" id="deleteProgramOutcomeModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Hapus Outcome</h4>
                </div>
                <div class="modal-body">
                    Anda Yakin akan menghapus Outcome Program yang dipilih?
                </div>
                <div class="modal-footer">
                    <button type="button" style="display: inline" class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <form style="display: inline" id="formDeleteOutcome" method="POST">
                        @method('delete')
                        @csrf
                        <button style="display: inline" button type="submit" class="btn btn-danger">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal batalkan capaian (delete history) --}}
    <div class="modal fade" id="cancelAchievmentModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Batalkan Capaian</h4>
                </div>
                <div class="modal-body">
                    Dengan ini, maka Capaian yang diinput akan ditarik kembali, Lanjutkan?
                </div>
                <div class="modal-footer">
                    <button type="button" style="display: inline" class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <form style="display: inline" id="cancelAchievmentForm" method="POST">
                        @method('delete')
                        @csrf
                        <button style="display: inline" button type="submit" class="btn btn-danger">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(".tableProgram").dataTable({
            "autoWidth": false,
            info: false,
            lengthChange: false,
            searching: false,
        });

        $("#tableProgram2").dataTable({
            "autoWidth": false,
            info: false,
            lengthChange: false,
            searching: false,
        });
        $('#btnTambahPeriode').on('click', function() {
            $('#addProgramModel').modal('show');
        })

        $(document).on('click', '#editProgramButton', function() {
            $('#editProgramModal').modal('show');
            $('#program_name').val($(this).attr('data-name'));
            var data_id = $(this).attr('data-id');
            var url = '/program/' + data_id;
            $('#editProgramForm').attr('action', url);
        });

        $(document).on('click', '#deleteProgramButton', function() {
            $('#deleteProgramModal').modal('show');
            var data_id = $(this).attr('data-id');
            var url = '/program/' + data_id;
            $('#deleteProgramForm').attr('action', url);
        });

        $(document).on('click', '.btnTambahCapaian', function() {
            console.log($(this).attr('data-deskripsi'));
            $('#outcome_name').val($(this).attr('data-deskripsi'));
            $('#formAchievment').prop('action', `/achievment/${$(this).attr('data-id')}/add`);
            $('#addAchievmentModal').modal('show');
        })

        $(document).on('click', '.btn-edit', function() {
            $('#formEditOutcome').prop('action', `/programOutcome/${$(this).attr('data-id')}`);
            $('#edit_outcome_name').val($(this).attr('data-name'));
            $('#outcome_unit').val($(this).attr('data-unit'));
            $('#outcome_target').val($(this).attr('data-targetOutcome'));
        })

        $(document).on('click', '.btn-delete', function() {
            $('#formDeleteOutcome').prop('action', `/programOutcome/${$(this).attr('data-id')}`);
        })
    </script>
@endsection
