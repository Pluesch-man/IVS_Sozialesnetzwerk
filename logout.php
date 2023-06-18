<?php
session_start();
class Off {
function ausloggen() {
session_destroy();
$dat = "index.php";
header("Location: $dat");
}
}
$obj = new Off();
$obj -> ausloggen();
?>