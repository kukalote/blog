@extends('layouts.page')

@section('page_main')
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                {{-- 面包屑 --}}
                @parent
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="widget">
                                <div class="widget-header  with-footer">
                                    <span class="widget-caption">
                                        <a href="#" target="_blank" class="btn btn-info btn-xs create" data-toggle="modal" data-target="#createModal">
                                            <i class="fa fa-plus"></i> 创建商品种类
                                        </a>
                                    </span>
                                    <div class="widget-buttons">
                                        <a href="#" data-toggle="maximize">
                                            <i class="fa fa-expand"></i>
                                        </a>
{{--
                                        <!-- 最小化 -->
                                        <a href="#" data-toggle="collapse">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                        <!-- 关闭 -->
                                        <a href="#" data-toggle="dispose">
                                            <i class="fa fa-times"></i>
                                        </a>
--}}
                                    </div>
                                </div>
                                <div class="widget-body">
                                    <div class="flip-scroll">
                                        <form class="form-horizontal" id="form_list_filters">
                                        {{ csrf_field() }}
                                        </form>
                                        <div class="fill_list">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->

<!-- 创建提示模态框（Modal） -->
<div class="modal fade" id="createModal" role="dialog" aria-labelledby="myCreateModalLabel" aria-hidden="true">
    <form id="form_create" class="form-horizontal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myCreateModalLabel">商品种类创建</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">商品种类</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="category" placeholder="商品种类" />
                        <span class="help-block" ></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{ csrf_field() }}
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
    <form id="form_delete">
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
                <input type="hidden" value="" name="id" />
                {{ csrf_field() }}
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </form>
</div>
<!-- /.modal -->

<!-- 编辑提示模态框（Modal） -->
<div class="modal fade" id="modifyModal" role="dialog" aria-labelledby="myModifyModalLabel" aria-hidden="true">
    <form id="form_modify" class="form-horizontal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModifyModalLabel">商品种类编辑</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">商品种类</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="category" placeholder="商品种类" />
                        <span class="help-block" ></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{ csrf_field() }}
                <input type="hidden" value="" name="id" />
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
    <script src="{{url('/assets/js/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{url('/assets/js/common/form-modal.js')}}"></script>

<script>
var url = {
    list:   "{{url('/goods/ajaxcategorylist')}}",
    create: "{{url('/goods/createcategory')}}",
    modify: "{{url('/goods/modifycategory')}}",
    delete: "{{url('/goods/deletecategory')}}",
};
$(function(){
    loadList();             // 初始化加载列表

    // 加载列表内容
    function loadList(){
        quiteAjaxFormToJson(url.list, '#form_list_filters', {
            successFunc: function(d){
                $(".fill_list").html(d.data);
            }
        });
    }

    // 确认窗口-创建商品
    $('#createModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $(this).find("input[name='category']").val('');
    });

    // 创建操作
    $("#form_create").submit(function(){
        var btn = $(this).find("button[type='submit']");
        ajaxFormToJson(url.create, $(this), {
            submit_btn: btn,
            successFunc: function(d){
                $('#createModal').modal('hide');
                loadList();
            }
        });
        return false;
    });

    // 确认窗口-修改商品
    $('#modifyModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $(this).find("input[name='id']").val(button.data('id'));
        $(this).find("input[name='category']").val(button.data('category'));
    });

    // 修改操作
    $("#form_modify").submit(function(){
        var btn = $(this).find("button[type='submit']");
        ajaxFormToJson(url.modify, $(this), {
            submit_btn: btn,
            successFunc: function(d){
                $('#modifyModal').modal('hide');
                loadList();
            }
        });
        return false;
    });

    // 确认窗口-删除商品
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $(this).find("input[name='id']").val(button.data('id'));
    });

    // 删除操作
    $("#form_delete").submit(function(){
        var btn = $(this).find("button[type='submit']");
        ajaxFormToJson(url.delete, $(this), {
            submit_btn: btn,
            successFunc: function(d){
                $('#deleteModal').modal('hide');
                loadList();
            }
        });
        return false;
    });

});

// 插件初始化
</script>
    <!-- self_js end -->
@endsection
@extends('layouts.page_callback')
