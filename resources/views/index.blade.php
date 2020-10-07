<!DOCTYPE html>
<html>
    <head>
        <title>How Many Times Has Laravel Been Released This Month?</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="container count">
            <h1>{{ $releases->count() }}</h1>
            <a href="/last" class="other-month-count">Last month: {{ $lastMonthCount }}</a>
            <a href="#releases" class="info">What versions?</a>
        </div>
        <a name="releases"></a>
        <div class="container releases">
            <ul>
                @foreach($releases as $release)
                    <?php /** @var \App\Models\Release $release */ ?>
                    <li>
                        <a href="{{ $release->url }}">
                            {{ $release->tag_name }} | {{ $release->released_at->format('m/d/Y') }}
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
