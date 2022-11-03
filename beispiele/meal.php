<?php
/**
 * Praktikum DBWT. Autoren:
- Tuan,Nguyen, 3517392
- Dorian,Hoevelmann, 3525346
 */
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_LANGUAGE = 'language';


$lang = 'DE';
$lang = $_GET[GET_PARAM_LANGUAGE] ?? $lang;
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

// strcasecmp: Vergleich von Zeichenketten ohne Unterscheidung von Groß- und Kleinschreibung
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (strcasecmp($rating['text'], $searchTerm)) {
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

function calcMeanStars($ratings) : float{
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'];
    }
    return $sum/count($ratings);
}

$translate_text = [
    'DE' => [
        "Gericht" => "Gericht",
        "Beschreibung Anzeigen" => "Beschreibung Anzeigen",
        "Beschreibung Ausblenden" => "Beschreibung Ausblenden",
        "Interne Preis" => "Interne Preis",
        "Externe Preis" => "Externe Preis",
        "Bewertungen" => "Bewertungen",
        "Insgesamt" => "Insgesamt",
        "Suchen" => "Suchen",
        "Allergene" => "Allergene"],
    'EN' => [
        "Gericht" => "Dish",
        "Beschreibung Anzeigen" => "Show Description",
        "Beschreibung Ausblenden" => "Hide Description",
        "Interne Preis" => "Price for internal customer",
        "Externe Preis" => "Price for external customer",
        "Bewertungen" => "Ratings",
        "Insgesamt" => "Overall",
        "Suchen" => "Search",
        "Allergene" => "Allergen"]
];


?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $translate_text[$lang]['Gericht'].": ".$meal['name']; ?></title>
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
    <form method="get">
        <input type="submit" name="language" value="EN"/>
        <input type="submit" name="language" value="DE"/>
    </form>

    <h1><?php echo $translate_text[$lang]['Gericht'].": ". $meal['name']; ?></h1>

    <form method="get">
        <input type="submit"  value="<?php echo $translate_text[$lang]['Beschreibung Anzeigen']; ?>" name="show"/>
        <input type="submit"  value="<?php echo $translate_text[$lang]['Beschreibung Ausblenden'];  ?>" name="hide"/>
    </form>
    <p>
        <?php
        if (isset($_GET['show']))
            echo '<h2>',$meal['description'], '</h2>';
        else if (isset($_GET['hide']))
            echo '<br>';

        ?>
    </p>

    <h2><?php echo"{$translate_text[$lang]['Bewertungen']} ({$translate_text[$lang]['Insgesamt']} : ".calcMeanStars($ratings); ?>)</h2>

        <form method="get">
            <label for="search_text" >Filter:</label>
            <input id="search_text" type="text" name="search_text" value="<?php echo $_GET['search_text'] ?? ''; ?>">
            <input type="submit"  value="<?php echo $translate_text[$lang]['Suchen']?>">
        </form>
        <table class="rating">
            <thead>
            <tr>
                <td>Text</td>
                <td>Sterne</td>
                <td>Author</td>
            </tr>
            </thead>
            <tbody>
            <?php
        foreach ($showRatings as $rating) {
            echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                      <td class='rating_stars'>{$rating['author']}</td>
                  </tr>";
        }
            ?>
            </tbody>
        </table>

        <?php
            echo "<br>\n";
            echo "Externer Preis : ".number_format($meal['price_extern'],2,'.','')."\xE2\x82\xAc"."<br>\n";
            echo "Interner Preis : ".number_format($meal['price_intern'],2,'.','')."\xE2\x82\xAc"."<br>\n";
            echo "<br>\n";
        ?>

     <h3><?php echo $translate_text[$lang]['Allergene'].": "; ?></h3>
        <?php
            echo '<ul>';
                foreach ($meal['allergens'] as $allergien) {
                    foreach($allergens as $index => $value){
                        if($allergien == $index){
                            echo '<li>'.$value."<br>\n".'</li>';
                        }
                    }
                 }
            echo '</ul>';
        ?>

    <form method="get">
        <input type="submit"  value="TOP" name="best-rating"/>
        <input type="submit"  value="FLOPP" name="worst-rating"/><br>

        <?php
        $most_star = 4;
        $least_star = 2 ;
        $check_bewertung = PHP_INT_MAX ;
        if(isset($_GET['best-rating'])){
            $check_bewertung = 1;
            echo "Best-Bewertung : "."<br>\n";
        }else{
            $check_bewertung = 0;
            echo "Schlechteste-Bewertung :"."<br>\n";
        }

        foreach ($ratings as $rating) {
            if($check_bewertung == 1){
                if($rating['stars'] >= $most_star){
                    $most_star = $rating['stars'];
                    echo $rating['text'].", ".$rating['stars'].",".$rating['author']."<br>\n";
                }
            }else if( $check_bewertung == 0){
                if($rating['stars'] <= $least_star){
                    $least_star = $rating['stars'];
                    echo $rating['text'].", ".$rating['stars'].",".$rating['author']."<br>\n";
                }
            }
        }
        ?>
    </form>

    </body>
</html>