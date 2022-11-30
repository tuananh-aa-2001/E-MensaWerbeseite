@include('header')
@include('begruessungtext')
@include('fussbereich')
@include('gerichtuebersicht')
@include('refresh')

        <!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Tuan,Nguyen, 3517392
- Dorian,Hoevelmann, 3525346
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <link rel="stylesheet" type="text/css" href="css/index_stylesheet.css" >
</head>
<body>
<header>
    @yield('header')
</header>

@section('begruessungtext')
@show
@section('gerichtuebersicht')
@show

<div id="numbersMain">
    <h1>E-Mensa in Zahlen</h1>
    <ul class="zahlenList">
        <li>
            <?php
            session_start();
            if(empty($_SESSION['counter']))
                $_SESSION['counter'] = 1;
            else
                $_SESSION['counter']++;
            echo $_SESSION['counter'];
            ?> Besuche
        </li>

        <li>
            <?php
            $text_file = "Anmeldungsdaten.txt";
            $lines = file($text_file);
            $number_of_lines = count($lines);
            echo $number_of_lines;
            ?>
            Anmeldungen zum Newsletter
        </li>
        <li>
            <?php
            $text_file = "Gerichte.txt";
            $all_lines = file($text_file);
            $number_of_lines = count($all_lines);
            echo $number_of_lines;
            ?>
            Speisen
        </li>
    </ul>
</div>

<div id="contactMain">
    <h1>Interesse geweckt? Wir informieren Sie!</h1>
    <form method="post" class="contactForm">
        <fieldset>
            <p> <label for="name">Ihr Name:</label>
                <input type="text" id="name" name="name" placeholder="Vorname" required>
            </p>
            <p><label for="email">Ihre E-Mail</label>
                <input type="text" id="email" name="email" placeholder="E-Mail" required>
            </p>
            <p>
                <label for="lang">Newsletter bitte in:</label>
                <select id="lang" name="language">
                    <option value="de">Deutsch</option>
                    <option value="en">English</option>
                    <option value="af">Afrikaans</option>
                </select>
            </p>
            <p>
                <label for="dsgvo">Den Datenschutzhinweise Stimme ich zu</label>
                <input type="checkbox" id="dsgvo">
            </p>
            <input type="submit" value="Zum Newsletter anmelden">

            <?php
            if ($_GET['submit'] == 'success')
                echo '<p>Vielen Dank. Sie haben sich erfolgreich zu unserem Newsletter angemeldet.</p>';
            if ($_GET['submit'] == 'error')
                echo '<p>Bitte geben Sie einen Namen oder eine gültige Email an!</p>';
            ?>
        </fieldset>
    </form>
</div>
<div id="importantMain">
    <h1>Das ist uns wichtig</h1>
    <ul class="importantList">
        <li>Beste frische saisonale Zutaten</li>
        <li>Ausgewogene abwechslungsreiche Gerichte</li>
        <li>Sauberkeit</li>
    </ul>
</div>
<div id="notQuiteFooter">
    <h1>Wir freuen uns auf Ihren Besuch!</h1>
</div>

@section('fussbereich')
@show
</body>
</html>
