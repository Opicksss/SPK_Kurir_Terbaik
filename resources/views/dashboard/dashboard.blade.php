@extends('layouts.layout')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-md flex-shrink-0">
                                    <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                        <i class="uim uim-briefcase"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-4">
                                    <p class="text-muted text-truncate font-size-15 mb-2">Total Kriteria</p>
                                    <h3 class="fs-4 flex-grow-1 mb-3">{{ $totalKriteria }} <span
                                            class="text-muted font-size-16">Kriteria</span></h3>
                                    <p class="text-muted mb-0 text-truncate"><span
                                            class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                                class="mdi mdi-arrow-top-right"></i> Active</span> Kriteria Evaluasi</p>
                                </div>
                                <div class="flex-shrink-0 align-self-start">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle btn-icon border rounded-circle" href="#"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-more-2-fill text-muted font-size-16"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{ route('kriteria.index') }}">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-md flex-shrink-0">
                                    <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                        <i class="uim uim-layer-group"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-4">
                                    <p class="text-muted text-truncate font-size-15 mb-2">Total Kurir</p>
                                    <h3 class="fs-4 flex-grow-1 mb-3">{{ $totalKurir }} <span
                                            class="text-muted font-size-16">Kurir</span></h3>
                                    <p class="text-muted mb-0 text-truncate"><span
                                            class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                                class="mdi mdi-arrow-top-right"></i> Active</span> Kurir Terdaftar</p>
                                </div>
                                <div class="flex-shrink-0 align-self-start">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle btn-icon border rounded-circle" href="#"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-more-2-fill text-muted font-size-16"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{ route('kurir.index') }}">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-md flex-shrink-0">
                                    <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                        <i class="uim uim-scenery"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-4">
                                    <p class="text-muted text-truncate font-size-15 mb-2">Total Rekap</p>
                                    <h3 class="fs-4 flex-grow-1 mb-3">{{ $totalRekap }} <span
                                            class="text-muted font-size-16">Data</span></h3>
                                    <p class="text-muted mb-0 text-truncate"><span
                                            class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                                class="mdi mdi-arrow-top-right"></i> Evaluasi</span> Data Penilaian</p>
                                </div>
                                <div class="flex-shrink-0 align-self-start">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle btn-icon border rounded-circle" href="#"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-more-2-fill text-muted font-size-16"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{ route('rekap.index') }}">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-md flex-shrink-0">
                                    <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                        <i class="uim uim-airplay"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-4">
                                    <p class="text-muted text-truncate font-size-15 mb-2">Rata-rata Nilai</p>
                                    <h3 class="fs-4 flex-grow-1 mb-3"> 0 <span class="text-muted font-size-16">Skor</span>
                                    </h3>
                                    <p class="text-muted mb-0 text-truncate"><span
                                            class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                                class="mdi mdi-arrow-top-right"></i> Rata-rata</span> Nilai Evaluasi</p>
                                </div>
                                <div class="flex-shrink-0 align-self-start">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle btn-icon border rounded-circle" href="#"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-more-2-fill text-muted font-size-16"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{ route('rekap.index') }}">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ROW -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex pb-0">
                            <h4 class="card-title mb-0 flex-grow-1">Statistik Evaluasi Kurir</h4>
                            <div>
                                <a href="{{ route('rekap.index') }}" class="btn btn-soft-primary btn-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                        @if ($terbaik)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="mb-3">
                                            Kurir Terbaik
                                            {{ $terbaik->periode == 1 ? 'Januari - Juni' : 'Juli - Desember' }}
                                            {{ $terbaik->tahun }}
                                        </h5>

                                        <div class="d-flex align-items-center mb-3">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                                    <i class="uim uim-briefcase"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">{{ $terbaik->kurir->name }}</h6>
                                                <p class="text-muted mb-0">Kode: {{ $terbaik->kurir->kode }}</p>
                                                <p class="text-success mb-0">Nilai:
                                                    {{ number_format($terbaik->nilai_preferensi, 3) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card-body">
                                <div class="alert alert-warning mb-0">
                                    Belum ada data kurir terbaik untuk periode ini.
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex pb-1">
                            <h4 class="card-title mb-0 flex-grow-1">Ringkasan Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Total Sub Kriteria</span>
                                <span class="fw-bold">{{ $totalSubKriteria }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Rata-rata Nilai</span>
                                <span class="fw-bold text-success">0</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Total Evaluasi</span>
                                <span class="fw-bold">{{ $totalRekap }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Kurir Terdaftar</span>
                                <span class="fw-bold">{{ $totalKurir }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ROW -->

        </div> <!-- container-fluid -->
    </div>
@endsection
