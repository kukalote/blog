    <!-- Main Container -->
    <div class="main-container container-fluid">
        <!-- Page Container -->
        <div class="page-container">
        @include('layouts.page_sidebar')
        @yield('page_main')

        </div>
        <!-- /Page Container -->
        <!-- Main Container -->

    </div>

    @include('layouts.page_base_js')
    @yield('self_js')
