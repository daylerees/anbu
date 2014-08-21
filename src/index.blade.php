<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $name }} | Anbu</title>
    <style>
        body {
            font-family:sans-serif;
        }

        .anbu-menu {
            position:fixed;
            left:0;
            top:0;
            bottom:0;
            width:150px;
            overflow:auto;
            background-color:white;
        }

        .anbu-menu ul {
            margin:2em 0 0 0;
            padding:0;
            list-style-type:none;
        }

        .anbu-menu a {
            display:block;
            color:#ccc;
            text-decoration:none;
            padding:0.5em 1em;
            border-left:2px solid transparent;
            text-transform:uppercase;
            font-size:0.8em;
        }

        .anbu-menu a:hover,
        .anbu-menu a.active {
            color:#777;
            background-color:#eee;
            border-left:2px solid #FA5B37;
        }

        .anbu-menu a:hover {
            -webkit-transition: all .2s linear;
        }

        .anbu-content {
            position:fixed;
            top:0;
            bottom:0;
            right:0;
            left:150px;
            background-color:#eee;
            padding:2em;
            overflow:auto;
        }

        .anbu-inner-content {
            color:#666;
            background-color:white;
            padding:1em;
            min-height:500px;
        }

        .anbu-inner-content a {
            color:#FA5B37;
        }

        .anbu-table {
            border:0;
            width:100%;
            font-size:0.8em;
        }

        .anbu-table th,
        .anbu-table td {
            margin:0.2em;
            padding:0.5em;
        }

        .anbu-table th {
            background-color:#FA5B37;
            color:white;
            text-transform:uppercase;
        }

        .anbu-log-type {
            text-transform:uppercase;
            font-weight:bold;
        }
    </style>
</head>
<body>
    <div class="anbu-menu">
        <ul>
            @foreach($menu as $menuItem)
            @if($menuItem['title'] == $name)
            <li><a href="{{ $menuItem['url'] }}" class="active">{{ $menuItem['title'] }}</a></li>
            @else
            <li><a href="{{ $menuItem['url'] }}">{{ $menuItem['title'] }}</a></li>
            @endif
            @endforeach
        </ul>
    </div>
    <div class="anbu-content">
        <div class="anbu-inner-content">
            {{ $child }}
        </div>
    </div>
</body>
</html>
