@extends('site/base')

@section('style')
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
@endsection




@section('container')
    @include('site.components.menu')

    <div>
        site.home
    </div>
@endsection


@section('script-body')
    {{--    <script src="{{ asset('js/index.js') }}" defer></script>--}}
@endsection
