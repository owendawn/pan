function checkLogin() {
    if (userId == undefined) {
        window.location.href = baseUrl + "/login/login";
    }
}
checkLogin();

var oTable,
    oTable2,
    dd=['请选择','周一','周二','周三','周四','周五','周六','周日'];

oTable = $('#editabledatatable').dataTable({
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": false,
    "bSort": true,
    "bInfo": true,
    "bAutoWidth": true,
    "bRetrieve": true,
    "bStateSave": false,
    "iDisplayLength": 20,
    "bServerSide": true, //每次数据修改，都请求服务器确认
    "bScrollCollapse": true,
    "sPaginationType": "full_numbers",
    "sServerMethod": "POST",
    "sAjaxSource": baseUrl+"/api/videos!getVideoOfAvailable",
    "aoColumns": [{
        "mData": "week",
        "sTitle": "时间",
        "sortable": true
    }, {
        "mData": "title",
        "sTitle": "网站名",
        "sortable": false
    }, {
        "mData": "link",
        "sTitle": "网站地址",
        "sortable": false
    }, {
        "mData": "img",
        "sTitle": "图片地址",
        "sortable": false
    }, {
        "mData": "id",
        "sTitle": "操作",
        "sortable": false
    }],
    "fnServerParams": function(aoData) {
        aoData.push({
            "name": "_token",
            "value": token
        });
        aoData.push({
            "name": "userid",
            "value": userId
        });
    },
    "aoColumnDefs": [{
        "aTargets": [0],
        "sTitle": "时间",
        "mData": "week",
        "sortable": true,
        "mRender": function(data, type, full) {
            if(!data){
                data=0;
            }
            return "<span data-value='"+data+"'>"+dd[Number(data)]+"</span>";
        }
    },{
        "aTargets": [4],
        "sTitle": "操作",
        "mData": "id",
        "sortable": false,
        "mRender": function(data, type, full) {
            return '' +
                '<a href="#" class="btn btn-info btn-xs edit" data-id="'+data+'" >' +
                '   <i class="fa fa-edit"></i> Edit' +
                '</a>' +
                '<a href="#" class="btn btn-danger btn-xs delete" data-mydata-id=' + data + '>' +
                '   <i class="fa fa-trash-o"></i> Delete' +
                '</a>';
        }
    }]
});
//oTable.api().on('draw', function(e, settings, json) {
//    //if (hasnew) {
//    //    $("#editabledatatable tbody tr td:nth-child(4) a.edit[data-mode='new']").click();
//    //}
//});

function clearModel(isEditNotAdd){
    var _title,_fun;
    if(isEditNotAdd){
        _title="修改";
        _fun="edit";
    }else{
        _title="新增";
        _fun="add";
    }
    $("#myModal form").get(0).reset();
    $("#time option").removeAttr("selected");
    $("#myModalLabel").text(_title);
    $("#modalimg").attr("src","");
    $("#modelsave").attr("data-fun",_fun);
    $("#imgdiv .imgbtn").hide();
}

//Add New Row
$('#addnew').click(function(e) {
    e.preventDefault();
    clearModel(false);
    $('#myModal').modal({keyboard: true});
});

$("#modelsave").on("click",function(){
    checkLogin();
    var _fun=$(this).attr("data-fun");
    var url;
    if(_fun=="add"){
        url=baseUrl+"/api/videos!addNewVideo";
    }else if(_fun=="edit"){
        url=baseUrl+"/api/videos!editVideoById"
    }
    $.post(url,$("#myModal form").serialize()+"&userId="+userId,function(data){
        if(data.code!="00000"){
            swal("提醒!", data.data.info, "warning");
        }else{
            oTable.fnDraw();
            $('#myModal').modal("hide");
        }
    },"json");
});

//Delete an Existing Row
$('#editabledatatable').on("click", 'a.delete', function(e) {
    var _id=$(this).attr("data-mydata-id");
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
    function(isConfirm){
        if (isConfirm) {
            $.post(baseUrl+"/api/videos!fackDeleteById", {
                "id": _id,
                "userId":userId
            }, function(datas) {
                if(datas.code!="00000"){
                    swal("提醒!", datas.info, "warning");
                }else{
                    oTable.fnDraw();
                    oTable2.fnDraw();
                    swal("成功!", "delete the row success!", "success");
                    $('#myModal').modal("hide");
                }
            }, "json");
        }
    });
});

function parseWeek(data){
    var returns="";
    for (var i = 0; i < dd.length; i++) {
        returns+="<option value='"+i+"' "+(Number(data)==i?"selected":"")+">"+dd[i]+"</option>";
    }
    returns+="";
    return returns;
}
//Edit A Row
$('#editabledatatable').on("click", 'a.edit', function(e) {
    e.preventDefault();
    clearModel(true);
    var _nRow = $(this).parents('tr')[0];
    var _cells=$(_nRow).find("td");
    console.log(_cells);
    var $_modalDom=$("#myModal");
    $_modalDom.find("select[name='time']").html(parseWeek($(_cells[0]).find("span").attr("data-value")));
    $_modalDom.find("input[name='title']").val($(_cells[1]).text());
    $_modalDom.find("input[name='link']").val($(_cells[2]).text());
    $_modalDom.find("input[name='image']").val($(_cells[3]).text());
    $_modalDom.find("input[name='id']").val($(_cells[4]).find(".edit").attr("data-id"));
    $('#myModal').modal({keyboard: true});

});

var imgs=[],imgidx=-1;
$("#imgsearchbtn").on("click",function(e){
    e.preventDefault();
    imgs=[];
    imgidx=-1;
    var _words=$("#myModal input[name='title']").val();
    if(_words.trim()==""){
        swal("提醒!", "请先填写视频名称", "warning");
    }else {
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
                        }else if(datas.data.data.length==0){
                            swal("提醒!", "搜索结果为空，请手动输入", "warning");
                        } else {
                            imgs=datas.data.data;
                            imgidx=0;
                            $("#imgdiv .imgbtn").show();
                            showImage(0);
                        }
                    }, "json");
                }
            });
    }
});

function showImage(offset){
    var _src;
    if(offset!=undefined) {
        imgidx=imgidx+offset;
        _src=imgs[imgidx];
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
    }else{
        $("#imgdiv .imgbtn").hide();
        _src=$("#myModal input[name='image']").val().trim();
    }
    $("#modalimg").attr("src",_src);

}

function chooseImg(){
    $("#image").val(imgs[imgidx].replace(new RegExp("&amp;", "g"), "&"));
}

//-----------------------------------------回收站---------------------------------------------------------------------

oTable2 = $('#trashdatatable').dataTable({
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": false,
    "bSort": true,
    "bInfo": true,
    "bAutoWidth": true,
    "bRetrieve": true,
    "bStateSave": false,
    "iDisplayLength": 20,
    "bServerSide": true, //每次数据修改，都请求服务器确认
    "bScrollCollapse": true,
    "sPaginationType": "full_numbers",
    "sServerMethod": "POST",
    "sAjaxSource": baseUrl+"/api/videos!getVideoOfTrash",
    "aoColumns": [{
        "mData": "week",
        "sTitle": "时间",
        "sortable": true
    }, {
        "mData": "title",
        "sTitle": "网站名",
        "sortable": false
    }, {
        "mData": "link",
        "sTitle": "网站地址",
        "sortable": false
    }, {
        "mData": "img",
        "sTitle": "图片地址",
        "sortable": false
    }, {
        "mData": "id",
        "sTitle": "操作",
        "sortable": false
    }],
    "fnServerParams": function(aoData) {
        aoData.push({
            "name": "_token",
            "value": token
        });
        aoData.push({
            "name": "userid",
            "value": userId
        });
    },
    "aoColumnDefs": [{
        "aTargets": [0],
        "sTitle": "时间",
        "mData": "week",
        "sortable": true,
        "mRender": function(data, type, full) {
            if(!data){
                data=0;
            }
            return "<span data-value='"+data+"'>"+dd[Number(data)]+"</span>";
        }
    },{
        "aTargets": [4],
        "sTitle": "操作",
        "mData": "id",
        "sortable": false,
        "mRender": function(data, type, full) {
            return '' +
                '<a href="#" class="btn btn-info btn-xs reducte" data-mydata-id=' + data + '>' +
                '   <i class="fa fa-edit"></i> Reducte' +
                '</a>' +
                '<a href="#" class="btn btn-danger btn-xs delete" data-mydata-id=' + data + '>' +
                '   <i class="fa fa-trash-o"></i> Delete' +
                '</a>';
        }
    }]
});

$('#trashdatatable').on("click", 'a.reducte', function(e) {
    var _id=$(this).attr("data-mydata-id");
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
        function(isConfirm){
            if (isConfirm) {
                $.post(baseUrl+"/api/videos!reductedById", {
                    "id": _id,
                    userId:userId
                }, function(datas) {
                    if(datas.code!="00000"){
                        swal("提醒!", datas.info, "warning");
                    }else{
                        oTable.fnDraw();
                        oTable2.fnDraw();
                        swal("成功!", "delete the row success!", "success");
                        $('#myModal').modal("hide");
                    }
                }, "json");
            }
        });
});
$('#trashdatatable').on("click", 'a.delete', function(e) {
    var _id=$(this).attr("data-mydata-id");
    e.preventDefault();
    swal({
            title: "Are you sure?",
            text: "Are You Sure To Delete This Row really?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "delete",
            cancelButtonText: "cancel",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                $.post(baseUrl+"/api/videos!deleteById", {
                    "id": _id,
                    userId:userId
                }, function(datas) {
                    if(datas.code!="00000"){
                        swal("提醒!", datas.info, "warning");
                    }else{
                        oTable2.fnDraw();
                        swal("成功!", "delete the row success!", "success");
                        $('#myModal').modal("hide");
                    }
                }, "json");
            }
        });
});



