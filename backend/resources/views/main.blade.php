<!DOCTYPE html>
<html lang="es">
<head>
    <title>RedCultural.net/Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{!! URL::to('favicon.png') !!}">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    {!! Html::style("backend/css/jquery-ui-1.10.4.custom.min.css") !!}
    {!! Html::style("backend/css/font-awesome.min.css") !!}
    {!! Html::style("backend/css/bootstrap.min.css") !!}
    {!! Html::style("backend/css/animate.css") !!}
    {!! Html::style("backend/css/all.css" )!!}
    {!! Html::style("backend/css/main.css") !!}
    {!! Html::style("backend/css/style-responsive.css") !!}
    {!! Html::style("backend/css/zabuto_calendar.min.css") !!}
    {!! Html::style("backend/css/pace.css") !!}
    {!! Html::style("backend/css/jquery-ui-1.10.4.custom.min.css") !!}
    {!! Html::style("backend/css/flatty.css") !!}
    {!! Html::style("backend/javascript/summernote/summernote.css") !!}
</head>
<body>

    <div>
        <!--BEGIN BACK TO TOP-->
        <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
        <!--END BACK TO TOP-->
        <!--BEGIN TOPBAR-->
        <div id="header-topbar-option-demo" class="page-header-topbar">
            <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="index.html" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">RedCultural.net</span><span style="display: none" class="logo-text-icon">µ</span></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                
                <form id="topbar-search" action="" method="" class="hidden-sm hidden-xs">
                    <div class="input-icon right text-white"><a href="#"><i class="fa fa-search"></i></a><input type="text" placeholder="Search here..." class="form-control text-white"/></div>
                </form>
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                    <li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-bell fa-fw"></i><span class="badge badge-green">3</span></a>
                        
                    </li>
                    <!--<li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-envelope fa-fw"></i><span class="badge badge-orange">7</span></a>
                        
                    </li>
                    <li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-tasks fa-fw"></i><span class="badge badge-yellow">8</span></a>
                        
                    </li>-->
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img src="images/avatar/48.jpg" alt="" class="img-responsive img-circle"/>&nbsp;<span class="hidden-xs">{!! Auth::user()->name !!}</span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="#"><i class="fa fa-user"></i>My Profile</a></li>
                            <li><a href="#"><i class="fa fa-calendar"></i>My Calendar</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i>My Inbox<span class="badge badge-danger">3</span></a></li>
                            <li><a href="#"><i class="fa fa-tasks"></i>My Tasks<span class="badge badge-success">7</span></a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-lock"></i>Lock Screen</a></li>
                            <li><a href="{!! url('/logout') !!}"><i class="fa fa-key"></i>Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
            <!--BEGIN MODAL CONFIG PORTLET-->
            <div id="modal-config" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                                &times;</button>
                            <h4 class="modal-title">
                                Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend et nisl eget
                                porta. Curabitur elementum sem molestie nisl varius, eget tempus odio molestie.
                                Nunc vehicula sem arcu, eu pulvinar neque cursus ac. Aliquam ultricies lobortis
                                magna et aliquam. Vestibulum egestas eu urna sed ultricies. Nullam pulvinar dolor
                                vitae quam dictum condimentum. Integer a sodales elit, eu pulvinar leo. Nunc nec
                                aliquam nisi, a mollis neque. Ut vel felis quis tellus hendrerit placerat. Vivamus
                                vel nisl non magna feugiat dignissim sed ut nibh. Nulla elementum, est a pretium
                                hendrerit, arcu risus luctus augue, mattis aliquet orci ligula eget massa. Sed ut
                                ultricies felis.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">
                                Close</button>
                            <button type="button" class="btn btn-primary">
                                Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--END MODAL CONFIG PORTLET-->
        </div>
        <!--END TOPBAR-->
        <div id="wrapper">
            <!--BEGIN SIDEBAR MENU-->
            <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                        <div class="clearfix"></div>
                    <li class="active"><a href="{!! URL::to('/') !!}"><i class="fa fa-tachometer fa-fw">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Dashboard</span></a></li>
                    <li><a href="{!! URL::to('events/') !!}"><i class="fa fa-calendar-plus-o fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Espectáculos</span></a>
                       
                    </li>
                    <li><a href="{!! URL::to('categories/') !!}"><i class="fa fa-tags fa-fw">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Categorias</span></a>
                    </li>
                    <li><a href="{!! URL::to('companies/') !!}"><i class="fa fa-group fa-fw">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Compañías</span></a>
                       
                    </li>
                    <li><a href="{!! URL::to('venues') !!}"><i class="fa fa-home fa-fw">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Salas</span></a>
                    </li>
                    <li><a href="{!! URL::to('people/') !!}"><i class="fa fa-user fa-fw">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Personas</span></a></li>
                    <li><a href="{!! URL::to('rols/') !!}"><i class="fa fa-file-text fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Roles</span></a>
                       
                    </li>
                    <li><a href="{!! URL::to('reviews/') !!}"><i class="fa fa-comments fa-fw">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Opiniones</span></a>
                    </li>
                    <li><a href="{!! URL::to('dispatches/') !!}"><i class="fa fa-file-text fa-fw">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Despachos</span></a>
                    </li>
                    <li><a href="{!! URL::to('users/') !!}"><i class="fa fa-users fa-fw">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Usuarios</span></a>
                    </li>
                </ul>
            </div>
        </nav>
            <!--END SIDEBAR MENU-->

            @yield('page-content')

            <!--BEGIN FOOTER-->
                <div id="footer">
                    <div class="copyright">
                        <a href="http://themifycloud.com">2014 © KAdmin Responsive Multi-Purpose Template</a></div>
                </div>
                <!--END FOOTER-->
            </div>
            <!--END PAGE WRAPPER-->
        </div>
    </div>
    {!! Html::script("backend/javascript/jquery-1.10.2.min.js") !!}
    {!! Html::script("backend/javascript/jquery-migrate-1.2.1.min.js") !!}
    {!! Html::script("backend/javascript/jquery-ui.js") !!}
    {!! Html::script("backend/javascript/bootstrap.min.js") !!}
    {!! Html::script("backend/javascript/bootstrap-hover-dropdown.js") !!}
    {!! Html::script("backend/javascript/html5shiv.js") !!}
    {!! Html::script("backend/javascript/respond.min.js") !!}
    {!! Html::script("backend/javascript/jquery.metisMenu.js") !!}
    {!! Html::script("backend/javascript/jquery.slimscroll.js") !!}
    {!! Html::script("backend/javascript/jquery.cookie.js") !!}
    {!! Html::script("backend/javascript/icheck.min.js") !!}
    {!! Html::script("backend/javascript/custom.min.js") !!}
    {!! Html::script("backend/javascript/jquery.menu.js") !!}
    {!! Html::script("backend/javascript/pace.min.js") !!}
    {!! Html::script("backend/javascript/holder.js") !!}
    {!! Html::script("backend/javascript/responsive-tabs.js") !!}
    {!! Html::script("backend/javascript/jquery.flot.js") !!}
    {!! Html::script("backend/javascript/jquery.flot.categories.js") !!}
    {!! Html::script("backend/javascript/jquery.flot.pie.js") !!}
    {!! Html::script("backend/javascript/jquery.flot.tooltip.js") !!}
    {!! Html::script("backend/javascript/jquery.flot.resize.js") !!}
    {!! Html::script("backend/javascript/jquery.flot.fillbetween.js") !!}
    {!! Html::script("backend/javascript/jquery.flot.stack.js") !!}
    {!! Html::script("backend/javascript/jquery.flot.spline.js") !!}
    {!! Html::script("backend/javascript/zabuto_calendar.min.js") !!}
    {!! Html::script("backend/javascript/summernote/summernote.min.js") !!}
    {!! Html::script("backend/javascript/summernote/summernote-es-ES.js") !!}
    <!--CORE JAVASCRIPT-->
    {!! Html::script("backend/javascript/main.js") !!}
    <script>
    /*(function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-145464-12', 'auto');
        ga('send', 'pageview');*/
    </script>
    <script type="text/javascript">
    $(function() {
      $('.summernote').summernote({
        height: 300,
        lang: 'es-ES'
      });
    });
  </script>
</body>
</html>