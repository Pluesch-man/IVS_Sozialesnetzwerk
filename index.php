<?php
session_start();
if (version_compare(PHP_VERSION, '7', '<')) {
    die('<h1>Für diese Anwendung ist mindestens PHP 7 notwendig</h1>');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="nav">
        <?php
        if (isset($_SESSION["login"]) && $_SESSION["login"] == "true") {
            require("navmitglieder.php");
        } else {
            require("nav.php");
        }
        ?>
    </div>
    <div id="content">
        <?php
        if (version_compare(PHP_VERSION, '7', '<')) {
            die('<h1>Für diese Anwendung ist mindestens PHP 7 notwendig</h1>');
        }
        ?>
        <h1>Image2Food – Sag mir was ich daraus kochen kann</h1>
        <h2>Das soziale, multimediale Netzwerk für Kochideen</h2>
        <?php
        /**
        * Das soziale Netzwerk für Kochideen
        * Die Einstiegsseite mit der Hauptklasse
        */
        class Index {
            function besucher() {
                echo "<div id='indextext'>Willkommen auf unserer Webseite. Schauen Sie sich um. Sie können sich hier registrieren und dann in einem geschlossenen Mitgliederbereich anmelden.</div>";
            }
        }
        $obj = new Index();
        $obj->besucher();
        ?>
    </div>
</body>
</html>
