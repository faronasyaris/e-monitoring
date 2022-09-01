@extends('layouts.main')

@section('title')
    Kelola Periode
@endsection

@section('sidebar')
    @include('layouts.secretary-sidebar')
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('layouts.notif')
        <div class="x_panel">
            <div class="x_title">
                <h4 class="card-title">Kelola Periode</h4>
                <div class="clearfix"></div>
            </div>
            <table id="tablePeriode" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Tahun Pelaksanaan</th>
                        <th>
                            <center>Action
                        </th>
                    </tr>
                </thead>
                @if (!empty($periods))
                    <tbody>
                        @foreach ($periods as $periode)
                            <tr>
                                <td>Periode {{ $periode->year }}</td>
                                <td>
                                    {{-- <button class="btn btn-warning btn-sm" id="editButton" data-id='{{$periode->id}}' data-year='{{$periode->year}}'>Edit</button> --}}
                                    <button class="btn btn-danger btn-sm" id="deleteButton"
                                        data-id='{{ $periode->id }}'>Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
            <hr>
            <button class="btn btn-primary " style="float:right" id="btnTambahPeriode"> <i class="fa fa-user-plus"></i>
                Tambah Periode</button>
        </div>
    </div>

    {{-- modal add --}}
    <div class="modal fade" id="addPeriodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Periode</h4>
                </div>
                <form action="/period" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Masukan Periode Tahun</label>
                            <input type="number" name="year" class="form-control" min="2000" max="2099"
                                required>
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

    {{-- modal edit --}}
    <div class="modal fade" id="editPeriodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Periode</h4>
                </div>
                <form method="post" id="editForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Masukan Periode Tahun</label>
                            <input type="number" id="editYear" name="year" class="form-control" value=""
                                min="2000" max="2099" required>
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

    {{-- modal delete --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <form style="display: inline" id="deleteForm" method="POST">
                        @method('delete')
                        @csrf
                        <button style="display: inline" button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#tablePeriode").dataTable({
            "autoWidth": false,
            info: false,
            lengthChange: false
        });

        $('#btnTambahPeriode').on('click', function() {
            $('#addPeriodeModal').modal('show');
        })

        $(document).on('click', '#editButton', function() {
            $('#editPeriodeModal').modal('show');
            $('#editYear').val($(this).attr('data-year'));
            var data_id = $(this).attr('data-id');
            var url = '/period/' + data_id;
            $('#editForm').attr('action', url);
        });

        $(document).on('click', '#deleteButton', function() {
            $('#deleteModal').modal('show');
            var data_id = $(this).attr('data-id');
            var url = '/period/' + data_id;
            $('#deleteForm').attr('action', url);
        });
    </script>
@endsection
