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
<!--Head-->
<head>
    <meta charset="utf-8" />
    <title>Error 500</title>

    <meta name="description" content="Error 500" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--Basic Styles-->
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="{{url('assets/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />

    <!--Fonts-->
    <link href="../fonts.googleapis.com/css@family=open+sans_3a300italic,400italic,600italic,700italic,400,600,700,300.css" rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link id="beyond-link" href="{{url('assets/css/beyond.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/css/demo.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/css/animate.min.css')}}" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="{{url('assets/js/skins.min.js')}}"></script>
</head>
<!--Head Ends-->
<!--Body-->
<body class="body-500">
    <div class="error-header"> </div>
    <div class="container ">
        <section class="error-container text-center">
            <h1>500</h1>
            <div class="error-divider">
                <h2>ooops!!</h2>
                <p class="description">SOMETHING WENT WRONG.</p>
            </div>
            <a href="{{url('home')}}" class="return-btn"><i class="fa fa-home"></i>Home</a>
        </section>
    </div>
    <!--Basic Scripts-->
    <script src="{{url('assets/js/jquery.min.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!--Beyond Scripts-->
    <script src="{{url('assets/js/beyond.min.js')}}"></script>

    
</body>
<!--Body Ends-->
</html>
