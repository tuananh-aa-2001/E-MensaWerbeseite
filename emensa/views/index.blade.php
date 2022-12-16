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
        @if($_SESSION['login_ok'])
            <a class="anmeldung" href="/abmeldung">Abmelden als {{$_SESSION['user']}}</a>
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
                <th>Bild</th>
                <th>Beschreibung</th>
                <th>Code</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
            </tr>
            <?php
            $link=mysqli_connect("localhost", "root", "root", "emensawerbeseite");
            if (!$link) {
                echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
                exit();
            }
            $tmp_gericht = '';
            $sql = "SELECT name,bildname,beschreibung, preis_intern, preis_extern FROM gericht where preis_extern > 4.9 order by name";
            $result = mysqli_query($link, $sql);
            if (!$result ) {
                echo "Fehler während der Abfrage:  ", mysqli_error($link);
                exit();
            }
            while ($row = mysqli_fetch_assoc($result)) {
                if($row['bildname'] == NULL){
                    $bild = '<img src="img/gerichte/00_image_missing.jpg"  width="250" height="200">';
                }
                else{
                    $bild = '<img src="img/gerichte/' .$row['bildname'] .'" width="250" height="200" >';
                }

                $tmp_gericht = $row['name'];
                $sql2 = "SELECT allergen.code as code
            from gericht join gericht_hat_allergen on gericht_hat_allergen.gericht_id = gericht.id
            join allergen on gericht_hat_allergen.code = allergen.code
            where gericht.name = ";
                $sql2 .= "'";
                $sql2 .= $tmp_gericht;
                $sql2 .= "'";
                $result2 = mysqli_query($link, $sql2);
                if (!$result2 ) {
                    echo "Fehler während der Abfrage:  ", mysqli_error($link);
                    exit();
                }
                $allergenLi = '';
                while ($allergen = mysqli_fetch_assoc($result2)) {$allergenLi .= $allergen['code']." ";}
                echo '<tr>'.'<td>'.$row['name']. '</td>' .'<td >'.$bild. '</td>'. '<td>' . $row['beschreibung']. '</td>' .'<td>'.$allergenLi.'</td>' . '<td>' . $row['preis_intern'].'</td>'. '<td>' . $row['preis_extern'].'</td>'.'</tr>';
            }
            ?>
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
            <?php
            $sql = "SELECT distinct allergen.code,allergen.name
            from gericht join gericht_hat_allergen on gericht_hat_allergen.gericht_id = gericht.id
            join allergen on gericht_hat_allergen.code = allergen.code
           order by allergen.code";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>'.'<td>'.$row['code']. '</td>' .'<td>'.$row['name'].'</td>'.'</tr>';
            }
            ?>
        </table>
    </div>
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



