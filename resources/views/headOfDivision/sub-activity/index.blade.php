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
        <div class="x_panel">
            <div class="x_title">
                <h4 class="card-title">Kelola Sub Kegiatan {{ session('monthName') }} {{ session('yearName') }}</h4>
                <h6>{{ \App\Models\Field::getField(auth()->user()->field_id) }}</h6>
                <div class="clearfix"></div>
            </div>
            <table id="tableProgram2" class="table table-bordered ">
                <thead>
                    <tr>
                        <th colspan='6' class="" style="background-color: rgba(52, 73, 94, 0.94)">
                            <h5 class="text-center" style="color:white">Nama Program 1</h5>
                        </th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Sub Kegiatan</th>
                        <th>Satuan</th>
                        <th>Target</th>
                        <th class="text-center">Progress</th>
                        <th>
                            <center>Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <th colspan='6' style="background-color: rgba(0,0,0,.05)">
                            <h5 class="">Kegiatan 1</h5>
                        </th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Sub Kegiatan 1</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-success">Manage</a></td>

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Sub Kegiatan 2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-success">Manage</a></td>
                    </tr>

                    <tr>
                        <th colspan='6' style="background-color: rgba(0,0,0,.05)">
                            <h5>Kegiatan 2</h5>
                        </th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Sub Kegiatan 1</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-success">Manage</a></td>
                    </tr>
                    <tr>
                        <td> 1 </td>
                        <td>Sub Kegiatan 2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-success">Manage</a></td>
                    </tr>


                </tbody>
            </table>

            <table id="tableProgram2" class="table table-bordered ">
                <thead>
                    <tr>
                        <th colspan='6' class="" style="background-color: rgba(52, 73, 94, 0.94)">
                            <h5 class="text-center" style="color:white">Nama Program 2</h5>
                        </th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Sub Kegiatan</th>
                        <th>Satuan</th>
                        <th>Target</th>
                        <th class="text-center">Progress</th>
                        <th>
                            <center>Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <th colspan='6' style="background-color: rgba(0,0,0,.05)">
                            <h5 class="">Kegiatan 1</h5>
                        </th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Sub Kegiatan 1</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-success">Manage</a></td>

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Sub Kegiatan 2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-success">Manage</a></td>

                    </tr>

                    <tr>
                        <th colspan='6' style="background-color: rgba(0,0,0,.05)">
                            <h5>Kegiatan 2</h5>
                        </th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Sub Kegiatan 1</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-success">Manage</a></td>

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Sub Kegiatan 2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-success">Manage</a></td>

                    </tr>


                </tbody>
            </table>
            <hr>
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
    </script>
@endsection
