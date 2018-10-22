
// form提交方法， 提交返回提示
// 


/**
 * ajax 提交
 */
function ajaxFormToJson(url, form, successFunc, failFunc) {
    var params = $(form).serialize()
    $.ajax({
        type: "POST",
        dataType: "json",
        url: url, 
        data: params,
        success: function(r){
            console.log(r); // todo
            if (r.code == 1) {
                notifySuccess(r.msg);
                if (successFunc != undefined && successFunc != null) {
                    successFunc(r);
                }
            } else {
                notifyDanger(r.msg);
                if (failFunc != undefined) {
                    failFunc(r);
                }
            }
        },
        error: function(){
            notifyDanger("请求异常!");
        }
    });
}


/*
$.notify("Hello World");
type ['success', 'warning', 'danger', 'info']
 */
function notifyMsg(msg, type) {
    if (type=="success") {
        var icon = "glyphicon glyphicon-ok";
    } else if (type=="warning") {
        var icon = "glyphicon glyphicon-warning-sign";
    } else if (type=="danger") {
        var icon = "glyphicon glyphicon-remove";
    } else {    // type: info
        var icon = "glyphicon glyphicon-info-sign";
        var type = "info";
    }
    $.notify({
        icon: icon,
        message: msg
    }, {
//        delay: 100000,
//        timer: 100000,
        animate: {
            enter: 'animated flipInY',
            exit: 'animated flipOutX'
        },
        type: type,
        z_index: 1500
//        ,placement: {
//            from: 'bottom',
//            align: 'right'
//        }
    });
}

function notifySuccess(msg) {
    notifyMsg(msg, 'success');
}

function notifyWarning(msg) {
    notifyMsg(msg, 'warning');
}

function notifyDanger(msg) {
    notifyMsg(msg, 'danger');
}

function notifyInfo(msg) {
    notifyMsg(msg, 'info');
}

//判断输入密码的类型
function CharMode(iN){ 
    if (iN>=48 && iN <=57) //数字 
        return 1;
    if (iN>=65 && iN <=90) //大写 
        return 2;
    if (iN>=97 && iN <=122) //小写 
        return 4;
    else 
        return 8;
} //bitTotal函数 //计算密码模式 
function bitTotal(num){ 
    modes=0;
    for (i=0; i<4; i++){ 
        if (num & 1) 
            modes++;
        num>>>=1;
    } 
    return modes;
} 
//返回强度级别 
function checkStrong(sPW){ 
    if (sPW.length<6) 
        return 0;
    //密码太短，不检测级别 
    Modes=0;
    for (i=0; i<sPW.length; i++){ 
        //密码模式 
        Modes|=CharMode(sPW.charCodeAt(i));
    } 
    return bitTotal(Modes);
}
