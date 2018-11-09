            <!-- Page Sidebar -->
            <div class="page-sidebar" id="sidebar">
                <!-- Page Sidebar Header-->
                <div class="sidebar-header-wrapper">
                    <input type="text" class="searchinput" />
                    <i class="searchicon fa fa-search"></i>
                    <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>
                </div>
                <!-- /Page Sidebar Header -->
                <!-- Sidebar Menu -->
                @if( !empty( $view_data->_item_info ) )
                <ul class="nav sidebar-menu">
                    <!--UI Elements-->
                    @foreach( $view_data->_item_info['item_list'] as $primary_item )
                    @if( !empty($primary_item['short_name']) && $primary_item['short_name']==$view_data->_item_info['step']['primary_item'] )
                        @if (empty($primary_item['item_list']))
                    <li class="active">
                        @else
                    <li class="active open">
                        @endif
                    @else
                    <li>
                    @endif
                        <a href="{{$primary_item['url']}}" class="menu-dropdown">
                            <i class="menu-icon fa fa-desktop"></i>
                            <span class="menu-text"> {{$primary_item['item_name']}} </span>
                            @if( !empty( $primary_item['item_list'] ) )
                            <i class="menu-expand"></i>
                            @endif
                        </a>
                        @if( !empty( $primary_item['item_list'] ) )
                        <ul class="submenu">
                            @foreach( $primary_item['item_list'] as $second_item )
                            @if( !empty($second_item['short_name']) && $second_item['short_name']==$view_data->_item_info['step']['second_item'] )
                                @if (empty($second_item['item_list']))
                            <li class="active">
                                @else 
                            <li class="active open">
                                @endif
                            @else 
                            <li>
                            @endif
                                <a href="{{$second_item['url']}}" class="menu-dropdown">
                                    <span class="menu-text">
                                        {{$second_item['item_name']}}
                                    </span>
                                    @if( !empty( $second_item['item_list'] ) )
                                    <i class="menu-expand"></i>
                                    @endif
                                </a>

                                @if( !empty( $second_item['item_list'] ) )
                                <ul class="submenu">
                                    @foreach( $second_item['item_list'] as $third_item )

                                    @if( !empty($third_item['short_name']) && $third_item['short_name']==$view_data->_item_info['step']['third_item'] )
                                    <li class="active">
                                    @else 
                                    <li>
                                    @endif
                                        <a href="{{ $third_item['url'] }}">
                                            <i class="menu-icon fa fa-rocket"></i>
                                            <span class="menu-text">{{ $third_item['item_name'] }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
                 @endif 
                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->
