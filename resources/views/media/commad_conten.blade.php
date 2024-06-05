@extends('layout.layout_media')
@section('title')
    Comentar
@endsection
@section('content')
    <div class="card px-2 mx-3 d-flex flex-row">
        @foreach ($post as $d)
        <div style="width: 20%; margin-top:10px;" >
            <img style="width: 110%; margin-top:0px;" class="rounded mb-2" src="{{ asset('storage/photo-content/' . $d->gambar) }}" alt="" class="card-img-top">
        </div>
        @endforeach
        <div class="container">
            <h3 class="font-weight-bold">Kommentar:</h3>
            <div class="commad my-2 mx-2 row" data-bs-spy="scroll">
                @foreach ($comd as $c)
                    <div id="comd" class="card Small shadow p-2 mb-2 mx-1">
                        <article class="font-weight-bold">{{ $c->user->name }}</article>
                        <article>{{ $c->commad }}</article>
                    </div>
                @endforeach
            </div>
            <a href="#" id="show-commad" class="mx-1 mb-2">Kommentar</a>
        </div>

    </div>

    <div class="fixed-bottom" id="commad-container" style="display: none;">
        @foreach ($post as $d)
            <div class="card px-2">
                <form method="POST" action="{{ route('createComment') }}">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" value="{{ $d->id }}" name="post_id">
                        <label for="exampleFormControlTextarea1">Comment</label>
                        <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        @endforeach
    </div>

    <script>
        document.getElementById('show-commad').addEventListener('click', function(event) {
            event.preventDefault();
            var commadContainer = document.getElementById('commad-container');
            commadContainer.style.display = commadContainer.style.display === 'block' ? 'none' : 'block';
        });
    </script>
@endsection
