<!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Tuan,Nguyen, 3517392
- Dorian,Hoevelmann, 3525346
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <link rel="stylesheet" type="text/css" href="index_stylesheet.css" >
</head>
<body>
<?php
$link=mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "root",    // Passwort
    "emensawerbeseite"      // Auswahl der Datenbanken (bzw. des Schemas)
);
?>
<div id="quickLinks">
    <a class="logoimg">
        <img src="MensaLogo.png" height="100" alt="Logo">
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
</div>
<!--begin body-->
<div id="filler">
    <p class="randMensa">
        <img src="mensa.jpg" height="275" alt="Mensa Bild">
    </p>
</div>
<div id="announcementsMain">
    <h1>Bald gibt es Essen auch online ;)</h1>
    <p class="announcementText">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dignissim ultricies turpis, at efficitur justo tempor a. Maecenas porta eget lectus id molestie. Ut aliquet mattis est, nec vehicula mauris maximus ac. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean interdum nunc ut diam bibendum aliquam. Nullam congue erat eget luctus viverra. Sed vulputate tellus et placerat sodales. Maecenas nec aliquet odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi lacinia placerat mi quis vestibulum. Suspendisse laoreet neque in porttitor blandit. Integer non blandit nibh. Morbi consectetur, nibh eget volutpat sodales, leo dolor mattis massa, id porttitor massa est a ante.
    </p>
</div>
<div id="mealsMain">
    <h1>Köstlichkeiten, die Sie erwarten</h1>
    <table class="mealTable">
        <tr>
            <th>Bild</th>
            <th>Beschreibung</th>
            <th>Preis intern</th>
            <th>Preis extern</th>
        </tr>
        <?php
        if (!$link) {
            echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
            exit();
        }
        $tmp_gericht = '';
        $sql = "SELECT name, beschreibung, preis_intern, preis_extern , null, null, null, null  FROM gericht where preis_extern > 4.9 order by name";


        $result = mysqli_query($link, $sql);

        if (!$result ) {
            echo "Fehler während der Abfrage:  ", mysqli_error($link);
            exit();
        }
        while ($row = mysqli_fetch_assoc($result)) {
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
            echo '<tr>'.'<td>'.$row['name']. '</td>' . '<td>' . $row['beschreibung']. '</td>' .'<td>'.$allergenLi.'</td>' . '<td>' . $row['preis_intern'].'</td>'. '<td>' . $row['preis_extern'].'</td>'.'</tr>';
        }
        ?>
    </table>
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
        </fieldset>
        <?php
        $invalid_emails = [
            1 => 'rcpt.at',
            2 => 'damnthespam.at',
            3 => 'wegwerfmail.de',
            4 => 'trashmail.'
        ];
        $file = fopen("Anmeldungsdaten.txt", "a");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST)) {
                $errors = [];
                if(empty(trim($_POST['name'])))
                    $errors[] = 'Bitte geben Sie einen Namen ein!';
                if(empty($_POST['email']))
                    $errors[] = 'Bitte geben Sie eine gültige Email ein!';
                else
                    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                        $errors[] = 'Bitte geben Sie eine gültige Email ein!';
                for($i = 0; $i < count($invalid_emails);$i++){
                    $invalid = strstr($_POST['email'],$invalid_emails[$i+1]);
                    if($invalid)
                        $errors[] = 'Bitte geben Sie eine gültige Email ein!';
                }
                if(empty($errors)){
                    echo  '<div class="success"> Vielen Danke. Sie haben sich erfolgreich zum Newsletter angemeldet.</div>';
                    fwrite($file,$_POST['name'].';'.$_POST['email'].';'. $_POST['language'] . "\n");
                }else{
                    echo '<div class="error"> <ul>';
                    foreach ($errors as $error)
                        echo '<li>'.$error.'</li>';
                    echo '</ul> </div>';
                }
            }
        }
        fclose($file);
        ?>
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

</body>
<footer>
    <div>
        <!--begin footer-->
        <ul class="unten">
            <li>(c) E-Mensa GmbH</li>
            <li>Tuan Nguyen & Dorian Hövelmann</li>
            <li>Impressum</li>
        </ul>
    </div>
</footer>
</html>