<html lang >
<body>
<form method="post">
    Enter First Number:
    <label>
        <input type="number" name="number1" />
    </label><br><br>
    Enter Second Number:
    <label>
        <input type="number" name="number2" />
    </label><br><br>
    <input  type="submit" name="submit" value="Addieren">
    <input  type="submit" name="submit" value="Multiplizieren">
</form>
<?php
/**
 * Praktikum DBWT. Autoren:
- Tuan,Nguyen, 3517392
- Dorian,Hoevelmann, 3525346
 */
if(isset($_POST['submit']))
{
    $number1 = $_POST['number1'];
    $number2 = $_POST['number2'];
    $sum =  $number1+$number2;
    echo "The sum of $number1 and $number2 is: ".$sum."<br>\n";
    $mul =  $number1*$number2;
    echo "The mul of $number1 and $number2 is: ".$mul."<br>\n";
}
?>
</body>
</html>