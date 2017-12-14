<?php
require "loginheader.php";
$my_id = $userRow['idUser'];
if(!$user->is_loggedin()||$userRow['priveledge']!=2)
{
    $user->redirect('../index.php');
}

if(isset($_GET['email'])&&isset($_GET['member']))
{
    $val=0;
    $student=0;
    if($_GET['member']==='regular')
        $val=1;
    if($_GET['member']==='student')
        $student=1;

    try{
        $stmt = $DB_con->prepare("UPDATE User SET priveledge = :val, student = :stud WHERE email=:umail");
            $stmt->bindParam(":val", $val);
            $stmt->bindParam(":stud", $student);
            $stmt->bindParam(":umail", $_GET['email']);
            $stmt->execute();
        echo "<p>Success!";
        } catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
?>