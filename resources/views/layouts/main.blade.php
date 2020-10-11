<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>How Many Times Has Laravel Been Released This Month?</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container count">
    <h1>{{ $releases->count() }}</h1>
    <a href="@yield('other-link')" class="other-month-count">@yield('other-text'): {{ $otherCount }}</a>
    <a href="#releases" class="info">What versions?</a>
</div>
<a name="releases"></a>
<div class="container releases">
    <ul>
        @foreach($releases as $release)
            <?php /** @var \App\Models\Release $release */ ?>
            <li>
                <a href="{{ $release->url }}" rel="noopener" target="_blank">
                    {{ $release->tag_name }} | {{ $release->released_at->format('m/d/Y') }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<a class="github" href="https://github.com/lo00l/laravel-versions" rel="noopener" target="_blank"><img src="/images/github.png" /> <span>Github</span> </a>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>
