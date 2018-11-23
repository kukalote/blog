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
                                        <a href="{{url('goods/createpage')}}" target="_blank" class="btn btn-info btn-xs create">
                                            <i class="fa fa-plus"></i> 创建商品
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
                                            <div class="form-group">
                                                <div class=" col-sm-3">
                                                    <label for="title" class="col-sm-4 control-label no-padding-left no-padding-right"> 商品名称: </label>
                                                    <div class="col-sm-8">
                                                        <input name="title" placeholder="商品名称" type="text" class="form-control" value=""/>
                                                    </div>
                                                </div>
                                                <div class=" col-sm-3">
                                                    <label for="category_id" class="col-sm-4 control-label no-padding-left no-padding-right"> 商品类别: </label>
                                                    <div class="col-sm-8">
                                                        <select name="category_id">
                                                                <option value="0">--请选择--</option>
                                                            @foreach($categorys as $category)
                                                                <option value="{{$category['id']}}"> {{$category['category']}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class=" col-sm-3">
                                                    <label for="author_id" class="col-sm-4 control-label no-padding-left no-padding-right"> 作者: </label>
                                                    <div class="col-sm-8">
                                                        <select name="author_id">
                                                                <option value="0"> --请选择-- </option>
                                                            @foreach($users as $user)
                                                                <option value="{{$user['id']}}"> {{$user['nick_name']}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class=" col-sm-3 pull-right">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-primary">提交</button>
                                                </div>
                                            </div>
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

<!-- 删除提示模态框（Modal） -->
<div class="modal fade" id="deleteModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="form_goods_delete">
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
@endsection


@section('self_js')
    <!-- self_js start -->
    <script src="{{url('/assets/js/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{url('/assets/js/common/form-modal.js')}}"></script>
    <link href="{{url('/assets/css/select2/select2.min.css')}}" rel="stylesheet" />
    <script src="{{url('/assets/js/select2/select2.min.js')}}"></script>





<script>
//        $(this).find("select[name='city_id']").select2().val(0).trigger("change");
//        $(this).find("select[name='city_id']").select2().val(user.city_id).trigger("change");
var url = {
    list:   "{{url('/goods/ajaxlist')}}",
    delete: "{{url('/goods/delete')}}",
};
$(function(){
    $("select").select2();  // 初始化 select 标签
    loadList();             // 初始化加载列表

    // 表单搜索
    $("#form_list_filters").submit(function(){
        loadList($(this).find("button"));
        return false;
    });

    // 加载列表内容
    function loadList(btn){
        quiteAjaxFormToJson(url.list, '#form_list_filters', {
            submit_btn: btn,
            successFunc: function(d){
                $(".fill_list").html(d.data);
            }
        });
    }

    // 确认窗口-删除商品
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $(this).find("input[name='id']").val(button.data('id'));
    });

    // 删除操作
    $("#form_goods_delete").submit(function(){
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
