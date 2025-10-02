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
                                <h5 class="m-0">Penilaian Kurir {{ $kurirs->name }}</h5>

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
                                        // Kelompokkan rekap berdasarkan tanggal
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
                                                <a href="{{ route('rekap.detail', $kurirs->id) }}"
                                                    class="btn btn-outline-info btn-sm">Detail</a>
                                            </td>
                                        </tr>
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
                    <form class="custom-validation" action="{{ route('kurir.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" required
                                placeholder="Masukkan Nama" />
                        </div>
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
