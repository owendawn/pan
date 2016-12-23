@extends('layouts.app')
@section("head")
    <title>hello</title>
    <script>
        console.log(1);
    </script>
    <style>
    </style>
    @endsection

    @section("content")

    <div class="panel-body">

        主页<i class="fa fa-window-close-o"></i>
        <a href="{{$base_url}}/login/login">登录</a>
        <a href="{{$base_url}}/login/register">注册</a>
    </div>
        <script>
            $.ajax({
                type: 'get',
                url: '{{$base_url}}/api/init!getBaseTableInit',
                data: 'ip=1&_token={{csrf_token()}}&user=2&pwd=3&db=',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                },
                error: function(xhr, type){
                    console.warn('Ajax error!')
                }
            });
        </script>
@endsection


