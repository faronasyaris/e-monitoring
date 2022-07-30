@extends("layouts.main")

@section('title')
Tambah Sub Kegiatan
@endsection

@section('sidebar')
@include('layouts.headOfDivision-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-md-12 col-sm-12 col-xs-12">
    @include('layouts.notif')
    <a href="javascript:void(0)" onclick="history.back()">
        < Kembali</a>
            <form class="form-horizontal form-label-left" method="post" action="/sub-kegiatan">
                @csrf
                <div class="x_panel" style="margin-top:10px;margin-bottom:10px">
                    <div class="x_title">
                        <h2>Tambah Sub Kegiatan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-margin">

                        <br>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Nama Kegiatan</label>
                                    <input type="text" class="form-control" value="{{$activity->name}}" disabled>
                                    <input type="hidden" name="activity_id" value="{{$activity->id}}">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label>Nama Sub Kegiatan</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nama Sub Kegiatan" required value="{{old('description')}}">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <div class="col-md-12 col-lg-6">
                                <div class="output">
                                    <div class="form-group">
                                        <label for="message">Satuan</label>
                                        @if($activity->activity_unit_target == 'bulan')
                                        <input type="text" name="unit" class="form-control" value="bulan" readonly id="satuan" required>
                                        @elseif($activity->activity_unit_target == 'dokumen')
                                        <input type="text" name="unit" class="form-control" value="dokumen" readonly id="satuan" required>
                                        @elseif($activity->activity_unit_target == 'persen')
                                        <select name="unit" name="unit" class="form-control" required id="satuan" required>
                                            <option value="bulan">Bulan</option>
                                            <option value="dokumen">Dokumen</option>
                                        </select>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="output">
                                    <div class="form-group">

                                        <div id="targetBulan" style="display:none">
                                            <label for="message">Target (Jumlah Bulan)</label>
                                            <input type="text" id="valueTargetBulan" class="form-control" value="12" readonly min=1 >
                                        </div>

                                        <div id="targetDokumen" style="display:none">
                                            <label for="message">Target (Jumlah Dokumen)</label>
                                            <input type="text" id="valueTargetDokumen" class="form-control"  placeholder="Jumlah Dokumen" min=1 >
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Indikator</label>
                            <textarea name="indicator" class="form-control" placeholder="Indikator" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="x_panel" style="margin-top:10px;margin-bottom:10px">
                    <div class="x_title">
                        <h2>Rincian Output</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="output">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-margin">
                            <div id="list-output">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Deskripsi Output</label>
                                            <input type="text" name="output[]" class="form-control" placeholder="Deskripsi Output" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-xs-12">
                            <button type="button" id="addOutput" class="btn btn-default col-lg-12" style="border:1px dashed gray"><i class="fa fa-plus"></i> Tambah Rincian Output</button=>
                        </div>
                    </div>
                </div>
                <div class="x_panel" style="margin-top:10px;margin-bottom:10px">
                    <div class="x_title">
                        <h2>Pilih Pelaksana</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-margin">
                        <div class="row">
                            @foreach($workers as $worker)
                            <div class="col-md-4 col-sm-3 ">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="flat" required name="pelaksana[]" value="{{$worker->id}}"> {{$worker->name}}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="float:right;margin-bottom:20px">Tambah Sub Kegiatan</buttoclass=>
                </div>
            </form>
</div>

@endsection

@section('js')
<script>
    checkSatuan();

    function checkSatuan() {
        if ($('#satuan').val() == 'bulan') {
            $('#targetBulan').show();
            $('#valueTargetBulan').prop('name','target');

            $('#valueTargetDokumen').prop('name','');
            $('#targetDokumen').hide();
            $('#valueTargetDokumen').val('');
        } else if ($('#satuan').val() == 'dokumen') {
            $('#targetDokumen').show();
            $('#valueTargetDokumen').prop('name','target');

            $('#valueTargetBulan').prop('name','');
            $('#targetBulan').hide();
            $('#valueTargetBulan').val('');

        }
    }

    $('#satuan').on('change', function() {
        checkSatuan();
    });
    $("#tableKegiatan").dataTable({
        "autoWidth": false,
        info: false,
        lengthChange: false
    });

    $('#btnTambahPeriode').on('click', function() {
        $('#addProgramModel').modal('show');
    })

    var inc = 1;

    $('#addOutput').on('click', function() {
        $('#list-output').append(`\
        <div class="row">\
        <div class="col-md-8">\
        <div class="input-group" id="output${inc}">\
      <input type="text" name="output[]" class="form-control" placeholder="Deskripsi Output" required>\
      <span class="input-group-btn">\
      <button type="button" class="btn btn-danger removeOutput" id="${inc}"><i class="fa fa-close"></i></button>\
      </span>\
      </div>\
    </div>\
        `);

        inc++;
    });

    $(document).on('click', '.removeOutput', function() {
        $id = $(this).attr('id');
        $('#output' + $id).remove();
    })
</script>
@endsection