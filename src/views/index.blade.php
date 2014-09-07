<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $current->getName() }} | Anbu</title>
    <link rel="stylesheet" href="{{ url('packages/daylerees/anbu/default.css') }}" />
</head>
<body>
    <header>
        <img src="{{ url('packages/daylerees/anbu/img/profiler_logo.png') }}" alt="Laravel" class="logo">
        <?php $date = new Carbon\Carbon($storage->created_at); ?>
        <span class="request"><span class="request-time"><span class="uri">{{ $uri }}</span> - {{ $date->format('d/m/y H:i:s') }} - <span class="duration">{{ number_format($storage->time, 3) }}ms</span></span><a href="{{ url('/anbu') }}" class="request-reset" title="Back to latest."><i class="fa fa-reply"></i></a></span>
        <span class="version">Laravel {{ $version }}</span>
    </header>
    <nav>
        <ul>
            @foreach($menu as $item)
            <li>
            @if(array_get($item, 'title') == $current->getName())
                <a href="{{ array_get($item, 'url') }}" class="active">
            @else
                <a href="{{ array_get($item, 'url') }}">
                <span class="label">
                    {{ array_get($item, 'title') }}
                    <div class="arrow"></div>
                </span>
            @endif
                    <i class="fa fa-{{ array_get($item, 'icon') }}"></i>
                    @if (array_get($item, 'badge') > 0)
                    <span class="badge">
                        <?php $badge = array_get($item, 'badge'); ?>
                        <span class="badge-inner">{{ $badge > 9 ? '+' : $badge  }}</span>
                    </span>
                    @endif
                </a></li>
            @endforeach
        </ul>
    </nav>
    <div class="container">
        <div class="content">
            {{ $child }}
        </div>
    </div>
</body>
</html>
