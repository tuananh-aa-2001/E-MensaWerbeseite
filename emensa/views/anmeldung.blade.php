<!--
- Praktikum DBWT. Autoren:
- Tuan,Nguyen, 3517392
- Dorian,Hoevelmann, 3525346
-->

<!DOCTYPE html>
<html lang="de">
<head>
    <title>{{$title}}</title>
    <link rel="stylesheet" type="text/css" >
<meta charset="utf-8">

</head>
<body>
<div></div>
<div>
    <h1>Anmeldung</h1>
    <h3>Email : admin@emensa.example and hashed salted pass :$2y$04$WbuRTYmSaNSArvAmI2JlS.WEDeYCduc8FdD0vXnX6AQIFa2aVtRyK</h3>
    <div>
        <form action="anmeldung_verifizieren" method="post">
            <div class="row">
                <div>
                    <label for="email">E-mail</label>
                </div>
                <div>
                    <input required type="email" id="email" name="email" placeholder="example@gmail.com" autocomplete="off">
                </div>
                <br>
            </div>
            <div>
                <div>
                    <label for="password">Password</label>
                </div>
                <div>
                    <input required type="password" id="password" name="password" autocomplete="off">
                </div>
                <br>
            </div>
            <div>
                <div></div>
                <div><input type="submit" name="submit" value="Anmelden"></div>
                <div></div>
                <div>
                    <?php
                    if ($_GET['submit'] == 'fail')
                        echo 'Email oder Passwort ist nicht korrekt!';
                    ?>
                </div>
            </div>
        </form>
        <form method="post" action="index">
            <div>
                <div></div>
                <div><input type="submit" name="" value="Return to Main Page"></div>
                <br>
            </div>
        </form>
    </div>
</div>
<div></div>


</body>
</html>
