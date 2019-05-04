@extends('master')
@section('css')
    <style>
        html, body {
            background-color: #fff;
            height: 100vh;
            font-family: 'Roboto+Condensed', sans-serif;
            background: url('/images/bg1.jpg');
            background-size:     cover;
            background-repeat:   no-repeat;
            background-position: center center;   
        }

        .main {
            min-height: 100%;
            display: flex;
            align-items: center;
        }
    </style>
@endsection

@section('body')
    <div class="main">
        <div class="container text-center">
        <form method="POST" action="{{ route('soal.add', $id_room)}}">
            @csrf
            {!! Form::label('PILIH PAKET SOAL') !!} <br/>
            @foreach($pakets as $paket)
            {!! Form::checkbox('paket_id[]', $paket->id, false) !!}
            {!! Form::label($paket->nama_paket) !!} <br/>
            @endforeach
            {!! Form::submit('SUBMIT') !!}
        </form>
        </div>
    </div>
@endsection

@section('js')

@endsection