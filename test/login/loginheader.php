<?php
// A few notes about this file
//
// This is required on all php pages.
// Using this file is just an easier way to inclue it on all pages without 
// copying and pasting the below code, multiple times
//
// If you see a page that doesn't have <?php require login/loginheader.php; ?
//			NOTE: make sure to add a ">" (no quotes) to the end of that ?, as it would mess up the // comment by adding it

//This header should be included on top of every page;
//  it grabs user data from either the database or
//  their session variable
require_once 'dbconfig.php';
if (isset($_SESSION['user_session'])) {
    $user_id = $_SESSION['user_session'];
    $stmt = $DB_con->prepare("SELECT * FROM `User` WHERE idUser=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
}
?>
