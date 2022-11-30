<?php
$invalid_emails = [
    1 => 'rcpt.at',
    2 => 'damnthespam.at',
    3 => 'wegwerfmail.de',
    4 => 'trashmail.'
];
$file = fopen("Anmeldungsdaten.txt", "a");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST)) {
        $errors = [];
        if(empty(trim($_POST['name'])))
            $errors[] = 'Bitte geben Sie einen Namen ein!';
        if(empty($_POST['email']))
            $errors[] = 'Bitte geben Sie eine gültige Email ein!';
        else
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                $errors[] = 'Bitte geben Sie eine gültige Email ein!';
        for($i = 0; $i < count($invalid_emails);$i++){
            $invalid = strstr($_POST['email'],$invalid_emails[$i+1]);
            if($invalid)
                $errors[] = 'Bitte geben Sie eine gültige Email ein!';
        }
        if(empty($errors)){
            echo  '<div class="success"> Vielen Dank. Sie haben sich erfolgreich zum Newsletter angemeldet.</div>';
            fwrite($file,$_POST['name'].';'.$_POST['email'].';'. $_POST['language'] . "\n"):
            header("Location: /?submit=success");
        }else{
            echo '<div class="error"> <ul>';
            foreach ($errors as $error)
                echo '<li>'.$error.'</li>';
            echo '</ul> </div>';
            header("Location: /?submit=error");
        }
    }
}
fclose($file);
