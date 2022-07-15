@extends("layouts.main")

@section('title')
Data Program
@endsection

@section('sidebar')
@include('layouts.headOfDepartement-siderbar')
@endsection

@section("content")

<div class="page-breadcrumb">

  <center>
    <h4 class="page-title">Lihat Data Program</h4>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
      <!-- ============================================================== -->
      <!-- Start Page Content -->
      <!-- ============================================================== -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <center> <a href="/formAkun" class="btn btn-info btn-md">Tambah</a>
                <div class="table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Bidang</th>
                        <th>
                          <center>Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>
                          <center>
                            <a href="/editAkun" class="btn btn-info btn-md">Export</a>
                        </td>
                      </tr>
                      <tr>
                        <td>Garrett Winters</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>63</td>
                        <td>2011/07/25</td>
                      </tr>
                      <tr>
                        <td>Donna Snider</td>
                        <td>Customer Support</td>
                        <td>New York</td>
                        <td>27</td>
                        <td>2011/01/25</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>

@stop

@section('js')

@endsection