<?php
$link=mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "root",    // Passwort
    "emensawerbeseite"      // Auswahl der Datenbanken (bzw. des Schemas)
// optional port der Datenbank
);

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$sql = "SELECT gericht.name,gericht.preis_intern,gericht.preis_extern,allergen.code
from gericht join gericht_hat_allergen on gericht_hat_allergen.gericht_id = gericht.id
join allergen on gericht_hat_allergen.code = allergen.code 
order by gericht.name limit 5";

$sql1 = "select name,preis_intern,preis_extern from gericht order by rand() limit 5";

$result = mysqli_query($link, $sql);
$result1 = mysqli_query($link, $sql1);

if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}
while ($row = mysqli_fetch_assoc($result)) {
        echo '<li>',$row['name'], ', ', $row['preis_intern'],'€ , ',$row['preis_extern'],'€',' , ', $row['code'],'</li>';
}



if (!$result1) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}

while ($row = mysqli_fetch_assoc($result1)) {
    echo '<li>',$row['name'], ', ', $row['preis_intern'],'€ , ',$row['preis_extern'],'€','</li>';
}


mysqli_free_result($result);
mysqli_close($link);