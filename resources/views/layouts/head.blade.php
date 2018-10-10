<head>
    <meta charset="utf-8" />
    <title>{{ $view_data->_head['title'] }}</title>
    <!-- seo -->
    <meta name="description" content="{{ $view_data->_head['description'] }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="{{ $view_data->_head['logo'] }}" type="image/x-icon">

    <!--Basic Styles-->
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="{{url('assets/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/css/weather-icons.min.css')}}" rel="stylesheet" />

    <!--Beyond styles-->
    <link id="beyond-link" href="{{url('assets/css/beyond.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/demo.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/css/typicons.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/css/user-extra.css')}}" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="{{url('assets/js/skins.min.js')}}"></script>

</head>

