<?php
// Datenbankverbindung herstellen
$host = "localhost"; // Hostname
$dbname = "sozialesnetz-werk"; // Datenbankname
$user = "sqluser"; // Benutzername
$password = "12345678"; // Passwort

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

// Daten aus dem Formular (Beispielwerte)
$name = $_POST['name'];
$vorname = $_POST['vorname'];
$email = $_POST['email'];
$userid = $_POST['userid'];
$pw = $_POST['pw'];
$zusatzinfos = $_POST['zusatzinfos'];

// Überprüfen der Daten auf Validität
$plausi = new Plausi();
$errors = array();

if ($plausi->namentest($name) != 0) {
    $errors[] = "Ungültiger Name";
}

if ($plausi->namentest($vorname) != 0) {
    $errors[] = "Ungültiger Vorname";
}

if ($plausi->emailtest($email) != 0) {
    $errors[] = "Ungültige E-Mail-Adresse";
}

if ($plausi->nutzerdatentest($userid) != 0) {
    $errors[] = "Ungültige Nutzer-ID";
}

if ($plausi->nutzerdatentest($pw) != 0) {
    $errors[] = "Ungültiges Passwort";
}

// Wenn keine Fehler vorliegen, Daten in die Datenbank einfügen
if (empty($errors)) {
    try {
        // Beispiel: Daten in die Tabelle "mitglieder" einfügen
        $query = "INSERT INTO mitglieder (name, vorname, email, userid, pw, zusatzinfos) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $vorname, $email, $userid, $pw, $zusatzinfos]);

        echo "Daten wurden erfolgreich in die Datenbank eingefügt.";
    } catch (PDOException $e) {
        die("Fehler bei der Datenbankoperation: " . $e->getMessage());
    }
} else {
    // Fehler anzeigen
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}
?>
