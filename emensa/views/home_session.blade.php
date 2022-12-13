@extends('index')
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
        <a> Angemeldet als {{$name}}</a>
        <li>
            <form action="abmeldung" method="post">
            <button type="submit" name="logout-submit">Logout</button>
            </form>
        </li>
    </div>
@endsection