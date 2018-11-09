
// form提交方法， 提交返回提示
/**
 1. 表单提交
 2. js模拟提交
 3. 统一事前调用，事后调用(提交按钮禁用，启用)
 */
//$.ajaxSetup({
//     headers: {
//         'X-XSRF-TOKEN': getCookie('XSRF-TOKEN')
//     }
//});

/**
 * ajax form 提交
 * events: [beforeFunc, successFunc, failFunc, afterFunc];
 */
function ajaxFormToJson(url, form, events) {
    var params = $(form).serialize()
    if (events == undefined) var events = {};
    if (events.beforeFunc == undefined && events.submit_btn != undefined) {
        events.beforeFunc = function(){
            $(events.submit_btn).addClass("disabled");
        }
    }
    if (events.afterFunc == undefined && events.submit_btn != undefined) {
        events.afterFunc = function(){
            $(events.submit_btn).removeClass("disabled");
        }
    }
    ajaxToJson(url, params, events);
}


/**
 * 静音请求-成功不提示
 * events: [beforeFunc, successFunc, failFunc, afterFunc];
 */

function quiteAjaxToJson(url, params, events, clear_notify) {
    if (clear_notify == undefined) {
        var clear_notify = {
            clearSuccess : true,
            clearDanger : true,
            clearError : true
        };
    }
    ajaxToJson(url, params, events, clear_notify);
}
/**
 * ajax 提交-返回json
 * events: [beforeFunc, successFunc, failFunc, afterFunc];
 * clear_notify: [clearSuccess, clearDanger, clearError];
 */
function ajaxToJson(url, params, events, clear_notify) {

    if (clear_notify == undefined) var clear_notify = {};
    if (events == undefined) var events = {};
    if (events.beforeFunc != undefined) {
        events.beforeFunc();
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        url: url, 
        data: params,
        success: function(r){
            if (r.code == 1) {
                if (events.successFunc != undefined && events.successFunc != null) {
                    events.successFunc(r);
                }
                if (clear_notify.clearSuccess != true) {
                    notifySuccess(r.msg);
                }
            } else {
                if (events.failFunc != undefined) {
                    events.failFunc(r);
                }
                if (clear_notify.clearDanger != true) {
                    notifyDanger(r.msg);
                }
            }
            if (events.afterFunc != undefined) {
                events.afterFunc(r);
            }
        },
        error: function(r){
            if (clear_notify.clearError != true) {
                notifyDanger("请求异常!");
            }
            if (events.afterFunc != undefined) {
                events.afterFunc(r);
            }
        }
    });
}

/**
 * ajax form 提交
 */
//function ajaxToJson(url, params, events) {
//    if (events == undefined) var events = {};
//    if (events.beforeFunc != undefined) {
//        events.beforeFunc();
//    }
//    $.ajax({
//        type: "POST",
//        dataType: "json",
//        url: url, 
//        data: params,
//        success: function(r){
//            if (r.code == 1) {
//                if (events.successFunc != undefined && events.successFunc != null) {
//                    events.successFunc(r);
//                }
//                notifySuccess(r.msg);
//            } else {
//                if (events.failFunc != undefined) {
//                    events.failFunc(r);
//                }
//                notifyDanger(r.msg);
//            }
//            if (events.afterFunc != undefined) {
//                events.afterFunc();
//            }
//        },
//        error: function(){
//            notifyDanger("请求异常!");
//            if (events.afterFunc != undefined) {
//                events.afterFunc();
//            }
//        }
//    });
//}



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
