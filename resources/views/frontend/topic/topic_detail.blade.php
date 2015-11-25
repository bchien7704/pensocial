@extends('frontend/shared/one_column')

@section('content')

    <div class="site_width">
        <div class="site_content">
            {!! $topic->body !!}
        </div>
    </div>
@stop
