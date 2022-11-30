<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "kategorie"
 */

function db_kategorie_select_all(): array{
    $link = connectdb();

    $sql = "SELECT * FROM kategorie";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function db_kategorie_name_aufsteigend(): array{
    $link = connectdb();
    $sql = "SELECT name FROM kategorie ORDER BY name";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}
