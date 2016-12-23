@extends('layouts.app')

@section("head")
    <style type="text/css">
        body,
        html {
            margin: 0;
            padding: 0;
        }

        canvas {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            user-select: none;
        }

        canvas div {
            background-color: transparent;
        }

        #scene {
            background-color: black;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            user-select: none;
        }
    </style>
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section("content")
    <canvas id='scene'></canvas>
    <script src="{{$base_url}}/js/login/registerbg.js"></script>
@endsection


