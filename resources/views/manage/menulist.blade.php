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
                        <!-- 树型结构 start -->
                        <div class="col-xs-6 col-md-6">
                            <div class="widget flat radius-bordered">
                                <div class="widget-header bg-lightred">
                                    <span class="widget-caption">菜单管理</span>
                            <!-- 最小和关闭按钮 -->
                            <!-- 
                                    <div class="widget-buttons">
                                        <a href="#" data-toggle="collapse">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                        <a href="#" data-toggle="dispose">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                            -->
                                </div>

                                <div class="widget-body">
                        <!-- folder start -->
                                    <div id="MyTree" class="tree tree-solid-line tree-unselectable">
                                        <!-- 加载文件夹及目录需要的样式模板 -->
                                        <div class="tree-folder" style="display: none;">
                                            <div class="tree-folder-header">
                                                <i class="fa fa-folder blueberry"></i>
                                                <div class="tree-folder-name"></div>
                                            </div>
                                            <div class="tree-folder-content"> </div>
                                            <div class="tree-loader" style="display: none;"></div>
                                        </div>
                                        <div class="tree-item" style="display: none;">
                                            <i class="tree-dot"></i>
                                            <div class="tree-item-name"></div>
                                        </div>
                                    </div>
                        <!-- folder end -->
                                </div>
                            </div>
                        </div>
                        <!-- 树型结构 end -->
                        <!-- 表单编辑框 start -->
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <div class="widget">
                                <div class="widget-header bordered-top bordered-palegreen">
                                    <span class="widget-caption"> 菜单编辑项 </span>
                                </div>
                                <div class="widget-body">
                                    <div class="collapse in">
                                        <form role="form" id="tree_bind">
                                            <div class="form-group">
                                                <label for="item_name"> 名称 </label>
                                                <input name="item_name" type="text" class="form-control" id="item_name" placeholder="菜单名称">
                                            </div>
                                            <div class="form-group">
                                                <label for="short_name"> 简称 </label>
                                                <input name="short_name" type="text" class="form-control" id="short_name" placeholder="菜单简称">
                                            </div>
                                            <div class="form-group">
                                                <label for="url"> 链接 </label>
                                                <input name="url" type="text" class="form-control" id="url" placeholder="菜单链接">
                                            </div>
                                            <div class="form-group">
                                                <label for="form_id"> ID </label>
                                                <input name="id" type="text" class="form-control" id="form_id" placeholder="ID" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="parent_id"> 父级ID </label>
                                                <input name="parent_id" type="text" class="form-control" id="parent_id" placeholder="父级ID">
                                            </div>
                                            <div class="form-group">
                                                <label for="sort"> 排序 </label>
                                                <input name="sort" type="text" class="form-control" id="sort" placeholder="排序-大值靠前">
                                            </div>
                                            <div class="form-group">
                                                <label>
                                                    <input name="disabled" class="checkbox-slider slider-icon" type="checkbox" value="1">
                                                    <span class="text"> 是否禁用 </span>
                                                </label>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-lg-3 col-lg-offset-9">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-blue"> 保存 </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 表单编辑框 end -->
                    </div>
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->

@endsection



@section('self_js')
    <!-- self_js start -->
    <script src="{{url('/assets/js/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{url('/assets/js/common/form-modal.js')}}"></script>

    <!--Page Related Scripts-->
    <script src="{{url('assets/js/fuelux/treeview/tree-custom.min.js')}}"></script>
    <script src="{{url('assets/js/fuelux/treeview/treeview-init.js')}}"></script>

<script>
var url = {
    tree:   "{{url('/manage/menu/tree')}}",
    create: "{{url('/manage/menu/create')}}",
    delete: "{{url('/manage/menu/delete')}}",
    modify:   "{{url('/manage/menu/modify')}}"
};

// 插件初始化
jQuery(document).ready(function () {
    var TreeMaker = function () {
        var self = this;
        this.form = $("#tree_bind");
        $("#MyTree").delegate(".tree-item-name, .tree-folder-name", "click", function(){
            var data = $(this).data();
            self.loadForm(data, "modify");
        });
        $("#MyTree").delegate(".tree-actions .fa-plus", "click", function(){
            var parent_data = $(this).parent().parent().data();
            var data = {parent_id:parent_data.id};
            self.loadForm(data, "create");
            return false;
        });
        $("#MyTree").delegate(".tree-actions .fa-trash-o", "click", function(){
            var item = $(this).parent().parent();
            self.loadForm(item.data(), "delete");
            self.form.submit();
            self.loadForm({}); // 加载form为空
            return false;
        });
        $("#MyTree").delegate(".tree-actions .fa-rotate-right", "click", function(){
            var item = $(this).parent().parent();
            self.refresh(item);
            return false;
        });
    };

    TreeMaker.prototype = {
        loadForm: function(data, form_type){
            if (form_type==undefined) {
                this.form.removeData("type");
            } else {
                this.form.data({type:form_type});
            }
            if (data.parent_id===0) {
                this.form.find("#parent_id").prop({disabled:true});
            } else {
                this.form.find("#parent_id").prop({disabled:false});
            }
            this.form.find("#item_name").val(data.item_name||'');
            this.form.find("#short_name").val(data.short_name||'');
            this.form.find("#url").val(data.url||'');
            this.form.find("#form_id").val(data.id||'');
            this.form.find("#parent_id").val(data.parent_id||0);
            this.form.find("#sort").val(data.sort||'');
            this.form.find("[name='disabled']").prop({checked:(data.disabled||0)});  // checkbox checked属性设置
        },
        refresh: function(item_to_refresh, reload_form) {
            // 模拟点击
            var node = $(item_to_refresh).parent().parent();
            item_to_refresh.click();
            node.find(".tree-folder-content").html("");
            item_to_refresh.click();
            if (reload_form!==undefined) {
                this.loadForm({});
            }
            return false;
        },
        // 获取节点 ajax
        getTargetItem: function (active_node, loadFunc) {
            var self = this;
            if (active_node.hasClass("tree-unselectable")){
                // 总结点
                var parent_id = 0;
            } else if (active_node.hasClass("tree-folder-header")) {
                // 目录结点
                var parent_id = $(active_node).find(".tree-folder-name").attr("id");
            } 
            quiteAjaxToJson(
                url.tree,
                {_token:"{{csrf_token()}}", parent_id:parent_id}, 
                {
                    successFunc: function(r){
                        var data = self.coverToTree(r.data);
                        loadFunc(data);
                    }
                }
            )
        },
        // 数据转换
        coverToTree: function(data) {
            var tree_sets = {};
            for (var i in data) {
                tree_sets[i] =  { 
                    type: data[i].type ,
                    additionalParameters: { id: data[i].id},
                    additionalDatas: data[i].data 
                };
                if (data[i].type=="folder") {
                    if (data[i].parent_id==0) {
                        tree_sets[i].name = data[i].name+'<div class="tree-actions"><i class="fa fa-plus green"></i><i class="fa fa-rotate-right blizzard"></i></div>';
                    } else {
                        tree_sets[i].name = data[i].name+'<div class="tree-actions"><i class="fa fa-plus green"></i><i class="fa fa-trash-o danger"></i><i class="fa fa-rotate-right blizzard"></i></div>';
                    }
                } else {
                    tree_sets[i].name = data[i].name+'<div class="tree-actions"><i class="fa fa-plus green"></i><i class="fa fa-trash-o danger"></i></div>';
                }
            }
            return tree_sets;
        }
    }
    // 自定义树扩展
    var tree_maker = new TreeMaker();
    UITree.init(tree_maker);

    // 编辑菜单项提交操作
    $("#tree_bind").submit(function(){
        var type = $(this).data("type");
        var submit_url = url[type];
        var parent_id = $(this).find("#parent_id").val();
        var refresh_item = $("#"+parent_id);
        if (type=="create") {
            if (refresh_item.hasClass("tree-item-name")) {
                refresh_item = refresh_item.parents(".tree-folder:eq(0)").find(".tree-folder-name"); // 父级
            }
        } else if (type=="delete") {
            var siblings = refresh_item.parents(".tree-folder:eq(0)").find(".tree-folder-content").children();
            if (siblings.length==1) {
                refresh_item = refresh_item.parents(".tree-folder:eq(1)").find(".tree-folder-name"); // 父级
            }
        }

        if (submit_url == undefined) {
            notifyDanger("未知操作关联");
            return false;
        }
        ajaxFormToJson(submit_url, $(this), {
            submit_btn: $("#tree_bind button[type='submit']"),
            successFunc: function(r){
                // 重新加载树节点
                tree_maker.refresh(refresh_item, true);
            }
        });
        return false;
    });
});
</script>
    <!-- self_js end -->
@endsection
