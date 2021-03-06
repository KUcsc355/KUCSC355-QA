<?php
//If you're looking at this file and thinking huh?
// It was created by the User Management Team and is important for their DB linkage

/******************/
/*                */
/* The User Class */
/*                */
/******************/
class USER
{
    private $db;

    //An accessor to the $db object
    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    //User registration.  Face-value verification is done on page, database management and
    // backend verification are done through the user class here.
    public function register($fName,$lName,$umail,$upass,$membership)
    {
        try
        {
            $member = 1;
            $student = 0;
            if($membership==="student"){
                $member = 0;
                $student = 1;
            }

            $new_password = password_hash($upass, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("INSERT INTO `User`(email,password,fName,lName,priveledge,student) 
                                                       VALUES(:umail, :upass, :fName, :lName, :member, :student)");

            $stmt->bindparam(":umail", $umail);
            $stmt->bindparam(":upass", $new_password);
            $stmt->bindparam(":fName", $fName);
            $stmt->bindparam(":lName", $lName);
            $stmt->bindparam(":member", $member);
            $stmt->bindparam(":student", $student);
            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    //Similarly to the registration function, database verification is done through this user class.
    //Allows for logging in via username or email, then once successfully logged in, save the session variable.
    public function login($umail,$upass)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT * FROM `User` WHERE email=:umail LIMIT 1");
            $stmt->execute(array(':umail'=>$umail));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0)
            {
                if(password_verify($upass, $userRow['password']))
                {
                    $_SESSION['user_session'] = $userRow['idUser'];
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    //Self-explanatory
    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }

    //As is done with the registration function, face-value verification is done on the front-end,
    //  once everything is given the 'ok' they're passed here and the database is updated.
    public function change_password($user_id, $new_pass)
    {
        $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("UPDATE `User`
                                    SET password = :upass
                                    WHERE idUser=:uid");
        $stmt->bindparam(":upass", $new_pass);
        $stmt->bindparam(":uid", $user_id);
        $stmt->execute();
        return $stmt;
    }

    //Not completely necessary, but may be useful someday. Wishful thinking.
    //  Ironically, this may end up taking more time to do than actually
    //  copy+pasting the stock header() function itself. With the redirect
    //  function, you need to write
    //    header("Location: $url); //23 chars
    //  which is only one character fewer than writing
    //    $user->redirect($url);  //22 chars
    public function redirect($url)
    {
        header("Location: $url");
    }

    //No explanation needed and you can't make me do one
    public function logout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }
}
?>