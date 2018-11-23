@section('subtitle', $view_data->_head['subtitle']) 
{{-- 二级菜单 --}}
@section('page_main')
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="{{url('/home')}}">Home</a>
                        </li>
                        @foreach ($view_data->_item_info['current_item'] as $key=>$item)
                            @if (count($view_data->_item_info['current_item']) > ($key+1)) 
                            <li>
                                <i class=""></i>
                                <a href="{{url($item['url'])}}">{{$item['item_name']}}</a>
                            </li>
                            @else
                            <li class="active"> {{$item['item_name']}} </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            @yield('subtitle')
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
@endsection

