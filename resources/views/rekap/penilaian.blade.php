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
                                <h5 class="m-0">Penilaian Kurir {{ $kurir->name }}</h5>

                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#create">Create</button>
                            </div>

                            <table id="dtabel" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        
                                        <th class="no-export">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {{-- @foreach ($kurir as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>

                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#update{{ $item->id }}">Update</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $item->id }}">Delete</button>
                                                </div>

                                            </td>
                                        </tr>
                                        <!-- modal update -->
                                        <div id="update{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="update{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="update{{ $item->id }}Label">Update
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="custom-validation"
                                                            action="{{ route('kurir.update', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label>Name</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    required placeholder="Masukkan Nama"
                                                                    value="{{ $item->name }}" />
                                                            </div>
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
                                        <!-- modal delete -->
                                        <div id="delete{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="delete{{ $item->id }}Label" aria-hidden="true">
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
                                                    Apakah Anda yakin ingin menghapus Kurir
                                                    <strong style="font-size: 1rem;">{{ ucwords($item->name) }}
                                                        ?</strong>
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
                                                <form action="{{ route('kurir.destroy', $item->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger">Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                        <!-- /modal delete -->
                                    @endforeach --}}
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
