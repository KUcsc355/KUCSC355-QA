<?php
function connect() {
    $host = 'lvaitpsitedb.c8yagni7c74b.us-east-2.rds.amazonaws.com';
    $name = 'lvaitpdb';
    $pass = 'Kutztown';
    $user = 'awsuser';

    $connection = mysqli_connect($host, $user, $pass, $name) or
        die("Cannot connect to $host as $user: " . mysqli_error($connection));

    return new mysqli($host, $user, $pass, $name);
}

function disconnect($db) {
    // $db->close();
    mysqli_close($db);
}
?>
