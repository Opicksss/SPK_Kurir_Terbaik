@extends('layouts.layout')

@section('title')
    Penilaian Kurir
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="m-0">
                                    <a href="{{ route('rekap.index') }}" class="text-decoration-none">
                                        Rekap Nilai
                                    </a>
                                    > Penilaian Kurir {{ $kurirs->name }}
                                </h5>

                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#create">Create</button>
                            </div>

                            <table id="dtabel" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->nama }}</th>
                                        @endforeach
                                        <th class="no-export">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $rekapByDate = $rekaps->groupBy('date');
                                    @endphp
                                    @foreach ($rekapByDate as $date => $rekapItems)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</td>
                                            @foreach ($kriterias as $kriteria)
                                                @php
                                                    $nilai = $rekapItems->where('kriteria_id', $kriteria->id)->first();
                                                @endphp
                                                <td>
                                                    {{ $nilai ? $nilai->nilai : '-' }}
                                                </td>
                                            @endforeach
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#update{{ $loop->iteration }}">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $loop->iteration }}">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Update -->
                                        <div id="update{{ $loop->iteration }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="update{{ $loop->iteration }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="update{{ $loop->iteration }}Label">
                                                            Update Rekap
                                                            ({{ \Carbon\Carbon::parse($date)->format('d-m-Y') }})
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('rekap.update', $date) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            @foreach ($kriterias as $kriteria)
                                                                @php
                                                                    $nilai = $rekapItems->where('kriteria_id', $kriteria->id)->first();
                                                                @endphp
                                                                @if (strtolower($kriteria->nama) === 'keterlambatan')
                                                                    <div class="mb-3">
                                                                        <label>{{ $kriteria->nama }}</label>
                                                                        <div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="nilai[{{ $kriteria->id }}]" id="keterlambatan0{{ $loop->parent->iteration }}" value="0" {{ $nilai && $nilai->nilai == 0 ? 'checked' : '' }} required>
                                                                                <label class="form-check-label" for="keterlambatan0{{ $loop->parent->iteration }}">Tidak Terlambat</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="nilai[{{ $kriteria->id }}]" id="keterlambatan1{{ $loop->parent->iteration }}" value="1" {{ $nilai && $nilai->nilai == 1 ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="keterlambatan1{{ $loop->parent->iteration }}">Terlambat</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif (strtolower($kriteria->nama) !== 'masa kerja')
                                                                    <div class="mb-3">
                                                                        <label>{{ $kriteria->nama }}</label>
                                                                        <input type="number" class="form-control" name="nilai[{{ $kriteria->id }}]"
                                                                            value="{{ $nilai ? $nilai->nilai : '' }}"
                                                                            required placeholder="Masukkan nilai {{ $kriteria->nama }}" min="0" />
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            <input type="hidden"
                                                                name="nilai[{{ $kriterias->where('nama', 'Masa Kerja')->first()->id ?? '' }}]"
                                                                value="{{ \Carbon\Carbon::parse($kurirs->tanggal_masuk)->diffInYears(now()) }}" />
                                                            <input type="hidden" name="kurir_id" value="{{ $kurirs->id }}">
                                                            <div class="mb-0">
                                                                <div class="d-flex justify-content-end">
                                                                    <button type="submit"
                                                                        class="btn btn-primary waves-effect waves-light me-1">
                                                                        Submit
                                                                    </button>
                                                                    <button type="reset"
                                                                        class="btn btn-secondary waves-effect">
                                                                        Reset
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                        <!-- /modal update -->

                                        <!-- Modal Delete -->
                                        <div id="delete{{ $loop->iteration }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete{{ $loop->iteration }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header justify-content-center">
                                                        <h5 class="modal-title text-danger">
                                                            Konfirmasi Penghapusan
                                                        </h5>
                                                    </div>

                                                    <!-- Modal Body -->
                                                    <div class="modal-body text-center">
                                                        <p class="mb-4">
                                                            Apakah Anda yakin ingin menghapus semua rekap pada tanggal
                                                            <strong style="font-size: 1rem;">
                                                                {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}
                                                            </strong>?
                                                            Tindakan ini tidak dapat dibatalkan.
                                                        </p>
                                                        <div class="d-flex justify-content-center">
                                                            <i class="bi bi-exclamation-circle-fill text-warning"
                                                                style="font-size: 3rem;"></i>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Footer -->
                                                    <div class="modal-footer justify-content-center gap-3">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Close
                                                        </button>
                                                        <form action="{{ route('rekap.destroy', $date) }}" method="POST"
                                                            style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                        <!-- /modal delete -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div> <!-- end row -->




    <!-- sample modal content -->

    <div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">Create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="custom-validation" action="{{ route('rekap.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="date" required
                                placeholder="Masukkan Tanggal" />
                        </div>
                        @foreach ($kriterias as $kriteria)
                            @if (strtolower($kriteria->nama) === 'keterlambatan')
                                <div class="mb-3">
                                    <label>{{ $kriteria->nama }}</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nilai[{{ $kriteria->id }}]" id="keterlambatan0" value="0" required>
                                            <label class="form-check-label" for="keterlambatan0">Tidak Terlambat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nilai[{{ $kriteria->id }}]" id="keterlambatan1" value="1">
                                            <label class="form-check-label" for="keterlambatan1">Terlambat</label>
                                        </div>
                                    </div>
                                </div>
                            @elseif (strtolower($kriteria->nama) !== 'masa kerja')
                                <div class="mb-3">
                                    <label>{{ $kriteria->nama }}</label>
                                    <input type="number" class="form-control" name="nilai[{{ $kriteria->id }}]"
                                        required placeholder="Masukkan nilai {{ $kriteria->nama }}" min="0" />
                                </div>
                            @endif
                        @endforeach
                        <input type="hidden"
                            name="nilai[{{ $kriterias->where('nama', 'Masa Kerja')->first()->id ?? '' }}]"
                            value="{{ \Carbon\Carbon::parse($kurirs->tanggal_masuk)->diffInYears(now()) }}" />
                        <input type="hidden" name="kurir_id" value="{{ $kurirs->id }}">
                        <div class="mb-0">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
