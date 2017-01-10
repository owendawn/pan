@extends('layouts.app')
@section("head")
    <title xmlns:data-iview="http://www.w3.org/1999/xhtml" xmlns:data-iview="http://www.w3.org/1999/xhtml">应用管理 - Pan
        攀</title>
    @include("common.checkLogin")
            <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link href="//cdn.bootcss.com/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.bootcss.com/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="{{$base_url}}/js/enjoy/dataTables.extends.js"></script>
    <link href="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">

@endsection

@section("content")
    <div class="bgcontainer">
        <div class="panel-body">
            @include("layouts.nav")
            <div class="col-xs-12" style="margin-top: 20%; padding-left: 10%; padding-right: 10%; padding-top: 0px;">
                <div class="tabbable tabs-left">
                    <ul class="nav nav-tabs" id="myTab3">
                        <li class="tab-sky active">
                            <a data-toggle="tab" href="#home">
                                <i class="glyphicon glyphicon-home"></i>
                            </a>
                        </li>
                        <li class="tab-red">
                            <a data-toggle="tab" href="#profile">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="home" class="tab-pane active col-xs-12">
                            <div class="row localpath">
                                <div class="link-buttons col-xs-1 pull-right" style="font-size: 16pt;">
                                    <a href="{{$base_url}}/enjoy/enjoy" data-toggle="tooltip"
                                       data-placement="bottom" title="Enjoy Station">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </a>
                                </div>
                            </div>
                            <br>

                            <div class="col-xs-12">
                                <button id="addnew" class="btn-info btn">新增行</button>
                            </div>
                            <div class="col-xs-12">
                                <table id="editabledatatable"
                                       class="table table-bordered table-striped table-condensed flip-content"></table>
                            </div>
                        </div>

                        <div id="profile" class="tab-pane col-xs-12">
                            <div class="row localpath">
                                <div class="link-buttons col-xs-1 pull-right" style="font-size: 16pt;">
                                    <a href="{{$base_url}}/enjoy/enjoy" data-toggle="tooltip"
                                       data-placement="bottom" title="Enjoy Station">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </a>
                                </div>
                            </div>
                            <br>

                            <div class="col-xs-12">
                                <table id="trashdatatable"
                                       class="table table-bordered table-striped table-condensed flip-content"
                                       style="width: 100%;"></table>
                            </div>
                        </div>
                        <div class="horizontal-space"></div>
                    </div>


                </div>
            </div>
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
                                {{--<input type="text" class="form-control" id="time" mame="time" placeholder="请输入时间">--}}
                                <select class="form-control" id="time" name="time">
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
                                    <input type="text" class="form-control" id="image" name="image">
                                    <span class="input-group-btn">

                                        <button type="button"
                                                class="btn btn-default dropdown-toggle"{{-- data-toggle="dropdown" tabindex="-1"--}}
                                                id="imgsearchbtn">
                                            select&nbsp;
                                        </button>
                                        <button class="btn btn-default" type="button" onclick="showImage()">preview
                                        </button>
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
    <script src="{{$base_url}}/js/enjoy/enjoyedit.pc.js"></script>
@endsection


