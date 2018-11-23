    <!-- Main Container -->
    <div class="main-container container-fluid">
        <!-- Page Container -->
        <div class="page-container">
{{-- 框架页加载侧栏 --}}
@if ($page_type=='frame')
        @include('layouts.page_sidebar', ['step'=>$view_data->_item_info['step'], 'current_item'=>$view_data->_item_info['current_item'], 'item_list'=>$view_data->_item_info['item_list']])
@endif
        @yield('page_main')

        </div>
        <!-- /Page Container -->
        <!-- Main Container -->

    </div>

    @include('layouts.page_base_js')
    @yield('self_js')
