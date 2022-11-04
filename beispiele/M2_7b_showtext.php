<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Show Text</title>
</head>
<body>
<form method="get">
    <label for="search_word" >Suche Wörter:</label>
    <input id="search_word" type="text" name="search_word" value="<?php echo $_GET['search_word'] ?? ''; ?>">
    <br>
    <?php
    /**
     * Praktikum DBWT. Autoren:
     * Tuan,Nguyen, 3517392
     * Dorian,Hoevelmann, 3525346
     */
    const GET_PARAM_FOR_SEARCH ='search_word';
    $search = $_GET[GET_PARAM_FOR_SEARCH];
    $found_word = "";
    $lines = file('en.txt');

    foreach($lines as $line)
    {
        if(str_contains($line, $search))
            $found_word = explode(";",$line);
    }
    if(!empty($found_word))
        echo "Übersetzung: ".($found_word[1])."</br>"."Das gesuchte Wort < ".$_GET[GET_PARAM_FOR_SEARCH]. " > ist enthalten"."</br>";
    else
        echo "Das gesuchte Wort < ". $_GET[GET_PARAM_FOR_SEARCH]. " > ist nicht enthalten"."</br>";
    ?>
</form>


</body>
</html>