<?php
session_start();
switch($_GET["action"]) {
    case "login":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = (isset($_POST["user"])) &&
            ctype_alnum($_POST["user"]) ? $_POST["user"] : null;
            $pass = (isset($_POST["pass"])) ? $_POST["pass"] : null;
            $salt = md5("misuperhash");

            /*echo("concatenado ".crypt($user . $pass, $salt));
            echo("original " .crypt("admintest", $salt));
            sleep(3);*/
        if (isset($user) && isset($pass) && (crypt($user . $pass, $salt) ==
                crypt("admintest", $salt))) {
                $_SESSION["user"] = $_POST["user"];
            }
        }
        /*else{
        	echo("Credenciales no validas");
        }*/
        break;
    case "logout":
        if(isset($_GET['csrf']) && $_GET["csrf"] == $_SESSION['token']){
        	$_SESSION = array();
        	session_destroy();
        }
        break;
}
header("Location: login.php");
?>