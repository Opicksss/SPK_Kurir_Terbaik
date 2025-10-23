@extends('layouts.home.app')
@section('title', 'Home')

@section('content')
    <div class="page-content-home">
        <div class="container-fluid">
            <div class="container py-5">
                <div class="main-card mx-auto col-lg-12 col-md-10 col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h2 class="mb-1">Rangking Kurir Terbaik</h2>
                                <p class="text-muted mb-0">Lihat daftar kurir terbaik berdasarkan periode 6 bulan</p>
                            </div>

                            @php
                                $selectedValue = $selected ?? request('periode_tahun') ?? '';
                                $periodLabel = fn($row) => ($row->periode == 1 ? 'Januari - Juni' : ($row->periode == 2 ? 'Juli - Desember' : '-'));
                                $badgeClass = fn($rank) => $rank == 1 ? 'badge bg-success' : ($rank == 2 ? 'badge bg-primary' : ($rank == 3 ? 'badge bg-warning text-dark' : 'badge bg-secondary'));
                            @endphp

                            <form method="GET" action="{{ route('home') }}" class="mb-4">
                                <div class="row g-2">
                                    <div class="col-sm-8">
                                        <label for="periode_tahun" class="form-label visually-hidden">Pilih Periode</label>
                                        <select name="periode_tahun" id="periode_tahun" class="form-select select2" required>
                                            <option value="">-- Pilih Periode --</option>
                                            @foreach ($periodOptions as $opt)
                                                <option value="{{ $opt['value'] }}" {{ (string)$selectedValue === (string)$opt['value'] ? 'selected' : '' }}>
                                                    {{ $opt['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 d-grid">
                                        <button type="submit" class="btn btn-primary">Lihat Rangking</button>
                                    </div>
                                </div>
                            </form>

                            @if (isset($hasil) && $hasil->count())
                                <div class="table-responsive">
                                    <div style="max-height: 330px; overflow-y: auto;">
                                        <table class="table table-striped table-hover align-middle text-center mb-0" style="width:100%;">
                                        <thead class="table-light" style="position: sticky; top: 0; z-index: 2;">
                                            <tr>
                                                <th style="width:110px">Ranking</th>
                                                <th>Nama Kurir</th>
                                                <th style="width:230px">Nilai Preferensi</th>
                                                <th style="width:90px">Tahun</th>
                                                <th style="width:230px">Periode</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($hasil as $row)
                                                @php $rank = $row->ranking ?? $loop->iteration; @endphp
                                                <tr>
                                                    <td>
                                                        <span class="{{ $badgeClass($rank) }}" style="font-size:0.95rem; padding:0.45rem 0.6rem;">
                                                            #{{ $rank }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="fw-semibold">
                                                            {{ mb_strtoupper(mb_substr(optional($row->kurir)->name ?? '-', 0, 1, 'UTF-8')) . mb_substr(optional($row->kurir)->name ?? '-', 1, null, 'UTF-8') }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="small text-muted">Skor</div>
                                                        <div class="fw-medium">{{ number_format($row->nilai_preferensi ?? 0, 4) }}</div>
                                                    </td>
                                                    <td>{{ $row->tahun ?? '-' }}</td>
                                                    <td>
                                                        <span class="text-muted">{{ $periodLabel($row) }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-warning text-center mb-0">
                                    <div class="fw-semibold mb-1">Data belum tersedia</div>
                                    <div class="small text-muted">Rangking untuk periode 6 bulan yang dipilih belum dipublikasikan.</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
