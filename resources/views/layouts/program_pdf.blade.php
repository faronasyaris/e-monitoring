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
    @if (auth()->user()->role == 'Kepala Bidang')
        <table width="100%" border=1 style="border-collapse: collapse" class="tab">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center" style="  vertical-align: middle;">KodeRek</th>
                    <th rowspan="2" class="text-center" style="  vertical-align: middle;">Program</th>
                    <th colspan="3" class="text-center" style="  vertical-align: middle;">Keuangan</th>
                    <th rowspan="2" class="text-center" style="  vertical-align: middle;">Fisik %</th>
                    <th rowspan="2" class="text-center" style="  vertical-align: middle;">Kinerja Indikator %
                    </th>
                    <th rowspan="2" class="text-center" style="  vertical-align: middle;">Tindak Lanjut
                    </th>
                </tr>
                <tr>
                    <th class="text-center">Anggaran</th>
                    <th class="text-center">Realisasi</th>
                    <th class="text-center">Kinerja%</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalBudget = 0;
                    $totalRealization = 0;
                    $totalFinancePerformance = 0;
                    $totalPhysical = 0;
                    $totalIndicator = 0;
                    $countFinancePerformance = 0;
                    $countActivityOutcome = 0;
                    $countIndicator = 0;
                @endphp
                @foreach ($data as $program)
                    @php
                        $totalBudget += \App\Models\Program::countProgramFinance($program->id)['totalBudget'];
                        $totalRealization += \App\Models\Program::countProgramFinance($program->id)['totalFinance'];
                        $totalFinancePerformance += \App\Models\Program::countProgramFinance($program->id)['performance'];
                        $countFinancePerformance++;
                        $totalPhysical += \App\Models\ProgramOutcome::countPhysicalPerformance($program->id);
                        $countActivityOutcome++;
                        $totalIndicator += \App\Models\ProgramOutcome::countIndicatorPerformance($program->id);
                        $countIndicator++;
                    @endphp
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
                        <td>{{ \App\Models\ProgramOutcome::countPhysicalPerformance($program->id) < 100 ? 'Perlu Evaluasi' : '-' }}
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        <center>Jumlah</center>
                    </td>
                    <td>Rp{{ number_format($totalBudget, 0, '', '.') }}</td>
                    <td>Rp{{ number_format($totalRealization, 0, '', '.') }}
                    </td>
                    <td>{{ round($totalFinancePerformance / $countFinancePerformance, 2) }}%</td>
                    <td>{{ round($totalPhysical / $countActivityOutcome, 2) }}%</td>
                    <td>{{ round($totalIndicator / $countIndicator, 2) }}%</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td colspan="3">
                        <center>
                            <p>Ciamis,...... {{ session('monthName') }} {{ session('yearName') }} <br>
                                Kepala Dinas Peternakan dan Perikanan <br>
                                Kabupaten Ciamis
                            </p>
                            <br>
                            <br>
                            <br>
                            <br>

                            <h5>{{ @\App\Models\User::where('role', 'Kepala Dinas')->first()->name }}</h5>
                        </center>
                    </td>
                </tr>
            </tbody>
        </table>
    @elseif(auth()->user()->role == 'Kepala Dinas')
        @foreach ($fields as $field)
            <br>
            <h4 class="text-align:center">{{ $field->name }}</h4>
            <table width="100%" border=1 style="border-collapse: collapse" class="tab">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="  vertical-align: middle;">KodeRek</th>
                        <th rowspan="2" class="text-center" style="  vertical-align: middle;">Program</th>
                        <th colspan="3" class="text-center" style="  vertical-align: middle;">Keuangan</th>
                        <th rowspan="2" class="text-center" style="  vertical-align: middle;">Fisik %</th>
                        <th rowspan="2" class="text-center" style="  vertical-align: middle;">Kinerja Indikator %
                        </th>
                        <th rowspan="2" class="text-center" style="  vertical-align: middle;">Tindak Lanjut
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center">Anggaran</th>
                        <th class="text-center">Realisasi</th>
                        <th class="text-center">Kinerja%</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalBudget = 0;
                        $totalRealization = 0;
                        $totalFinancePerformance = 0;
                        $totalPhysical = 0;
                        $totalIndicator = 0;
                        $countFinancePerformance = 0;
                        $countActivityOutcome = 0;
                        $countIndicator = 0;
                    @endphp
                    @foreach ($data->where('field_id', $field->id) as $program)
                        @php
                            $totalBudget += \App\Models\Program::countProgramFinance($program->id)['totalBudget'];
                            $totalRealization += \App\Models\Program::countProgramFinance($program->id)['totalFinance'];
                            $totalFinancePerformance += \App\Models\Program::countProgramFinance($program->id)['performance'];
                            $countFinancePerformance++;
                            $totalPhysical += \App\Models\ProgramOutcome::countPhysicalPerformance($program->id);
                            $countActivityOutcome++;
                            $totalIndicator += \App\Models\ProgramOutcome::countIndicatorPerformance($program->id);
                            $countIndicator++;
                        @endphp
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
                            <td>{{ \App\Models\ProgramOutcome::countPhysicalPerformance($program->id) < 100 ? 'Perlu Evaluasi' : '-' }}
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">
                            <center>Jumlah</center>
                        </td>
                        <td>Rp{{ number_format($totalBudget, 0, '', '.') }}</td>
                        <td>Rp{{ number_format($totalRealization, 0, '', '.') }}
                        </td>
                        <td>{{ $countFinancePerformance > 0 ? round($totalFinancePerformance / $countFinancePerformance, 2) : 0 }}%
                        </td>
                        <td>{{ $countActivityOutcome > 0 ? round($totalPhysical / $countActivityOutcome, 2) : 0 }}%
                        </td>
                        <td>{{ $countIndicator > 0 ? round($totalIndicator / $countIndicator, 2) : 0 }}%</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                        <td colspan="3">
                            <center>
                                <p>Ciamis,...... {{ session('monthName') }} {{ session('yearName') }} <br>
                                    Kepala Dinas Peternakan dan Perikanan <br>
                                    Kabupaten Ciamis
                                </p>
                                <br>
                                <br>
                                <br>
                                <br>

                                <h5>{{ @\App\Models\User::where('role', 'Kepala Dinas')->first()->name }}</h5>
                            </center>
                        </td>
                    </tr>
                </tbody>
            </table>
            @if (!$loop->last)
                <div class="page_break"></div>
            @endif
        @endforeach
    @endif
</body>

</html>
