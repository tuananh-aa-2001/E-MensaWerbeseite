<?php

function get_user($user){
    $link = connectdb();

    $statement = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement,
        "SELECT * FROM benutzer WHERE email = (?)");
    mysqli_stmt_bind_param($statement, 's',
        $user);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $data = mysqli_fetch_array($result);

    mysqli_free_result($result);
    mysqli_close($link);

    return $data;
}

function update_user($user,$success): void
{
    $link = connectdb();

    mysqli_begin_transaction($link);
    $statement = mysqli_stmt_init($link);
    if($success){
        mysqli_stmt_prepare($statement,
            "CALL anmeldungszaehler(?)");
        mysqli_stmt_bind_param($statement, 's',
            $user);
        mysqli_stmt_execute($statement);
        mysqli_stmt_prepare($statement,
            "UPDATE benutzer 
                  SET letzteanmeldung=NOW()
                  WHERE email = (?);");
    }else {
        mysqli_stmt_prepare($statement,
            "CALL anmeldungszaehler(?)");
        mysqli_stmt_bind_param($statement, 's',
            $user);
        mysqli_stmt_execute($statement);
        mysqli_stmt_prepare($statement,
            "UPDATE benutzer 
                  SET letzterfehler=NOW()
                  WHERE email = (?);");
    }
    mysqli_stmt_bind_param($statement, 's',
        $user);
    mysqli_stmt_execute($statement);
    mysqli_commit($link);
    mysqli_close($link);
}
