
@extends('layout')


@section('head')

    <title>@yield('title', config('app.name', 'Site'))</title>

    <!-- Scripts -->
    @yield('script-head')

    <!-- Fonts -->
    @yield('fonts')

    <!-- Styles -->
    @yield('style')

@endsection

@section('body')

    @yield('container')
    @yield('script-body')

@endsection

