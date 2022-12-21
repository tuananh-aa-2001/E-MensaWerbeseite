<html lange ="de">
<head>
    <title>Bewertungen</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css">
</head>
<body>
@foreach($bewertungen as $bewertung)
    <hr>
    Gericht: {{$bewertung['name']}}<br>
    Bewertung: {{$bewertung['sternebewertung']}} <br>
    Bemerkung: {{$bewertung['bemerkung']}} <br>
    Datum: {{$bewertung['bewertungszeitpunkt']}}<br>
    <form method="POST">
        <input type="hidden" id="bewertungId" name="bewertungId" value={{$bewertung['id']}}>
        <input type="submit" value="Löschen"><br>
    </form>
    <hr>
@endforeach
</body>
</html>