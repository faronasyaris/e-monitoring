@extends('layouts.main')

@section('title')
    Sub Kegiatan
@endsection

@section('sidebar')
    @include('layouts.employee-sidebar')
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('layouts.notif')
        <div class="x_panel">
            <div class="x_title">
                <h4 class="card-title">Sub Kegiatan</h4>
                <!-- <h6>{{ \App\Models\Field::getField(auth()->user()->field_id) }}</h6> -->
                <div class="clearfix"></div>
            </div>
            <table id="tableProgram" class="table table-striped jambo_table table-bordered ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sub Kegiatan</th>
                        <th>Kinerja Indikator</th>
                        <th>Kinerja Keuangan</th>
                        <th>Total Anggaran</th>
                        <th>
                            <center>Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subActivities as $sub_activity)
                        @php
                            $plotSubActivity = $sub_activity->getPlotting->where('month', session('month'))->first();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sub_activity->sub_activity_name }}</td>
                            <td class="text-center">
                                {{ \App\Models\SubActivityOutput::countIndicatorPerformance($sub_activity->id) }}%
                            </td>
                            <td class="text-center">
                                {{ \App\Models\PlottingSubActivity::countFinancePerformance($plotSubActivity) }}%
                            </td>
                            <td class=""> Rp{{ number_format($plotSubActivity->budget, 0, '', '.') }}
                            </td>
                            <td class="text-center">
                                <a href="/sub-kegiatan/{{ $sub_activity->id }}/manage-sub-kegiatan"
                                    class="btn btn-sm btn-success">Manage</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
    </script>
@endsection
