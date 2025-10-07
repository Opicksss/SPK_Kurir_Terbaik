@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Hasil Perhitungan TOPSIS ({{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }})</h3>
    <hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Nama Kurir</th>
                <th>Nilai Preferensi (Vᵢ)</th>
            </tr>
        </thead>
        <tbody>
            @php $rank = 1; @endphp
            @foreach($preferensi as $kurirId => $nilai)
                <tr>
                    <td>{{ $rank++ }}</td>
                    <td>{{ $kurirs->find($kurirId)->name }}</td>
                    <td>{{ number_format($nilai, 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
