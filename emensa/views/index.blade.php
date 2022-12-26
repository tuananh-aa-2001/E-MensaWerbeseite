@extends('homelayout')

@section('title', 'Ihre E-Mensa')

@section('header')
    <div id="quickLinks">
        <a class="logoimg">
            <img src="/img/MensaLogo.png" height="100" alt="Logo">
        </a>
        <a class="announcements" href="#announcementsMain">
            Ankündigungen
        </a>
        <a class="meals" href="#mealsMain">
            Speisen
        </a>
        <a class="numbers" href="#numbersMain">
            Zahlen
        </a>
        <a class="contact" href="#contactMain">
            Kontakt
        </a>
        <a class="important" href="#importantMain">
            Wichtig für uns
        </a>
        @if(isset($_SESSION['login_ok']))
            <a class="abmeldung" href="/abmeldung">Abmelden als {{$_SESSION['user']}}</a>
        @else
            <a class="anmeldung" href="/anmeldung">Anmelden</a>
        @endif
    </div>
@endsection
@section('begruessungtext')
    <div id="filler">
        <p class="randMensa">
            <img src="/img/mensa.jpg" height="275" alt="Mensa Bild">
        </p>
    </div>
    <div id="announcementsMain">
        <h1>Bald gibt es Essen auch online ;)</h1>
        <p class="announcementText">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dignissim ultricies turpis, at efficitur justo tempor a. Maecenas porta eget lectus id molestie. Ut aliquet mattis est, nec vehicula mauris maximus ac. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean interdum nunc ut diam bibendum aliquam. Nullam congue erat eget luctus viverra. Sed vulputate tellus et placerat sodales. Maecenas nec aliquet odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi lacinia placerat mi quis vestibulum. Suspendisse laoreet neque in porttitor blandit. Integer non blandit nibh. Morbi consectetur, nibh eget volutpat sodales, leo dolor mattis massa, id porttitor massa est a ante.
        </p>
    </div>
@endsection

@section('gerichtuebersicht')
    <div id="mealsMain">
        <h1>Köstlichkeiten, die Sie erwarten</h1>
        <table class="mealTable">
            <tr>
                <th>Name</th>
                <th>Bild</th>
                <th>Beschreibung</th>
                <th>Allergen</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
            </tr>
            @foreach($gerichte as $key=>$gericht)
                <tr>
                    <td>{{$gericht['name']}}
                        <br>
                        @if(isset($_SESSION['login_ok']))
                            <a href="/bewertung?id={{$gericht['id']}}" style='font-size: smaller'>Gericht bewerten</a>
                        @else
                            <a href="/anmeldung" style='font-size: smaller'>Gericht bewerten</a>

                        @endif
                    </td>
                    @if($gericht['bildname'] == NULL)
                        <td><img src="/img/gerichte/00_image_missing.jpg" width="250" height="200" ></td>
                    @else
                        <td><img src="/img/gerichte/{{$gericht['bildname']}}" width="250" height="200"></td>
                    @endif
                    <td>{{$gericht['beschreibung']}}</td>
                    <td>{{$gericht['allergene']}}</td>
                    <td>{{$preis_intern[$key]}}</td>
                    <td>{{$preis_extern[$key]}}</td>
                </tr>
            @endforeach

        </table>
        <br>
        <form method="post" action="/index/wunschgericht">
            <div class="row">
                <div></div>
                <div><input type="submit" name="" value="To order the food"></div>
                <br>
            </div>
        </form>

        <h1>Allergene</h1>
        <table class="allergenTable">
            <tr>
                <th>Code</th>
                <th>Allergen</th>
            </tr>
            @foreach($allergene as $allergen)
                <tr>
                    <td>{{$allergen['code']}}</td>
                    <td>{{$allergen['name']}}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <h2>Meinungen unserer Gäste</h2>
    <table style="width:100%">
        @foreach($bewertungen as $bewertung)
            <tr>
                <td>
                    <br>
                    Gericht: {{$bewertung['name']}} <br>
                    Bewertung: {{$bewertung['sternebewertung']}}<br>
                    Bemerkung: {{$bewertung['bemerkung']}}<br>
                    <br>
                </td>
            </tr>
        @endforeach
    </table>

@endsection

@section('fussbereich')
    <footer>
        <div>
            <ul class="unten">
                <li>(c) E-Mensa GmbH</li>
                <li>Tuan Nguyen & Dorian Hövelmann</li>
                <li>Impressum</li>
            </ul>
        </div>
    </footer>
@endsection



