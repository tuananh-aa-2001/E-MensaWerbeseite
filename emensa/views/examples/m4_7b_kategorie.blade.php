<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        li.odd{
            font-weight: bold;
        }
    </style>
</head>
<body>
<div>
    <h1>Kategorieübersicht</h1>
</div>
<ul>
    @foreach($name as $kat_name)
        @if($loop->iteration % 2 == 0)
            <li class ="even">
                {{ $kat_name['name'] }}
            </li>
        @else
            <li class ="odd">
                {{ $kat_name['name'] }}
            </li>
        @endif
    @endforeach
</ul>
</body>
</html>
