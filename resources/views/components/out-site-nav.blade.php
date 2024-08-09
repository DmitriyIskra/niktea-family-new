<div class="nav-out">
    
    <div class="nav-out__wrapper">

        <div class="nav-out__wr-title">
            <a class="nav-out__title" href="https://nikteaworld.com/">
                <span>niktea </span><span>Collection</span>
            </a>
        </div>

        <div class="nav-out__wr-nav">
            <div class="nav-out__triangle"></div>
            <ul class="nav-out__list">
                @foreach ($nav_points as $item)
                    <li class="nav-out__item">
                        <a href="{{$item['link']}}" title="{{$item['title']}} Niktea Family">{{$item['title']}}</a>
                        <div class="nav-out__line-anim"></div>
                    </li>    
                @endforeach
            </ul>
        </div>

    </div>

</div>

