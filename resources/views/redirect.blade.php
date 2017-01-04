@extends('layouts.app')
@section("head")
    <title>重定向</title>
@endsection

@section("content")
    <script>
        var path;
        path = "{{$base_url}}{{$path}}";
    </script>
    <div class="panel-body">重定向至
        <script>
            document.write("<a href='" + window.location.origin + path + "'>" + path + "</a>");
            window.location.href = decodeURIComponent(path);
        </script>
    </div>

@endsection


