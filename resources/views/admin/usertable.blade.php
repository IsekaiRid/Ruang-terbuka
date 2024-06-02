@extends('layout.dasboard')
@section('title')
    Usert
@endsection
@section('content')
    @if (session('sukses'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <h5>Sukses!</h5>
            {{ session('sukses') }}
        </div>
    @endif
    @if (session('gagal'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <h5>Gagal!</h5>
            {{ session('gagal') }}
        </div>
    @endif
    <div class="card p-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-add">
                    <i class="fas fa-plus fa-sm"></i>
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>{{ $d->role == 1 ? 'admin' : 'petugas' }}</td>
                                    <td><a class="btn btn-primary" data-toggle="modal"
                                            data-target="#modal-edit{{ $d->id }}">
                                            <i class="fas fa-edit fa-sm"></i>
                                        </a>
                                        <a class="btn btn-danger" data-toggle="modal"
                                            data-target="#modal-del{{ $d->id }}">
                                            <i class="fas fa-trash fa-sm"></i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-edit{{ $d->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('update.user') }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" id="id"
                                                        value="{{ $d->id }}">
                                                    <div class="form-group">
                                                        <label for="edit-name" class="col-form-label">Name:</label>
                                                        <input type="text" class="form-control" id="edit-name"
                                                            name="name">
                                                        @error('name')
                                                            <strong>{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit-email" class="col-form-label">Email:</label>
                                                        <input type="email" class="form-control" id="edit-email"
                                                            name="email">
                                                        @error('email')
                                                            <strong>{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit-password" class="col-form-label">Password:</label>
                                                        <input type="password" class="form-control" id="edit-password"
                                                            name="password">
                                                        @error('password')
                                                            <strong>{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit-role" class="col-form-label">Role:</label>
                                                        <select class="form-control" id="edit-role" name="role">
                                                            <option value="">Pilih Role</option>
                                                            <option value="1">Admin</option>
                                                            <option value="2">Petugas</option>
                                                        </select>
                                                        @error('role')
                                                            <strong>{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="modal-del{{ $d->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('users.destroy',$d->id) }}" method="POST">
                                                @csrf
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delate usert</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit{{ $d->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('update.user') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="{{ $d->id }}">
                        <div class="form-group">
                            <label for="edit-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="edit-name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="edit-email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="edit-email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="edit-password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="edit-password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="edit-role" class="col-form-label">Role:</label>
                            <select class="form-control" id="edit-role" name="role">
                                <option value="">Pilih Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Petugas</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="{{ route('add.user') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="edit-name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="edit-email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="edit-email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="edit-password" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="edit-password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="edit-role" class="col-form-label">Role:</label>
                        <select class="form-control" id="edit-role" name="role">
                            <option value="">Pilih Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Petugas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
