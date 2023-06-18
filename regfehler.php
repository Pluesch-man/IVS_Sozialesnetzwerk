<?php
session_start();
if (0 > version_compare(PHP_VERSION, '7')) {
die('<h1>Für diese Anwendung ' .
'ist mindestens PHP 7 notwendig</h1>');
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
…
</head>
<body>
<div id="nav">
<?php
require ("nav.php");
?>
</div>
<div id="content">
<h1>Registrierungsfehler</h1>
<?php
require ("registrieren.inc.php");
class RegFehler {
public function fehler() {
echo "<h4>Die Registrierung hat leider" .
" nicht funktioniert.</h4>".
"<h5>Wählen Sie eine andere Userid und " .
"versuchen Sie es erneut.</h5>";
}
}
$regobj = new RegFehler();
$regobj -> fehler();
?>
</div>
</body>
</html>