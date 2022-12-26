<html lange ="de">
<head>
    <title>Bewertung</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css">
</head>
<body>
<h2>Bewertung für {{$gericht->name}}</h2>
<span class="fehlerausgabe">
            @if(isset($meldung))
        {{$meldung}} <br>
    @endif
        </span>
<div>
    @if($gericht['bildname'] == NULL)
        <td><img src="/img/gerichte/00_image_missing.jpg" width="250" height="200"></td>
    @else
        <td><img src="/img/gerichte/{{$gericht['bildname']}}" width="250" height="200"></td>
    @endif
    <br>
    <form action ="bewertung_absenden" method="POST">
        <label id="bewertung">Bitte Bewertungstext eingeben: </label><br>
            <textarea rows="5" cols="40" name="bewertungstext" id="bewertungstext" minlength="5" required></textarea><br>
        <label id="bewertung"> Bitte die Bewertung angeben: </label>
        <!-- <input list="bewertung"  name="bewertung_form" id="bewertung_form" placeholder="Bitte auswählen"> <br>-->
        <select id="bewertung" name="bewertung">
            <option value="sehr gut">Sehr gut</option>
            <option value="gut">Gut</option>
            <option value="schlecht">Schlecht</option>
            <option value="sehr schlecht">Sehr schlecht</option>
        </select><br>
        <br>
        <input type="submit" style="width: 80px;" value="Absenden">
        <input type='hidden' name='gerichtId' value='{{$gericht->id}}'/>
    </form>
</div>
</body>
</html>