function checkLogin() {
    if (userId == undefined) {
        window.location.href = baseUrl + "/login/login";
    }
}
checkLogin();

var oTable,
    oTable2,
    isTrash=false,
    dd = ['请选择', '周一', '周二', '周三', '周四', '周五', '周六', '周日'];
function createItemCardHtml(title,week,link,img,id) {
    return [
        '<div class="panel panel-default" style="margin-top: 10px;background: inherit;box-shadow: 0px 0px 3px 4px rgba(127, 127, 127, 0.3);">',
        '   <div class="panel-heading" style="opacity: 0.9;text-align: center;">'+(title||"")+'</div>',
        '   <ul class="list-group">',
        '       <li class="list-group-item">时&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;间：<span data-value="'+week+'">'+dd[week||0]+'</span></li>',
        '       <li class="list-group-item">链接地址：<span>'+(link||"")+'</span></li>',
        '       <li class="list-group-item">图片地址：<span>'+(img||"")+'</span></li>',
        '       <li class="list-group-item" style="text-align: center;">',
        isTrash?
            '       <a class="reducte"  data-id="'+id+'" ><i class="glyphicon glyphicon-share-alt"></i>还原</a>':
        '           <a class="edit"  data-id="'+id+'" ><i class="glyphicon glyphicon-edit"></i>修改</a>',
        '           <a class="delete" data-mydata-id=' + id + '><i class="glyphicon glyphicon-trash"></i>删除</a>',
        '       </li>',
        '   </ul>',
        '</div>'
    ].join("");
}
function render(toggle) {
    if(toggle==true){
        if(isTrash==true){
            isTrash=false;
            $("#trashtoggle").show();
            $("#hometoggle").hide();
        }else{
            isTrash=true;
            $("#hometoggle").show();
            $("#trashtoggle").hide();
        }
    }
    if(isTrash){
        $.post(baseUrl + "/api/videos!getVideoOfTrash", {_token: token, userid: userId}, function (data) {
            data = data.aaData;
            var _html = "";
            for (var i = 0; i < data.length; i++) {
                _html += createItemCardHtml(data[i].title, data[i].week, data[i].link, data[i].img, data[i].id);
            }
            $("#cards-container").html(_html);
        }, "json");
    }else {
        $.post(baseUrl + "/api/videos!getVideoOfAvailable", {_token: token, userid: userId}, function (data) {
            data = data.aaData;
            var _html = "";
            for (var i = 0; i < data.length; i++) {
                _html += createItemCardHtml(data[i].title, data[i].week, data[i].link, data[i].img, data[i].id);
            }
            $("#cards-container").html(_html);
        }, "json");
    }
}
render();

function clearModel(isEditNotAdd) {
    var _title, _fun;
    if (isEditNotAdd) {
        _title = "修改";
        _fun = "edit";
    } else {
        _title = "新增";
        _fun = "add";
    }
    $("#myModal form").get(0).reset();
    $("#time option").removeAttr("selected");
    $("#myModalLabel").text(_title);
    $("#modalimg").attr("src", "");
    $("#modelsave").attr("data-fun", _fun);
    $("#imgdiv .imgbtn").hide();
}

//Add New Row
$('#addnew').click(function (e) {
    e.preventDefault();
    clearModel(false);
    $('#myModal').modal({keyboard: true});
});

$("#modelsave").on("click", function () {
    checkLogin();
    var _fun = $(this).attr("data-fun");
    var url;
    if (_fun == "add") {
        url = baseUrl + "/api/videos!addNewVideo";
    } else if (_fun == "edit") {
        url = baseUrl + "/api/videos!editVideoById"
    }
    $.post(url, $("#myModal form").serialize() + "&userId=" + userId, function (data) {
        if (data.code != "00000") {
            swal("提醒!", data.data.info, "warning");
        } else {
            render();
            $('#myModal').modal("hide");
        }
    }, "json");
});

//Delete an Existing Row
$('#cards-container').on("click", 'a.delete', function (e) {
    var _id = $(this).attr("data-mydata-id");
    e.preventDefault();
    swal({
            title: "Are you sure?",
            text: "Are You Sure To Delete This Row?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "delete",
            cancelButtonText: "cancel",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                var __url;
                if(isTrash){
                    __url=baseUrl + "/api/videos!deleteById";
                }else{
                    __url=baseUrl + "/api/videos!fackDeleteById";
                }
                $.post(__url, {
                    "id": _id,
                    "userId": userId
                }, function (datas) {
                    if (datas.code != "00000") {
                        swal("提醒!", datas.info, "warning");
                    } else {
                        render();
                        swal("成功!", "delete the row success!", "success");
                        $('#myModal').modal("hide");
                    }
                }, "json");
            }
        });
});

function parseWeek(data) {
    var returns = "";
    for (var i = 0; i < dd.length; i++) {
        returns += "<option value='" + i + "' " + (Number(data) == i ? "selected" : "") + ">" + dd[i] + "</option>";
    }
    returns += "";
    return returns;
}
//Edit A Row
$('#cards-container').on("click", 'a.edit', function (e) {
    e.preventDefault();
    clearModel(true);
    var _nRow = $(this).parents().parent("ul")[0];
    var _cells = $(_nRow).find("li>span");
    console.log(_cells);
    var $_modalDom = $("#myModal");
    $_modalDom.find("input[name='title']").val($(_nRow).parent().find(".panel-heading").text());
    $_modalDom.find("select[name='time']").html(parseWeek($(_cells[0]).attr("data-value")));
    $_modalDom.find("input[name='link']").val($(_cells[1]).text());
    $_modalDom.find("input[name='image']").val($(_cells[2]).text());
    $_modalDom.find("input[name='id']").val($(this).attr("data-id"));
    $('#myModal').modal({keyboard: true});

});

var imgs = [], imgidx = -1;
$("#imgsearchbtn").on("click", function (e) {
    e.preventDefault();
    imgs = [];
    imgidx = -1;
    var _words = $("#myModal input[name='title']").val();
    if (_words.trim() == "") {
        swal("提醒!", "请先填写视频名称", "warning");
    } else {
        swal({
                title: "Are you sure?",
                text: "确认搜索视频【" + _words + "】吗?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#5bc0de",
                confirmButtonText: "yes",
                cancelButtonText: "cancel",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.post(baseUrl + "/api/videos!getImgUrlByName", {
                        userId: userId,
                        words: _words
                    }, function (datas) {
                        if (datas.code != "00000") {
                            swal("提醒!", datas.info, "warning");
                        } else if (datas.data.data.length == 0) {
                            swal("提醒!", "搜索结果为空，请手动输入", "warning");
                        } else {
                            imgs = datas.data.data;
                            imgidx = 0;
                            $("#imgdiv .imgbtn").show();
                            showImage(0);
                        }
                    }, "json");
                }
            });
    }
});

function showImage(offset) {
    var _src;
    if (offset != undefined) {
        imgidx = imgidx + offset;
        _src = imgs[imgidx];
        if (imgidx == 0) {
            $("#imgdiv a:eq(0)").hide();
        } else {
            $("#imgdiv a:eq(0)").show();
        }
        if (imgidx == imgs.length - 1) {
            $("#imgdiv a:eq(1)").hide();
        } else {
            $("#imgdiv a:eq(1)").show();
        }
        _src = _src.replace(new RegExp("&amp;", "g"), "&");
    } else {
        $("#imgdiv .imgbtn").hide();
        _src = $("#myModal input[name='image']").val().trim();
    }
    $("#modalimg").attr("src", _src);

}

function chooseImg() {
    $("#image").val(imgs[imgidx].replace(new RegExp("&amp;", "g"), "&"));
}

//-----------------------------------------回收站---------------------------------------------------------------------


$('#cards-container').on("click", 'a.reducte', function (e) {
    var _id = $(this).attr("data-id");
    e.preventDefault();
    swal({
            title: "Are you sure?",
            text: "Are You Sure To reducte This Row?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5bc0de",
            confirmButtonText: "reducted",
            cancelButtonText: "cancel",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $.post(baseUrl + "/api/videos!reductedById", {
                    "id": _id,
                    userId: userId
                }, function (datas) {
                    if (datas.code != "00000") {
                        swal("提醒!", datas.info, "warning");
                    } else {
                        render();
                        swal("成功!", "delete the row success!", "success");
                        $('#myModal').modal("hide");
                    }
                }, "json");
            }
        });
});
//$('#trashdatatable').on("click", 'a.delete', function (e) {
//    var _id = $(this).attr("data-mydata-id");
//    e.preventDefault();
//    swal({
//            title: "Are you sure?",
//            text: "Are You Sure To Delete This Row really?",
//            type: "warning",
//            showCancelButton: true,
//            confirmButtonColor: "#DD6B55",
//            confirmButtonText: "delete",
//            cancelButtonText: "cancel",
//            closeOnConfirm: true,
//            closeOnCancel: true
//        },
//        function (isConfirm) {
//            if (isConfirm) {
//                $.post(baseUrl + "/api/videos!deleteById", {
//                    "id": _id,
//                    userId: userId
//                }, function (datas) {
//                    if (datas.code != "00000") {
//                        swal("提醒!", datas.info, "warning");
//                    } else {
//                        swal("成功!", "delete the row success!", "success");
//                        $('#myModal').modal("hide");
//                    }
//                }, "json");
//            }
//        });
//});



