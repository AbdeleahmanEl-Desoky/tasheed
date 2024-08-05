<!DOCTYPE html>
<html dir="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Scarface</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {{--<!-- Bootstrap 3.3.7 -->--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/skin-blue.min.css') }}">



    <style>
        .sidebar_new .nav-links {
            /*height: 100%;*/
            /*padding: 30px 0 150px 0;*/
            margin-right: -13%;
            overflow: auto;
        }
        .sidebar.close .nav-links {
            overflow: visible;
        }
        .sidebar_new .nav-links::-webkit-scrollbar {
            display: none;
        }
        .sidebar_new .nav-links li {
            position: relative;
            list-style: none;
            transition: all 0.4s ease;
        }
        .sidebar_new .nav-links li:hover {
            background: #1E282C;
                }
        .sidebar_new .sub-menu li:hover {
            background: none;
            color: #77619e;
        }
        .sidebar_new .nav-links li .icon-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .sidebar.close .nav-links li .icon-link {
            display: block;
        }
        .sidebar_new .nav-links li i {
            height: 30px;
            min-width: 36px;
            /*text-align: center;*/
            line-height: 33px;
            color: #b8c7ce;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 2%;
        }
        .sidebar_new .nav-links li.showMenu i.arrow {
            transform: rotate(-180deg);
        }
        .sidebar.close .nav-links i.arrow {
            display: none;
        }
        .sidebar_new .nav-links li a {
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        .sidebar_new .nav-links li a .link_name {
            color: #b8c7ce;
            transition: all 0.4s ease;
        }
        .sidebar.close .nav-links li a .link_name {
            opacity: 0;
            pointer-events: none;
        }
        .sidebar_new .nav-links li .sub-menu {
            padding: 6px 6px 14px 80px;
            margin-top: 0px;
            /*background: #fff;*/
            display: none;
        }
        .sidebar_new .nav-links li.showMenu .sub-menu {
            display: block;
        }
        .sidebar_new .nav-links li .sub-menu a {
            font-size: 15px;
            padding: 5px 0;
            white-space: nowrap;
            opacity: 0.6;
            transition: all 0.3s ease;
            color: #fff3cdf ;

        }
        .sidebar_new .nav-links li .sub-menu a:hover {
            opacity: 1;
        }
        .sidebar.close .nav-links li .sub-menu {
            position: absolute;
            left: 100%;
            top: -10px;
            margin-top: 0;
            padding: 10px 20px;
            border-radius: 0 6px 6px 0;
            opacity: 0;
            display: block;
            pointer-events: none;
            transition: 0s;
        }
        .sidebar.close .nav-links li:hover .sub-menu {
            top: 0;
            opacity: 1;
            pointer-events: auto;
            transition: all 0.4s ease;
        }
        .sidebar_new .nav-links li .sub-menu .link_name {
            display: none;
        }
        .sidebar.close .nav-links li .sub-menu .link_name {
            font-size: 18px;
            opacity: 1;
            display: block;
        }
        .sidebar_new .nav-links li .sub-menu.blank {
            opacity: 1;
            pointer-events: auto;
            padding: 3px 20px 6px 16px;
            opacity: 0;
            pointer-events: none;
        }
        .sidebar_new .nav-links li:hover .sub-menu.blank {
            top: 50%;
            transform: translateY(-50%);
        }
        .sidebar_new .profile-details {
            position: fixed;
            bottom: 0;
            width: 260px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f3f1f6;
            padding: 12px 0;
            transition: all 0.5s ease;
        }
        .sidebar.close .profile-details {
            background: none;
        }
        .sidebar.close .profile-details {
            width: 78px;
        }
        .sidebar_new .profile-details .profile-content {
            display: flex;
            align-items: center;
        }
        .sidebar_new .profile-details img {
            height: 52px;
            width: 52px;
            object-fit: cover;
            border-radius: 16px;
            margin: 0 14px 0 12px;
            background: #1d1b31;
        }

        .sidebar_new .profile-details .profile_name,
        .sidebar_new .profile-details .job {
            color: #77619e;
            font-size: 18px;
            font-weight: 500;
            white-space: nowrap;
            transition: all 5s ease;
        }
        .sidebar.close .profile-details i,
        .sidebar.close .profile-details .profile_name,
        .sidebar.close .profile-details .job {
            display: none;
        }
        .sidebar_new .profile-details .job {
            font-size: 12px;
        }
        .home-section {
            position: relative;
            background: #e4e9f7;
            height: 100vh;
            left: 260px;
            width: calc(100% - 260px);
            transition: all 0.5s ease;
        }
        .sidebar.close ~ .home-section {
            left: 78px;
            width: calc(100% - 78px);
        }
        .home-section .home-content {
            height: 60px;
            display: flex;
            align-items: center;
        }
        .home-section .home-content .bx-menu,
        .home-section .home-content .text {
            color: #77619e;
            font-size: 35px;
        }
        .home-section .home-content .bx-menu {
            margin: 0 15px;
            cursor: pointer;
        }
        .home-section .home-content .text {
            font-size: 26px;
            font-weight: 600;
        }
        @media (max-width: 400px) {
            .sidebar.close .nav-links li .sub-menu {
                display: none;
            }
            .sidebar_new {
                width: 78px;
            }
            .sidebar.close {
                width: 0;
            }
            .home-section {
                left: 78px;
                width: calc(100% - 78px);
                z-index: 100;
            }
            .sidebar.close ~ .home-section {
                width: 100%;
                left: 0;
            }
        }

    </style>






























@if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE-rtl.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/rtl.css') }}">

<style>
    body {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1;
    }
    .kagepisuceng {
        position: relative;
        display: block;
        margin: 0 auto;
        width: 100%;
    }

    .kagepisuceng__items {
        position: relative;
        width: 100%;
        overflow: hidden;

    }

    .kagepisuceng__item {
        position: relative;
        display: none;
        width: 100%;
        transition: transform 0.6s ease;
        backface-visibility: hidden;
    }

    .kagepisuceng__item_active,
    .kagepisuceng__item_next,
    .kagepisuceng__item_prev {
        display: block;
    }

    .kagepisuceng__item_next,
    .kagepisuceng__item_prev {
        position: absolute;

        top: 0;
    }

    .kagepisuceng__item_next.kagepisuceng__item_left,
    .kagepisuceng__item_prev.kagepisuceng__item_right {
        transform: translateX(0);
    }

    .kagepisuceng__item_next,
    .kagepisuceng__item_right.kagepisuceng__item_active {
        transform: translateX(100%);
    }

    .kagepisuceng__item_prev,
    .kagepisuceng__item_left.kagepisuceng__item_active {
        transform: translateX(-100%);
    }



    .kagepisuceng__control {
        position: absolute;
        top: 0;
        bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 15%;
        color: #fff;
        text-align: center;
        opacity: 0.5;
    }

    .kagepisuceng__control:hover,
    .kagepisuceng__control:focus {
        /*color: #fff;*/
        text-decoration: none;
        outline: 0;
        opacity: .9;
    }

    .kagepisuceng__control_prev {
        left: 0;
    }

    .kagepisuceng__control_next {
        right: 0;
    }

    .kagepisuceng__control::before {
        content: '';
        display: inline-block;
        width: 20px;
        height: 20px;
        background: transparent no-repeat center center;
        background-size: 100% 100%;
    }

    .kagepisuceng__control_prev::before {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
    }

    .kagepisuceng__control_next::before {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
    }

    /* индикаторы слайдера */

    .kagepisuceng__indicators {
        position: absolute;
        right: 0;
        bottom: 10px;
        left: 0;
        z-index: 15;
        display: flex;
        justify-content: center;
        padding-left: 0;
        margin-right: 15%;
        margin-left: 15%;
        list-style: none;
    }

    .kagepisuceng__indicator {
        position: relative;
        flex: 0 1 auto;
        width: 30px;
        height: 3px;
        margin-right: 3px;
        margin-left: 3px;
        text-indent: -999px;
        cursor: pointer;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 6px;
    }

    .kagepisuceng__indicator::before {
        position: absolute;
        top: -10px;
        left: 0;
        display: inline-block;
        width: 100%;
        height: 10px;
        content: "";
    }

    .kagepisuceng__indicator::after {
        position: absolute;
        bottom: -10px;
        left: 0;
        display: inline-block;
        width: 100%;
        height: 10px;
        content: "";
    }

    .kagepisuceng__indicator_active {
        background-color: #fff;
    }

    img {
        display: inline-block;
        height: auto;
        max-width: 100%;
        border-radius: 50%;
    }

    .kagepisuceng__item {}

    .kagepisuceng__item_1 {
        background: linear-gradient(45deg, #085078 10%, #85d8ce 90%);
    }

    .kagepisuceng__item_2 {
        background: linear-gradient(to right, #dd1818, #333333);
    }

    .kagepisuceng__item_3 {
        background: linear-gradient(to right, #093028, #237a57);
    }

    .kagepisuceng__item_4 {
        background: linear-gradient(to right, #243B55, #141E30);
    }

    .kagepisuceng__item {
        height: 320px;
        overflow: hidden;
    }

    .kagepisuceng__item_inner {
        position: absolute;
        left: 15%;
        right: 15%;
        top: 36px;
        bottom: 36px;
        overflow: hidden;
        color: #fff;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .kagepisuceng__item_img {
        flex: 0 0 80px;
        max-width: 80px;
    }

    .kagepisuceng__item_testimonial {
        flex: 1 0 0;
        display: flex;
        flex-direction: column;
        text-align: center;

    }

    @media (min-width: 576px) {
        .kagepisuceng__item {
            height: 250px;
        }
        .kagepisuceng__item_inner {
            flex-direction: row;
        }
        .kagepisuceng__item_testimonial {
            margin-left: 15px;
        }
        .kagepisuceng__item_img {
            flex: 0 0 300px;
            max-width: 300px;
        }
        .kagepisuceng__item_testimonial {
            text-align: left;
        }
    }

    .kagepisuceng__item_name {
        font-size: 20px;
        margin-bottom: 8px;
        color: rgba(255, 255, 255, 0.8);
    }

    .kagepisuceng__item_post {
        font-size: 14px;
        margin-bottom: 8px;
        color: rgba(255, 255, 255, 0.8);
    }

    .kagepisuceng__item_text {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.5);
    }


    /********************************/
    /* some convenient global rules */
    /********************************/
    [outlines="1"] * { outline: 1px dashed }

    /*
        TIP: when in 3D view your objects have jagged edges,
             try using 'outline: 1px solid transparent' on your 3D elements
             and they will probably get smooth edges... Layman's anti-aliassing!!
    */

    *,::before,::after { box-sizing: border-box }
    html,.mina          { width: 100%; max-width: 100% }

    /* responsive base font size using y = mx + b 'y-intercept form' => y = 0.00625x + 12 */
    html { font-size: calc(0.625vmin + 0.75rem) } /* (320,14)(1280,20) */
    .mina { font-size: 1rem; margin: 0; min-height: 100vh }

    /* Simple page banding attributes for use in 'Landing Page' layout */
    [band],[block] { display: flex; justify-content: center; align-content: center; align-items: center }
    [band]         { flex-flow: row wrap; width: 100% } /* row of columns, full viewport width */
    [block]        { flex-flow: column wrap }           /* column of rows */

    [block] [block] { width: 100% } /* block child blocks at full parent width */

    [padded] {
        /*
            responsive spacing y=mx+b, use at top level [band]/[block] for nice page spacing

            top/bottom padding: p1(320,16) p2(1920, 72) => 0.035x + 4.8  => vary from 16 to  72px
            left/right padding: p1(320, 8) p2(1920,320) => 0.195x - 54.4 => vary from  8 to 320px
        */
        padding: calc( 3.5vh +  4.8px) calc(19.5vw - 54.4px);
    }

    /* prevent/enable text selection, also convenient for inadverted user multi-clicks */
    [no-select],[noselect] { -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none }
    [select]               { -webkit-user-select: text; -moz-user-select: text; -ms-user-select: text; user-select: text }

    /* Absolutely, positively hide the element from view and voice-readers */
    [gone],.gone,[data-gone="1"],[hide],.hidden {
        display:none; position:absolute; overflow:hidden; clip:rect(0 0 0 0);
        z-index:-999999; top:-999999px; margin:-1px; padding:0; border:0;
        height:1px; width:1px; min-height:0; min-width:0; max-height:0; max-width:0
    } /* also set <tag aria-hidden="true"> to be complete */


    /**********************************/
    /* Demo page layout, this 'n that */
    /**********************************/

    .mina {
        /* circumvents 'overflow jitter' in 3D when parent doesn't fit the viewport height */
        overflow-y: scroll;

        font-family: Inconsolata, monospace;
        font-weight: 600;
    }

    .threed-child {
        font-size: 3em;
        width: 6em; aspect-ratio: 9/16;
        border-radius: 0.5em;
        background-color: hsl(218.5,79.2%,66.1%,.5);/* CornflowerBlue */
        /*    color: hsl(48,100%,93.1%); /* CornSilk */

        /* GMD elevation 1dp */
        box-shadow: 0px 2px 1px -1px rgba(0,0,0,.20),
        0px 1px 1px  0px rgba(0,0,0,.14),
        0px 1px 3px  0px rgba(0,0,0,.12);
    }
    .threed-child:hover {
        transform: scale(1.01);

        z-index: 1; /* on top of the rest, HTML default = 0 */
        cursor: pointer;

        /* GMD elevation 3dp */
        box-shadow: 0px 3px 3px -2px rgba(0,0,0,.20),
        0px 3px 4px  0px rgba(0,0,0,.14),
        0px 1px 8px  0px rgba(0,0,0,.12);
    }
    .threed-child:active {
        /* Mouse/touch 'click' action */
        transform: scale(1);
    }

    /***********************/
    /* animated 3D view ON */
    /***********************/
    /* When <.mina threed="1"> then '3D view' will be active */

    /*
        Firefox doesn't react well to toggling 3D on/off and occasionally fails to refresh the viewport.
        Resize the browser window or toggle 'element outlines' to refresh and the circle will re-appear.

        Chrome and Edge work fine.
    */

    /* Enable 3D viewport */
    /*--------------------*/
    [threed="1"] .threed-parent {
        perspective: 800px;
        perspective-origin: center calc(50% - 20rem); /* the higher the rem, the higher the tilt */
        transition: all 0.5s ease-in-out;
    }
    [threed="1"] .threed-child {
        transform-style: preserve-3d;
        outline: 1px solid transparent;

        --rotateX: 90deg;
        --rotateY:  0deg;
        --rotateZ:  0deg;
    }
    [threed="1"] .threed-child:hover {
        --rotateX: 85deg;
        --rotateY:  0deg;
        --rotateZ:  0deg;
    }

    /* the '3D' shadow */
    /*-----------------*/
    [threed="1"] .threed-parent {
        margin-top: -10rem; /* move the parent a bit up */
        filter: drop-shadow(0px 150px 7px rgba(0, 0, 0, .5));
        /* That's it, really! */
    }

    /* animated view */
    /*---------------*/
    [threed="1"] .threed-child {
        -webkit-animation: rotate 30s infinite linear;
        animation: rotate 30s infinite linear;
    }

    @-webkit-keyframes rotate {
        from { transform: rotateX(var(--rotateX)) rotateY(var(--rotateY)) rotateZ(var(--rotateZ)) rotate(  0deg); }
        to   { transform: rotateX(var(--rotateX)) rotateY(var(--rotateY)) rotateZ(var(--rotateZ)) rotate(360deg); }
    }

    @keyframes rotate {
        from { transform: rotateX(var(--rotateX)) rotateY(var(--rotateY)) rotateZ(var(--rotateZ)) rotate(  0deg); }
        to   { transform: rotateX(var(--rotateX)) rotateY(var(--rotateY)) rotateZ(var(--rotateZ)) rotate(360deg); }
    }
    img{
        width:100%
    }









</style>

{{--        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">--}}

{{--        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">--}}

{{--        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}

{{--        <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">--}}

{{--        <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">--}}

{{--        <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">--}}

{{--        <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css?v=3.2.0')}}">--}}

{{--        <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">--}}

{{--        <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">--}}

{{--        <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css)}}">--}}














<style>
            body, h1, h2, h3, h4, h5, h6 {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>
    @else
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE.min.css') }}">
    @endif

    <style>
        .mr-2{
            margin-right: 5px;
        }

        .loader {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #367FA9;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 1s linear infinite; /* Safari */
            animation: spin 1s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

    </style>
    {{--<!-- jQuery 3 -->--}}
    <script src="{{ asset('dashboard_files/js/jquery.min.js') }}"></script>

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>

    {{--morris--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/morris/morris.css') }}">

    {{--<!-- iCheck -->--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/icheck/all.css') }}">

    {{--html in  ie--}}
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    <header class="main-header">

        {{--<!-- Logo -->--}}
        <a href="" class="logo">
            {{--<!-- mini logo for sidebar mini 50x50 pixels -->--}}
            <span class="logo-mini"><b>Scar</b></span>
            <span class="logo-lg"><b>Scarface</b></span>

        </a>

        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- Messages: style can be found in dropdown.less-->
                    {{-- <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li> --}}
                                <!-- inner menu: contains the actual data -->
                                {{-- <ul class="menu"> --}}
                                    {{-- <li><!-- start message --> --}}
                                        {{-- <a href="#">
                                            <div class="pull-left">
                                                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small>
                                                    <i class="fa fa-clock-o"></i> 5 mins
                                                </small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">See All Messages</a>
                            </li>
                        </ul>
                    </li> --}}

                    {{--<!-- Notifications: style can be found in dropdown.less -->--}}
                    {{-- <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li> --}}
                            {{-- <li> --}}
                                {{--<!-- inner menu: contains the actual data -->--}}
                                {{-- <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all</a>
                            </li>
                        </ul>
                    </li> --}}

                    <!-- Tasks: style can be found in dropdown.less -->
                    {{-- <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                {{--<!-- inner menu: contains the actual data -->--}}
                                {{-- <ul class="menu">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li> --}}

                    {{--<!-- User Account: style can be found in dropdown.less -->--}}
                    <li class="dropdown user user-menu">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('dashboard_files/img/logo.jpg') }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                        </a>
                        <ul class="dropdown-menu">

                            {{--<!-- User image -->--}}
                            <li class="user-header">
                                <img src="{{ asset('dashboard_files/img/logo.jpg') }}" class="img-circle" alt="User Image">

                                <p>
                                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                    <small></small>
                                </p>
                            </li>

                            {{--<!-- Menu Footer-->--}}
                            <li class="user-footer">

                            @if (auth()->user()->hasPermission('products-create'))
                                <a href="{{ route('dashboard.printedit',1) }}" class="btn btn-default btn-flat">بيانات الفاتورة</a>
                            @endif

                                <a ></a>


                                <a href="{{ route('dashboard.logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">@lang('site.logout')</a>

                                <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

    </header>

    @include('layouts.dashboard._aside')

    @yield('content')

    @include('partials._session')

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 3.0.0
        </div>
        <strong>
            System Cacher</strong>
    </footer>

</div><!-- end of wrapper -->

{{--<!-- Bootstrap 3.3.7 -->--}}
<script src="{{ asset('dashboard_files/js/bootstrap.min.js') }}"></script>

{{--icheck--}}
<script src="{{ asset('dashboard_files/plugins/icheck/icheck.min.js') }}"></script>

{{--<!-- FastClick -->--}}
<script src="{{ asset('dashboard_files/js/fastclick.js') }}"></script>

{{--<!-- AdminLTE App -->--}}
<script src="{{ asset('dashboard_files/js/adminlte.min.js') }}"></script>

{{--ckeditor standard--}}
<script src="{{ asset('dashboard_files/plugins/ckeditor/ckeditor.js') }}"></script>

{{--jquery number--}}
<script src="{{ asset('dashboard_files/js/jquery.number.min.js') }}"></script>

{{--print this--}}
<script src="{{ asset('dashboard_files/js/printThis.js') }}"></script>

{{--morris --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('dashboard_files/plugins/morris/morris.min.js') }}"></script>

{{--custom js--}}
<script src="{{ asset('dashboard_files/js/custom/image_preview.js') }}"></script>
<script src="{{ asset('dashboard_files/js/custom/order.js') }}"></script>

<script>
    $(document).ready(function () {

        $('.sidebar-menu').tree();

        //icheck
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        //delete
        $('.delete').click(function (e) {

            var that = $(this)

            e.preventDefault();

            var n = new Noty({
                text: "@lang('site.confirm_delete')",
                type: "warning",
                killer: true,
                buttons: [
                    Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                        that.closest('form').submit();
                    }),

                    Noty.button("@lang('site.no')", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });

            n.show();

        });//end of delete

        // // image preview
        // $(".image").change(function () {
        //
        //     if (this.files && this.files[0]) {
        //         var reader = new FileReader();
        //
        //         reader.onload = function (e) {
        //             $('.image-preview').attr('src', e.target.result);
        //         }
        //
        //         reader.readAsDataURL(this.files[0]);
        //     }
        //
        // });

        CKEDITOR.config.language =  "{{ app()->getLocale() }}";

    });//end of ready
    function printPdf(link) {

        {{--let pdf =--}}
        {{--    '{{ route('dashboard.orders.printproducts', ['id' => ':id']) }}';--}}
        {{--pdf = pdf.replace(':id', link);--}}
        var iframe = document.createElement('iframe');
        iframe.style.display = "none";
        // iframe.style.dir = "rtl";
        iframe.src = link;
        document.body.appendChild(iframe);
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
    }
</script>
<script>
    'use strict';
    var kagepisuceng = (function (config) {

        const ClassName = {
            INDICATOR_ACTIVE: 'kagepisuceng__indicator_active',
            ITEM: 'kagepisuceng__item',
            ITEM_LEFT: 'kagepisuceng__item_left',
            ITEM_RIGHT: 'kagepisuceng__item_right',
            ITEM_PREV: 'kagepisuceng__item_prev',
            ITEM_NEXT: 'kagepisuceng__item_next',
            ITEM_ACTIVE: 'kagepisuceng__item_active'
        }

        var
            _isSliding = false, // индикация процесса смены слайда
            _interval = 0, // числовой идентификатор таймера
            _transitionDuration = 700, // длительность перехода
            _kagepisuceng = {}, // DOM элемент слайдера
            _items = {}, // .kagepisuceng-item (массив слайдов)
            _kagepisucengIndicators = {}, // [data-slide-to] (индикаторы)
            _config = {
                selector: '', // селектор слайдера
                isCycling: true, // автоматическая смена слайдов
                direction: 'next', // направление смены слайдов
                interval: 5000, // интервал между автоматической сменой слайдов
                pause: true // устанавливать ли паузу при поднесении курсора к слайдеру
            };

        var
            // функция для получения порядкового индекса элемента
            _getItemIndex = function (_currentItem) {
                var result;
                _items.forEach(function (item, index) {
                    if (item === _currentItem) {
                        result = index;
                    }
                });
                return result;
            },
            // функция для подсветки активного индикатора
            _setActiveIndicator = function (_activeIndex, _targetIndex) {
                if (_kagepisucengIndicators.length !== _items.length) {
                    return;
                }
                _kagepisucengIndicators[_activeIndex].classList.remove(ClassName.INDICATOR_ACTIVE);
                _kagepisucengIndicators[_targetIndex].classList.add(ClassName.INDICATOR_ACTIVE);
            },

            // функция для смены слайда
            _slide = function (direction, activeItemIndex, targetItemIndex) {
                var
                    directionalClassName = ClassName.ITEM_RIGHT,
                    orderClassName = ClassName.ITEM_PREV,
                    activeItem = _items[activeItemIndex], // текущий элемент
                    targetItem = _items[targetItemIndex]; // следующий элемент

                var _slideEndTransition = function () {
                    activeItem.classList.remove(ClassName.ITEM_ACTIVE);
                    activeItem.classList.remove(directionalClassName);
                    targetItem.classList.remove(orderClassName);
                    targetItem.classList.remove(directionalClassName);
                    targetItem.classList.add(ClassName.ITEM_ACTIVE);
                    window.setTimeout(function () {
                        if (_config.isCycling) {
                            clearInterval(_interval);
                            _cycle();
                        }
                        _isSliding = false;
                        activeItem.removeEventListener('transitionend', _slideEndTransition);
                    }, _transitionDuration);
                };

                if (_isSliding) {
                    return;
                }
                _isSliding = true;

                if (direction === "next") {
                    directionalClassName = ClassName.ITEM_LEFT;
                    orderClassName = ClassName.ITEM_NEXT;
                }

                targetItem.classList.add(orderClassName);
                _setActiveIndicator(activeItemIndex, targetItemIndex);
                window.setTimeout(function () {
                    targetItem.classList.add(directionalClassName);
                    activeItem.classList.add(directionalClassName);
                    activeItem.addEventListener('transitionend', _slideEndTransition);
                }, 0);

            },

            _slideTo = function (direction) {
                var
                    activeItem = _kagepisuceng.querySelector('.' + ClassName.ITEM_ACTIVE),
                    activeItemIndex = _getItemIndex(activeItem),
                    lastItemIndex = _items.length - 1,
                    targetItemIndex = activeItemIndex === 0 ? lastItemIndex : activeItemIndex - 1;
                if (direction === "next") {
                    targetItemIndex = activeItemIndex == lastItemIndex ? 0 : activeItemIndex + 1;
                }
                _slide(direction, activeItemIndex, targetItemIndex);
            },

            _cycle = function () {
                if (_config.isCycling) {
                    _interval = window.setInterval(function () {
                        _slideTo(_config.direction);
                    }, _config.interval);
                }
            },

            _actionClick = function (e) {
                var
                    activeItem = _kagepisuceng.querySelector('.' + ClassName.ITEM_ACTIVE),
                    activeItemIndex = _getItemIndex(activeItem),
                    targetItemIndex = e.target.getAttribute('data-slide-to');

                if (!(e.target.hasAttribute('data-slide-to') || e.target.classList.contains('kagepisuceng__control'))) {
                    return;
                }
                if (e.target.hasAttribute('data-slide-to')) {
                    if (activeItemIndex === targetItemIndex) {
                        return;
                    }
                    _slide((targetItemIndex > activeItemIndex) ? 'next' : 'prev', activeItemIndex, targetItemIndex);
                } else {
                    e.preventDefault();
                    _slideTo(e.target.classList.contains('kagepisuceng__control_next') ? 'next' : 'prev');
                }
            },

            _setupListeners = function () {

                _kagepisuceng.addEventListener('click', _actionClick);

                if (_config.pause && _config.isCycling) {
                    _kagepisuceng.addEventListener('mouseenter', function (e) {
                        clearInterval(_interval);
                    });
                    _kagepisuceng.addEventListener('mouseleave', function (e) {
                        clearInterval(_interval);
                        _cycle();
                    });
                }
            };

        for (var key in config) {
            if (key in _config) {
                _config[key] = config[key];
            }
        }
        _kagepisuceng = (typeof _config.selector === 'string' ? document.querySelector(_config.selector) : _config.selector);
        _items = _kagepisuceng.querySelectorAll('.' + ClassName.ITEM);
        _kagepisucengIndicators = _kagepisuceng.querySelectorAll('[data-slide-to]');
        // запуск функции cycle
        _cycle();
        _setupListeners();

        return {
            next: function () {
                _slideTo('next');
            },
            prev: function () {
                _slideTo('prev');
            },
            stop: function () {
                clearInterval(_interval);
            },
            cycle: function () {
                clearInterval(_interval);
                _cycle();
            }
        }
    }({
        selector: '.kagepisuceng',
        isCycling: false,
        direction: 'next',
        interval: 5000,
        pause: true
    }));
</script>
@stack('scripts')
<script>
    const arrows = document.querySelectorAll(".arrow");
    arrows.forEach((arrow) => {
        arrow.addEventListener("click", (e) => {
            const arrowParent = e.target.closest(".arrow").parentElement.parentElement;
            arrowParent.classList.toggle("showMenu");
        });
    });



</script>

</body>
</html>
