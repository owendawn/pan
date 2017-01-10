<style>
    /* Content */

    .content {
        text-align: center;
        position: absolute;
        left: 0;
        z-index: 999;
        margin-top: -14px;
    }

    /* Device styles */

    .device {
        position: relative;
        overflow: hidden;
        margin: 0 auto;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-touch-callout: none;
        -khtml-user-select: none;
    }

    .device__screen {
        position: relative;
        overflow: hidden;
        height: 100%;
        text-align: left;
        border-radius: 4px 4px 0 0;
        /*box-shadow: inset 0 6.2em 0 rgba(0, 0, 0, 0.1);*/
    }




    .dummy__item {
        /*height: 3em;*/
        font-size: 20px;
        padding:10px 20px;;
        margin: 1px 0;
        /*pointer-events: none;*/
        border-radius: 4px;
        background: rgba(0, 0, 0, 0.32);
        -webkit-transition: -webkit-transform 0.5s;
        transition: transform 0.5s;
        -webkit-transition-timing-function: cubic-bezier(0.7, 0, 0.3, 1);
        transition-timing-function: cubic-bezier(0.7, 0, 0.3, 1);
    }

    .dummy__item {
        -webkit-transform: translate3d(-100%, 0, 0) translate3d(-2em, 0, 0) scale3d(0.5, 1, 1);
        transform: translate3d(-100%, 0, 0) translate3d(-2em, 0, 0) scale3d(0.5, 1, 1);
        -webkit-transform-origin: 100% 50%;
        transform-origin: 100% 50%;
    }



    .dummy--active .dummy__item {
        -webkit-transition-timing-function: cubic-bezier(0.56, 1.19, 0.2, 1.05);
        transition-timing-function: cubic-bezier(0.56, 1.19, 0.2, 1.05);
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    .dummy__item:nth-child(4),
    .dummy--active .dummy__item:first-child {
        -webkit-transition-delay: 0.05s;
        transition-delay: 0.05s;
    }

    .dummy__item:nth-child(3),
    .dummy--active .dummy__item:nth-child(2) {
        -webkit-transition-delay: 0.1s;
        transition-delay: 0.1s;
    }

    .dummy__item:nth-child(2),
    .dummy--active .dummy__item:nth-child(3) {
        -webkit-transition-delay: 0.15s;
        transition-delay: 0.15s;
    }

    .dummy__item:first-child,
    .dummy--active .dummy__item:nth-child(4) {
        -webkit-transition-delay: 0.2s;
        transition-delay: 0.2s;
    }

    .dummy a {
        color: #e8e8e8;
        text-decoration: none;
    }

    .dummy a:hover {
        color: white;
        text-decoration: none;
    }

    /* Related demos */



    .content--related h3 {
        margin: 0 0 7em;
    }



    .media-item:hover .media-item__img,
    .media-item:focus .media-item__img {
        opacity: 1;
    }

    @media screen and (max-width: 50em) {
        .device {
            width: 100%;
            height: auto;
            background-image: none;
        }
        .device__screen {
            margin: 0;
            border-radius: 0;
        }
    }

    /* Menu icon styles */

    .menu-icon-wrapper {
        position: relative;
        display: inline-block;
        width: 34px;
        height: 34px;
        margin: 15px;
        pointer-events: none;
        transition: 0.1s;
    }

    .menu-icon-wrapper.scaled {
        -webkit-transform: scale(0.5);
        -ms-transform: scale(0.5);
        transform: scale(0.5);
    }

    .menu-icon-wrapper svg {
        position: absolute;
        top: -33px;
        left: -33px;
        -webkit-transform: scale(0.1);
        -ms-transform: scale(0.1);
        transform: scale(0.1);
        -webkit-transform-origin: 0 0;
        -ms-transform-origin: 0 0;
        transform-origin: 0 0;
    }

    .menu-icon-wrapper svg path {
        stroke: #fff;
        stroke-width: 60px;
        stroke-linecap: round;
        stroke-linejoin: round;
        fill: transparent;
    }

    .menu-icon-wrapper .menu-icon-trigger {
        position: relative;
        width: 100%;
        height: 100%;
        cursor: pointer;
        pointer-events: auto;
        background: none;
        border: none;
        margin: 0;
        padding: 0;
    }

    .menu-icon-wrapper .menu-icon-trigger:hover,
    .menu-icon-wrapper .menu-icon-trigger:focus {
        outline: none;
    }
</style>
<div class="content" >
    <div class="device">
        <div class="device__screen">
            <div  style="display: inline-block;box-shadow: inset 0 8em 0   rgba(0, 0, 0, 0.1);">
                <div id="menu-icon-wrapper" class="menu-icon-wrapper" style="visibility: hidden">
                    <svg width="1000px" height="1000px">
                        <path id="pathA" d="M 300 400 L 700 400 C 900 400 900 750 600 850 A 400 400 0 0 1 200 200 L 800 800"></path>
                        <path id="pathB" d="M 300 500 L 700 500"></path>
                        <path id="pathC" d="M 700 600 L 300 600 C 100 600 100 200 400 150 A 400 380 0 1 1 200 800 L 800 200"></path>
                    </svg>
                    <button id="menu-icon-trigger" class="menu-icon-trigger"></button>
                </div>
            </div><!-- menu-icon-wrapper -->
            <div id="dummy" class="dummy">
                @if(isset($login)&&$login==false)
                    <script type="text/javascript">
                        // -----------ajax方法-----------//
                        (function getLabelsPost(){
                            /* 创建 XMLHttpRequest 对象 */
                            var xmlHttp;
                            function GetXmlHttpObject(){
                                if (window.XMLHttpRequest){
                                    // code for IE7+, Firefox, Chrome, Opera, Safari
                                    xmlhttp=new XMLHttpRequest();
                                }else{// code for IE6, IE5
                                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                                }
                                return xmlhttp;
                            }
                            xmlHttp=GetXmlHttpObject();
                            if (xmlHttp==null){
                                alert('您的浏览器不支持AJAX！');
                                return false;
                            }
                            var url="{{$base_url}}/api/user!checkloginAlways";
                            xmlhttp.open("POST",url,false);
                            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                            xmlhttp.send("key="+(localStorage[window.location.host + "-pan-key"]||""));
                            //同步回调
                            (function(){
                                var d=xmlHttp.responseText; // 返回值
                                if(d=="false"){
                                   document.write('<div class="dummy__item"><a href="{{$base_url}}/login/login">Login</a></div>');
                                }else if(d=="true"){
                                    document.write('<div class="dummy__item"><a href="{{$base_url}}/user/logout">Logout</a></div>');
                                }
                            })()
                        })();

                    </script>

                @endif
                @if(isset($login)&&$login==true)
                <div class="dummy__item"><a href="{{$base_url}}/user/logout">Logout</a></div>
                @endif
                <div class="dummy__item"><a href="{{$base_url}}/index">Home</a></div>
                <div class="dummy__item"><a href="{{$base_url}}/enjoy/enjoy" >Enjoy Video</a></div>
            </div><!-- /dummy -->
        </div><!-- /device-content -->
    </div><!-- /device -->
</div><!-- /content -->
<script src="//cdn.bootcss.com/segment-js/1.0.8/segment.min.js"></script>
<script type="text/javascript">
    !function(n,t){"object"==typeof exports&&"undefined"!=typeof module?t(exports):"function"==typeof define&&define.amd?define(["exports"],t):t(n.ease={})}(this,function(n){function t(n,t){return null==n||isNaN(n)?t:+n}function u(n,u){n=Math.max(1,t(n,1)),u=t(u,0.3)*A;var i=u*Math.asin(1/n);return function(t){return n*Math.pow(2,10*--t)*Math.sin((i-t)/u)}}function i(n,u){n=Math.max(1,t(n,1)),u=t(u,0.3)*A;var i=u*Math.asin(1/n);return function(t){return n*Math.pow(2,-10*t)*Math.sin((t-i)/u)+1}}function f(n){return B>n?L*n*n:D>n?L*(n-=C)*n+E:G>n?L*(n-=F)*n+H:L*(n-=J)*n+K}function z(n,t,u){var i=(n+="").indexOf("-");return 0>i&&(n+="-in"),arguments.length>1&&T.hasOwnProperty(n)?T[n](t,u):S.hasOwnProperty(n)?S[n]:g}var A=1/(2*Math.PI),B=4/11,C=6/11,D=8/11,E=0.75,F=9/11,G=10/11,H=0.9375,J=21/22,K = 63 / 64,L=1/B/B,S={"bounce-out":f,"elastic-in":u(),"elastic-out":i(),},T={"elastic-in":u,"elastic-out":i,};n.ease=z});

    (function() {
        /* In animations (to close icon) */

        var beginAC = 80,
                endAC = 320,
                beginB = 80,
                endB = 320;

        function inAC(s) {
            s.draw('80% - 240', '80%', 0.3, {
                delay: 0.1,
                callback: function() {
                    inAC2(s)
                }
            });
        }

        function inAC2(s) {
            s.draw('100% - 545', '100% - 305', 0.6, {
                easing: ease.ease('elastic-out', 1, 0.3)
            });
        }

        function inB(s) {
            s.draw(beginB - 60, endB + 60, 0.1, {
                callback: function() {
                    inB2(s)
                }
            });
        }

        function inB2(s) {
            s.draw(beginB + 120, endB - 120, 0.3, {
                easing: ease.ease('bounce-out', 1, 0.3)
            });
        }

        /* Out animations (to burger icon) */

        function outAC(s) {
            s.draw('90% - 240', '90%', 0.1, {
                easing: ease.ease('elastic-in', 1, 0.3),
                callback: function() {
                    outAC2(s)
                }
            });
        }

        function outAC2(s) {
            s.draw('20% - 240', '20%', 0.3, {
                callback: function() {
                    outAC3(s)
                }
            });
        }

        function outAC3(s) {
            s.draw(beginAC, endAC, 0.7, {
                easing: ease.ease('elastic-out', 1, 0.3)
            });
        }

        function outB(s) {
            s.draw(beginB, endB, 0.7, {
                delay: 0.1,
                easing: ease.ease('elastic-out', 2, 0.4)
            });
        }

        /* Awesome burger default */

        var pathA = document.getElementById('pathA'),
                pathB = document.getElementById('pathB'),
                pathC = document.getElementById('pathC'),
                segmentA = new Segment(pathA, beginAC, endAC),
                segmentB = new Segment(pathB, beginB, endB),
                segmentC = new Segment(pathC, beginAC, endAC),
                trigger = document.getElementById('menu-icon-trigger'),
                toCloseIcon = true,
                dummy = document.getElementById('dummy'),
                wrapper = document.getElementById('menu-icon-wrapper');

        wrapper.style.visibility = 'visible';

        trigger.onclick = function() {
            if (toCloseIcon) {
                inAC(segmentA);
                inB(segmentB);
                inAC(segmentC);

                dummy.className = 'dummy dummy--active';
            } else {
                outAC(segmentA);
                outB(segmentB);
                outAC(segmentC);

                dummy.className = 'dummy';
            }
            toCloseIcon = !toCloseIcon;
        };
    })();
</script>