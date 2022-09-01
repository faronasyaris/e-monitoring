@extends('layouts.main')

@section('title')
    Data Kegiatan
@endsection

@section('sidebar')
    @if (auth()->user()->role == 'Kepala Bidang')
        @include('layouts.headOfDivision-sidebar')
    @elseif(auth()->user()->role == 'Pelaksana')
        @include('layouts.employee-sidebar')
    @elseif(auth()->user()->role == 'Kepala Dinas')
        @include('layouts.headOfDepartement-sidebar')
    @endif
@endsection

@section('content')
@section('content')
    @include('sweetalert::alert')
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-percent"></i> Kinerja Indikator</span>
            <div class="count">
                {{ \App\Models\SubActivityOutput::countIndicatorPerformance($subActivity->id) }}%
            </div>

        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-percent"></i> Kinerja Keuangan</span>
            <div class="count">{{ \App\Models\PlottingSubActivity::countFinancePerformance($plotSubActivity) }}%</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-plus-square"></i> Jumlah Indikator</span>
            <div class="count">{{ $subActivity->getSubActivityOutput->count() }}</div>

        </div>

        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-money"></i> Anggaran Sub Kegiatan</span>
            <div class="count green">
                <h4> Rp{{ number_format($plotSubActivity->budget, 0, '', '.') }}</h4>
            </div>

        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-money"></i> Realisasi Keuangan</span>
            <div class="count green">
                <h4>Rp{{ number_format($plotSubActivity->finance_realization, 0, '', '.') }}</h4>
            </div>

        </div>
    </div>
    @include('layouts.notif')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Deskripsi Sub Kegiatan</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x-content">
                <table>
                    <tr>
                        <td><b>Nama Sub Kegiatan</b></td>
                        <td>&nbsp;:&nbsp; </td>
                        <td>{{ $subActivity->sub_activity_name }}</td>
                    </tr>
                    <tr>
                        <td><b>Pelaksana</b></td>
                        <td> &nbsp;:&nbsp;</td>
                        <td>{{ @$subActivity->getPlotting->where('month', session('month'))->first()->getUser->name }}</td>
                    </tr>
                    <tr>
                        <td><b>Dibuat Oleh</b></td>
                        <td> &nbsp;:&nbsp;</td>
                        <td>{{ @$subActivity->getUser->name }}</td>
                    </tr>
                </table>
                <hr>
                @if (auth()->user()->role == 'Kepala Bidang')
                    <button class="btn btn-primary btn-sm " style="float:right" data-toggle="modal"
                        data-target="#chooseEmployeeMpdal"> <i class="fa fa-user"></i>
                        Pilih Pelaksana</button>
                @endif

            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Realisasi Keuangan</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x-content">
                <table id="tableTahapan" class="table table-striped table-bordered tableProgram">
                    <thead>
                        <tr>
                            <th width="4%">No</th>
                            <th width="20%">Deskripsi</th>
                            <th width="17%">Jumlah Dana</th>
                            <th width="15%">Tanggal Input</th>
                            <th width="15%">User</th>
                            <th>Bukti</th>

                            @if (auth()->user()->role != 'Kepala Dinas')
                                <th width="15%">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budgetHistories as $history)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $history->description }}</td>
                                <td> Rp{{ number_format($history->budget, 0, '', '.') }}</td>
                                <td>{{ date('d F Y', strtotime($history->date)) }}</td>
                                <td>{{ @$history->User->name }}</td>
                                <td>
                                    @if (!empty($history->file))
                                        <a href="{{ asset('/evidence/' . $history->file) }}"><i class="fa fa-download"></i>
                                            Donwload File</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                @if (auth()->user()->role != 'Kepala Dinas')
                                    <td><button class="btn btn-sm btn-danger btnCancelFinance"
                                            data-id="{{ $history->id }}">Batalkan</button></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                {{-- @if (session('month') >= date('m')) --}}
                @if (auth()->user()->role != 'Kepala Dinas')
                    <button class="btn btn-primary btn-sm " style="float:right" data-toggle="modal"
                        data-target="#addFinance"> <i class="fa fa-plus"></i>
                        Tambah Realisasi Keuangan</button>
                @endif
                {{-- @endif --}}

            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Output Sub Kegiatan</h2>
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
                        @foreach ($sub_activity_output as $outcome)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $outcome->activity_output_name }}</td>
                                <td>{{ $outcome->getPlotting->where('month', session('month'))->first()->unit }}</td>
                                <td>{{ $outcome->getPlotting->where('month', session('month'))->first()->target }}</td>
                                <td>{{ $outcome->getPlotting->where('month', session('month'))->first()->achievment }}
                                <td>
                                    {{ \App\Models\PlottingSubActivityOutput::countOutcomePerformance($outcome->getPlotting->where('month', session('month'))->first()->id) }}%
                                </td>
                                @if (auth()->user()->role != 'Kepala Dinas')
                                    <td><button class="btn btn-sm btn-success btnTambahCapaian" data-toggle="modal"
                                            data-target="#addAchievmentModal"
                                            data-id="{{ $outcome->getPlotting->where('month', session('month'))->first()->id }}"
                                            data-deskripsi="{{ $outcome->activity_output_name }}">Tambah
                                            Capaian</button>
                                        <button class="btn btn-sm btn-warning btn-edit" data-toggle="modal"
                                            data-target="#editActivityOutputModal" data-id="{{ $outcome->id }}"
                                            data-name="{{ $outcome->activity_output_name }}"
                                            data-unit="{{ $outcome->getPlotting->where('month', session('month'))->first()->unit }}"
                                            data-targetOutcome="{{ $outcome->getPlotting->where('month', session('month'))->first()->target }}">Edit</button><button
                                            class="btn btn-sm btn-danger btn-delete" data-toggle="modal"
                                            data-target="#deleteActivityOutputModal"
                                            data-id="{{ $outcome->id }}">Delete</button>
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
                        data-target="#addProgramOutputModal"> <i class="fa fa-plus"></i>
                        Tambah Output</button>
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
                            <th width="19%">Nama Output</th>
                            <th width="15%">Jumlah Capaian</th>
                            <th width="15%">File Bukti</th>
                            <th>User</th>
                            @if (auth()->user()->role != 'Kepala Dinas')
                                <th width="12%">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                            <tr>
                                <td>{{ date('d F Y', strtotime($history->date)) }}</td>
                                <td>{{ $history->getOutputActivity->activity_output_name }}</td>
                                <td>{{ $history->achievment }}</td>
                                <td>
                                    @if (empty($history->file))
                                        -
                                    @else
                                        <a href="{{ asset('/evidence/' . $history->file) }}"><i
                                                class="fa fa-download"></i>
                                            Donwload File</a>
                                    @endif
                                </td>
                                <td>{{ @$history->User->name }}</td>
                                @if (auth()->user()->role != 'Kepala Dinas')
                                    <td><button class="btn btn-sm btn-danger btnCancelAchievment"
                                            data-id="{{ $history->id }}">Batalkan</button></td>
                                @endif
                            </tr>
                        @endforeach
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
    {{-- modal tambah Output --}}
    <div class="modal fade" id="addProgramOutputModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Output Sub Kegiatan</h4>
                </div>
                <form action="/subKegiatanOutcome" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $subActivity->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Output</label>
                            <input type="text" name="description" class="form-control" required
                                placeholder="Nama Output">
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

    <div class="modal fade" id="addFinance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Realisasi Anggaran</h4>
                </div>
                <form action="/sub-kegiatan/financeRealization" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $subActivity->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Deskripsi Penggunaan</label>
                            <input type="text"name="description" class="form-control" required
                                placeholder="Deskripsi">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Jumlah Dana</label>
                            <input type="number" min=0 name="budget" class="form-control" required placeholder="0">
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
                            <label for="" class="form-label">Nama Output</label>
                            <input id="outcome_name" type="text" id="Output_name" name="sub_activity_name"
                                class="form-control" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Jumlah Capaian</label>
                            <input type="number" min=0 id="achievment" name="achievment" class="form-control" required>
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

    <div class="modal fade" id="deleteProgramOutputModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Hapus Output</h4>
                </div>
                <div class="modal-body">
                    Anda Yakin akan menghapus Output Program yang dipilih?
                </div>
                <div class="modal-footer">
                    <button type="button" style="display: inline" class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <form style="display: inline" method="POST">
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

    <div class="modal fade" id="editActivityOutputModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Output Sub Kegiatan</h4>
                </div>
                <form id="formEditOutcome" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Output</label>
                            <input type="text" id="edit_outcome_name" name="outcome_name" class="form-control"
                                required placeholder="Nama Output">
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Satuan</label>
                            <input type="text" name="unit" id="outcome_unit" class="form-control" required
                                placeholder="Satuan">
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Target</label>
                            <input type="number" min=0 name="target" id="outcome_target" q class="form-control"
                                required placeholder="Target">
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
    <div class="modal fade" id="deleteActivityOutputModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Delete Output Sub Kegiatan</h4>
                </div>
                <form id="formDeleteOutcome" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Anda yakin akan menghapus Output Kegiatan yang dipilih?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cancelFinanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Batalkan Capaian</h4>
                </div>
                <div class="modal-body">
                    Dengan ini, maka Realisasi Keuangan yang diinput akan ditarik kembali, Lanjutkan?
                </div>
                <div class="modal-footer">
                    <button type="button" style="display: inline" class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <form style="display: inline" id="cancelFinanceForm" method="POST">
                        @method('delete')
                        @csrf
                        <button style="display: inline" button type="submit" class="btn btn-danger">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="chooseEmployeeMpdal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Pilih Pelaksana</h4>
                </div>
                <form action="/sub-kegiatan/{{ $subActivity->id }}/selectEmployee" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Pelaksana</label>
                            <select name="worker" id="" class="form-control" required>
                                <option selected disabled>Pilih Pelaksana</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ $subActivity->getPlotting->where('month', session('month'))->first()->user_id == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Pilih</button>
                    </div>
                </form>
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
            searching: false,
        });

        $('#btnTambahPeriode').on('click', function() {
            $('#addProgramModel').modal('show');
        })

        $(document).on('click', '.btnTambahCapaian', function() {
            $('#outcome_name').val($(this).attr('data-deskripsi'));
            $('#formAchievment').prop('action', `/subKegiatan-achievment/${$(this).attr('data-id')}/add`);
            $('#addAchievmentModal').modal('show');
        })

        $(document).on('click', '.btnCancelAchievment', function() {
            $('#cancelAchievmentForm').prop('action', `/subKegiatan-achievment/${$(this).attr('data-id')}/cancel`);
            $('#cancelAchievmentModal').modal('show');
        })

        $(document).on('click', '.btnCancelFinance', function() {
            $('#cancelFinanceForm').prop('action',
                `/sub-kegiatan/financeRealization/${$(this).attr('data-id')}/cancel`);
            $('#cancelFinanceModal').modal('show');
        })

        $(document).on('click', '.btn-edit', function() {
            $('#formEditOutcome').prop('action', `/subKegiatanOutcome/${$(this).attr('data-id')}`);
            $('#edit_outcome_name').val($(this).attr('data-name'));
            $('#outcome_unit').val($(this).attr('data-unit'));
            $('#outcome_target').val($(this).attr('data-targetOutcome'));
        })

        $(document).on('click', '.btn-delete', function() {
            $('#formDeleteOutcome').prop('action', `/subKegiatanOutcome/${$(this).attr('data-id')}`);
        })
    </script>
@endsection
