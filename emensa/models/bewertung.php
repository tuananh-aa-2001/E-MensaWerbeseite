<?php

function db_bewertung_eintragen($bemerkung,$bewertung,$timestamp,$gericht_id,$benutzer_id): void
{
    $link = connectdb();
    $sql = "INSERT INTO bewertung (bemerkung,sternebewertung,bewertungszeitpunkt,gerichtId,benutzerId) VALUES (?,?,?,?,?);";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('sssii',$bemerkung,$bewertung,$timestamp,$gericht_id,$benutzer_id);
    $stmt->execute();
    $stmt->close();
}

function get_bewertungen_by_userId($userID)
{
    $link = connectdb();

    $sql = "SELECT gericht.name,bewertung.* FROM gericht,bewertung WHERE gericht.id = bewertung.gerichtId AND bewertung.benutzerId =" . $userID . " ORDER BY bewertung.bewertungszeitpunkt DESC";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function anzeigen_bewertungen_mit_hervorgehoben(){
    $link = connectdb();

    $sql = "SELECT gericht.name,bewertung.* FROM gericht,bewertung WHERE gericht.id = bewertung.gerichtId AND hervorgehoben = true;";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}