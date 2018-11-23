@extends('layouts.page', ['page_type'=>'single'])

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
                            <!-- widget -->
                            <div class="widget">
                                <div class="widget-header  with-footer">
                                </div>
                                <!-- widget Body -->
                                <div class="widget-body">
                                    <div class="flip-scroll">
                                        @yield('goods_part')
                                    </div>
                                </div>
                                <!-- /widget Body -->
                            </div>
                            <!-- /widget -->
                        </div>
                    </div>
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
@endsection


@section('self_js')
    <!-- self_js start -->
    <link href="{{url('/assets/css/select2/select2.min.css')}}" rel="stylesheet" />
    <script src="{{url('/assets/js/select2/select2.min.js')}}"></script>
    <script src="{{url('/assets/js/common/form-modal.js')}}"></script>
    <!--Summernote Scripts-->
    <script src="{{url('/assets/js/editors/summernote/summernote.js')}}"></script>







<script>
var url = {
    create: "{{url('/goods/create')}}",
    modify: "{{url('/goods/modify')}}",
};
$(function(){
    $("select").select2();  // 初始化 select 标签
    $('#summernote').summernote({ height: 300 });   // 初始化编辑器


    // 插入文章输入规则
    formValidator.init($('#form_goods_detail'), {
        title: {
            validators: {
                notEmpty: {
                    message: '商品名称不得为空'
                },
                stringLength: {
                    min: 2,
                    max: 125,
                    message: '商品名称须为大于2且小于125'
                }
            }
        },
        activity: {
            validators: {
                stringLength: {
                    max: 200,
                    message: '商品活动不大于200字'
                }
            }
        },
        model: {
            validators: {
                stringLength: {
                    max: 200,
                    message: '商品型号不大于200字'
                }
            }
        }
    });

    $("#form_goods_detail button").click(function(){
        var btn = $(this);
        quiteAjaxFormToJson(url.{{$type}}, $("#form_goods_detail"), {
            submit_btn: btn,
            successFunc: function(d){
                notifySuccess(d.msg);
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
