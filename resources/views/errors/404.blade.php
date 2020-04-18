@extends("layouts.app")

@section("links")

@endsection

@section("content")
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 100;
            height: auto;
            margin: 0;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
            height:70vh;
        }

        .code {
            border-right: 2px solid;
            font-size: 26px;
            padding: 0 15px 0 15px;
            text-align: center;
        }

        .message {
            font-size: 18px;
            text-align: center;
        }

        footer {
            /*display: none;*/
            position: fixed;
            width:100%;
            bottom: 0;
        }
    </style>
    <div class="flex-center position-ref">
        <div class="code">404</div>

        <div class="message" style="padding: 10px;">
            {{ __("Not Found") }}
        </div>
    </div>
@endsection
