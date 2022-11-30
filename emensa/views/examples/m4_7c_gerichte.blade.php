<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>
<body>
<div>
    <h1>Gericht Kosten über 2€</h1>
</div>
@empty($gerichte)
    Es sind keine Gerichte vorhanden!
@else
    <ul>
        @foreach($gerichte as $gericht)
            <li>
                {{ $gericht['name'] }}
                {{ $gericht['preis_intern'] }} €
            </li>
        @endforeach
    </ul>
@endempty

</body>
</html>
<?php
