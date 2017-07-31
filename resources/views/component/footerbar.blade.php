<div class="footer-bar">
    <ul class="link">
        <li>
            @foreach(config('blog.footer_urls') as $name => $url)
                <a href="{{ $url }}">{{ $name }}</a>
            @endforeach
        </li>
    </ul>
    <p class="description">
        Copyright © 2016 drakframe. All rights reserved.
    </p>
</div>