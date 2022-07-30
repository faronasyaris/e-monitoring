@extends("layouts.main")

@section('title')
Data Sub Kegiatan
@endsection

@section('sidebar')
@include('layouts.headOfDivision-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h4 class="card-title">Kelola Sub Kegiatan {{date('Y')}}</h4>
            <h6>{{\App\Models\Field::getField(auth()->user()->field_id)}}</h6>
            <div class="clearfix"></div>
        </div>
        <table id="tableKegiatan" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama Sub Kegiatan</th>
                    <th>Jumlah Indikator</th>
                    <th>Kinerja Indikator (%)</th>
                    <th>
                        <center>Action
                    </th>
                </tr>
            </thead>
            <tbody>
             
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
    
    $('#btnTambahPeriode').on('click',function(){
        $('#addProgramModel').modal('show');
    })
</script>
@endsection

