@extends("layouts.main")

@section('title')
Kelola Periode
@endsection

@section('sidebar')
@include('layouts.secretary-sidebar')
@endsection

@section("content")
@include('sweetalert::alert')
<div class="col-md-12 col-sm-12 col-xs-12">
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
            @if(!empty($periods))
            <tbody>
                @foreach($periods as $periode)
                    <tr>
                        <td>Periode {{$periode->year}}</td>
                        <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                    </tr>
                @endforeach
            </tbody>
            @endif
        </table>
        <hr>
        <button class="btn btn-primary " style="float:right" id="btnTambahPeriode"> <i class="fa fa-user-plus"></i> Tambah Periode</button>
    </div>
</div>

<div class="modal fade" id="addPeriodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="number" name="year" class="form-control" min="2000" max="2099" required>
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
      $("#tablePeriode").dataTable({
        "autoWidth": false,
        info: false,
        lengthChange: false
    });
    
    $('#btnTambahPeriode').on('click',function(){
        $('#addPeriodeModal').modal('show');
    })
</script>
@endsection