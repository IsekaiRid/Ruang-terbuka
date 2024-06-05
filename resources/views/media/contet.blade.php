@extends('layout.layout_media')
@section('title')
    Tamu
@endsection
@section('content')
    <div class="card py-2 px-3 mx-4">
        <div class="d-flex justify-content-center">
            <div class="row d-flex justify-content-center">
                @forelse ($konten as $d)
                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/photo-content/' . $d->gambar) }}" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $d->konten }}</h5>
                                <h6 class="text-muted">Postingan: {{ $d->user->name }}</h6>
                                <p class="card-text">{{ $d->des }}</p>
                                <a href="{{ route('comentar', $d->id) }}" class="btn btn-outline-success btn-sm">Comment</a>
                                <a class="btn btn-outline-danger btn-sm likeButton" data-post-id="{{ $d->id }}">
                                    <i class="far fa-heart"></i> {{ htmlspecialchars($likes[$d->id]) }}
                                </a>
                                @if (auth()->check() && $d->user_id == auth()->user()->id)
                                    <div class="dropdown btn-group">
                                        <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('posting.edit', $d->id) }}">
                                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Edit
                                            </a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#DeleModal{{ $d->id }}"> <i
                                                    class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="DeleModal{{ $d->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Apa kamu mau hapus postingan ini</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('delate.posting', $d->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" class="form-control" id="id_post"
                                                            name="id_post" value="{{ $d->id }}">
                                                        <button type="submit" class="dropdown-item btn btn-denger">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No data found.</p>
                @endforelse
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.likeButton', function() {
                const $likeButton = $(this);
                const postId = $likeButton.data('postId');
                $.ajax({
                    url: `/like/${postId}`,
                    method: 'GET',
                    success: function({
                        likes,
                        liked
                    }) {
                        $likeButton
                            .toggleClass('liked', liked)
                            .html(`<i class="far fa-heart"></i> ${likes}`)
                            .find('.likes-count').text(likes);
                    },
                    error: console.error
                });
            });
        });
    </script>
@endsection
