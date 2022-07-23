@extends("layouts.main")

@section('title')
Tambah Kegiatan
@endsection

@section('sidebar')
@include('layouts.headOfDivision-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-md-12 col-sm-12 col-xs-12">
    @include('layouts.notif')
    <a href="/program/{{$program->id}}/manage-program">
        < Kembali</a>
            <div class="x_panel" style="margin-top:10px;margin-bottom:10px">
                <div class="x_title">
                    <h2>Tambah Kegiatan</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 left-margin">
                    <form class="form-horizontal form-label-left" method="post" action="/kegiatan">
                        @csrf
                        <br>
                        <div class="form-group">
                            <label>Nama Program</label>
                            <input type="text" class="form-control" value="{{$program->program_name}}" disabled>
                            <input type="hidden" name="program_id" value="{{$program->id}}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Nama Kegiatan</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Kegiatan" required value="{{old('description')}}">
                        </div>

                        <br>
                        <div class="form-group">
                            <label for="message">Satuan</label>
                            <select name="unit" class="form-control" required>
                                <option value="bulan">Bulan</option>
                                <option value="dokumen">Dokumen</option>
                                <option value="persen">Persen</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Indikator</label>
                            <textarea name="indicator"  class="form-control" placeholder="Indikator" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" style="float:left">Tambah Kegiatan</buttoclass=>
                        </div>
                    </form>
                </div>
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