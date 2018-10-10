@extends('layouts.page')

@section('title', '管理后台')
@section('logo', url('assets/img/favicon.png'))
@section('description', '管理后台描述')

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
            <!-- 天气 start -->
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <div class="databox databox-vertical databox-xxxlg radius-bordered databox-shadowed">
                                <div class="databox-top bg-orange text-align-left padding-left-30">
                                    <span class="databox-header"><i class="glyphicon glyphicon-map-marker"></i> NEW YORK CITY</span>
                                </div>
                                <div class="databox-bottom no-padding bg-sky">
                                    <div class="databox-row row-4 bg-yellow padding-30 text-align-left">
                                        <span class="databox-text padding-bottom-5" style="font-size:20px;">FRI 29/09</span>
                                        <span class="databox-number" style="font-size:44px;">14° <i class="wi wi-day-cloudy"></i></span>
                                    </div>
                                    <div class="databox-row row-1 padding-5 padding-left-30 text-align-left bordered-bottom bordered-whitesmoke">
                                        <div class="databox-cell cell-8">
                                            <span class="databox-title no-margin">SAT</span>
                                        </div>
                                        <div class="databox-cell cell-4">
                                            <span class="databox-number">18°  <i class="wi wi-day-cloudy"></i></span>
                                        </div>
                                    </div>
                                    <div class="databox-row row-1 padding-5 padding-left-30 text-align-left bordered-bottom bordered-whitesmoke">
                                        <div class="databox-cell cell-8">
                                            <span class="databox-title no-margin">SUN</span>
                                        </div>
                                        <div class="databox-cell cell-4">
                                            <span class="databox-number">25°  <i class="wi wi-cloudy-gusts"></i></span>
                                        </div>
                                    </div>
                                    <div class="databox-row row-1 padding-5 padding-left-30 text-align-left bordered-bottom bordered-whitesmoke">
                                        <div class="databox-cell cell-8">
                                            <span class="databox-title no-margin">MON</span>
                                        </div>
                                        <div class="databox-cell cell-4">
                                            <span class="databox-number">22°  <i class="wi wi-windy"></i></span>
                                        </div>
                                    </div>
                                    <div class="databox-row row-1 padding-5 padding-left-30 text-align-left bordered-bottom bordered-whitesmoke">
                                        <div class="databox-cell cell-8">
                                            <span class="databox-title no-margin">TUE</span>
                                        </div>
                                        <div class="databox-cell cell-4">
                                            <span class="databox-number">19°  <i class="wi wi-day-showers"></i></span>
                                        </div>
                                    </div>
                                    <div class="databox-row row-1 padding-5 padding-left-30 text-align-left bordered-bottom bordered-whitesmoke">
                                        <div class="databox-cell cell-8">
                                            <span class="databox-title no-margin">WED</span>
                                        </div>
                                        <div class="databox-cell cell-4">
                                            <span class="databox-number">16°  <i class="wi wi-day-fog"></i></span>
                                        </div>
                                    </div>
                                    <div class="databox-row row-1 padding-5 padding-left-30 text-align-left bordered-bottom bordered-whitesmoke">
                                        <div class="databox-cell cell-8">
                                            <span class="databox-title no-margin">THU</span>
                                        </div>
                                        <div class="databox-cell cell-4">
                                            <span class="databox-number">14°  <i class="wi wi-day-lightning"></i></span>
                                        </div>
                                    </div>
                                    <div class="databox-row row-1 padding-5 padding-left-30 text-align-left bordered-bottom bordered-whitesmoke">
                                        <div class="databox-cell cell-8">
                                            <span class="databox-title no-margin">FRI</span>
                                        </div>
                                        <div class="databox-cell cell-4">
                                            <span class="databox-number">11°  <i class="wi wi-day-rain-mix"></i></span>
                                        </div>
                                    </div>
                                    <div class="databox-row row-1 padding-5 padding-left-30 text-align-left">
                                        <div class="databox-cell cell-8">
                                            <span class="databox-title no-margin">SAT</span>
                                        </div>
                                        <div class="databox-cell cell-4">
                                            <span class="databox-number">29°  <i class="wi wi-day-hail"></i></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
            <!-- 天气 end -->

            <!-- 日期 start -->
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="databox radius-bordered databox-shadowed databox-graded databox-vertical">
                                <div class="databox-top bg-blue">
                                    <div class="databox-icon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <div class="databox-bottom text-align-center">
                                    <span class="databox-text">{{date('l - Y d F')}}</span>
                                    <span class="databox-text">{{date('h:i A')}}</span>
                                </div>
                            </div>
                        </div>
            <!-- 日期 end -->
                    </div>
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
@endsection
@section('self_js')
    <!-- self_js start -->
    <!-- self_js end -->
@endsection

