@extends('layouts.layout')

@section('title')
    hasil topsis
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <h3 class="mb-3">Perhitungan TOPSIS ({{ $periode == 1 ? 'Jan–Jun' : 'Jul–Des' }}
                                    {{ $tahun }})</h3>

                                <form method="GET" class="mb-4">
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <select name="tahun" class="form-control">
                                                @for ($t = date('Y') - 2; $t <= date('Y') + 1; $t++)
                                                    <option value="{{ $t }}"
                                                        {{ $t == $tahun ? 'selected' : '' }}>{{ $t }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="periode" class="form-control">
                                                <option value="1" {{ $periode == 1 ? 'selected' : '' }}>Januari – Juni
                                                </option>
                                                <option value="2" {{ $periode == 2 ? 'selected' : '' }}>Juli – Desember
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-primary w-100">Tampilkan</button>
                                        </div>
                                    </div>
                                </form>

                                {{-- ================= 1️⃣ MATRIX NILAI (KONVERSI SUBKRITERIA) ================= --}}
                                <h5>1️⃣ Matrix Keputusan (Konversi Nilai → Bobot Subkriteria)</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kurir</th>
                                            @foreach ($kriterias as $k)
                                                <th>{{ $k->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kurirs as $kurir)
                                            <tr>
                                                <td>{{ $kurir->name }}</td>
                                                @foreach ($kriterias as $k)
                                                    <td>
                                                        {{ number_format($nilaiMatrix[$kurir->id][$k->id] ?? 0, 4) }}
                                                        <div class="text-muted" style="font-size: 11px;">
                                                            nilai: {{ number_format($nilaiAsliMatrix[$kurir->id][$k->id] ?? 0, 2) }}
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- ================= 2️⃣ MATRIX NORMALISASI ================= --}}
                                <h5 class="mt-4">2️⃣ Matrix Ternormalisasi (R)</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kurir</th>
                                            @foreach ($kriterias as $k)
                                                <th>{{ $k->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kurirs as $kurir)
                                            <tr>
                                                <td>{{ $kurir->name }}</td>
                                                @foreach ($kriterias as $k)
                                                    <td>{{ number_format($normalisasi[$kurir->id][$k->id] ?? 0, 4) }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- ================= 3️⃣ MATRIX TERBOBOT ================= --}}
                                <h5 class="mt-4">3️⃣ Matrix Terbobot (Y)</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kurir</th>
                                            @foreach ($kriterias as $k)
                                                <th>{{ $k->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kurirs as $kurir)
                                            <tr>
                                                <td>{{ $kurir->name }}</td>
                                                @foreach ($kriterias as $k)
                                                    <td>{{ number_format($terbobot[$kurir->id][$k->id] ?? 0, 4) }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- ================= 4️⃣ SOLUSI IDEAL ================= --}}
                                <h5 class="mt-4">4️⃣ Solusi Ideal (A⁺ dan A⁻)</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kriteria</th>
                                            <th>A⁺ (Maksimum)</th>
                                            <th>A⁻ (Minimum)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kriterias as $k)
                                            <tr>
                                                <td>{{ $k->nama }}</td>
                                                <td>{{ number_format($A_plus[$k->id], 4) }}</td>
                                                <td>{{ number_format($A_minus[$k->id], 4) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- ================= 5️⃣ JARAK IDEAL ================= --}}
                                <h5 class="mt-4">5️⃣ Jarak Terhadap Solusi Ideal (D⁺ dan D⁻)</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kurir</th>
                                            <th>D⁺</th>
                                            <th>D⁻</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kurirs as $k)
                                            <tr>
                                                <td>{{ $k->name }}</td>
                                                <td>{{ number_format($D_plus[$k->id], 4) }}</td>
                                                <td>{{ number_format($D_minus[$k->id], 4) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- ================= 6️⃣ NILAI PREFERENSI DAN RANKING ================= --}}
                                <h5 class="mt-4">6️⃣ Nilai Preferensi (V) dan Ranking</h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Peringkat</th>
                                            <th>Kurir</th>
                                            <th>Nilai V</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($ranking as $kurirId => $nilai)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $kurirs->find($kurirId)->name }}</td>
                                                <td>{{ number_format($nilai, 4) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
