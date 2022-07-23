@extends("layouts.main")

@section('title')
Dashboard
@endsection

@section('sidebar')
@include('layouts.headOfDepartement-sidebar')
@endsection

@section('content')



@endsection

@section('script')
<script>
    chartDashboard('penyuluhan_fieldstaff', '#455C73');
    chartDashboard('pemetaan_fieldstaff', '#3498DB');
    chartDashboard('penyusunanModel_fieldstaff', '#9B59B6');
    chartDashboard('pendampingan_fieldstaff', '#26B99A');
    chartDashboard('penyusunanData_fieldstaff', '#BDC3C7');

    function chartDashboard(id, warna) {

        if (typeof($.fn.easyPieChart) === 'undefined') {
            return;
        }
        // console.log('chartDashboard');

        $('#' + id).easyPieChart({
            easing: 'easeOutElastic',
            delay: 3000,
            barColor: warna,
            trackColor: '#eceff3',
            scaleColor: false,
            lineWidth: 20,
            trackWidth: 16,
            lineCap: 'butt',
            onStep: function(from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent) + "%");
            }
        });

    };
</script>
@endsection


@section('js')

@endsection
