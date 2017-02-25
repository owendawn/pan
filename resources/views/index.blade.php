@extends('layouts.app')
@section("head")
    @if(session("isStore")!=""&&session("isStore")==true)
        <script>
            var key='{{session("storeKey")}}';
            localStorage[window.location.host+"-pan-key"]=key;
        </script>
    @endif
    <title xmlns:data-iview="http://www.w3.org/1999/xhtml" xmlns:data-iview="http://www.w3.org/1999/xhtml">首页 - Pan 攀</title>
    <link rel="stylesheet" href="{{$base_url}}/css/index.css" media="screen" type="text/css"/>
    <link rel="stylesheet" href="//cdn.bootcss.com/normalize/2.1.3/normalize.min.css"/>
    <link async href="http://fonts.googleapis.com/css?family=Warnes" rel="stylesheet" type="text/css"/>
    <link async href="http://fonts.googleapis.com/css?family=Zeyada" rel="stylesheet" type="text/css"/>
    <link async href="http://fonts.googleapis.com/css?family=Princess%20Sofia" rel="stylesheet" type="text/css"/>
@endsection

@section("content")

    <div class="panel-body">
        @include("layouts.nav")
        <div id="iview" style="width: 100%;margin:0;padding:0;">
            <div
                    {{--data-iview:image="{{$base_url}}/img/photo1.jpg"--}}
                    data-iview:image="https://vi3.6rooms.com/live/2017/02/25/12/1002v1487998238517126140_b.jpg"
                 data-iview:transition="slice-top-fade,slice-right-fade">
                <div class="iview-caption caption1" data-x="80" data-y="200">dReam</div>
                <div class="iview-caption" data-x="80" data-y="275" data-transition="wipeRight">To get what i want, i will Get better.
                </div>
                <div class="iview-caption" data-x="254" data-y="320" data-transition="wipeLeft"><i>Presented by a fighter</i></div>
            </div>

            <div
                    {{--data-iview:image="{{$base_url}}/img/photo2.jpg"--}}
                    data-iview:image="https://vi1.6rooms.com/live/2017/02/25/12/1002v1487998241680079630_b.jpg"
                 data-iview:transition="zigzag-drop-top,zigzag-drop-bottom" data-iview:pausetime="3000">
                <div class="iview-caption caption5" data-x="60" data-y="280" data-transition="wipeDown">The best preparation for tomorrow
                    is doing your best today
                </div>
                <div class="iview-caption caption6" data-x="300" data-y="350" data-transition="wipeUp"><a href="#">~ to do</a></div>
            </div>

            <div
                    {{--data-iview:image="{{$base_url}}/img/video.jpg" data-iview:type="video"--}}
                    data-iview:image="https://vi0.6rooms.com/live/2017/02/25/12/1002v1487998744685837350_b.jpg" data-iview:type="video"
                 data-iview:transition="strip-right-fade,strip-left-fade">
                {{--<iframe src="http://player.vimeo.com/video/11475955?byline=1&amp;portrait=0" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>--}}
                <div class="iview-caption caption2" data-x="450" data-y="340" data-transition="wipeRight">Video</div>
                <div class="iview-caption caption3" data-x="600" data-y="345" data-transition="wipeLeft">Support</div>
            </div>

            <div
                    {{--data-iview:image="{{$base_url}}/img/photo3.jpg"--}}
                    data-iview:image="https://vi0.6rooms.com/live/2017/02/25/12/1002v1487998243324948278_b.jpg"
                    >
                <div class="iview-caption caption4" data-x="50" data-y="80" data-width="312" data-transition="fade">
                    Don't
                </div>
                <div class="iview-caption blackcaption" data-x="50" data-y="135" data-transition="wipeLeft"
                     data-easing="easeInOutElastic">aim for success
                </div>
                <div class="iview-caption blackcaption" data-x="50" data-y="172" data-transition="wipeLeft"
                     data-easing="easeInOutElastic">if you want it;
                </div>
                <div class="iview-caption blackcaption" data-x="50" data-y="209" data-transition="wipeLeft"
                     data-easing="easeInOutElastic">just do what you love and believe in,
                </div>
                <div class="iview-caption blackcaption" data-x="50" data-y="246" data-transition="wipeLeft"
                     data-easing="easeInOutElastic">and it will come naturally.
                </div>
                <div class="iview-caption blackcaption" data-x="50" data-y="283" data-transition="wipeLeft"
                     data-easing="easeInOutElastic">&nbsp;&nbsp;_____
                </div>
                <div class="iview-caption blackcaption" data-x="50" data-y="320" data-transition="wipeLeft"
                     data-easing="easeInOutElastic">&nbsp;&nbsp;~ &nbsp;&nbsp;&nbsp;&nbsp;keep on ……
                </div>
            </div>

            <div
                    {{--data-iview:image="{{$base_url}}/img/photo4.jpg"--}}
                    data-iview:image="https://vi3.6rooms.com/live/2017/02/25/12/1002v1487998245133240443_b.jpg"
                    >
                <div class="iview-caption caption7" data-x="0" data-y="0" data-width="180" data-height="480"
                     data-transition="wipeRight">
                    <br>
                    <br>
                    <h1>The Courage</h1>
                    <br>
                    <h3 style="color:#888;">
                    The
                    <b><i>greatest test of courage</i></b>
                    <br>
                    <br>
                     on earth
                    <br>
                        <br>
                        <br>
                    is to bear defeat
                    <br>
                    <br>
                    <b>without losing heart.</b>
                    </h3>
                </div>
            </div>

            <div
                    {{--data-iview:image="{{$base_url}}/img/photo5.jpg"--}}
                    data-iview:image="https://vi3.6rooms.com/live/2017/01/14/19/1002v1484392518589574991_b.jpg"
                    >
                <div class="iview-caption caption5" data-x="60" data-y="150" data-transition="wipeLeft">What are you
                    waiting for?
                </div>
                <div class="iview-caption caption6" data-x="160" data-y="230" data-transition="wipeRight">Get it Now!
                </div>
            </div>
        </div>
    </div>
    <div class="zzsc-content" >
        <div class="second_neon">Hobby Favor</div>
        <div class="first_neon">My Joy</div>
        <div class="third_neon"><a href="{{$base_url}}/enjoy/enjoy">Enjoy Video</a></div>
    </div>
    {{--<script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>--}}
    <script src="//cdn.bootcss.com/jquery/1.7.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/raphael/2.2.7/raphael.min.js"></script>
    <script src="//cdn.bootcss.com/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="{{$base_url}}/lib/iview.js"></script>
    {{--<script src="http://www.html5tricks.com/demo/jquery-html5-responsive-slider/js/iview.js"></script>--}}
    <script>
        jQuery.fn.neonText = function (options) {
            var options = jQuery.extend({
                textColor: '#FFFFFF',
                textSize: 'xx-large',
                neonHighlight: '#FFFFFF',
                neonHighlightColor: '#FF00DE',
                neonHighlightHover: '#00FFFF',
                neonFontHover: '#FFFFFF'
            }, options)
            return this.each(function () {
                jQuery(this).css('color', options.textColor)
                        .css('font-size', options.textSize)
                        .css('text-shadow', '0 0 10px ' + options.neonHighlight + ',0 0 20px ' + options.neonHighlight + ',0 0 30px ' + options.neonHighlight + ',0 0 40px ' + options.neonHighlightColor + ',0 0 70px ' + options.neonHighlightColor + ',0 0 80px ' + options.neonHighlightColor + ',0 0 100px ' + options.neonHighlightColor)
                        .hover(
                        function () {
                            jQuery(this)
                                    .css('text-shadow', '0 0 10px ' + options.neonHighlight + ',0 0 20px ' + options.neonHighlight + ',0 0 30px ' + options.neonHighlight + ',0 0 40px ' + options.neonHighlightHover + ',0 0 70px ' + options.neonHighlightHover + ',0 0 80px ' + options.neonHighlightHover + ',0 0 100px ' + options.neonHighlightHover)
                                    .css('color', options.neonFontHover);
                        },
                        function () {
                            jQuery(this)
                                    .css('color', options.textColor)
                                    .css('text-shadow', '0 0 10px ' + options.neonHighlight + ',0 0 20px ' + options.neonHighlight + ',0 0 30px ' + options.neonHighlightColor + ',0 0 40px ' + options.neonHighlightColor + ',0 0 70px ' + options.neonHighlightColor + ',0 0 80px ' + options.neonHighlightColor + ',0 0 100px ' + options.neonHighlightColor)
                        }
                );
            });
        };
        $(document).ready(function () {
            $('#iview').iView({
                pauseTime: 7000,
                directionNav: false,
                controlNav: true,
                tooltipY: -15
            });


            $('.first_neon').neonText();
            $('.second_neon').neonText({
                textColor: 'white',
                textSize: '40pt',
                neonHighlight: 'white',
                neonHighlightColor: '#008000',
                neonHighlightHover: '#FFFF00',
                neonFontHover: 'white'
            });
            $('.third_neon').neonText({
                textColor: 'white',
                textSize: '40pt',
                neonHighlight: 'white',
                neonHighlightColor: '#00FFFF',
                neonHighlightHover: '#7FFF00',
                neonFontHover: 'white'
            });
        });
    </script>
@endsection


