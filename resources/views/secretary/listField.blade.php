@extends("layouts.main")

@section('title')
Kelola Akun
@endsection

@section('sidebar')
@include('layouts.secretary-sidebar')
@endsection

@section("content")

<div class="row">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Kelola Akun</h5>
            <h5 class="card-subtitle">Data Akun Master</h5>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>NIP</th>
                          <th>Jabatan</th>
                          <th><center>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($masters as $master)
                        <tr>
                            <td>{{$master->name}}</td>
                            <td>{{$master->email}}</td>
                            <td>{{$master->NIP}}</td>
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
                <button class="btn btn-primary" style="float:right"> <i class="fa fa-user-plus"></i> Tambah Akun</button>
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
                            <td>{{$user->NIP}}</td>
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
                <button class="btn btn-primary" style="float:right"> <i class="fa fa-user-plus"></i> Tambah Akun</button>
        </div>
    </div>
</div>
@endforeach

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
        info:false,
        lengthChange:false
       
    });
    $(".zero_config2").DataTable({
        info:false,
        lengthChange:false
    });
</script>
@endsection