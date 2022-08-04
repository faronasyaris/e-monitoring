<!-- <li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/subKegiatan" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Pelaksanaan Sub Kegiatan</span></a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/capaianPelaksanaan" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Capaian Pelaksanaan</span></a>
</li> -->

<ul class="nav side-menu">
    <li class="{{(\Request::is('dashboard*')) ? 'current-page' : '' }}"><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
    <li class="{{(\Request::is('sub-kegiatan*')) ? 'current-page' : '' }}"><a href="/sub-kegiatan"><i class="fa fa-tasks"></i> Data Tugas</a></li>
</ul>