<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all(): array{
    try {
        $link = connectdb();

        $sql = 'SELECT id, name, beschreibung FROM gericht ORDER BY name';
        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'error'=>true,
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        return $data;
    }
}

function db_gericht_name_preis_absteigend(): array{
    $link = connectdb();
    $sql = "SELECT name, preis_intern FROM gericht WHERE preis_intern >= 2 ORDER BY name DESC";

    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function db_gericht_hat_allergen(): array
{
    $link = connectdb();

    $sql = "SELECT distinct allergen.code,allergen.name
            from gericht join gericht_hat_allergen on gericht_hat_allergen.gericht_id = gericht.id
            join allergen on gericht_hat_allergen.code = allergen.code
           order by allergen.code";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result,MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}



