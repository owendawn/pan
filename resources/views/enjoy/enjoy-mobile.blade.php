@extends("layouts.app")
@section("head")
    <title xmlns:data-iview="http://www.w3.org/1999/xhtml" xmlns:data-iview="http://www.w3.org/1999/xhtml">应用中心 - Pan 攀</title>
    @include("common.checkLogin")
    <script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://d.139.sh/owendawn139/lib/icono/icono.min.css">

    <link rel="stylesheet" href="{{$base_url}}/css/enjoy/gallary.mobile.css"/>

    <style>
        /*==================================================================================*/
        input {
            border: 2px solid #5E6C77;
            font-size: 1.5em;
            padding: .25em .5em .3125em;
            color: #5E6C77;
            border-radius: .25em;
            background: transparent;
            -webkit-transition: all .100s;
            transition: all .100s;
        }

        input:focus {
            outline: none;
            color: #A2ACB3;
            border-color: #A2ACB3;
        }

        input.keyup {
            color: white;
            border-color: white;
            text-shadow: 0 0 .125em white;
            box-shadow: 0 0 .25em white, inset 0 0 .25em white;
        }

        body {
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        canvas {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            pointer-events: none;
        }

        input {
            font-family: "Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif;
        }

        ::-webkit-input-placeholder {
            color: #5E6C77;
            text-shadow: 0 0 .125em transparent;
            -webkit-transition: all .25s;
            transition: all .25s;
        }

        input:focus::-webkit-input-placeholder {
            opacity: .5;
        }

        ::-moz-placeholder {
            color: #5E6C77;
            text-shadow: 0 0 .125em transparent;
            -webkit-transition: all .25s;
            transition: all .25s;
        }

        input:focus::-moz-placeholder {
            opacity: .5;
        }

        :-ms-input-placeholder {
            color: #5E6C77;
            text-shadow: 0 0 .125em transparent;
            -webkit-transition: all .25s;
            transition: all .25s;
        }

        input:focus:-ms-input-placeholder {
            opacity: .5;
        }

        html, body {
            height: 100%;
            overflow: hidden;
        }

        html {
            background: #282E33;
        }

        .form-control:focus {
            border-color: #b4b3b3;
        }

        /*=====================================================*/
        .a_demo_four {
            background-color: #3bb3e0;
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            text-decoration: none;
            color: #fff;
            position: relative;
            padding: 10px 20px;
            padding-right: 50px;
            background-image: linear-gradient(bottom, rgb(44, 160, 202) 0%, rgb(62, 184, 229) 100%);
            background-image: -o-linear-gradient(bottom, rgb(44, 160, 202) 0%, rgb(62, 184, 229) 100%);
            background-image: -moz-linear-gradient(bottom, rgb(44, 160, 202) 0%, rgb(62, 184, 229) 100%);
            background-image: -webkit-linear-gradient(bottom, rgb(44, 160, 202) 0%, rgb(62, 184, 229) 100%);
            background-image: -ms-linear-gradient(bottom, rgb(44, 160, 202) 0%, rgb(62, 184, 229) 100%);
            background-image: -webkit-gradient(
                    linear,
                    left bottom,
                    left top,
                    color-stop(0, rgb(44, 160, 202)),
                    color-stop(1, rgb(62, 184, 229))
            );
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            -o-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #156785, 0px 10px 5px #999;
            -moz-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #156785, 0px 10px 5px #999;
            -o-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #156785, 0px 10px 5px #999;
            box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #156785, 0px 10px 5px #999;
            -webkit-transition: all 0.2s linear;
            -moz-transition: all 0.2s linear;
            -o-transition: all 0.2s linear;
            transition: all 0.2s linear;
        }

        .a_demo_four:hover {
            -webkit-transform: scale(1.05);
            -moz-transform: scale(1.05);
            -ms-transform: scale(1.05);
            -o-transform: scale(1.05);
            transform: scale(1.05);
            text-decoration: none;;
            color: white;
        }

        .a_demo_four:active {
            top: 3px;
            background-image: linear-gradient(bottom, rgb(62, 184, 229) 0%, rgb(44, 160, 202) 100%);
            background-image: -o-linear-gradient(bottom, rgb(62, 184, 229) 0%, rgb(44, 160, 202) 100%);
            background-image: -moz-linear-gradient(bottom, rgb(62, 184, 229) 0%, rgb(44, 160, 202) 100%);
            background-image: -webkit-linear-gradient(bottom, rgb(62, 184, 229) 0%, rgb(44, 160, 202) 100%);
            background-image: -ms-linear-gradient(bottom, rgb(62, 184, 229) 0%, rgb(44, 160, 202) 100%);
            background-image: -webkit-gradient(
                    linear,
                    left bottom,
                    left top,
                    color-stop(0, rgb(62, 184, 229)),
                    color-stop(1, rgb(44, 160, 202))
            );
            -webkit-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #156785, 0px 5px 3px #999;
            -moz-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #156785, 0px 5px 3px #999;
            -o-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #156785, 0px 5px 3px #999;
            box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #156785, 0px 5px 3px #999;
        }

        .a_demo_four::before {
            background-color: #2591b4;
            /*background-image:url(../images/right_arrow.png);*/
            content: "\e003";
            font-family: 'Glyphicons Halflings';
            padding: 3px;
            background-repeat: no-repeat;
            background-position: center center;
            width: 20px;
            height: 20px;
            position: absolute;
            right: 15px;
            top: 50%;
            margin-top: -9px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -o-border-radius: 50%;
            border-radius: 50%;
            -webkit-box-shadow: inset 0px 1px 0px #052756, 0px 1px 0px #60c9f0;
            -moz-box-shadow: inset 0px 1px 0px #052756, 0px 1px 0px #60c9f0;
            -o-box-shadow: inset 0px 1px 0px #052756, 0px 1px 0px #60c9f0;
            box-shadow: inset 0px 1px 0px #052756, 0px 1px 0px #60c9f0;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        .a_demo_four:hover::before {
            opacity: 0.5;
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }

        .a_demo_four:active::before {
            top: 50%;
            margin-top: -12px;
            -webkit-box-shadow: inset 0px 1px 0px #60c9f0, 0px 3px 0px #0e3871, 0px 6px 3px #1a80a6;
            -moz-box-shadow: inset 0px 1px 0px #60c9f0, 0px 3px 0px #0e3871, 0px 6px 3px #1a80a6;
            -o-box-shadow: inset 0px 1px 0px #60c9f0, 0px 3px 0px #0e3871, 0px 6px 3px #1a80a6;
            box-shadow: inset 0px 1px 0px #60c9f0, 0px 3px 0px #0e3871, 0px 6px 3px #1a80a6;
            opacity: 1;
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
            -webkit-transition: all 0.1s ease-in-out;
            -moz-transition: all 0.1s ease-in-out;
            -o-transition: all 0.1s ease-in-out;
            transition: all 0.1s ease-in-out;
        }

    </style>

    <style>

        /*==========================================================*/
        .background {
            background: -moz-linear-gradient(148deg, rgba(253, 43, 43, 0.8) 0%, rgba(255, 165, 0, 0.8) 13%, rgba(84, 255, 84, 0.8) 30%, rgba(28, 230, 28, 0.8) 40%, rgba(46, 222, 222, 0.8) 50%, rgba(37, 37, 255, 0.8) 70%, rgba(245, 72, 245, 0.8) 100%);
            background: -o-linear-gradient(148deg, rgba(253, 43, 43, 0.8) 0%, rgba(255, 165, 0, 0.8) 13%, rgba(84, 255, 84, 0.8) 30%, rgba(28, 230, 28, 0.8) 40%, rgba(46, 222, 222, 0.8) 50%, rgba(37, 37, 255, 0.8) 70%, rgba(245, 72, 245, 0.8) 100%);
            background: -webkit-linear-gradient(148deg, rgba(253, 43, 43, 0.8) 0%, rgba(255, 165, 0, 0.8) 13%, rgba(84, 255, 84, 0.8) 30%, rgba(28, 230, 28, 0.8) 40%, rgba(46, 222, 222, 0.8) 50%, rgba(37, 37, 255, 0.8) 70%, rgba(245, 72, 245, 0.8) 100%);
            background: linear-gradient(148deg, rgba(253, 43, 43, 0.8) 0%, rgba(255, 165, 0, 0.8) 13%, rgba(84, 255, 84, 0.8) 30%, rgba(28, 230, 28, 0.8) 40%, rgba(46, 222, 222, 0.8) 50%, rgba(37, 37, 255, 0.8) 70%, rgba(245, 72, 245, 0.8) 100%);
            background-attachment: fixed;
        }

        #leftarticle, #rightarticle {
            color: #CAF5F1;
            font-family: 'Alright Sans Light', 'Open Sans', sans-serif;
        }

        #nav-label {
            position: relative;
            height: 30%;
            padding: 0;
        }

        .panel-body {
            overflow-y: auto;
            overflow-x: hidden;
            height: 100%;;
        }

        .items--small {
            width: 48%;
            display: inline-block;
        }
    </style>

@endsection

@section("content")
    <div class="background" style="width: 100%;height: 100%;">
        <div class="panel-body scroll">
            @include("layouts.nav")
            <div class="col-xs-12 " style="margin-bottom: 10px;font-size: 14pt;text-align: left;margin-top: 15px;">
                <a href="{{$base_url}}/enjoy/enjoyedit" class="pull-right" data-toggle="tooltip" data-placement="bottom" title=""
                   data-original-title="应用管理">
                    <i class="glyphicon glyphicon-th-list"></i>应用管理
                </a>
            </div>
            <div class="col-xs-12"
                 style="padding:0;margin-bottom:10px; box-shadow: 0 -4px 13px 0px rgba(0,0,0,.3);margin-left: -16px;width: 109%;">
                <canvas class="canvas col-sm-8 col-sm-offset-2 col-xs-12" id="nav-label"></canvas>
            </div>
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label hidden">名字</label>

                        <div class="col-xs-8">
                            <input type="text" class="form-control" id="vedioname"
                                   placeholder="please fill the name of video"
                                   style="background: rgba(250, 244, 244, 0.7);box-shadow: 3px 5px 9px #999;">
                        </div>
                        <div class="col-xs-4" style="padding-top: 5px;padding-left: 0;">
                            <a class="a_demo_four" onclick="searchs();">search</a>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    function searchs() {
                        var vn = document.getElementById("vedioname").value;
                        if (vn.trim() != "") {
                            @if($isMobile==false)
                            window.open("http://v.baidu.com/v?word=" + encodeURIComponent(vn) + "&ct=301989888&rn=20&pn=0&db=0&s=0&fbl=800&ie=utf-8")
                            @endif
                             @if($isMobile==true)
                            window.open("http://m.v.baidu.com/search?word=" + encodeURIComponent(vn) + "&src=video")
                            @endif

                        }
                    }
                </script>
            </div>

            {{--===================================== 移动端 ====================================--}}
            <div id="gallery-container">
                <div>
                    <ul class="items--small sitems1" style="vertical-align: top;">
                    </ul>
                    <ul class="items--small sitems2" style="vertical-align: top;">
                    </ul>
                </div>
                <ul class="items--big">
                </ul>
                <div class="controls">
                    <span class="control icon-arrow-left" data-direction="previous"></span>
                    <span class="control icon-arrow-right" data-direction="next"></span>
                    <span class="grid icon-grid"></span>
                    <span class="fs-toggle icon-fullscreen"></span>
                </div>

            </div>

            <script src="http://cdn.bootcss.com/hammer.js/2.0.8/hammer.min.js"></script>
            <script src="http://cdn.bootcss.com/screenfull.js/3.0.2/screenfull.min.js"></script>

            <script>
                var baseUrl = "{{$base_url}}";
                var lkey = "{{session("lkey")}}" == "" ? null : "{{session("lkey")}}";
                var userId = lkey || localStorage[window.location.host + "-pan-key"];
                var token = "{{csrf_token()}}";
            </script>
            <script>
                (function init() {
                    $.post(baseUrl + "/api/videos!getVideoByUserId", {userid: userId}, function (data) {
                        var counts = data.data.length;
                        var ready = 0;
                        var imgssl1 = [], imgssl2 = [], imgs = [];
                        for (var i = 0; i < counts; i++) {
                            var img=data.data[i].img;
                            if (i % 2 == 0) {
                                imgssl1.push(' <li class="item" data-idx="' + i + '"><a href="#"><img src="' + img + '" alt="" /></a></li>');
                            } else {
                                imgssl2.push(' <li class="item" data-idx="' + i + '"><a href="#"><img src="' + img + '" alt="" /></a></li>');
                            }
                            imgs.push([
                                '<li class="item--big" data-idx="' + i + '">',
                                '   <a href="#">',
                                '       <figure>',
                                '           <img src="' + img + '" alt="" />',
                                '           <figcaption class="img-caption">' +
                                '               梦想的声音 ' +
                                '               <a href="'+data.data[i].link+'" style="color:lightskyblue;">' +
                                '                   Link<i class="glyphicon glyphicon-link"></i>' +
                                '               </a>' +
                                '           </figcaption>',
                                '       </figure>',
                                '   </a>',
                                '</li>'
                            ].join(""))
                        }
                        $(".sitems1").html(imgssl1.join(""));
                        $(".sitems2").html(imgssl2.join(""));
                        $(".items--big").html(imgs.join(""));
                        $("img").one("load", function () {
                            ready++;
                            if (ready == counts) {
                                $('#gallery-container').sGallery({
                                    fullScreenEnabled: false
                                });
                                ready = 0;
                            }
                        });
                    }, "json");
                })();
            </script>
            <script src="{{$base_url}}/js/enjoy/gallary.mobile.js"></script>
            <script src="{{$base_url}}/js/enjoy/inputanimation.js"></script>
            <script src="{{$base_url}}/js/enjoy/title.js"></script>
        </div>
    </div>
@endsection


