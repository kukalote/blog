@extends('layouts.page')

@section('page_main')
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="#">Home</a>
                        </li>
                        <li class="active">Dashboard</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            Dashboard
                        </h1>
                    </div>
                    <!--Header Buttons-->
                    <div class="header-buttons">
                        <a class="sidebar-toggler" href="#">
                            <i class="fa fa-arrows-h"></i>
                        </a>
                        <a class="refresh" id="refresh-toggler" href="default.htm">
                            <i class="glyphicon glyphicon-refresh"></i>
                        </a>
                        <a class="fullscreen" id="fullscreen-toggler" href="#">
                            <i class="glyphicon glyphicon-fullscreen"></i>
                        </a>
                    </div>
                    <!--Header Buttons End-->
                </div>
                <!-- /Page Header -->
                <!-- Page Body -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="widget">
                                <div class="widget-header  with-footer">
                                    <span class="widget-caption">
                                        <a href="#" class="btn btn-info btn-xs create" data-id="1" data-toggle="modal" data-target="#createModal">
                                            <i class="fa fa-plus"></i> 创建用户
                                        </a>
                                    </span>
                                    <div class="widget-buttons">
                                        <a href="#" data-toggle="maximize">
                                            <i class="fa fa-expand"></i>
                                        </a>
<!-- 最小化 -->
<!--
                                        <a href="#" data-toggle="collapse">
                                            <i class="fa fa-minus"></i>
                                        </a>
-->
<!-- 关闭 -->
<!--
                                        <a href="#" data-toggle="dispose">
                                            <i class="fa fa-times"></i>
                                        </a>
-->
                                    </div>
                                </div>
                                <div class="widget-body">
                                    <div class="flip-scroll">
                                        <table class="table table-bordered table-striped table-condensed flip-content">
                                            <thead class="flip-content bordered-palegreen">
                                                <tr>
                                                    <th>
                                                        ID
                                                    </th>
                                                    <th>
                                                        用户名
                                                    </th>
                                                    <th>
                                                        邮箱
                                                    </th>
                                                    <th>
                                                        城市
                                                    </th>
                                                    <th>
                                                        操作
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($users->items() as $user)
                                                <tr>
                                                    <td>
                                                        {{$user->id}}
                                                    </td>
                                                    <td>
                                                        {{$user->name}}
                                                    </td>
                                                    <td>
                                                        {{$user->email}}
                                                    </td>
                                                    <td>
                                                        {{isset($view_data->_citys[$user->city_id]) ? ($view_data->_citys[$user->city_id]['city_name']) : ''}}
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-xs edit" data-id="{{$user->id}}" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i> Edit</a>
                                                        <a href="#" class="btn btn-danger btn-xs delete" data-id="{{$user->id}}" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{$users->render()}}
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->

<!-- 创建提示模态框（Modal） -->
<div class="modal fade" id="createModal" role="dialog" aria-labelledby="myCreateModalLabel" aria-hidden="true">
    <form id="form_user_create" class="form-horizontal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myCreateModalLabel">用户创建</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">用户名</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" placeholder="用户名" />
                        <span class="help-block" ></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">昵称</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="nick_name" placeholder="昵称" />
                        <span class="help-block "></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">密码</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" placeholder="密码" />
                        <span class="help-block" ></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">重复密码</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="重复密码" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">邮箱</label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" name="email" placeholder="邮箱" data-bv-emailaddress-message="邮箱格式不正确" />
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">所在城市</label>
                    <div class="col-sm-5">
                        <select name="city_id" style="width:75%;">
                                <option value="0">--请选择--</option>
                            @foreach($view_data->_citys as $val)
                                <option value="{{$val['city_id']}}">{{$val['city_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{ csrf_field() }}
                <input type="hidden" value="" name="uid" />
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </form>
</div>
<!-- /.modal -->

<!-- 删除提示模态框（Modal） -->
<div class="modal fade" id="deleteModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="form_user_delete">
    {{ csrf_field() }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">提示</h4>
            </div>
            <div class="modal-body">
                <p>确定删除操作么?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="" name="uid" />
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </form>
</div>
<!-- /.modal -->

<!-- 编辑提示模态框（Modal） -->
<div class="modal fade" id="editModal" role="dialog" aria-labelledby="myEditModalLabel" aria-hidden="true">
    <form id="form_user_edit" class="form-horizontal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myEditModalLabel">用户编辑</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">用户名</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" placeholder="用户名" />
                        <span class="help-block" ></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">昵称</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="nick_name" placeholder="昵称" />
                        <span class="help-block "></span>
                    </div>
                </div>
<!--
                <div class="form-group">
                    <label class="col-sm-3 control-label">密码</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" placeholder="密码" />
                        <span class="help-block" ></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">重复密码</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="重复密码" />
                        <span class="help-block"></span>
                    </div>
                </div>
-->
                <div class="form-group">
                    <label class="col-sm-3 control-label">邮箱</label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" name="email" placeholder="邮箱" data-bv-emailaddress-message="邮箱格式不正确" />
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">所在城市</label>
                    <div class="col-sm-5">
                        <select name="city_id" style="width:75%;">
                                <option value="0">--请选择--</option>
                            @foreach($view_data->_citys as $val)
                                <option value="{{$val['city_id']}}">{{$val['city_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{ csrf_field() }}
                <input type="hidden" value="" name="uid" />
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </form>
</div>
<!-- /.modal -->
@endsection



@section('self_js')
    <!-- self_js start -->
    <link href="{{url('/assets/css/select2/select2.min.css')}}" rel="stylesheet" />
    <script src="{{url('/assets/js/common/form-modal.js')}}"></script>
    <script src="{{url('/assets/js/select2/select2.min.js')}}"></script>
<script>
var url = {
    create:"{{url('/manage/user/create')}}",
    delete:"{{url('/manage/user/delete')}}",
    edit:"{{url('/manage/user/edit')}}"
};

var users = @json(array_column($users->items(), NULL, 'id'));

$(function(){
    $("select[name='city_id']").select2();


    // 创建弹框
    $('#createModal').on('show.bs.modal', function (event) {
        // 清空表单内容 
        $(this).find("input[name='uid']").val('');
        $(this).find("input[name='name']").val('');
        $(this).find("input[name='nick_name']").val('');
        $(this).find("input[name='email']").val('');
        $(this).find("input[name='password']").val('');
        $(this).find("input[name='password_confirmation']").val('');
        $(this).find("select[name='city_id']").select2().val(0).trigger("change");
        // 还原样式
        $(this).find(".form-group").removeClass('has-success').removeClass('has-error');
        $(this).find("i.form-control-feedback, small.help-block").hide();
    })

    // 创建操作
    $("#createModal button[type='submit']").click(function(){
        ajaxFormToJson(url.create, '#form_user_create', function(d){
            $('#createModal').modal('hide');
            setTimeout("location.reload()", 3000);
        });
        return false;
    });

    // 模拟框自定义事件
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $(this).find("input[name='uid']").val(button.data('id'));
    })
    // 删除操作
    $("#deleteModal button[type='submit']").click(function(){
        ajaxFormToJson(url.delete, '#form_user_delete', function(d){
            $('#deleteModal').modal('hide');
            setTimeout("location.reload()", 3000);
        });
        return false;
    });

    // 编辑弹框
    $('#editModal').on('show.bs.modal', function (event) {
//        // 还原表单信息
//        $(this).find("input[type='text']").val('');
//        $(this).find("select[name='city_id']").select2().val(0).trigger("change");

        // 自动填充表单信息
        var button = $(event.relatedTarget);
        var uid    = button.data('id');
        var user   = users[uid];
        $(this).find("input[name='uid']").val(user.id);
        $(this).find("input[name='name']").val(user.name);
        $(this).find("input[name='nick_name']").val(user.nick_name);
        $(this).find("input[name='email']").val(user.email);
        $(this).find("select[name='city_id']").select2().val(user.city_id).trigger("change");
    })

    // 编辑操作
    $("#editModal button[type='submit']").click(function(){
        ajaxFormToJson(url.edit, '#form_user_edit', function(d){
            $('#editModal').modal('hide');
            setTimeout("location.reload()", 3000);
        });
        return false;
    });

    // 编辑弹框输入规则
    formValidator.init($('#form_user_create, #form_user_edit'), {
        name: {
            validators: {
                notEmpty: {
                    message: '用户名是必填且不得为空'
                },
                stringLength: {
                    min: 2,
                    max: 30,
                    message: '用户名须为大于2且小于30'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: '密码不得为空'
                },
                stringLength: {
                    min: 6,
                    message: '密码须为大于6'
                }
            },
            onSuccess: function(e, data) {
                var password = e.currentTarget.value;
                if (checkStrong(password)<3) {
                    formValidator.hasError(e, data, '密码强度过低');
                } else {
                    formValidator.hasSuccess(e, data);
                } 
            }
        },
        password_confirmation: {
            validators: {
                notEmpty: {
                    message: '密码不得为空'
                },
                stringLength: {
                    min: 6,
                    message: '密码须为大于6'
                }
            },
            onSuccess: function(e, data) {
                // 验证密码统一性
                var src_password = $("#form_user_create input[name='password']").val();
                var repassword   = $("#form_user_create input[name='password_confirmation']").val();
                if (src_password != repassword) {
                    formValidator.hasError(e, data, '密码不统一');
                }
            }
        },
        email: {
            validators: {
                notEmpty: {
                    message: '邮件地址不得为空'
                },
                emailAddress: {
                    message: '邮件地址是无效的'
                }
            }
        },
        nick_name: {
            validators: {
                stringLength: {
                    min: 2,
                    max: 30,
                    message: '用户名须为大于2且小于30'
                }
            }
        }
    });
})
</script>
    <!-- self_js end -->
@endsection
