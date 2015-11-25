@extends('frontend/shared/three_column')
@section('left_content')
@include('frontend.wall.profile')
@stop
@section('center_content')
    @include('frontend.wall.user_online')

@stop
@section('right_content')
    @include('frontend.wall.user_status')
@stop