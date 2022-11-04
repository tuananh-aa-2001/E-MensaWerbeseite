<?php
/**
 * Praktikum DBWT. Autoren:
 * Tuan,Nguyen, 3517392
 * Dorian,Hoevelmann, 3525346
 */
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];

echo '<ol>';

for ($index = 0; $index < count($famousMeals); $index++) {
    echo '<li>' , $famousMeals[$index + 1] ['name'] , '</li>';
    if ($index == 3 ) {
        echo $famousMeals[$index + 1]['winner'];
        break;
    }
    for ($j = count($famousMeals[$index + 1]['winner']) - 1; $j >= 0;$j--) {
        echo $famousMeals[$index + 1]['winner'][$j];

        if ($j != count($famousMeals[$index+1]['winner']) && ($j != 0))
            echo ', ';

    }
}
echo '</ol>';

function NoWinner($array): void{
    $beginn = 2000;
    for ($k = 0; $k <= 21; $k++) {
        $count = false;
        for ($i = 0; $i < count($array); $i++) {
            if ($i == 3) {
                $temp = $array[$i + 1]['winner'];
                if ($temp == $beginn) {
                    $count = true;
                    break;
                }
                break;
            }

            for ($j = count($array[$i + 1]['winner']) - 1; $j >= 0; $j--) {
                $temp = $array[$i + 1]['winner'][$j];
                if ($beginn == $temp) {
                    $count = true;
                    break;
                }
            }
            if ($count)
                break;
        }
        if (!$count) {
            echo $beginn;
            echo '<br>';
        }
        $beginn++;
    }

}
echo "In den folgenden Jahren ab 2000 bis heute existieren kein Gewinn:"."</br>";
echo NoWinner($famousMeals);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Famous Meals</title>
</head>
</html>