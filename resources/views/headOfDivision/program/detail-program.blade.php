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
            <div class="count">0</div>

        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-plus-square"></i> Jumlah Indikator</span>
            <div class="count">{{ $program_plot->getOutcome->count() }}</div>

        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-percent"></i> Kinerja Indikator</span>
            <div class="count">{{ \App\Models\PlottingProgramOutcome::countIndicatorPerformance($program_plot->id) }}</div>

        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-money"></i> Dana Program</span>
            <div class="count">0</div>

        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-money"></i> Realisasi Keuangan</span>
            <div class="count">0</div>

        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-percent"></i> Kinerja Keuangan</span>
            <div class="count">0</div>

        </div>
    </div>
    @include('layouts.notif')

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
                            <th width="22%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($program_outcomes as $outcome)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $outcome->description }}</td>
                                <td>{{ $outcome->unit }}</td>
                                <td>{{ $outcome->target }}</td>
                                <td>{{ $outcome->achievment }}</td>
                                <td>{{ \App\Models\PlottingProgramOutcome::countOutcomePerformance($outcome->id) }}%</td>
                                <td><button class="btn btn-sm btn-success btnTambahCapaian" data-id="{{ $outcome->id }}"
                                        data-deskripsi="{{ $outcome->description }}">Tambah
                                        Capaian</button><button class="btn btn-sm btn-warning">Edit</button><button
                                        class="btn btn-sm btn-danger">Delete</button></td>
                            </tr @endforeach
                    </tbody>
                </table>
                <hr>
                {{-- @if (session('month') >= date('m')) --}}
                <button class="btn btn-primary btn-sm " style="float:right" data-toggle="modal"
                    data-target="#addProgramOutcomeModal"> <i class="fa fa-plus"></i>
                    Tambah Outcome</button>
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
                            <th width="19%">Outcome</th>
                            <th width="15%">Jumlah Capaian</th>
                            <th width="15%">File Bukti</th>
                            <th width="12%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- modal edit program --}}
    <div class="modal fade" id="editProgramModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
    </div>
    {{-- modal confirm delete program --}}
    <div class="modal fade" id="deleteProgramModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                    <button type="button" style="display: inline" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <form style="display: inline" id="deleteProgramForm" method="POST">
                        @method('delete')
                        @csrf
                        <button style="display: inline" button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addProgramOutcomeModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Outcome Program</h4>
                </div>
                <form action="/programOutcome" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $program_plot->program_id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" required placeholder="Deskripsi"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Satuan</label>
                            <input type="text" name="unit" class="form-control" required placeholder="Satuan">
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Target</label>
                            <input type="number" min=0 name="target" class="form-control" required
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
                            <input type="number" id="achievment" name="achievment" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Bukti (Optional)</label>
                            <input type="file" id="evidence" name="evidence" class="form-control" required>
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
            $('#outcome_name').val($(this).attr('data-deskripsi'));
            $('#formAchievment').prop('action', `/achievment/${$(this).attr('data-id')}/add`);
            $('#addAchievmentModal').modal('show');
        })
    </script>
@endsection
