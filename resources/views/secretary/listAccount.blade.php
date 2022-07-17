@extends("layouts.main")

@section('title')
Kelola Akun
@endsection

@section('sidebar')
@include('layouts.secretary-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="row">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Kelola Akun</h5>
            <h5 class="card-subtitle">Data Akun Master</h5>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>
                                <center>Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($masters as $master)
                        <tr>
                            <td>{{$master->name}}</td>
                            <td>{{$master->email}}</td>
                            <td>{{$master->nip}}</td>
                            <td>{{$master->role}}</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <hr>
            <button class="btn btn-primary " style="float:right" id="btnOpenFormMaster"> <i class="fa fa-user-plus"></i> Tambah Akun</button>
        </div>
    </div>
</div>

@foreach($fields as $field)
<div class="row">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Kelola Akun</h5>
            <h5 class="card-subtitle">{{$field->name}}</h5>
            <div class="table-responsive">
                <table id="zero_config2" class=" zero_config2 table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($field->getUser as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->nip}}</td>
                            <td>{{$user->role}}</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <button class="btn btn-primary" style="float:right" id="addUser" data-id="{{$field->id}}" data-name="{{$field->name}}"> <i class="fa fa-user-plus"></i> Tambah Akun</button>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="addMaster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun Master</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/account" method="post">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Jabatan</label>
                        <br>
                        @if(empty($masters))
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio1" value="Kepala Dinas">
                            <label class="form-check-label" for="inlineRadio1">Kepala Dinas</label>
                        </div>
                        @endif
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="Sekretaris">
                            <label class="form-check-label" for="inlineRadio2">Sekretaris</label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="addUserByField" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/account" method="post">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Bidang</label>
                        <input type="text" class="form-control" readonly id="fieldName">
                        <input type="hidden" id="fieldId" name="field">
                    </div>
                    <div class="form-group" id="jabatan">
                        <label for="" class="form-label">Jabatan</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="Pelaksana">
                            <label class="form-check-label" for="inlineRadio2">Pelaksana</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    div.dataTables_wrapper {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
</style>
<link href="{{asset('template/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="{(asset('template/assets/extra-libs/multicheck/datatable-checkbox-init.js')}}"></script>
<script src="{{asset('template/assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
<script src="{{asset('template/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script>
    $("#zero_config").DataTable({
        info: false,
        lengthChange: false

    });
    $(".zero_config2").DataTable({
        info: false,
        lengthChange: false
    });

    $('#btnOpenFormMaster').on('click', function() {
        $('#addMaster').modal('show');
    })

    $(document).on('click', '#addUser', function() {
        $('#fieldName').val($(this).attr('data-name'));
        $('#fieldId').val($(this).attr('data-id'));
        $.get(`/field/${$(this).attr('data-id')}/head`, function(data) {
            if (data.data == null) {
                $('#jabatan').append(
                    '<div class="form-check form-check-inline" id="kepalaBidang">' +
                    '<input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="Kepala Bidang">' +
                    '<label class="form-check-label" for="inlineRadio2">Kepala Bidang</label>' +
                    '</div>'
                );
            }
        });
        $('#addUserByField').modal('show');
    })

    $('#addUserByField').on('hidden.bs.modal', function() {
        $('#fieldName').val('');
        $('#fieldId').val('');
        $('#kepalaBidang').remove();
    });
</script>
@endsection