<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $current['name'] }} | Anbu</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        @import url(http://fonts.googleapis.com/css?family=Lato:400,700,400italic);

        body {
            font-family: 'Lato', sans-serif;
        }

        header {
            height:50px;
            position:fixed;
            top:0;
            left:0;
            right:0;
            background-color:rgba(230,230,230, 0.8);
            z-index:9999;
        }

        .logo {
            width:32px;
            height:32px;
            position:absolute;
            top:9px;
            left:15px;
        }

        nav {
            position:fixed;
            top:50px;
            left:0;
            bottom:0;
            width:60px;
            background-color:#f4726d;
        }

        nav ul {
            list-style-type:none;
            margin:0.5em 0 0 0;
            padding:0;
        }

        nav ul a {
            position:relative;
            text-decoration:none;
            color:#ffbebb;
            display:block;
            width:60px;
            height:40px;
            font-size:1.2em;
            text-shadow:0 1px 1px #e85a5a;
            -webkit-transition:all .2s linear;
        }

        nav ul a:hover {
            color:white;
            background-color:#dc5954;
        }

        nav ul a.active {
            color:white;
            background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAnCAYAAADtu3N3AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyNpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChNYWNpbnRvc2gpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkI5QjQ2OTdEMjU3NDExRTRCMzE4QjRBRDkzNTg5MkI4IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkI5QjQ2OTdFMjU3NDExRTRCMzE4QjRBRDkzNTg5MkI4Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6QjlCNDY5N0IyNTc0MTFFNEIzMThCNEFEOTM1ODkyQjgiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6QjlCNDY5N0MyNTc0MTFFNEIzMThCNEFEOTM1ODkyQjgiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7i5QLiAAAA5UlEQVR42qzWwQqBQRTF8TEfxdN8yUaykrKhLGTBS3keJZKysLBTkp2UjVhTx7k1U1/KQnNu/be/puZOTQmAE03mVRCbOztZYhlbQAlBCUEJQQlBCUEJQQlBCUEJQQlBCdn4n4/Wuc6/r92roG8sCSpiyVDEvAKK2EwBRewSSp+wVzlbI3GKizpkDxVmW98LJ3ylYrE2O6uwGpuwgwIrXspWhVlj9lRhVost2VuBWV12VWF2KSO2U2CxBtursHJYm5sCi9XZSoVZA3ZXYRXWZ5u4NoqfY5MdVViVTdmpJPxt5x8BBgDrgG6UO0LmngAAAABJRU5ErkJggg==);
            background-repeat:no-repeat;
            background-size: 10px 20px;
            background-position:50px 10px;
        }

        nav ul a i {
            position:absolute;
            left:20px;
            top:10px;
        }

        .container {
            position:fixed;
            top:0;
            left:60px;
            bottom:0;
            right:0;
            overflow:auto;
        }

        .content {
            padding-top:25px;
            color:#555;
            margin:2em;
        }

        .content .code {
            font-family:Monaco, monospace;
            font-size:0.8em;
        }

        .content table {
            width:100%;
            font-size:0.9em;
        }

        .content th {
            text-align:left;
            border-bottom:1px solid #f4726d;
        }

        .content th,
        .content td {
            padding:0.5em 1em;
        }

        .content tr:nth-child(even) {
            background-color:#fbfbfb;
        }

        .content a {
            color:#f4726d;
        }

        .content a:hover {
            color:#ffbebb;
        }

        .content .parameter {
            color:#f4726d;
        }

        .badge {
            position:absolute;
            left:32px;
            top:3px;
            background-color:white;
            width:15px;
            height:15px;
            border-radius:999px;
            -webkit-box-shadow:0 1px 1px #d73924;
        }

        .badge-inner {
            position:absolute;
            left:4px;
            top:1px;
            font-size:0.6em;
            color:#931f10;
            font-weight:bold;
            text-shadow:none;
        }

        .empty {
            background-color:#f3f3f3;
            color:#bbb;
            text-shadow:0 1px 0 white;
            padding:1em;
        }

        .log-tag {
            background-color:#eee;
            font-weight:bold;
            color:white;
            display:inline-block;
            padding:0.5em 1em;
            font-size:0.6em;
            width:60px;
            text-align:center;
            border-radius:5px;
        }

        .log-tag-error {
            background-color:#e53c5c;
        }

        .log-tag-info {
            background-color:#9ed646;
        }

        .log-col-0 {
            width:80px;
        }

        .method-tag {
            background-color:#666;
            font-weight:bold;
            color:white;
            display:inline-block;
            padding:0.5em 1em;
            font-size:0.6em;
            text-align:center;
            border-radius:5px;
        }

        .method-tag-get {
            background-color: #9ed646;
        }

        .friendly-time {
            color:#aaa;
            margin-left:1em;
        }

        .version {
            position:absolute;
            right:10px;
            top:11px;
            display:inline-block;
            text-transform:uppercase;
            font-size:0.8em;
            background-color:white;
            border-radius:3px;
            padding:.5em 1em;
            color:#777;
        }
    </style>
</head>
<body>
    <header>
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAD8AAAA+CAYAAACcA8N6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyNpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChNYWNpbnRvc2gpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkI5QjQ2OTc5MjU3NDExRTRCMzE4QjRBRDkzNTg5MkI4IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkI5QjQ2OTdBMjU3NDExRTRCMzE4QjRBRDkzNTg5MkI4Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6QjlCNDY5NzcyNTc0MTFFNEIzMThCNEFEOTM1ODkyQjgiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6QjlCNDY5NzgyNTc0MTFFNEIzMThCNEFEOTM1ODkyQjgiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4WZhDaAAAJBklEQVR42uRbB3AU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" alt="Laravel" class="logo">
        <span class="version">Laravel {{ $global['version'] }}</span>
    </header>
    <nav>
        <ul>
            @foreach($menu as $menuItem)
            <li>
            @if($menuItem['title'] == $current['name'])
                <a href="{{ $menuItem['url'] }}" title="{{ $menuItem['title'] }}" class="active">
            @else
                <a href="{{ $menuItem['url'] }}" title="{{ $menuItem['title'] }}">
            @endif
                    <i class="fa fa-{{ $menuItem['icon'] }}"></i>
                    @if ($menuItem['badge'] > 0)
                    <span class="badge">
                        <span class="badge-inner">{{ $menuItem['badge'] }}</span>
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
