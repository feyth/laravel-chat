<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Chat App</title>

    <link rel="stylesheet" href="/chat/css/chat.css" />

    <!-- inject:css -->
    <link rel="stylesheet" href="/chat/css/animate.css">
    <link rel="stylesheet" href="/chat/css/font-awesome.min.css">
    <link rel="stylesheet" href="/chat/css/fontello.css">
    <link rel="stylesheet" href="/chat/css/jquery-ui.css">
    <link rel="stylesheet" href="/chat/css/lnr-icon.css">
    <link rel="stylesheet" href="/chat/css/owl.carousel.css">
    <link rel="stylesheet" href="/chat/css/slick.css">
    <link rel="stylesheet" href="/chat/css/trumbowyg.min.css">
    <link rel="stylesheet" href="/chat/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/chat/css/style.css">
</head>
<body class="preload messages-page">
<!-- start menu-area -->
<div class="menu-area">
    <!-- start .top-menu-area -->
    <div class="top-menu-area">
        <!-- start .container -->
        <div class="container">
            <!-- start .row -->
            <div class="row">
                <!-- start .col-md-3 -->
                <div class="col-lg-3 col-md-3 col-6 v_middle">
                    <div class="logo">
                        <a href="/">
                            <img width="100px" src="/chat/images/logo-chat.png" alt="logo image" class="img-fluid">
                        </a>
                    </div>
                </div>
                <!-- end /.col-md-3 -->

                <!-- start .col-md-5 -->
                <div class="col-lg-8 offset-lg-1 col-md-9 col-6 v_middle">
                    <!-- start .author-area -->
                    <div class="author-area">
                        @if(Auth::check())
                            <a href="/logout" class="author-area__seller-btn inline">Sair do sistema</a>
                        @else
                            <a href="/login" class="author-area__seller-btn inline">Faça o login</a>
                        @endif

                        <div class="author__notification_area">
                            <ul>
                                <li class="has_dropdown">
                                    <div class="icon_wrap">
                                        <span class="lnr lnr-envelope"></span>
                                        <span class="notification_count msg">0</span>
                                    </div>

                                    <div class="dropdowns messaging--dropdown">
                                        <div class="dropdown_module_header">
                                            <h4>Minhas mensagens</h4>
                                        </div>

                                        <div class="messages">

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--start .author__notification_area -->

                        <!--start .author-author__info-->
                        <div class="author-author__info inline has_dropdown">
                            <div class="author__avatar">
                                <img src="/chat/images/usr_avatar.png" alt="user avatar">
                            </div>
                            @if(Auth::check())
                                <div class="autor__info">
                                    <p class="name">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p class="ammount">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="dropdowns dropdown--author">
                                    <ul>
                                        <li>
                                            <a href="/">
                                                <span class="lnr lnr-home"></span>Home
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/logout">
                                                <span class="lnr lnr-exit"></span>Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="autor__info">
                                    <p class="name">
                                        Convidado
                                    </p>
                                    <p class="ammount">Usuário não logado</p>
                                </div>
                                <div class="dropdowns dropdown--author">
                                    <ul>
                                        <li>
                                            <a href="/login">
                                                <span class="lnr lnr-home"></span>Entrar
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <!--end /.author-author__info-->
                    </div>
                    <!-- end .author-area -->

                    <!-- author area restructured for mobile -->
                    <div class="mobile_content ">
                        <span class="lnr lnr-user menu_icon"></span>

                        <!-- offcanvas menu -->
                        <div class="offcanvas-menu closed">
                            <span class="lnr lnr-cross close_menu"></span>
                            <div class="author-author__info">
                                <div class="author__avatar v_middle">
                                    <img src="/chat/images/usr_avatar.png" alt="user avatar">
                                </div>
                                @if(Auth::check())
                                    <div class="autor__info v_middle">
                                        <p class="name">
                                            {{ Auth::user()->name }}
                                        </p>
                                        <p class="ammount">{{ Auth::user()->email }}</p>
                                    </div>
                                @else
                                    <div class="autor__info v_middle">
                                        <p class="name">
                                            Convidado
                                        </p>
                                        <p class="ammount">Usuário não logado</p>
                                    </div>
                                @endif
                            </div>
                            <!--end /.author-author__info-->



                            <div class="dropdowns dropdown--author">
                                @if(Auth::check())
                                    <ul>
                                        <li>
                                            <a href="/">
                                                <span class="lnr lnr-home"></span>Home
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/logout">
                                                <span class="lnr lnr-exit"></span>Logout
                                            </a>
                                        </li>
                                    </ul>
                                @else
                                    <ul>
                                        <li>
                                            <a href="/login">
                                                <span class="lnr lnr-home"></span>Entrar
                                            </a>
                                        </li>
                                    </ul>
                                @endif
                            </div>

                            <div class="text-center">
                                @if(Auth::check())
                                    <a href="/logout" class="author-area__seller-btn inline">Sair do sistema</a>
                                @else
                                    <a href="/login" class="author-area__seller-btn inline">Faça o login</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- end /.mobile_content -->
                </div>
                <!-- end /.col-md-5 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </div>
    <!-- end  -->

    <!-- start .mainmenu_area -->
    <div class="mainmenu">
        <!-- start .container -->
        <div class="container">
            <!-- start .row-->
            <div class="row">
                <!-- start .col-md-12 -->
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-md navbar-light mainmenu__menu">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li>
                                    <a href="/">HOME</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row-->
        </div>
        <!-- start .container -->
    </div>
    <!-- end /.mainmenu-->
</div>
<!-- end /.menu-area -->



@yield('content')

<div id="chat-overlay" class="row"></div>

<audio id="chat-alert-sound" style="display: none">
    <source src="/chat/sound/facebook_chat.mp3" />
</audio>

<!-- inject:js -->
<script src="/chat/js/vendor/jquery/jquery-1.12.3.js"></script>
<script src="/chat/js/vendor/jquery/popper.min.js"></script>
<script src="/chat/js/vendor/jquery/uikit.min.js"></script>
<script src="/chat/js/vendor/bootstrap.min.js"></script>
<script src="/chat/js/vendor/chart.bundle.min.js"></script>
<script src="/chat/js/vendor/grid.min.js"></script>
<script src="/chat/js/vendor/jquery-ui.min.js"></script>
<script src="/chat/js/vendor/jquery.barrating.min.js"></script>
<script src="/chat/js/vendor/jquery.countdown.min.js"></script>
<script src="/chat/js/vendor/jquery.counterup.min.js"></script>
<script src="/chat/js/vendor/jquery.easing1.3.js"></script>
<script src="/chat/js/vendor/owl.carousel.min.js"></script>
<script src="/chat/js/vendor/slick.min.js"></script>
<script src="/chat/js/vendor/tether.min.js"></script>
<script src="/chat/js/vendor/trumbowyg.min.js"></script>
<script src="/chat/js/vendor/waypoints.min.js"></script>
<script src="/chat/js/dashboard.js"></script>
<script src="/chat/js/main.js"></script>
<!-- endinject -->
@yield('script')
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script src="/chat/js/chat.js"></script>
</body>
</html>
