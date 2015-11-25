<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>Studentjibe</title>
    {{--<meta name="description"--}}
    {{--content="{!! isset($meta_description) ? $meta_description : ($settings['meta_description']) !!}">--}}
    {{--<meta name="keywords" content="{!! isset($meta_keywords) ? $meta_keywords : ($settings['meta_keywords']) !!}">--}}
    <meta name="author" content="Sefa Karagöz">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! HTML::script('assets/js/jquery.2.0.3.js') !!}
    {!! HTML::script('assets/js/jquery-ui.min.js') !!}
    {!! HTML::script('frontend/js/common.js') !!}
    {!! HTML::script('frontend/js/wall.js') !!}
    {!! HTML::script('frontend/js/user.js') !!}
    {!! HTML::script('frontend/js/box.js') !!}
    {!! HTML::style("frontend/css/stylesheet.css") !!}
    {!! HTML::style("frontend/css/jquery-ui.min.css") !!}


<!--[if lt IE 9]>
    {!! HTML::script("frontend/js/html5shiv.js") !!}
    {!! HTML::script("frontend/js/respond.min.js") !!}

    <![endif]-->
    <link rel="shortcut icon" href="{!! url('favicon.ico') !!}">

</head>
<!--/head-->
<body>
@include('frontend.shared.header')
@include('frontend.shared.subheader')
<div class="site_width">
    @yield('left_content')
    @yield('center_content')
    @yield('right_content')

</div>
<div class="clear"><!-- --></div>
@include('frontend.shared.footer')
</body>
</html>