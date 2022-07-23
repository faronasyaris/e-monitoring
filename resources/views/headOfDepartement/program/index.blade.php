@extends("layouts.main")

@section('title')
Data Program
@endsection

@section('sidebar')
@include('layouts.headOfDepartement-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h4 class="card-title">Data Program {{date('Y')}}</h4>
            <div class="clearfix"></div>
        </div>
        <table id="tableProgram" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama Program</th>
                    <th>Jumlah Indikator</th>
                    <th>Kinerja Indikator (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $program)
                <tr>
                    <td>{{$program->program_name}}</td>
                    <td>{{count($program->getProgramIndicator)}}</td>
                    <td>0.0</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
    </div>
</div>

<div class="modal fade" id="addProgramModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Tambah Program</h4>
            </div>
            <form action="/period" method="post">
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
    
    $('#btnTambahPeriode').on('click',function(){
        $('#addProgramModel').modal('show');
    })
</script>
@endsection
