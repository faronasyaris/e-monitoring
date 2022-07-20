<ul class="nav side-menu">
    <li class="{{(\Request::is('dashboard*')) ? 'current-page' : '' }}"><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
    <li class="{{(\Request::is('dataKantah*')) ? 'current-page' : '' }}"><a href="/account"><i class="fa fa-building"></i> Kelola Data Akun</a></li>
    <li class="{{(\Request::is('dataFieldstaff*')) ? 'current-page' : '' }}"><a href="/lihatLaporanAkun"><i class="fa fa-user"></i> Kelola Periode</a></li>
</ul>