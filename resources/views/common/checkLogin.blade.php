
@if(isset($checkLogin)&&$checkLogin==true)
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
//            console.log(localStorage,localStorage[window.location.host + "-pan-key"])
            xmlhttp.send("key="+(localStorage[window.location.host + "-pan-key"]||""));
            //异步回调
           /* xmlHttp.onreadystatechange=function(){
                if(xmlHttp.readyState==1||xmlHttp.readyState==2||xmlHttp.readyState==3){
                    // 本地提示：加载中/处理中
                    console.info("checking the status of login")
                }
                if (xmlHttp.readyState==4 && xmlHttp.status==200){
                    var d=xmlHttp.responseText; // 返回值
                    if(d=="false"){
                        window.location.href="{{$base_url}}/login/login";
                    }
                }
            }*/
            //同步回调
            (function(){
                var d=xmlHttp.responseText; // 返回值
                if(d=="false"){
                    window.location.href="{{$base_url}}/login/login";
                }
            })()
        })();

    </script>
@endif