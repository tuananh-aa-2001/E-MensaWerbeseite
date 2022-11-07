<?php
/**
* Praktikum DBWT. Autoren:
* Tuan,Nguyen, 3517392
* Dorian,Hoevelmann, 3525346
*/
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_LANGUAGE = 'sprache';
/**
 * List of all allergens.
 */
$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch'
];

$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42             // Number of available meals
];

$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (stripos($rating['text'], $searchTerm) > 0){
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}

function calcMeanStars(array $ratings) : float{
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
    }
    return $sum;
}
$lang = 'DE';
$lang = $_GET[GET_PARAM_LANGUAGE] ?? $lang;

$translations = [
    'DE' => [
        "Gericht" => "Gericht",
        "Beschreibung Anzeigen" => "Beschreibung Anzeigen",
        "Beschreibung Ausblenden" => "Beschreibung Ausblenden",
        "Interner Preis" => "Interner Preis",
        "Externer Preis" => "Externer Preis",
        "Bewertungen" => "Bewertungen",
        "Insgesamt" => "Insgesamt",
        "Suchen" => "Suchen",
        "Allergene" => "Allergene",
        "Sterne" => "Sterne",
        "Beste Bewertung" => "Beste Bewertung",
        "Schlechteste Bewertung" => "Schlechteste Bewertung"],
    'EN' => [
        "Gericht" => "Dish",
        "Beschreibung Anzeigen" => "Show Description",
        "Beschreibung Ausblenden" => "Hide Description",
        "Interner Preis" => "Price for internal customer",
        "Externer Preis" => "Price for external customer",
        "Bewertungen" => "Ratings",
        "Insgesamt" => "Overall",
        "Suchen" => "Search",
        "Allergene" => "Allergens",
        "Sterne" => "Stars",
        "Beste Bewertung" => "Best Rating",
        "Schlechteste Bewertung" => "Worst Rating"]
];

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $translations[$lang]['Gericht'].": ".$meal['name']; ?></title>
        <style>
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: darkgray;
            }
        </style>
    </head>
    <body>
        <h1><?php echo $translations[$lang]['Gericht'].": ".$meal['name']; ?></h1>
        <p>
            <?php
            //Beschreibung anzeigen/verstecken
            if (isset($_GET['show']))
                echo '<h2>',$meal['description'], '</h2>';
            else if (isset($_GET['hide']))
                echo '<br>';
            //Preis Anzeigen
            echo $translations[$lang]['Externer Preis']. ': '. number_format($meal['price_extern'], 2, '.', '') . "\xE2\x82\xAc" . "<br>\n";
            echo $translations[$lang]['Interner Preis']. ': '. number_format($meal['price_intern'], 2, '.', '') . "\xE2\x82\xAc" . "<br>\n";
            echo "<br>\n";
            ?>
        </p>
        <h1><?php echo $translations[$lang]['Allergene'].": "; ?></h1>
        <?php
        echo '<ul>';
        foreach ($meal['allergens'] as $allergene) {
            foreach($allergens as $i => $value){
                if($allergene == $i){
                    echo '<li>'.$value.'</li>';
                }
            }
        }
        echo '</ul>';
        ?>
        <h1><?php echo $translations[$lang]['Bewertungen']?> (<?php echo $translations[$lang]['Insgesamt'].":".calcMeanStars($ratings); ?>)</h1>
        <form method="get">
            <input type="submit" name="sprache" value="EN"/>
            <input type="submit" name="sprache" value="DE"/>
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" value="<?php echo $_GET['search_text'] ?? ''; ?>" name="search_text">
            <input type="submit" value="<?php echo $translations[$lang]['Suchen']?>">
            <input type="submit"  value="<?php echo $translations[$lang]['Beschreibung Anzeigen']; ?>" name="show"/>
            <input type="submit"  value="<?php echo $translations[$lang]['Beschreibung Ausblenden'];  ?>" name="hide" />
            <input type="submit"  value="TOP" name="top"/>
            <input type="submit"  value="FLOPP" name="flopp"/><br>
        </form>
        <table class="rating">
            <thead>
            <tr>
                <td>Text</td>
                <td><?php echo $translations[$lang]['Sterne']?></td>
                <td>Author</td>
            </tr>
            </thead>
            <tbody>
            <?php
            //Ausgabe der Rezessionen
        foreach ($showRatings as $rating) {
            echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                      <td class='rating_author'>{$rating['author']}</td>
                  </tr>";
        }
        ?>

            </tbody>
        </table>
        <br>
        <?php
        $max = max(array_column($ratings, 'stars'));
        $min = min(array_column($ratings, 'stars'));
        $check_bewertung = PHP_INT_MAX ;
        if(isset($_GET['top'])){
            $check_bewertung = 1;
            echo $translations[$lang]['Beste Bewertung']." : "."<br>\n";
        }else{
            $check_bewertung = 0;
            echo $translations[$lang]['Schlechteste Bewertung']." : "."<br>\n";
        }

        foreach ($ratings as $rating) {
                if($check_bewertung == 1){
                    if($rating['stars'] == $max){
                        echo $rating['text'].": ".$rating['stars']." ".$translations[$lang]['Sterne']." , ".$rating['author']."<br>\n";
                    }
                }else if( $check_bewertung == 0){
                    if($rating['stars'] == $min){
                        echo $rating['text'].": ".$rating['stars']." ".$translations[$lang]['Sterne']." , ".$rating['author']."<br>\n";
                    }
                }
            }
        ?>
    </body>
</html>