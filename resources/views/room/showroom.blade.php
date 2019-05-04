@extends('master')
@section('css')
    <style>
        html, body {
            background-color: #fff;
            height: 100vh;
            font-family: 'Roboto+Condensed', sans-serif;
            background: url('/images/bg5.jpg');
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
            background-color: #EF4A4E;
        }

        .kotak-soal-2 {
            position: absolute;
            bottom: 0;
            height: 34vh;
            width: 100vw;
            background-color: #C93E43;
            margin-bottom: 3vh;
        }

        .kotak-soal-3 {
            position: absolute;
            bottom: 0;
            height: 28vh;
            width: 94vw;
            background-color: #EAE0D4;
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
            padding: 0px 300px;
            text-align: center;
            width: 100%;
            display: inline-table;
        }

        .pilihan-jawaban .jawaban{
            width: 50%;
            text-align: center;
            display: inline-block;
            height: 50px;
            line-height: 50px;
            margin-bottom: 15px;
        }

        .jawaban p{
            background-color: #EAE0D4;
            border: 2px solid rgba(139, 139, 139, .3);
            border-radius: 25px;
            margin: 3px 0px;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            transition: all .2s;

            transition: transform .3s ease-in-out;
        }

        .jawaban.clicked p{
            background-color: #FFF7A5;
        }
        
        #kotak-time-bar {
            position: absolute;
            top: 0;
            height: 5vh;
            width: 50vw;
            background-color: #EAE0D4;
            left: 50%;
            margin-left: -25vw;
            border-radius: 5px;
        }

        #kotak-time-bar div {
            height: 100%;
            text-align: right;
            padding: 0 10px;
            line-height: 5vh;
            width: 0;
            background-color: #EF4A4E;
            box-sizing: border-box;
        }

    </style>
@endsection

@section('body')
    <div class="main">
        <div class="container text-center">
        </div>
            <div id="kotak-time-bar">
                <div></div>
            </div>

            <div class="kotak-soal-1">

                <div class="kotak-soal-2">
                    <div class="kotak-soal-3">
                    
                    <form method="" action="" id="jawab-soal">
                    @csrf
                    
                        <div class="soal">
                            <h5><b>Siapakah nama saya?</b></h5>
                        </div>

                        <div class="pilihan-jawaban">
                            <div class="jawaban">
                                <p>Dandy</p>
                            </div>
                            <div class="jawaban">
                                <p>Randi</p> 
                            </div>
                            <div class="jawaban">
                                <p>Titut</p>
                            </div>
                            <div class="jawaban">
                                <p>Syavira</p>
                            </div>
                        </div>
                    
                    </form>

                    </div>
                </div>
            </div>
        

    </div>

@endsection

@section('js')
    <script>
        $(function(){ 
            var flag = 0;

            $('.jawaban').click(function(){ 
                if(!flag){
                    $(this).addClass('clicked');
                    
                    flag = 1;
                }
                 
            }) 
        });

        function progress(timeleft, timetotal, $element) {
            var progressBarWidth = timeleft * $element.width() / timetotal;
            
            $('#kotak-time-bar div').animate(
                { width: progressBarWidth + 'px'}, 
                timeleft == timetotal ? 0 : 1000, 'linear');
            if(timeleft > 0) {
                
                setTimeout(function() {
                    progress(timeleft - 1, timetotal, $element);
                }, 1000);
                
            }
        };

        progress(15, 15, $('#kotak-time-bar'));

    </script>

@endsection