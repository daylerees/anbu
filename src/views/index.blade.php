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
        <span class="request"><span class="request-time">{{ $uri }} - {{ $date->format('d/m/y H:i:s') }}</span><a href="{{ url('/anbu') }}" class="request-reset" title="Back to latest."><i class="fa fa-reply"></i></a></span>
        <span class="version">Laravel {{ $version }}</span>
    </header>
    <nav>
        <ul>
            @foreach($menu as $item)
            <li>
            @if(array_get($item, 'title') == $current->getName())
                <a href="{{ array_get($item, 'url') }}" title="{{ array_get($item, 'title') }}" class="active">
            @else
                <a href="{{ array_get($item, 'url') }}" title="{{ array_get($item, 'title') }}">
            @endif
                    <i class="fa fa-{{ array_get($item, 'icon') }}"></i>
                    @if (array_get($item, 'badge') > 0)
                    <span class="badge">
                        <span class="badge-inner">{{ array_get($item, 'badge') }}</span>
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
