<!-- <li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dataProgram" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Data Program</span></a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/progresProgram" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Progres Program</span></a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/laporanAkhir" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Lihat Laporan Akhir</span></a>
</li> -->

<ul class="nav side-menu">
    <li class="{{ \Request::is('dashboard*') ? 'current-page' : '' }}"><a href="/dashboard"><i class="fa fa-home"></i>
            Dashboard</a></li>
    <li class="{{ \Request::is('program*') ? 'current-page' : '' }}"><a href="/program"><i class="fa fa-clipboard "></i>
            Data Program</a></li>
    <li class="{{ \Request::is('kegiatan*') ? 'current-page' : '' }}"><a href="/kegiatan"><i class="fa fa-list-alt"></i>
            Data Kegiatan</a></li>
    <li class="{{ \Request::is('sub-kegiatan*') ? 'current-page' : '' }}"><a href="/sub-kegiatan"><i
                class="fa fa-tasks"></i> Data Sub Kegiatan</a></li>
    <li class="{{ \Request::is('report*') ? 'current-page' : '' }}"><a href="/report"><i class="fa fa-file"></i>
            Laporan </a></li>
    <li class=""><a href="/selectPeriod"><i class="fa fa-calendar"></i>
            Pilih Periode </a></li>
</ul>
