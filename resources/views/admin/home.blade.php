@extends('layout.dasboard')
@section('title')
Dasboard
@endsection
@section('content')
    <div class="card p-5 ">
        <h3>Selamat Datang di Ruang Terbuka, {{ Auth::user()->name }}</h3>
    </div>
@endsection
