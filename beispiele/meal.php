/**
* Praktikum DBWT. Autoren:
- Tuan,Nguyen, 3517392
- Dorian,Hoevelmann, 3525346
*/
<?php
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';

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

$texts = ['Bewertung' => 'Rating','Name' => 'Name','Begründung'=> 'Reason','Senden' => 'send'];

$showRatings = [];

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
        $sum += $rating['stars'] / count($ratings);
    }
    return $sum;
}


?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title>Gericht: <?php echo $meal['name']; ?></title>
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
        <h1>Gericht: <?php echo $meal['name']; ?></h1>
        <p><?php
            if(isset($_GET['show_description'])){
                echo $meal['description'];
            }else{
                echo "There is no description for this meal.";
            }
            ?></p>
        <h1>
            <?php
            if(isset($_GET['sprache']) && $_GET['sprache']== 'de'){
                echo "Bewertung";
            }else if(isset($_GET['sprache']) && $_GET['sprache']== 'en'){
                echo $texts['Bewertung'];
            }else{
                echo "Bewertung";
            }
            ?>
            (Insgesamt: <?php echo calcMeanStars($ratings); ?>)
        </h1>
        <form method="get">
            <label for="search_text" >Filter:</label>
            <input id="search_text" type="text" name="search_text" value="<?php echo $_GET['search_text'] ?? ''; ?>">
            <input type="submit"  value="<?php echo isset($_GET['sprache']) && $_GET['sprache']== 'de' ? 'Senden' : $texts['Senden'] ; ?>">
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
            echo '<ul>';
                foreach ($meal['allergens'] as $allergien) {
                    foreach($allergens as $index => $value){
                        if($allergien == $index){
                            echo '<li>'.$value."<br>\n".'</li>';
                        }
                    }
                 }
            echo '</ul>';

            echo "Externer Preis : ".number_format($meal['price_extern'],2,'.','')."\xE2\x82\xAc"."<br>\n";
            echo "Interner Preis : ".number_format($meal['price_intern'],2,'.','')."\xE2\x82\xAc"."<br>\n";
            echo "<br>\n";

            $most_star = 4;
            $least_star = 2 ;
            $check_bewertung = PHP_INT_MAX ;
            if(isset($_GET['rating']) && $_GET['rating'] == "TOP"){
                $check_bewertung = 1;
                echo "Best-Bewertung : "."<br>\n";
            }else if(isset($_GET['rating']) && $_GET['rating'] == "FLOPP"){
                $check_bewertung = 0;
                echo "Schlechteste-Bewertung : "."<br>\n";
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
    </body>
</html>