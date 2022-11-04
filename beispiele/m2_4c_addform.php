<html lang>
    <form method = "post">
        Nummer 1:
        <label>
            <input type="number" name="num1">
        </label>
        <br>
        Nummer 2:
        <label>
            <input type="number" name="num2">
        </label>
        <input  type="submit" name="submit" value="Addieren">
        <input  type="submit" name="submit" value="Multiplizieren">
    </form>
</html>
<?php
/**
 * Praktikum DBWT. Autoren:
- Tuan,Nguyen, 3517392
- Dorian,Hoevelmann, 3525346
 */
if(isset($_POST['submit']))
{
    $number1 = $_POST['num1'];
    $number2 = $_POST['num2'];
    if (str_contains($_POST['submit'],"Addieren")){
    $sum =  $number1+$number2;
    echo "The sum of $number1 and $number2 is: ".$sum."<br>\n";}
    else {
    $mul =  $number1*$number2;
    echo "The mul of $number1 and $number2 is: ".$mul."<br>\n";}
}
?>