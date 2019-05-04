@extends('master')
@section('css')
    <style>
        html, body {
            background-color: #fff;
            height: 100vh;
            font-family: 'Roboto+Condensed', sans-serif;
            background: url('/images/bg4.jpg');
            background-size:     cover;
            background-repeat:   no-repeat;
            background-position: center center;   
        }

        .main {
            min-height: 100%;
            display: flex;
            align-items: center;
        }

        .kotak-soal-1 {
            position: absolute;
            bottom: 0;
            height: 40vh;
            width: 100vw;
            background-color: #DD0A00;
        }

        .kotak-soal-2 {
            position: absolute;
            bottom: 0;
            height: 34vh;
            width: 100vw;
            background-color: #65171D;
            margin-bottom: 3vh;
        }

        .kotak-soal-3 {
            position: absolute;
            bottom: 0;
            height: 28vh;
            width: 94vw;
            background-color: #FFFFFF;
            margin-bottom: 3vh;
            left: 50%;
            margin-left: -47vw;
            border-radius: 10px;
        }

        .kotak-soal-3 .soal {
            padding: 10px 300px;
            text-align: center;
        }

        .kotak-soal-3 .pilihan-jawaban {
            padding: 10px 300px;
            text-align: center;
        }

        
    </style>
@endsection

@section('body')
    <div class="main">
        <div class="container text-center">
        </div>
    
        <div class="kotak-soal-1">

            <div class="kotak-soal-2">
                <div class="kotak-soal-3">
                    <div class="soal">
                        <h5><b>Siapakah nama saya?</b></h5>
                    </div>

                    <div class="pilihan-jawaban">
                        <div class="jawaban">
                            Dandy
                        </div>
                        <div class="jawaban">
                            Randi 
                        </div>
                        <div class="jawaban">
                            Titut
                        </div>
                        <div class="jawaban">
                            Syavira
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
@endsection