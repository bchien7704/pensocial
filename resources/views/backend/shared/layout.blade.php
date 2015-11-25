<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>{!! $appSetting->name !!} | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{!! url('backend/css/datatables.min.css') !!}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap 3.3.2 -->
    <link href="{!! url('backend/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css"/>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

    <!-- Theme style -->
    <link href="{!! url('backend/css/AdminLTE.min.css') !!}" rel="stylesheet" type="text/css"/>

    <link href="{!! url('backend/css/style.css') !!}" rel="stylesheet" type="text/css"/>
    {{--{!! HTML::style("assets/css/github-left.css") !!}--}}
            <!-- jQuery 2.1.3 -->
    <script src="{!! url('backend/plugins/jQuery/jQuery-2.1.3.min.js') !!}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{!! url('backend/bootstrap/js/bootstrap.min.js') !!}" type="text/javascript"></script>
    <script src="{!! url('backend/js/datatables.min.js') !!}" type="text/javascript"></script>
    <!-- FastClick -->
    {{--<script src="{!! url('backend/plugins/fastclick/fastclick.min.js') !!}"></script>--}}
    <!-- AdminLTE App -->
    <script src="{!! url('backend/js/app.min.js') !!}" type="text/javascript"></script>
    <!-- Sparkline -->


    <!-- iCheck -->
    {{--<script src="{!! url('backend/plugins/iCheck/icheck.min.js') !!}" type="text/javascript"></script>--}}
    {{--<!-- SlimScroll 1.3.0 -->--}}
    {{--<script src="{!! url('backend/plugins/slimScroll/jquery.slimscroll.min.js') !!}" type="text/javascript"></script>--}}
    <!-- ChartJS 1.0.1 -->

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- AdminLTE for demo purposes -->
    {{--<script src="{!! url('backend/js/demo.js') !!}" type="text/javascript"></script>--}}

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="{!! url('backend/css/skins/_all-skins.min.css') !!}" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// --><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script><![endif]-->

</head>
<body class="skin-blue">
{{--<span id="forkongithub"><a target="_blank" href="https://github.com/sseffa/fullycms">Fork me on GitHub</a></span>--}}
<div class="wrapper">

    @include('backend.shared.top')
    @include('backend.shared.menu')

            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('backend.shared.header')
        <section class="content">
            <div class="row">
                @if(!isset($no_boxes))
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                @endif
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('#notification').show().delay(4000).fadeOut(700);
                                    });
                                </script>
                                {!! Notification::showAll() !!}
                                @yield('content')
                                @if(!isset($no_boxes))
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->

    @include('backend/shared/footer')
</div>
<!-- ./wrapper -->

</body>
</html>