@section('title', 'Error 404 - Page Not Found')
@section('logo', url('assets/img/favicon.png'))
@section('description', 'Error 404 - Page Not Found')


<!DOCTYPE html>
<!--
BeyondAdmin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 1.6.0
Purchase: https://wrapbootstrap.com/theme/beyondadmin-adminapp-angularjs-mvc-WB06R48S4
-->

<html xmlns="http://www.w3.org/1999/xhtml">
@include('layouts.head')
<!--Body-->
<body class="body-404">
    <div class="error-header"> </div>
    <div class="container ">
        <section class="error-container text-center">
            <h1>404</h1>
            <div class="error-divider">
                <h2>page not found</h2>
                <p class="description">We Couldn’t Find This Page</p>
            </div>
            <a href="{{url('home')}}" class="return-btn"><i class="fa fa-home"></i>Home</a>
        </section>
    </div>

    @include('layouts.page_base_js')
    
</body>
<!--Body Ends-->
</html>
