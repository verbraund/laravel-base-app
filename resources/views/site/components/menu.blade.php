<ul class="menu">
    @foreach($menu as $item)
        <li>
            <a href="{{$item->url}}">{{$item->name}}</a>
        </li>
    @endforeach
</ul>
