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
                @if( !empty( $item_list ) )
                <ul class="nav sidebar-menu">
                    <!--UI Elements-->
                    @foreach( $item_list as $primary_item )
                    @if( !empty($primary_item['short_name']) && $primary_item['short_name']==$step[1] )
                        @if (empty($primary_item['item_list']))
                    <li class="active">
                        @else
                    <li class="active open">
                        @endif
                    @else
                    <li>
                    @endif
                        @if (empty($primary_item['item_list']))
                        <a href="{{$primary_item['url']}}" >
                        @else
                        <a href="{{$primary_item['url']}}" class="menu-dropdown">
                        @endif
                            <i class="menu-icon fa fa-desktop"></i>
                            <span class="menu-text"> {{$primary_item['item_name']}} </span>
                            @if( !empty( $primary_item['item_list'] ) )
                            <i class="menu-expand"></i>
                            @endif
                        </a>

                        @if(!empty( $primary_item['item_list'] ))
                        <ul class="submenu">
                            @foreach( $primary_item['item_list'] as $second_item )
                            @if( !empty($second_item['short_name']) && !empty($step[2]) && $second_item['short_name']==$step[2] )
                                @if (empty($second_item['item_list']))
                            <li class="active">
                                @else 
                            <li class="active open">
                                @endif
                            @else 
                            <li>
                            @endif
                                @if (empty($second_item['item_list']))
                                <a href="{{$second_item['url']}}">
                                @else
                                <a href="{{$second_item['url']}}" class="menu-dropdown">
                                @endif
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

                                    @if( !empty($third_item['short_name']) && !empty($step[3]) && $third_item['short_name']==$step[3] )
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
