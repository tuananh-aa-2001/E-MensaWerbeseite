<html lange ="de">
<head>
    <title>Bewertungen</title>
    <meta charset="utf-8">
    <style>
         p.hervorgehoben{
             border: 5px #0078e7;
             font-size: x-large;
             background: #0078e7;
        }
    </style>
</head>
<body>
<a href="meinebewertungen">Zu meinen Bewertungen</a>
@foreach($bewertungen as $bewertung)
    <hr>
    <p
            @if($bewertung['hervorgehoben'])
                class="hervorgehoben", style="font-weight: bold"
            @endif
    >
        Gericht: {{$bewertung->gericht['name']}}<br>
        Bewertung: {{$bewertung['sternebewertung']}} <br>
        Bemerkung: {{$bewertung['bemerkung']}} <br>
        Datum: {{$bewertung['bewertungszeitpunkt']}}<br>
    </p>
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