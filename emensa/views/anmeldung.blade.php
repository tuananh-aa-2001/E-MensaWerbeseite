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
    <h3>Email : admin@emensa.example and pass :password</h3>
    <h2>{{$_SESSION['login_result_message']}}</h2>
    <div>
        <form action="anmeldung_verifizieren" method="post">

            <label for="email">E-mail</label>
            <input required type="email" id="email" name="email" placeholder="example@gmail.com" autocomplete="off">
            <label for="password">Password</label>
            <input required type="password" id="password" name="password" autocomplete="off">
             <input type="submit" name="submit" value="Anmelden">

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
