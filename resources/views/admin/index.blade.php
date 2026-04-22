@extends('layouts.layout')

@section('title', 'Admin Management')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Management Account Admin Management</h5>

                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#create">Create</button>
                        </div>

                        <table id="dtabel" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>

                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-outline-warning btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#update{{ $item->id }}">Update</button>

                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $item->id }}">Delete</button>

                                            <div id="delete{{ $item->id }}" class="modal fade" tabindex="-1"
                                                role="dialog" aria-labelledby="delete{{ $item->id }}Label"
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
                                                                Apakah Anda yakin ingin menghapus admin
                                                                <strong style="font-size: 1rem;">{{ ucwords($item->name) }}
                                                                    ?</strong>

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
                                                            <form action="{{ route('admin.destroy', $item->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger">Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </td>
                                </tr>

                                <div id="update{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="update{{ $item->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="update{{ $item->id }}Label">Create
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="custom-validation"
                                                    action="{{ route('admin.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            required placeholder="Enter a valid name"
                                                            value="{{ $item->name }}" />
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Email</label>
                                                        <div>
                                                            <input type="email" class="form-control" required
                                                                parsley-type="email" name="email"
                                                                placeholder="Enter a valid e-mail"
                                                                value="{{ $item->email }}" />
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Password</label>
                                                        <div>
                                                            <input type="password" class="form-control"
                                                                name="password" />
                                                        </div>
                                                        <div class="mt-2">
                                                            <input type="password" class="form-control"
                                                                data-parsley-equalto="#pass2"
                                                                name="password_confirmation" />
                                                        </div>
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
                                </div><!-- /.modal -->
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
                <form class="custom-validation" action="{{ route('admin.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required
                            placeholder="Enter a valid name" />
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <div>
                            <input type="email" class="form-control" required parsley-type="email" name="email"
                                placeholder="Enter a valid e-mail" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <div>
                            <input type="password" id="pass2" class="form-control" name="password" required
                                placeholder="Enter a valid-password" />
                        </div>
                        <div class="mt-2">
                            <input type="password" class="form-control" required data-parsley-equalto="#pass2"
                                name="password_confirmation" placeholder="Please confirm your password" />
                        </div>
                    </div>

                    <input type="hidden" name="role" value="admin">

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