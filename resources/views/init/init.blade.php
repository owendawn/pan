@extends('layouts.app')
@section("head")
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #B6BCC9;
            font-family: 'Comic Sans MS', cursive;
        }

        * {
            outline: none;
        }

        h1 {
            font-size: 25px;
            font-weight: 100;
            color: #2C2C2C;
            margin: 20px 25px;
            font-family: 'Comic Sans MS', cursive;;
        }

        a {
            text-decoration: none;
            color: #3476CA;
        }

        a:hover {
            color: #6CB5F3;
        }

        .open {
            position: fixed;
            width: 100px;
            height: 40px;
            left: 50%;
            top: -1000px;
            margin-left: -80px;
            margin-top: -30px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 6px;
            padding: 10px 30px;
            color: #444;
            transition: all ease-out 0.6s;
        }

        .open:hover {
            border: 1px solid #aaa;
            box-shadow: 0 0 8px #ccc inset;
            transition: all ease-out 0.6s;
        }

        .container {
            position: relative;
            min-height: 238px;
            margin-top: 119px;
            background-color: #F3F3F3;
            border-radius: 6px;
            box-shadow: 0px 0px 24px rgba(0, 0, 0, 0.4);
        }

        .container p, .container .slider-turn > div {
            width: 350px;
            font-size: 16px;
            color: #a8aab2;
            font-weight: 400;
            line-height: 28px;
            display: inline-block;
            margin: 0;
            vertical-align: top;
        }

        .container p input, .container .slider-turn > div input {
            max-width: -moz-calc(100% - 5px);
            max-width: -webkit-calc(100% - 5px);
            max-width: calc(100% - 5px);
        }

        .container .bottom {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            width: 100%;
            bottom: 0;
            position: absolute;
        }

        .container .bottom .step {
            flex: 3;
            -webkit-flex: 3;
            -ms-flex: 3;
            width: 100%;
            height: 54px;
            background-color: #373942;
            border-bottom-left-radius: 6px;
            display: flex;
        }

        .container .bottom .step span {
            flex: 1;
            -webkit-flex: 1;
            -ms-flex: 1;
            line-height: 54px;
            color: #fff;
            margin-left: 25px;
            font-size: 18px;
        }

        .container .bottom .step ul {
            flex: 2;
            -webkit-flex: 2;
            -ms-flex: 2;
            list-style: none;
            height: 10px;
            margin: 23px 0;
            padding-left: 15px;
        }

        .container .bottom .step ul li {
            position: relative;
            height: 7px;
            width: 7px;
            margin: 0 10px;
            float: left;
            border-radius: 50%;
            border: 1px solid #535560;
        }

        .container .bottom .step ul li:first-child:before {
            width: 0;
        }

        .container .bottom .step ul li:before {
            content: '';
            position: absolute;
            width: 20px;
            border-top: 1px solid #535560;
            left: -21px;
            top: 3px;
        }

        .container .bottom .step ul li.true {
            background-color: #7a7d86;
        }

        .container .bottom .step ul li.active {
            background-color: #fff;
            box-shadow: 0 0 6px rgba(255, 255, 255, 0.78);
        }

        .close {
            cursor: pointer;
        }

        .close:before,
        .close:after {
            content: "";
            position: absolute;
            height: 13px;
            width: 13px;
            top: 26px;
            right: 31px;
            border-top: 2px solid #7c7c7c;
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .close:before {
            right: 40px;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .btn {
            border-radius: 0;
        }

        .slider-container {
            width: 350px;
            margin: 0 25px;
            overflow: hidden;
        }

        .slider-turn {
            width: 10000px;
        }

        /*********************************button03***********************************/

        .menu {
            height: 34px;;
            width: initial;
            overflow: hidden;
            margin: 0;
            display: inline-block;
            text-align: center;
        }

        .menu ul {
            width: initial;
            display: inline-block;
            margin: 0;
            padding: 0;
        }

        .menu ul li {
            float: left;
            margin: 0 5px;
            list-style-type: none;
        }

        /* Menu Link Styles */
        .menu ul a {
            cursor: pointer;
            padding: 8px;
            display: block;
            background: #40e7df;
            color: #fff;
            font: lighter 16px "Helvetica Neue", Arial, Helvetica, Geneva, sans-serif;
            text-decoration: none;

            -webkit-transition: margin .4s ease-in-out;
            -moz-transition: margin .4s ease-in-out;
            -o-transition: margin .4s ease-in-out;
            -ms-transition: margin .4s ease-in-out;
            transition: margin .4s ease-in-out;
        }

        /* Secondary Link Styles */
        .menu ul a:nth-of-type(even) {
            background: #000;
            color: white;
        }

        /* Hover Slide */
        .menu ul li:hover :first-child {
            margin-top: -34px;
        }

        /***********************************end button03***********************************/
    </style>
    <title>数据库初始化 - Pan 攀</title>
    <link href="http://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
@endsection

@section("content")
    <div class="panel-body">
        @if(isset($logined)?$logined:false)
            <div class='container col-lg-4 col-lg-offset-4 col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-12' style="padding:0;">
                <h1>Guided tour initiation of App</h1>
                <span class='close'></span>

                <form id="theform" style="padding-bottom: 54px;">
                    <div class='slider-container'>
                        <div class='slider-turn'>

                            <p>Guided tour initiation of App inspired by Super Administrator</p>

                            <div>
                                please fill and Check the Database's IP HOST!
                                <br>

                                <div>
                                    <input type="text" name="ip" style="vertical-align: bottom;">

                                    <div class="menu" style="vertical-align: bottom">
                                        <ul id="aul">
                                            <li><a onclick="checkIp(this)">Check</a><a onclick="checkIp(this)">No
                                                    Check</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div style="font-size: 10pt;">
                                please fill and Check the User and Password of Mysql!<br>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                username:<input type="text" name="user" style="width: 40%;"><br>
                                password:<input type="text" name="pwd" style="width: 40%;">

                                <div class="menu" style="vertical-align: bottom">
                                    <ul id="aul2">
                                        <li><a onclick="checkdbconnect(this)">Check</a><a
                                                    onclick="checkdbconnect(this)">No
                                                Check</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div>
                                please fill the Database's DBName of Mysql and Check it!<br>
                                <input type="text" name="db">
                                <div class="menu" style="vertical-align: bottom">
                                    <ul id="aul3">
                                        <li><a onclick="checkdatabaseName(this)">Check</a><a
                                                    onclick="checkdatabaseName(this)">No
                                                Check</a></li>
                                    </ul>
                                </div>
                            </div>


                            <p>
                                <span id="inittableinfo">initializing the tables ... </span>
                            </p>

                            <p>
                                Thank you !<br><br>
                                <a href="{{$base_url}}/index">go to the Home Page ?</a><br>
                            </p>

                        </div>
                    </div>
                </form>
                <div class='bottom'>
                    <div class='step'>
                        <span>Step 1</span>
                        <ul class="hidden-xs">
                            <li data-num='1' class="active"></li>
                            <li data-num='2'></li>
                            <li data-num='3'></li>
                            <li data-num='4'></li>
                            <li data-num='5'></li>
                            <li data-num='6'></li>
                        </ul>
                    </div>
                    <button class='btn btn-info disabled' style="border-right-width: 3px;" id="prevbtn">prev</button>
                    <button class='btn btn-info' data-idx=1 data-dbchecked=false data-dbnamechecked="false"
                            data-connectcheck="false" id="nextbtn">Next
                    </button>
                </div>
            </div>
            <button class='open'>
                Open
            </button>

            <script type="text/javascript">

                function checkIp(obj) {
                    var _$ip = $("input[name='ip']");
                    if (_$ip.val() == "") {
                        $("#aul>li>a:nth-child(1)").css("background-color", "red");
                        $("#aul>li>a:nth-child(2)").text("Not Null");
                    } else {
                        $("#nextbtn").attr("data-dbchecked", true);
                        $("#nextbtn").removeClass("disabled");
                        $("#aul>li>a:nth-child(1)").css("background-color", "green");
                        $("#aul>li>a").text("Checked");
                    }
                }

                function checkdbconnect() {
                    if ($("#theform input[name='user']").val().trim() == "") {
                        $("#aul2>li>a:nth-child(1)").css("background-color", "red");
                        $("#aul2>li>a:nth-child(2)").text("User Not Null");
                    } else {
                        $("#aul2>li>a").text("Checking...");
                        $.post("{{$base_url}}/api/init!getConnectCheck", $("#theform").serialize(), function (data) {
                            if (data.data.isSuccess == true) {
                                $("#nextbtn").attr("data-connectcheck", true);
                                $("#nextbtn").removeClass("disabled");
                                $("#aul2>li>a:nth-child(1)").css("background-color", "green");
                                $("#aul2>li>a").text("Checked");
                            } else {
                                $("#aul2>li>a:nth-child(1)").css("background-color", "red");
                                $("#aul2>li>a:nth-child(1)").text("Check");
                                $("#aul2>li>a:nth-child(2)").text("No Check");
                                swal("warn!", data.data.info, "warning");
                            }
                        }, "json");
                    }
                }

                function checkdatabaseName(obj) {
                    if ($("input[name='db']") == "") {
                        $("#aul3>li>a:nth-child(1)").css("background-color", "red");
                        $("#aul3>li>a:nth-child(2)").text("DBName Not Null");
                    } else {
                        $("#aul3>li>a").text("Checking...");
                        $.post("{{$base_url}}/api/init!getDBNameCheck", $("#theform").serialize(), function (data) {
                            if (data.data.isSuccess == true) {
                                $("#nextbtn").attr("data-dbnamechecked", true);
                                $("#nextbtn").removeClass("disabled");
                                $("#aul3>li>a:nth-child(1)").css("background-color", "green");
                                $("#aul3>li>a").text("Checked");
                            } else {
                                $("#aul3>li>a:nth-child(1)").css("background-color", "red");
                                $("#aul3>li>a:nth-child(1)").text("Check");
                                $("#aul3>li>a:nth-child(2)").text("No Check");
                                swal("warn!", data.data.info, "warning");
                            }
                        }, "json");
                    }
                }

                function msgbtninitofall() {
                    $("#aul>li>a:nth-child(1)").css("background-color", "#40e7df");
                    $("#aul>li>a:nth-child(1)").text("Check");
                    $("#aul>li>a:nth-child(2)").text("No Check");
                    $("#aul2>li>a:nth-child(1)").css("background-color", "#40e7df");
                    $("#aul2>li>a:nth-child(1)").text("Check");
                    $("#aul2>li>a:nth-child(2)").text("No Check");
                    $("#aul3>li>a:nth-child(1)").css("background-color", "#40e7df");
                    $("#aul3>li>a:nth-child(1)").text("Check");
                    $("#aul3>li>a:nth-child(2)").text("No Check");
                }

                $('body').on('click', '.close', function () {
                    $('.container').animate({'opacity': 0}, 600);
                    $('.container').animate({'top': -1200}, {duration: 2300, queue: false});
                    $('.open').animate({'top': '50%'});
                });

                $('body').on('click', '.open', function () {
                    $('.open').animate({'top': -1000});
                    $('.container').animate({'opacity': 1}, 400);
                    $('.container').animate({'top': '50%'}, {duration: 800, queue: false});
                });

                $(document).ready(function () {
                    var _containerwidth = $(".container").width();
                    var _slidercontainerwidth = _containerwidth - 25 * 2;
                    $('.slider-container,.slider-turn >p,.slider-turn >div').css("width", _slidercontainerwidth + "px");
                    var nbP = $('.slider-turn >p,.slider-turn >div').length;
                    var w = _slidercontainerwidth;
                    var max = (nbP - 1) * w + 2 * nbP;

                    $('body').on('click', '.btn#nextbtn', function () {
                        msgbtninitofall();
                        $(this).prev().removeClass("disabled");
                        $(this).addClass("disabled");
                        if ($(this).attr("data-idx") == $(".step ul li").length) {
                            $(this).addClass("disabled");
                            return;
                        } else if ($(this).attr("data-idx") == $(".step ul li").length - 1) {
                            $(this).addClass("disabled");
                        }
                        if ($(this).attr("data-idx") == 2 && $(this).attr("data-dbchecked") == "false") {
                            return;
                        }
                        if ($(this).attr("data-idx") == 3 && $(this).attr("data-connectcheck") == "false") {
                            return;
                        }
                        if ($(this).attr("data-idx") == 4 && $(this).attr("data-dbnamechecked") == "false") {
                            return;
                        }

                        var margL = -Number($(this).attr("data-idx")) * _slidercontainerwidth + _slidercontainerwidth;
                        if (-margL < max) {
                            margL -= w;
                            $('ul li.active').addClass('true').removeClass('active');
                            var x = Number($(this).attr("data-idx")) + 1;
                            $('.slider-turn').animate({'margin-left': margL - x * 2}, 300);
                            $(this).attr("data-idx", x);
                            $('ul li[data-num="' + x + '"]').addClass('active');
                            $('.step span').html("Step " + x);
                            if ($(this).attr("data-idx") == 5) {
                                $.post("{{$base_url}}/api/init!getBaseTableInit", $("#theform").serialize(), function (data) {
                                    if (data.data.isSuccess == true) {
                                        $("#nextbtn").removeClass("disabled");
                                        $("#inittableinfo").text("initializing the tables ...");
                                        for(var i=0;i<data.data.infos.length;i++){
                                            $("#inittableinfo").append("<br>"+data.data.infos[i].desc);
                                        }
                                        $("#inittableinfo").append("<br>initialize the tables success,continue!");
                                    } else {
                                        swal("warn!", data.data.info, "warning");
                                    }
                                }, "json");

                            }
                        }
                    });

                    $('body').on('click', '.btn#prevbtn', function () {
                        msgbtninitofall();
                        var _$next = $(this).next();
                        _$next.removeClass("disabled");
                        if (_$next.attr("data-idx") == 1) {
                            $(this).addClass("disabled");
                            return;
                        } else if (_$next.attr("data-idx") == 2) {
                            $(this).addClass("disabled");
                        } else {
                            $(this).removeClass("disabled");
                        }
                        if (_$next.attr("data-idx") == 3 || _$next.attr("data-idx") == 2) {
                            _$next.attr("data-dbchecked", "false");
                            $("input[name='ip']").css("border", "2px inset");
                        }
                        if (_$next.attr("data-idx") == 4 || _$next.attr("data-idx") == 3) {
                            _$next.attr("data-connectcheck", "false");
                            $("input[name='user']").css("border", "2px inset");
                        }
                        if (_$next.attr("data-idx") == 5) {
                            _$next.attr("data-dbnamechecked", "false");
                        }


                        var margL = -Number(_$next.attr("data-idx")) * _slidercontainerwidth + _slidercontainerwidth;
                        if (-margL < max) {
                            margL += w;
                            $('ul li.active').addClass('true').removeClass('active');
                            var x = Number(_$next.attr("data-idx")) - 1;
                            $('.slider-turn').animate({'margin-left': margL - x * 2}, 300);
                            _$next.attr("data-idx", x);
                            $('ul li[data-num="' + x + '"]').addClass('active');
                            $('.step span').html("Step " + x);
                        }
                    });

                });
            </script>
        @endif
    </div>

@endsection


