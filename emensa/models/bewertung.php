<?php

function db_bewertung_eintragen($bemerkung,$bewertung,$timestamp,$hervorgehoben,$gericht_id): void
{
    $link = connectdb();
    $sql = "INSERT INTO bewertung (bemerkung,sternebewertung,bewertungszeitpunkt,hervorgehoben,gerichtId) VALUES (?,?,?,?,?);";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('sssii',$bemerkung,$bewertung,$timestamp,$hervorgehoben,$gericht_id);
    $stmt->execute();
    $stmt->close();
}



