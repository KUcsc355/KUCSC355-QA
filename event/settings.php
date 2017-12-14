<?php
function connect() {
    $db = null;
    $host = 'lvaitpsitedb.c8yagni7c74b.us-east-2.rds.amazonaws.com';
    $name = 'lvaitpdb';
    $pass = 'Kutztown';
    $user = 'awsuser';
    
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
