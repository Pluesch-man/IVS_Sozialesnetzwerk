<?php
session_start();

?>
<!DOCTYPE html>
<html lang="de">
<head>

</head>
<body>
<div id="nav">
<?php
require("nav.php");
require("plausi.inc.php");
?>
</div>
<div id="content">
<h1>Registrierung</h1>
<?php
require("registrieren.inc.php");
class Registrierung {
    public function registrieren() {
        if ($this->plausibilisieren()) {
            $this->eintragen_db();
        }
    }

    private function plausibilisieren() {
        // Fehlervariable
        $anmelden = 0;
        $p = new Plausi();
        $anmelden += $p->namentest(isset($_POST['name']) ? $_POST['name'] : '');
        $anmelden += $p->namentest(isset($_POST['vorname']) ? $_POST['vorname'] : '');
        $anmelden += $p->emailtest(isset($_POST['email']) ? $_POST['email'] : '');
        $anmelden += $p->nutzerdatentest(isset($_POST['userid']) ? $_POST['userid'] : '');
        $anmelden += $p->nutzerdatentest(isset($_POST['pw']) ? $_POST['pw'] : '');

        // Kritische Zeichen auf der freien Eingabe der Zusatzinfos eliminieren
        $_POST['zusatzinfos'] = preg_replace("/[<|>|$|%|&|§]/", "#", isset($_POST['zusatzinfos']) ? $_POST['zusatzinfos'] : '');

        // Testausgaben für den derzeitigen Stand des Projekts
        echo "Die Eingaben: <hr>";
        print_r($_POST);
        echo "<br>Fehleranzahl: " . $anmelden . "<hr>";

        if ($anmelden == 0) {
            return true;
        } else {
            return false;
        }
    }

    private function eintragen_db()
    {
        require("db.inc.php");
        try {
            $stmt = $pdo->prepare("INSERT INTO mitglieder (name, vorname, email, zusatzinfos, rolle, userid, pw)
                VALUES (:name, :vorname, :email, :zusatzinfos, :rolle, :userid, :pw)");
            $stmt->execute(array(
                ':name' => $_POST["name"],
                ':vorname' => $_POST["vorname"],
                ':email' => $_POST["email"],
                ':zusatzinfos' => $_POST["zusatzinfos"],
                ':rolle' => "Mitglied",
                ':userid' => $_POST["userid"],
                ':pw' => password_hash($_POST["pw"], PASSWORD_DEFAULT)
            ));
            $_SESSION["name"] = $_POST["userid"];
            $_SESSION["login"] = "false";
            $dat = "index.php";
        } catch (PDOException $e) {
            $dat = "regfehler.php";
        }
        header("Location: $dat");
    }
}
$regobj = new Registrierung();
if (sizeof($_POST) > 0) {
    $regobj->registrieren();
}
?>
</div>
</body>
</html>
