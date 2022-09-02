<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>On the Job Training</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        .tab {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tab td {
            font-size: x-small;
            padding: 7px;
        }

        .tab th {
            font-size: x-small;
            padding: 10px 3px;
        }

        tr td {
            font-size: x-small;
        }

        .baris tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .blue {
            background-color: #0275d8;
            color: white;
        }

        .imgLogo {
            x object-fit: cover;
            width: 15%;
        }

        .wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            grid-auto-rows: minmax(100px, auto);
        }

        .one {
            grid-column: 1 / 3;
            grid-row: 1;
        }

        .two {
            grid-column: 2 / 4;
            grid-row: 1 / 3;
        }

        .page_break {
            page-break-before: always;
        }
    </style>

</head>

<body>
    <center>
        <h4>
            Laporan Monitoring Dan Evaluasi Capaian Kinerja Program<br>

            Periode Bulan {{ session('monthName') }} Tahun Anggaran {{ session('yearName') }}<br>

            Dinas Peternakan Dan Perikanan Kabupaten Ciamis
        </h4>
    </center>
    <table width="100%" border=1 style="border-collapse: collapse" class="tab">
        <thead>
            <tr>
                <th rowspan="2" class="text-center" style="  vertical-align: middle;">KodeRek</th>
                <th rowspan="2" class="text-center" style="  vertical-align: middle;">Program</th>
                <th colspan="3" class="text-center" style="  vertical-align: middle;">Keuangan</th>
                <th rowspan="2" class="text-center" style="  vertical-align: middle;">Fisik %</th>
                <th rowspan="2" class="text-center" style="  vertical-align: middle;">Kinerja Indikator %
                </th>
            </tr>
            <tr>
                <th class="text-center">Anggaran</th>
                <th class="text-center">Realisasi</th>
                <th class="text-center">Kinerja%</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $program)
                <tr>
                    <td></td>
                    <td>{{ $program->program_name }}</td>
                    <td>Rp{{ number_format(\App\Models\Program::countProgramFinance($program->id)['totalBudget'], 0, '', '.') }}
                    </td>
                    <td>Rp{{ number_format(\App\Models\Program::countProgramFinance($program->id)['totalFinance'], 0, '', '.') }}
                    </td>
                    <td>{{ \App\Models\Program::countProgramFinance($program->id)['performance'] }}%</td>
                    <td>{{ \App\Models\ProgramOutcome::countPhysicalPerformance($program->id) }}%</td>
                    <td>{{ \App\Models\ProgramOutcome::countIndicatorPerformance($program->id) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
