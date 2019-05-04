@extends('master')

@section('css')
    <style>
        html, body {
            background-color: #fff;
            height: 100vh;
            font-family: 'Roboto+Condensed', sans-serif;
            background: url('/images/bg6.jpg');
            background-size:     cover;
            background-repeat:   no-repeat;
            background-position: center center;   
        }

        .main {
            min-height: 100%;
            display: flex;
            align-items: center;
        }

        .scoreboard {
            width: 50%;
            margin: auto;
            padding: 20px 50px;
            background: #FFFFFF;
            border-radius: 12px;
        }

        .scoreboard table span {
            width: 100px;
        }

    </style>
@endsection

@section('body')
    <div class="main">
        <div class="container">
            <div class="scoreboard shadow p-3 mb-5">
                <table class="table table-sm table-borderless text-center">
                    <tbody>
                        <tr>
                            <th scope="row"><h2>Titut</h2></th>
                            <td><h2><span class="badge badge-secondary">200</span></h2></td>
                        </tr>
                        <tr>
                            <th scope="row"><h2>Dandy</h2></th>
                            <td><h2><span class="badge badge-secondary">100</span></h2></td>
                        </tr>
                        <tr>
                            <th scope="row"><h2>Yoshi</h2></th>
                            <td><h2><span class="badge badge-secondary">90</span></h2></td>
                        </tr>
                        <tr>
                            <th scope="row"><h2>Randi</h2></th>
                            <td><h2><span class="badge badge-secondary">80</span></h2></td>
                        </tr>
                        <tr>
                            <th scope="row"><h2>Syauqi</h2></th>
                            <td><h2><span class="badge badge-secondary">70</span></h2></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
    </div>


@endsection

@section('js')

@endsection

