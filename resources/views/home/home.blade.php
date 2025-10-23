@extends('layouts.home.app')
@section('title', 'Home')

@section('value')

    <a href="{{ route('login') }}" class="btn btn-outline-primary login-link">Login</a>
    <div class="container">
        <div class="main-card mx-auto col-lg-8 col-md-10 col-12">
            <h2 class="text-center">Rangking Kurir Terbaik</h2>
            <form method="GET" action="{{ route('home') }}" class="mb-4">
                <div class="form-group">
                    <label for="periode_tahun">Pilih Periode:</label>
                    <select name="periode_tahun" id="periode_tahun" class="form-control" required>
                        <option value="">-- Pilih Periode --</option>
                        @foreach ($periodOptions as $opt)
                            <option value="{{ $opt['value'] }}" {{ $selected == $opt['value'] ? 'selected' : '' }}>
                                {{ $opt['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2 w-100">Lihat Rangking</button>
            </form>

            @if ($hasil)
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Ranking</th>
                                <th>Nama Kurir</th>
                                <th>Nilai Preferensi</th>
                                <th>Tahun</th>
                                <th>Periode</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $row)
                                <tr>
                                    <td>{{ $row->ranking }}</td>
                                    <td>{{ $row->kurir->name }}</td>
                                    <td>{{ number_format($row->nilai_preferensi, 4) }}</td>
                                    <td>{{ $row->tahun }}</td>
                                    <td>{{ $row->periode == 1 ? 'Januari - Juni' : 'Juli - Desember' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center">
                    Data rangking periode 6 bulan belum tersedia.
                </div>
            @endif
        </div>
    </div>

@endsection
