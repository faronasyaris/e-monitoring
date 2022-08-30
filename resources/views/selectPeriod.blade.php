<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/icon.ico') }}" />


    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <!-- <link href="{{ asset('vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" /> -->
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet"> -->
    <!-- <link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet"> -->
    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/custom2.min.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div
                class="row"style="margin-left:20px !important; margin-right:20px !important; margin-top:30px !important">
                <div class="col-md-12 col-sm-12 ">
                    <form action="/selectPeriod" method="post" id="formPilihPeriod">
                        @csrf
                        <div class="dashboard_graph">
                            <div class="row x_title">
                                <div class="col-md-10">
                                    <h3>Pilih Periode</h3>
                                </div>

                                <div class="col-md-2">
                                    <select name="year" class="form-control pull-right" id="year">
                                        @foreach ($years as $year)
                                            <option value="{{ $year->id }}"
                                                @if (empty(Request::get('year'))) @if ($year->year == date('Y'))
                                                selected @endif
                                            @else @if (Request::get('year') == $year->year) selected @endif @endif

                                                data-year = {{ $year->year }}>Periode
                                                {{ $year->year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @php
                                $checkPeriodByRequest = \App\Models\Periode::where('year', Request::get('year'))->first();
                                $checkPeridByYear = \App\Models\Periode::where('year', date('Y'))->first();
                            @endphp
                            @if ($years->count() == 0 ||
                                (!empty(Request::get('year')) && empty($checkPeriodByRequest)) ||
                                (empty(Request::get('year')) && empty($checkPeridByYear)))
                                <h4 class="text-center" style="margin-top:50px !important">Periode Belum Dibuat</h4>
                                <center> <a class="btn btn-success btn-sm" href="/logout">Logout</a></center>
                            @else
                                @foreach ($period as $periode)
                                    <div class="col-md-3 col-sm-3" style=" !important; margin-top:20px !important">
                                        <div class="x_panel tile  overflow_hidden">
                                            <div class="x_title">
                                                <h3 class="text-center">{{ $periode['month'] }}</h3>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <center><button type="button" class="btn btn-success btn-sm btnPilih"
                                                        data-month="{{ $periode['code'] }}"
                                                        data-monthName="{{ $periode['month'] }}"
                                                        onclick="{{ $periode['code'] > date('m') || Request::get('year') > date('Y') ? 'return false;' : '' }}"
                                                        {{ ($periode['code'] > date('m') && (Request::get('year') == date('Y') || empty(Request::get('year')))) || Request::get('year') > date('Y') ? 'disabled' : '' }}>Pilih
                                                        Bulan</button>
                                                </center>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <input type="hidden" id="month" name="month">
                        <input type="hidden" id="monthName" name="monthName">
                    </form>
                </div>
            </div>

        </div>

    </div>

</body>
<!-- jQuery -->
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<!-- <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script> -->
<!-- NProgress -->
<script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
<!-- Chart.js -->
<script src="{{ asset('vendors/Chart.js/dist/Chart.min.js') }}"></script>
<!-- gauge.js -->
<!-- <script src="{{ asset('vendors/gauge.js/dist/gauge.min.js') }}"></script> -->
<!-- bootstrap-progressbar -->
<script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
<!-- Skycons -->
<script src="{{ asset('vendors/skycons/skycons.js') }}"></script>
<!-- Flot -->
<!-- <script src="{{ asset('vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('vendors/Flot/jquery.flot.resize.js') }}"></script> -->
<!-- Flot plugins -->
<!-- <script src="{{ asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('vendors/flot.curvedlines/curvedLines.js') }}"></script> -->
<!-- DateJS -->
<!-- <script src="{{ asset('vendors/DateJS/build/date.js') }}"></script> -->
<!-- bootstrap-daterangepicker -->
<!-- <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script> -->
<!-- <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script> -->
<!-- Datatables -->
<script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- <script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script> -->
<!-- <script src="{{ asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script> -->
<!-- <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script> -->
<!-- <script src="{{ asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script> -->
<script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<!-- <script src="{{ asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script> -->
<!-- <script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script> -->
<!-- <script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script> -->
<!-- <script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script> -->
<!-- easy-pie-chart -->
<script src="{{ asset('vendors/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
<!-- Custom Theme Scripts -->
<script src="{{ asset('build/js/custom.min.js') }}"></script>

<script>
    $(document).on('click', '.btnPilih', function() {
        $('#month').val($(this).attr('data-month'));
        $('#monthName').val($(this).attr('data-monthName'));
        $('#formPilihPeriod').submit();
    })

    $(document).on('change', '#year', function() {
        console.log('aa');
        window.location.replace("/selectPeriod?year=" + $('option:selected', this).attr('data-year'));
    })
</script>

@yield('js')


</html>
