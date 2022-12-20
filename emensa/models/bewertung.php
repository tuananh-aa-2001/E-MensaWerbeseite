<?php

function db_bewertung_eintragen($bemerkung,$bewertung,$hervorgehoben,$gericht_id): void
{
    $link = connectdb();
    $statement = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement,
                "INSERT INTO bewertung (bemerkung,sternebewertung,hervorgehoben,gerichtId) VALUES (?,?,?,?)"
    );
    mysqli_stmt_bind_param($statement,'ssii',
        $bemerkung,$bewertung,$hervorgehoben,$gericht_id);
    mysqli_stmt_execute($statement);

    mysqli_close($link);
}



