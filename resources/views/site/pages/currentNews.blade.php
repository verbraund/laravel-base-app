@extends('site/base')




@section('container')
    @include('site.components.menu')
    <div>
        <h1>{{$news->title}}</h1>
        <p>{{$news->created_at}}</p>
        <p>{{$news->text}}</p>
    </div>
@endsection


