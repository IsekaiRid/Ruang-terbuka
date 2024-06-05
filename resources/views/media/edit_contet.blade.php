@extends('layout.layout_media')
@section('title')
    Posting
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
    <div class="card mx-4">
        @foreach ($post as $d)
            <div style="width: 20%; margin:20px;">
                <img style="width: 110%; margin-top:0px;" class="rounded mb-2"
                    src="{{ asset('storage/photo-content/' . $d->gambar) }}" alt="" class="card-img-top">
            </div>
            <form method="POST" action="{{ route('editpost') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" id="id_user" name="id_user" value=" {{ Auth::user()->id }}">
                <input type="hidden" class="form-control" id="id_post" name="id_post" value="{{ $d->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="konten" class="col-form-label">Kontet</label>
                        <input type="text" class="form-control" id="konten" name="konten"
                            value="{{ $d->konten }}">
                        @error('konten')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Des" class="col-form-label">Desripsi</label>
                        <input type="text" class="form-control" id="konten" name="des"
                            value="{{ $d->des }}">
                        @error('des')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="gambar" class="col-form-label">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                <label class="custom-file-label" for="gambar">Choose file</label>
                            </div>
                        </div>
                        @error('gambar')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>

        @endforeach
    </div>
@endsection
