<?php
session_start();
if (version_compare(PHP_VERSION, '7', '<')) {
    die('<h1>Für diese Anwendung ist mindestens PHP 7 erforderlich</h1>');
}
?>

<?php
/**
 * Festlegung der Untergrenze für die PHP-Version
 * @version: 1.0
 */
if (version_compare(PHP_VERSION, '7', '<')) {
    die('<h1>Für diese Anwendung ist mindestens PHP 7 erforderlich</h1>');
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="utf-8">
<title>Image2Food – Sag mir, was ich daraus kochen kann – Index</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div id="nav">
<?php
require("nav.php");
require("plausi.inc.php");
?>
</div>
<div id="content">

<h1>Login</h1>
<h6>Das soziale, multimediale Netzwerk für Kochideen</h6>

<?php
require("login.inc.php");

$login = new Login();
$login->_login();

/**
 * Das soziale Netzwerk für Kochideen
 * Die Einstiegsseite mit der Hauptklasse
 */
class Login {
    private function anmelden_db() {
        $vorhanden = false;
        require("db.inc.php");
        if ($stmt = $pdo->prepare("SELECT userid, pw FROM mitglieder")) {
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                if (isset($_POST["userid"]) &&
                    $_POST["userid"] == $row['userid'] &&
                    md5($_POST["pw"]) == $row['pw']) {
                    $vorhanden = true;
                    break;
                }
            }
        }

        if ($vorhanden) {
            $_SESSION["name"] = $_POST["userid"];
            $_SESSION["login"] = "true";
            $dat = "index.php";
        } else {
            $dat = "loginfehler.php";
        }
        header("Location: $dat");
    }

    public function _login() {
        if ($this->plausibilisieren()) {
            $this->anmelden_db();
        }
    }

    private function plausibilisieren() {
        $anmelden = 0;
        $plogin = new Plausi();
        $anmelden += $plogin->nutzerdatentest(isset($_POST['userid']) ? $_POST['userid'] : '');
        $anmelden += $plogin->nutzerdatentest(isset($_POST['pw']) ? $_POST['pw'] : '');

        echo "Die Eingaben: <hr>";
        print_r($_POST);
        echo "<br>Fehleranzahl: " . $anmelden . "<hr>";

        if ($anmelden == 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>

</div>
</body>
</html>
