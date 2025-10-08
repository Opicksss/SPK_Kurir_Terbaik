@extends('layouts.layout')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-md flex-shrink-0">
                                    <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                        <i class="uim uim-layers-alt"></i>
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

                <div class="col-xl-4 col-md-6">
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

                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-md flex-shrink-0">
                                    <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                        <i class="uim uim-document-layout-left"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-4">
                                    <p class="text-muted text-truncate font-size-15 mb-2">Rekap Hari Ini</p>
                                    <h3 class="fs-4 flex-grow-1 mb-3">{{ $sisaRekapHariIni }} <span
                                            class="text-muted font-size-16">Data</span></h3>
                                    <p class="text-muted mb-0 text-truncate">
                                        <span class="badge bg-subtle-success text-success font-size-12 fw-normal me-1">
                                            <i class="mdi mdi-arrow-top-right"></i> Sisa
                                        </span>
                                         Data Belum Dievaluasi
                                    </p>
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

            <div class="row mb-4">
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex pb-0">
                            <h4 class="card-title mb-0 flex-grow-1">Statistik Evaluasi Kurir</h4>
                            <div>
                                <a href="{{ route('topsis.index', ['periode_tahun' => $terbaik->first()->tahun . '-' . $terbaik->first()->periode]) }}" class="btn btn-soft-primary btn-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>

                        @if ($terbaik && $terbaik->count())
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <h5 class="mb-3">
                                            Kurir Terbaik
                                            {{ $terbaik->first()->periode == 1 ? 'Januari - Juni' : 'Juli - Desember' }}
                                            {{ $terbaik->first()->tahun }}
                                        </h5>
                                        @foreach ($terbaik as $item)
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                                        <i class="mdi mdi-account-circle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">{{ $item->kurir->name }}</h6>
                                                    <p class="text-muted mb-0">Kode: {{ $item->kurir->kode }}</p>
                                                    <p class="text-success mb-0">Nilai:
                                                        {{ number_format($item->nilai_preferensi, 3) }}</p>
                                                </div>
                                            </div>
                                            @endforeach
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

                <div class="col-xl-5">
                   <div class="card mb-0">
                        <div id="external-events">
                        </div>
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ROW -->

        </div> <!-- container-fluid -->
    </div>
@endsection
