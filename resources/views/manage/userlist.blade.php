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
                                    <span class="widget-caption">Responsive Flip Scroll Tables</span>
                                    <div class="widget-buttons">
                                        <a href="#" data-toggle="maximize">
                                            <i class="fa fa-expand"></i>
                                        </a>
<!--
                                        <a href="#" data-toggle="collapse">
                                            <i class="fa fa-minus"></i>
                                        </a>
-->
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
                                                    <th class="numeric">
                                                        邮箱
                                                    </th>
                                                    <th class="numeric">
                                                        城市
                                                    </th>
                                                    <th class="numeric">
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
                                                    <td class="numeric">
                                                        {{$user->email}}
                                                    </td>
                                                    <td>
                                                        {{isset($view_data->_citys[$user->city_id]) ? ($view_data->_citys[$user->city_id]['city_name']) : ''}}
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-xs edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i> Edit</a>
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

<!-- 删除提示模态框（Modal） -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <input type="hidden" value="" name="delete_id" />
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary submit">提交</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection



@section('self_js')
    <!-- self_js start -->
<script>
var url = {
    "delete":"",
    "edit":""
};
// 模拟框自定义事件
$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var node = $(this).find("input[name='delete_id']").val(button.data('id'));
})
// 删除操作
$('#deleteModal button.submit').click(function(){
    var deleted_id = $("#deleteModal input").val();

    $('#deleteModal').modal('hide')

});

// 执行删除
function ajaxDelete(id) {
    
}
/*
$.notify("Hello World");
 */
 $.notify("Enter: Flip In on Y AxisExit: Flip Out on X Axis", {
	animate: {
		enter: 'animated flipInY',
		exit: 'animated flipOutX'
	}
});   
</script>
    <!-- self_js end -->
@endsection
