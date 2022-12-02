@section('gerichtuebersicht')
    <div id="mealsMain">
        <h1>Köstlichkeiten, die Sie erwarten</h1>
        <table class="mealTable">
            <tr>
                <th>Bild</th>
                <th>Beschreibung</th>
                <th>Code</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
            </tr>
            <?php
            $link=mysqli_connect("localhost", "root", "root", "emensawerbeseite");
            if (!$link) {
                echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
                exit();
            }
            $tmp_gericht = '';
            $sql = "SELECT name, beschreibung, preis_intern, preis_extern FROM gericht where preis_extern > 4.9 order by name";


            $result = mysqli_query($link, $sql);

            if (!$result ) {
                echo "Fehler während der Abfrage:  ", mysqli_error($link);
                exit();
            }
            while ($row = mysqli_fetch_assoc($result)) {
                $tmp_gericht = $row['name'];
                $sql2 = "SELECT allergen.code as code
            from gericht join gericht_hat_allergen on gericht_hat_allergen.gericht_id = gericht.id
            join allergen on gericht_hat_allergen.code = allergen.code
            where gericht.name = ";
                $sql2 .= "'";
                $sql2 .= $tmp_gericht;
                $sql2 .= "'";
                $result2 = mysqli_query($link, $sql2);
                if (!$result2 ) {
                    echo "Fehler während der Abfrage:  ", mysqli_error($link);
                    exit();
                }
                $allergenLi = '';
                while ($allergen = mysqli_fetch_assoc($result2)) {$allergenLi .= $allergen['code']." ";}
                echo '<tr>'.'<td>'.$row['name']. '</td>' . '<td>' . $row['beschreibung']. '</td>' .'<td>'.$allergenLi.'</td>' . '<td>' . $row['preis_intern'].'</td>'. '<td>' . $row['preis_extern'].'</td>'.'</tr>';
            }
            ?>
        </table>
        <br>
        <form method="post" action="wunschgericht.php">
            <div class="row">
                <div></div>
                <div><input type="submit" name="" value="To order the food"></div>
                <br>
            </div>
        </form>

        <h1>Allergene</h1>
        <table class="allergenTable">
            <tr>
                <th>Code</th>
                <th>Allergen</th>
            </tr>
            <?php
            $sql = "SELECT distinct allergen.code,allergen.name
            from gericht join gericht_hat_allergen on gericht_hat_allergen.gericht_id = gericht.id
            join allergen on gericht_hat_allergen.code = allergen.code
           order by allergen.code";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>'.'<td>'.$row['code']. '</td>' .'<td>'.$row['name'].'</td>'.'</tr>';
            }
            ?>
        </table>
    </div>

@endsection
