@extends('layouts.app')
@section("head")
    <title xmlns:data-iview="http://www.w3.org/1999/xhtml" xmlns:data-iview="http://www.w3.org/1999/xhtml">注册 - Pan
        攀</title>
    <style>
        body {
            padding-top: 0;
            margin: 0;
        }

        form {
            margin-left: auto;
            margin-right: auto;
            max-width: 343px;
            padding: 30px;
            border: 1px solid rgba(0, 0, 0, .2);
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            background: rgba(41, 139, 182, 0.5);
            -moz-box-shadow: 0 0 13px 3px rgba(0, 0, 0, .5);
            -webkit-box-shadow: 0 0 13px 3px rgba(0, 0, 0, .5);
            box-shadow: 0 0 13px 3px rgba(0, 0, 0, .5);
            overflow: hidden;
        }

        textarea {
            background: rgba(255, 255, 255, 0.4);
            width: 276px;
            height: 110px;
            border: 1px solid rgba(255, 255, 255, .6);
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            display: block;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 18px;
            color: #fff;
            padding-left: 45px;
            padding-right: 20px;
            padding-top: 12px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        input {
            width: calc(100% - 60px);;
            height: 48px;
            border: 1px solid rgba(255, 255, 255, .4);
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            display: block;
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 16px;
            color: #fff;
            padding-left: 20px;
            padding-right: 20px;
            margin-bottom: 20px;
        }

        textarea {
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 16px;
        }

        input[type=submit] {
            cursor: pointer;
        }

        input.name, input.email, input.message {
            background: rgba(255, 255, 255, 0.4);
            padding-left: 45px;
        }

        a {
            color: #8f8e93;
            cursor: pointer;
            text-decoration: none;
        }

        a:hover {
            color: #2ae6ff;
            cursor: pointer;
            text-decoration: underline;;
        }

        ::-webkit-input-placeholder {
            color: #fff;
        }

        :-moz-placeholder {
            color: #fff;
        }

        ::-moz-placeholder {
            color: #fff;
        }

        :-ms-input-placeholder {
            color: #fff;
        }

        input:focus, textarea:focus {
            background-color: rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 0 5px 1px rgba(255, 255, 255, .5);
            -webkit-box-shadow: 0 0 5px 1px rgba(255, 255, 255, .5);
            box-shadow: 0 0 5px 1px rgba(255, 255, 255, .5);
            overflow: hidden;
        }

        .btn {
            width: 138px;
            height: 44px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
            float: right;
            border: 1px solid #253737;
            background: #416b68;
            background: -webkit-gradient(linear, left top, left bottom, from(#6da5a3), to(#416b68));
            background: -webkit-linear-gradient(top, #6da5a3, #416b68);
            background: -moz-linear-gradient(top, #6da5a3, #416b68);
            background: -ms-linear-gradient(top, #6da5a3, #416b68);
            background: -o-linear-gradient(top, #6da5a3, #416b68);
            background-image: -ms-linear-gradient(top, #6da5a3 0%, #416b68 100%);
            padding: 10.5px 21px;
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            border-radius: 6px;
            -webkit-box-shadow: rgba(255, 255, 255, 0.1) 0 1px 0, inset rgba(255, 255, 255, 0.7) 0 1px 0;
            -moz-box-shadow: rgba(255, 255, 255, 0.1) 0 1px 0, inset rgba(255, 255, 255, 0.7) 0 1px 0;
            box-shadow: rgba(255, 255, 255, 0.1) 0 1px 0, inset rgba(255, 255, 255, 0.7) 0 1px 0;
            text-shadow: #333333 0 1px 0;
            color: #e1e1e1;
        }

        .btn:hover {
            border: 1px solid #253737;
            text-shadow: #333333 0 1px 0;
            background: #416b68;
            background: -webkit-gradient(linear, left top, left bottom, from(#77b2b0), to(#416b68));
            background: -webkit-linear-gradient(top, #77b2b0, #416b68);
            background: -moz-linear-gradient(top, #77b2b0, #416b68);
            background: -ms-linear-gradient(top, #77b2b0, #416b68);
            background: -o-linear-gradient(top, #77b2b0, #416b68);
            background-image: -ms-linear-gradient(top, #77b2b0 0%, #416b68 100%);
            color: #fff;
        }

        .btn:active {
            margin-top: 1px;
            text-shadow: #333333 0 -1px 0;
            border: 1px solid #253737;
            background: #6da5a3;
            background: -webkit-gradient(linear, left top, left bottom, from(#416b68), to(#416b68));
            background: -webkit-linear-gradient(top, #416b68, #609391);
            background: -moz-linear-gradient(top, #416b68, #6da5a3);
            background: -ms-linear-gradient(top, #416b68, #6da5a3);
            background: -o-linear-gradient(top, #416b68, #6da5a3);
            background-image: -ms-linear-gradient(top, #416b68 0%, #6da5a3 100%);
            color: #fff;
            -webkit-box-shadow: rgba(255, 255, 255, 0) 0 1px 0, inset rgba(255, 255, 255, 0.7) 0 1px 0;
            -moz-box-shadow: rgba(255, 255, 255, 0) 0 1px 0, inset rgba(255, 255, 255, 0.7) 0 1px 0;
            box-shadow: rgba(255, 255, 255, 0) 0 1px 0, inset rgba(255, 255, 255, 0.7) 0 1px 0;
        }

    </style>
    @endsection

    @section("content")
    <div class="panel-body" style="padding:0;z-index: -1;" frameborder="0" scrolling="no">
        <div style="z-index: 0;position: fixed;width:100%;height: 100%;;">
            <iframe src="{{$base_url}}/login/registerbg" style="width: 100%;height: 100%;border: 0;"></iframe>
            <div></div>
        </div>
        <div style="padding-top: 5%;">
            <form action="javascript:submit();" method="post"
                  style="z-index: 99;position: relative;padding-top:70px;padding-bottom: 25px;" id="theform">
                <input name="name" placeholder="What is your name?" class="name" type="text" required
                       value="{{isset($msg)&&isset($msg["name"])?$msg["name"]:""}}"/>
                <input name="mail" placeholder="What is your Email?" class="email" type="email" required
                       value="{{isset($msg)&&isset($msg["mail"])?$msg["mail"]:""}}"/>
                <input name="password" placeholder="What is your password?" class="email" type="password" required/>
                <input name="passwordcheck" placeholder="Your password, Again?" class="email" type="password" required/>
                {{--<textarea rows="4" cols="50" name="subject" placeholder="Please enter your message" class="message" required></textarea>--}}
                <input name="button" class="btn" type="submit" value="Register"/>
                <br>
                <span id="info"
                      style="color:rgba(247, 150, 200, 0.7);">{{isset($register)&&$register==false?$info:""}}</span>
                <br>
                <hr style="width:100%;border-color: #908b8b;">
                <a href="{{$base_url}}/login/login">already has an Account ?</a>
            </form>
        </div>
    </div>
    <script>
        function submit(obj) {
            $_formdom = document.getElementById("theform");
            $_infodom = document.getElementById("info");
            if (document.getElementsByName('name').value == "") {
                $_infodom.innerHTML = "name is required!";
            } else if (document.getElementsByName('mail').value == "") {
                $_infodom.innerHTML = "Email is required!";
            } else if (document.getElementsByName("password").value == "") {
                $_infodom.innerHTML = "password is required!";
            } else {
                $_infodom.innerHTML = "";
                if (document.getElementsByName("password").value == document.getElementsByName("passwordcheck").value) {
                    $_formdom.action = "{{$base_url}}/user/register";
                    document.getElementById("theform").submit();
                    document.getElementsByName("button")[0].click();
                } else {
                    $_infodom.innerHTML = "password again is't same as password!";
                }
            }
        }
    </script>

@endsection


