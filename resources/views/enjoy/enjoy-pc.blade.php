@extends('layouts.app')
@section("head")
    @include("common.checkLogin")
    <title xmlns:data-iview="http://www.w3.org/1999/xhtml" xmlns:data-iview="http://www.w3.org/1999/xhtml">应用中心 - Pan 攀</title>
    <script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/normalize/2.1.3/normalize.min.css"/>
    <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.bootcss.com/lightgallery/1.3.7/css/lightgallery.min.css">
    <link rel="stylesheet" href="{{$base_url}}/css/enjoy/enjoy.pc.css">


    <style>

/*==================================输入框特效样式================================================*/
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
            box-shadow: 0 0 .25em white,inset 0 0 .25em white;
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
            font-family: "Arial Rounded MT Bold","Helvetica Rounded",Arial,sans-serif;
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
        /*===================按钮样式==================================*/
        .a_demo_four {
            background-color:#3bb3e0;
            font-family: Tahoma, Geneva, sans-serif;
            font-size:12px;
            text-decoration:none;
            color:#fff;
            position:relative;
            padding:10px 20px;
            padding-right:50px;
            background-image: linear-gradient(bottom, rgb(44,160,202) 0%, rgb(62,184,229) 100%);
            background-image: -o-linear-gradient(bottom, rgb(44,160,202) 0%, rgb(62,184,229) 100%);
            background-image: -moz-linear-gradient(bottom, rgb(44,160,202) 0%, rgb(62,184,229) 100%);
            background-image: -webkit-linear-gradient(bottom, rgb(44,160,202) 0%, rgb(62,184,229) 100%);
            background-image: -ms-linear-gradient(bottom, rgb(44,160,202) 0%, rgb(62,184,229) 100%);
            background-image: -webkit-gradient(
                    linear,
                    left bottom,
                    left top,
                    color-stop(0, rgb(44,160,202)),
                    color-stop(1, rgb(62,184,229))
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
        .a_demo_four:hover{
            -webkit-transform: scale(1.05);
            -moz-transform: scale(1.05);
            -ms-transform: scale(1.05);
            -o-transform: scale(1.05);
            transform: scale(1.05);
            text-decoration: none;;
            color:white;
        }

        .a_demo_four:active {
            top:3px;
            background-image: linear-gradient(bottom, rgb(62,184,229) 0%, rgb(44,160,202) 100%);
            background-image: -o-linear-gradient(bottom, rgb(62,184,229) 0%, rgb(44,160,202) 100%);
            background-image: -moz-linear-gradient(bottom, rgb(62,184,229) 0%, rgb(44,160,202) 100%);
            background-image: -webkit-linear-gradient(bottom, rgb(62,184,229) 0%, rgb(44,160,202) 100%);
            background-image: -ms-linear-gradient(bottom, rgb(62,184,229) 0%, rgb(44,160,202) 100%);
            background-image: -webkit-gradient(
                    linear,
                    left bottom,
                    left top,
                    color-stop(0, rgb(62,184,229)),
                    color-stop(1, rgb(44,160,202))
            );
            -webkit-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #156785, 0px 5px 3px #999;
            -moz-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #156785, 0px 5px 3px #999;
            -o-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #156785, 0px 5px 3px #999;
            box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #156785, 0px 5px 3px #999;
        }

        .a_demo_four::before {
            background-color:#2591b4;
            /*background-image:url(../images/right_arrow.png);*/
            content: "\e003";
            font-family: 'Glyphicons Halflings';
            padding:3px;
            background-repeat:no-repeat;
            background-position:center center;
            width:20px;
            height:20px;
            position:absolute;
            right:15px;
            top:50%;
            margin-top:-9px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -o-border-radius: 50%;
            border-radius: 50%;
            -webkit-box-shadow: inset 0px 1px 0px #052756, 0px 1px 0px #60c9f0;
            -moz-box-shadow: inset 0px 1px 0px #052756, 0px 1px 0px #60c9f0;
            -o-box-shadow: inset 0px 1px 0px #052756, 0px 1px 0px #60c9f0;
            box-shadow: inset 0px 1px 0px #052756, 0px 1px 0px #60c9f0;
            -webkit-transition:all 0.3s ease-in-out;
            -moz-transition:all 0.3s ease-in-out;
            -o-transition:all 0.3s ease-in-out;
            transition:all 0.3s ease-in-out;
            -webkit-transform:rotate(0deg);
            -moz-transform:rotate(0deg);
            -ms-transform:rotate(0deg);
            -o-transform:rotate(0deg);
            transform:rotate(0deg);
        }
        .a_demo_four:hover::before {
            opacity:0.5;
            -webkit-transform:rotate(360deg);
            -moz-transform:rotate(360deg);
            -ms-transform:rotate(360deg);
            -o-transform:rotate(360deg);
            transform:rotate(360deg);
        }

        .a_demo_four:active::before {
            top:50%;
            margin-top:-12px;
            -webkit-box-shadow: inset 0px 1px 0px #60c9f0, 0px 3px 0px #0e3871, 0px 6px 3px #1a80a6;
            -moz-box-shadow: inset 0px 1px 0px #60c9f0, 0px 3px 0px #0e3871, 0px 6px 3px #1a80a6;
            -o-box-shadow: inset 0px 1px 0px #60c9f0, 0px 3px 0px #0e3871, 0px 6px 3px #1a80a6;
            box-shadow: inset 0px 1px 0px #60c9f0, 0px 3px 0px #0e3871, 0px 6px 3px #1a80a6;
            opacity:1;
            -webkit-transform:rotate(360deg);
            -moz-transform:rotate(360deg);
            -ms-transform:rotate(360deg);
            -o-transform:rotate(360deg);
            transform:rotate(360deg);
            -webkit-transition:all 0.1s ease-in-out;
            -moz-transition:all 0.1s ease-in-out;
            -o-transition:all 0.1s ease-in-out;
            transition:all 0.1s ease-in-out;
        }

    </style>

    <style>
        /*=====================自定义特效=====================================*/
        .background {
            background: -moz-linear-gradient(148deg, rgba(253, 43, 43, 0.8) 0%, rgba(255, 165, 0, 0.8) 13%, rgba(84, 255, 84, 0.8) 30%,rgba(28, 230, 28, 0.8) 40%,rgba(46, 222, 222, 0.8) 50%,rgba(37, 37, 255, 0.8) 70%,rgba(245, 72, 245, 0.8) 100%);
            background: -o-linear-gradient(148deg, rgba(253, 43, 43, 0.8) 0%, rgba(255, 165, 0, 0.8) 13%, rgba(84, 255, 84, 0.8) 30%,rgba(28, 230, 28, 0.8) 40%,rgba(46, 222, 222, 0.8) 50%,rgba(37, 37, 255, 0.8) 70%,rgba(245, 72, 245, 0.8) 100%);
            background: -webkit-linear-gradient(148deg, rgba(253, 43, 43, 0.8) 0%, rgba(255, 165, 0, 0.8) 13%, rgba(84, 255, 84, 0.8) 30%,rgba(28, 230, 28, 0.8) 40%,rgba(46, 222, 222, 0.8) 50%,rgba(37, 37, 255, 0.8) 70%,rgba(245, 72, 245, 0.8) 100%);
            background: linear-gradient(148deg, rgba(253, 43, 43, 0.8) 0%, rgba(255, 165, 0, 0.8) 13%, rgba(84, 255, 84, 0.8) 30%,rgba(28, 230, 28, 0.8) 40%,rgba(46, 222, 222, 0.8) 50%,rgba(37, 37, 255, 0.8) 70%,rgba(245, 72, 245, 0.8) 100%);
            background-attachment: fixed;
        }

        #nav-label{
            position: relative;
            height:30%;
            padding:0;
        }
        .panel-body{
            overflow-y: auto;
            overflow-x: hidden;
            height: 100%;;
        }
        #lightgallery li>a .fa{
            font-size: 14pt;
            background-color: rgba(0,0,0,0.3);
            border-radius: 11px;
            padding: 8px;
            color: silver;
            margin-right: 5px;
            cursor: pointer;
        }
        #lightgallery .covers{
            display: none;
        }
        #lightgallery li:hover .covers{
            display: block;
            background: rgba(0,0,0,0.5);
        }
        .nav-menu > a:first-child {
            color: #D6CECE;
        }

        .nav-menu > a:hover:first-child {
            color: white;
        }

    </style>

@endsection

@section("content")
    <div class="background" style="width: 100%;height: 100%;">
        <div class="panel-body scroll">
            @include("layouts.nav")
            <div class="col-xs-12  nav-menu " style="margin-bottom: 13px;margin-top:10px;font-size: 14pt;">
                <a href="{{$base_url}}/enjoy/enjoyedit" class="pull-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="应用管理">
                    <i class="glyphicon glyphicon-th-list"></i>
                </a>
            </div>
            <div class="col-xs-12" style="padding:0;margin-bottom:10px; box-shadow: 0 -4px 13px 0px rgba(0,0,0,.3);margin-left: -14px;width: 103%;">
                <canvas class="canvas col-sm-8 col-sm-offset-2 col-xs-12" id="nav-label" style="max-width: 800px;"></canvas>
            </div>
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label hidden">名字</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" id="vedioname" placeholder="please fill the name of video" style="background: rgba(250, 244, 244, 0.7);box-shadow: 3px 5px 9px #999;">
                        </div>
                        <div class="col-xs-4" style="padding-top: 5px;padding-left: 0;">
                            <a class="a_demo_four" onclick="searchs();">search</a>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    function searchs(){
                        var vn=document.getElementById("vedioname").value;
                        if(vn.trim()!=""){
                            @if($isMobile==false)
                            window.open("http://v.baidu.com/v?word="+encodeURIComponent(vn)+"&ct=301989888&rn=20&pn=0&db=0&s=0&fbl=800&ie=utf-8")
                            @endif
                             @if($isMobile==true)
                            window.open("http://m.v.baidu.com/search?word="+encodeURIComponent(vn)+"&src=video")
                            @endif
                        }
                    }
                </script>
            </div>

            {{--====================================  桌面端 ====================================--}}

            <div class="row">
                <div class="visible-md visible-lg col-md-2" id="leftarticle">
                    <p>
                        “人生若只如初见，何事秋风悲画扇”如果人生的很多事，很多的境遇，很多的人，都还如初见时的模样该多好呀！若只是初见，一切美好都不会遗失。很多时候，初见，惊艳；蓦然回首，却已是物是人非,沧海桑田。。。</p>

                    <p>
                        “执子之手，与子偕老”简简单单一句话，道尽了古今多少人的愿望。就像那首歌，“我能想到最浪漫的事，就是和你一起慢慢变老。。。”其实啊，人生在世，求什么呢，若有一个人，愿意与你生死相随，这一生，也就够了。</p>

                    <p>
                        “曾经沧海难为水，除却巫山不是云”永远是这样，人的心啊，看过辽阔的大海，就看不上寻常的小溪小河了，去看过巫山的云，就不觉得其他地方的云是云了。所以其实不要太早遇见好男人/好女人，因为万一捉不住他/她，你会一辈子都活在这句诗句里。</p>

                    <p>“此情可待成追忆
                        只是当时已惘然”现在回想，旧情难忘，犹可追忆，只是一切都恍如隔世了。一个“已”字，可怕至极。若非当初年少无知，何至如此!</p>

                    <p>“纵使相逢应不识，尘满面，鬓如霜”这是我最害怕的一句，若是不见也就罢了，若是相见，却互不认识，就这样在岁月里蹉跎地擦肩而过，那该是多么令人心碎的一幕。。。</p>
                </div>
                <div class="grid demo-gallery col-md-8"></div>
                <div class="visible-md visible-lg col-md-2" id="rightarticle">
                    <p>
                        The furthest distance in the world <br>
                        &nbsp;&nbsp;---Rabindranath Tagore
                    </p>
                    <br>

                    <p>The furthest distance in the world Is not between life and
                        death But when I stand in front of you Yet you don’t know that I
                        love you</p>

                    <p>The furthest distance in the world Is not when i stand in
                        font of you Yet you can’t see my love But when undoubtedly knowing
                        the love from both Yet cannot Be togehter</p>

                    <p>The furthest distance in the world Is not being apart while
                        being in love But when plainly can not resist the yearning Yet
                        pretending You have never been in my heart</p>

                    <p>The furthest distance in the world Is not But using one’s
                        indifferent heart To dig an uncrossable river For the one who loves
                        you</p>

                </div>
            </div>
                <script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
                <script src="//cdn.bootcss.com/jquery-easing/1.3/jquery.easing.min.js"></script>

            <script src="https://cdn.bootcss.com/picturefill/3.0.2/picturefill.min.js"></script>
            <script src="http://cdn.bootcss.com/lightgallery/1.3.7/js/lightgallery.js"></script>
            <script src="http://cdn.bootcss.com/lightgallery/1.2.21/js/lg-fullscreen.min.js"></script>
            <script src="http://cdn.bootcss.com/lightgallery/1.2.21/js/lg-thumbnail.min.js"></script>
            {{--<script src="http://cdn.bootcss.com/lightgallery/1.2.21/js/lg-video.min.js"></script>--}}
            <script src="http://cdn.bootcss.com/lightgallery/1.2.21/js/lg-autoplay.min.js"></script>
            <script src="http://cdn.bootcss.com/lightgallery/1.2.21/js/lg-zoom.min.js"></script>
            {{--<script src="http://cdn.bootcss.com/lightgallery/1.2.21/js/lg-hash.min.js"></script>--}}
            <script src="http://cdn.bootcss.com/lightgallery/1.2.21/js/lg-pager.min.js"></script>

            <script src="{{$base_url}}/js/enjoy/inputanimation.js"></script>
            <script>
                var baseUrl = "{{$base_url}}";
                var lkey = "{{session("lkey")}}" == "" ? null : "{{session("lkey")}}";
                var userId = lkey || localStorage[window.location.host + "-pan-key"];
                var token = "{{csrf_token()}}";
            </script>
                <script src="{{$base_url}}/js/enjoy/title.js"></script>

                <script type="text/javascript">
                    $.post(baseUrl+"/api/videos!getVideoByUserId",{userid:userId},function(data){
                        var images = "<ul id='lightgallery' class='list-unstyled'>", count = data.data.length, complete = 0;
                        for (var i = 0; i < count; i++) {
                            var url=data.data[i].img;
                            images +=''+
                                    '<li >'+
                                    '   <a>'+
                                    '       <img src="'+url+'" class="img-responsive" />'+
                                    '       <span class="imgtitle" style="position: absolute;color:cyan;opacity: 0;bottom: 1px;left:5px;">'+data.data[i].title+'</span>'+
                                    '       <div class="covers" style="position: absolute;top: 0;width: 100%;height: 100%;text-align: center;"> '+
                                    "           <div style='display:inline-block;height:50%;width:0;'></div>"+
                                    '           <div style="display: inline-block;vertical-align: middle;">'+
                                    '               <i class="fa fa-search" data-src="'+url+'" data-link="www.baidu.com">'+
                                    '                   <img src="'+url+'" style="display:none;">'+
                                    '               </i>'+
                                    '               <i data-link="'+data.data[i].link+'" onclick="jumpUrl(this);" class="fa fa-link"></i>'+
                                    '           </div>'+
                                    '       </div>'+
                                    '   </a>'+
                                    '</li>';
                        }
                        images+="</ul>";
                        $(".grid").html(images);
                        $("img").load(function () {
                            complete++;
                            if (complete == count) {
                                animate();
                            }
                        });
                    },"json");

                    function animate() {
                        $("img.img-responsive").each(function () {
                            $(this).delay(Math.random() * 1000).animate({opacity: 0}, {
                                step: function (n) {
                                    $(this).css("transform", "scale(" + (1-n) + ")");
                                },
                                duration: 1000
                            })
                        }).promise().done(function () {
                            storm();
                        });
                        function storm() {
                            $("img.img-responsive").each(function () {
                                $(this).delay(Math.random() * 1000).animate({opacity: 1}, {
                                    step: function (n) {
                                        $(this).css("transform", "rotateY(" + ((1 - n) * 360) + "deg) translateZ(" + ((1 - n) * 1000) + "px)");
                                    },
                                    duration: 3000,
                                    easing: 'easeOutQuint'
                                })
                            }).promise().done(function(){
                                $(".imgtitle").css("opacity",1);
                                $('#lightgallery').lightGallery({
                                    selector:"#lightgallery>li .fa-search"
                                });
                            });
                        }
                    }

                    function jumpUrl(obj){
                        window.open(obj.attributes["data-link"].value);
                    }
                </script>

        </div>
    </div>
@endsection


