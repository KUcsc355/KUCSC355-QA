<?php
function connect() {
    $db = null;
    $host = 'localhost';
    $name = 'eventeam_aitp';
    $pass = 'n0pa$$w0rd';
    $user = 'eventeam_admin';
    
    try {
        $db = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return $db;
}

function disconnect($db) {
    $db = null;
}
?>
