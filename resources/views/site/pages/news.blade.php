@extends('site/base')




@section('container')
    @include('site.components.menu')
    <div>
        <h1>Все новости</h1>
        <div>
            @foreach($news as $n)
                <div>
                    <a href="{{ route('news.show', ['slug' => $n->slug]) }}">
                        {{ $n->title }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection


