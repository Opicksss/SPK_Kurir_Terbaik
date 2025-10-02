@extends('layouts.layout')

@section('title')
    Rekap Kurir
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Rekap Kurir</h5>

                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#create">Create</button>
                            </div>

                            <table id="dtabel" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Kurir</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->nama }}</th>
                                        @endforeach
                                        <th class="no-export">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($kurirs as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->name }}</td>

                                            <td>
                                                @foreach ($rekaps->where('kurir_id', $item->id) as $rekap)
                                                    {{ $rekap->nilai }} <br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('rekap.detail', $item->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
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
@endsection
