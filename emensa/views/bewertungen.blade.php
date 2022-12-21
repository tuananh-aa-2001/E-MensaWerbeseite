<html lange ="de">
<head>
    <title>Bewertungen</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css">
</head>
<body>
<a href="meinebewertungen">Zu meinen Bewertungen</a>
@foreach($bewertungen as $bewertung)
    <hr>
    <div
            @if($bewertung['hervorgehoben'])
                style="font-weight: bold"
            @endif
    >
        Gericht: {{$bewertung->gericht['name']}}<br>
        Bewertung: {{$bewertung['sternebewertung']}} <br>
        Bemerkung: {{$bewertung['bemerkung']}} <br>
        Datum: {{$bewertung['bewertungszeitpunkt']}}<br>
        @if($_SESSION['admin'])
            @if($bewertung['hervorgehoben'])
                <a href="/bewertungen?hl={{$bewertung['id']}}">Hervorhebung abwählen</a>
            @else
                <a href="/bewertungen?hl={{$bewertung['id']}}">Hervorheben</a>
            @endif
        @endif
    </div>
    <hr>
@endforeach
</body>
</html>