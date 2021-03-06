@extends('layouts.app')
@section("head")
    <title xmlns:data-iview="http://www.w3.org/1999/xhtml" xmlns:data-iview="http://www.w3.org/1999/xhtml">应用管理 - Pan 攀</title>
    @include("common.checkLogin")
        <!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link href="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
<style>
    html, body {
        width: 100%;
        height: 100%;;
    }

    .tabs-left > .nav-tabs {
        top: auto;
        margin-bottom: 0;
        float: left;
    }

    .nav-tabs {
        margin-bottom: 0;
        margin-left: 0;
        border: 0;
        top: 2px;
        background-color: #eee;
        -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, .3);
        -moz-box-shadow: 0 0 4px rgba(0, 0, 0, .3);
        box-shadow: 0 0 4px rgba(0, 0, 0, .3);
    }

    .tabs-left > .nav-tabs > li {
        float: none;
    }

    .nav-tabs > li {
        margin-bottom: -2px;
    }

    .tabs-left > .nav-tabs > li > a, .tabs-right > .nav-tabs > li > a {
        min-width: 60px;
    }

    .tabs-left > .nav-tabs > li > a, .tabs-left > .nav-tabs > li > a:focus, .tabs-left > .nav-tabs > li > a:hover {
        margin: 0 -1px 0 0;
    }

    .nav-tabs > li:first-child > a {
        margin-left: 0;
        border-left: 1px solid #fbfbfb;
    }

    .tabs-left .tab-content, .tabs-right .tab-content {
        overflow: auto;
    }

    .tab-content {
        background-color: #fbfbfb;
        padding: 16px 12px;
        position: relative;
        -webkit-box-shadow: 1px 0 10px 1px rgba(0, 0, 0, .3);
        -moz-box-shadow: 1px 0 10px 1px rgba(0, 0, 0, .3);
        box-shadow: 1px 0 10px 1px rgba(0, 0, 0, .3);
    }

    .tabs-left > .nav-tabs > li.active > a, .tabs-left > .nav-tabs > li.active > a:focus,
    .tabs-left > .nav-tabs > li.active > a:hover {
        border: 0;
        border-left: 2px solid #5db2ff;
        border-right-color: transparent;
        margin: 0 -1px 0 -1px;
        margin-top: 0px;
        margin-right: -1px;
        margin-bottom: 0px;
        margin-left: -1px;
        -webkit-box-shadow: -2px 0 3px 0 rgba(0, 0, 0, .3);
        -moz-box-shadow: -2px 0 3px 0 rgba(0, 0, 0, .3);
        box-shadow: -2px 0 3px 0 rgba(0, 0, 0, .3);
    }

    .nav-tabs > li > a, .nav-tabs > li > a:focus {
        border-radius: 0 !important;
        color: #777;
        margin-right: -1px;
        line-height: 12px;
        position: relative;
        z-index: 11;
    }

    .nav-tabs > li.active > a:active, .nav-tabs > li.active > a:focus {
        background-color: #FBFBF7;
    }

    .link-buttons a i {
        color: silver;
    }

    .link-buttons a i:hover {
        color: grey;
    }

    .background {
        width: 100%;
        height: 100%;
        background: -moz-linear-gradient(148deg, rgba(253, 43, 43, 0.8) 0%, rgba(255, 165, 0, 0.8) 13%, rgba(84, 255, 84, 0.8) 30%,rgba(28, 230, 28, 0.8) 40%,rgba(46, 222, 222, 0.8) 50%,rgba(37, 37, 255, 0.8) 70%,rgba(245, 72, 245, 0.8) 100%);
        background: -o-linear-gradient(148deg, rgba(253, 43, 43, 0.8) 0%, rgba(255, 165, 0, 0.8) 13%, rgba(84, 255, 84, 0.8) 30%,rgba(28, 230, 28, 0.8) 40%,rgba(46, 222, 222, 0.8) 50%,rgba(37, 37, 255, 0.8) 70%,rgba(245, 72, 245, 0.8) 100%);
        background: -webkit-linear-gradient(148deg, rgba(253, 43, 43, 0.8) 0%, rgba(255, 165, 0, 0.8) 13%, rgba(84, 255, 84, 0.8) 30%,rgba(28, 230, 28, 0.8) 40%,rgba(46, 222, 222, 0.8) 50%,rgba(37, 37, 255, 0.8) 70%,rgba(245, 72, 245, 0.8) 100%);
        background: linear-gradient(148deg, rgba(253, 43, 43, 0.8) 0%, rgba(255, 165, 0, 0.8) 13%, rgba(84, 255, 84, 0.8) 30%,rgba(28, 230, 28, 0.8) 40%,rgba(46, 222, 222, 0.8) 50%,rgba(37, 37, 255, 0.8) 70%,rgba(245, 72, 245, 0.8) 100%);
        background-attachment: fixed;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .nav-menu > a:first-child {
        color: #a0a0a0;
    }
    .list-group-item {
        position: relative;
        display: block;
        padding: 10px 15px;
        margin-bottom: -1px;
        background-color: #fffdfd;
        border: 1px solid #ddd;
        opacity: 0.96;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
    .pointer{
        cursor: pointer;;
    }
</style>
@endsection

@section("content")
        <div class="panel-body background" style="padding-left: 0;padding-right: 0;">
            @include("layouts.nav")
            <div class="col-xs-12  nav-menu " style="margin-bottom: 10px;font-size: 14pt;margin-top: 15px;">
                <a href="{{$base_url}}/enjoy/enjoy" class="pointer pull-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="应用管理">
                    <i class="glyphicon glyphicon-th"></i>应用中心
                </a>
                <a onclick="render(true);" class="pull-right pointer" style="margin-right: 7px;" id="trashtoggle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="应用管理">
                    <i class="glyphicon glyphicon-trash"></i>回收站
                </a>
                <a  onclick="render(true);" class="pull-right pointer" style="display: none;margin-right: 7px;" id="hometoggle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="应用管理">
                    <i class="glyphicon glyphicon-home"></i>应用管理
                </a>
            </div>
            <div class="col-xs-12"  style="margin-bottom:10px; box-shadow: 0 -4px 13px 0px rgba(0,0,0,.3);padding:5px;" >
                <a class="btn btn-info pull-right" id="addnew"><i class="glyphicon glyphicon-plus-sign"></i>Add</a>
            </div>
            <div class="col-xs-12"id="cards-container">

            </div>
        </div>
    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <input type="hidden" name="id">

                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">视频名称</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" placeholder="请输入视频名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time" class="col-sm-2 control-label">时间</label>

                            <div class="col-sm-10">
                                <select class="form-control"  id="time" name="time">
                                    <option value="0">请选择时间</option>
                                    <option value="1">周一</option>
                                    <option value="2">周二</option>
                                    <option value="3">周三</option>
                                    <option value="4">周四</option>
                                    <option value="5">周五</option>
                                    <option value="6">周六</option>
                                    <option value="7">周日</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link" class="col-sm-2 control-label">视频网址</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="link" name="link" placeholder="请输入视频导航网址">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-sm-2 control-label">图片网址</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="image" name="image" >
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle"{{-- data-toggle="dropdown" tabindex="-1"--}} id="imgsearchbtn">
                                            select
                                        </button>
                                        <button class="btn btn-default" type="button" onclick="showImage()">preview</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="imgdiv" style="text-align: center;">
                            <img src="" id="modalimg">
                            <a class="imgbtn" onclick="showImage(-1)">上一张</a>
                            <a class="imgbtn" onclick="showImage(1)" class="">下一张</a>
                            <a class="imgbtn" onclick="chooseImg()">选择</a>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">关闭
                    </button>
                    <button type="button" class="btn btn-primary" data-fun="none" id="modelsave">
                        保存
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script src="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        var baseUrl = "{{$base_url}}";
        var lkey = "{{session("lkey")}}" == "" ? null : "{{session("lkey")}}";
        var userId = lkey || localStorage[window.location.host + "-pan-key"];
        var token = "{{csrf_token()}}";
    </script>
    <script src="{{$base_url}}/js/enjoy/enjoyedit.mobile.js"></script>
@endsection


