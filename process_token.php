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
                crypt("admintest", $salt)) || (crypt($user . $pass, $salt) ==
                crypt("usuariocomun", $salt))) {
                $_SESSION["user"] = $_POST["user"];
            }
        }
        /*else{
        	echo("Credenciales no validas");
        }*/
        break;
    case "logout":
        $_SESSION = array();
        session_destroy();
        break;
    case "transfer":
        //include "db.txt";
        if(isset($_SESSION["user"])){
            if(isset($_POST['csrf']) && $_POST["csrf"] == $_SESSION['token']){
                $server = "localhost";
        $dbname = "informacion";
        $username = "root";
        $password = "";
        $mysqli = new mysqli($server, $username, $password, $dbname);
        // Check connection
        if ($mysqli->connect_errno) {
            printf("Falló la conexión: %s\n", $mysqli->connect_error);
            exit();
        }

        $cantidad_pasada =  0;
        $current_user = $_POST['destinatary'];
        if ($resultado = $mysqli->query("SELECT cantidad FROM usuarios WHERE Usuario='$current_user'")) {
            while($row = $resultado->fetch_assoc()) {
                $cantidad_pasada+=$row['cantidad'];
                //echo($row['Usuario']." ".$row['cantidad']);
            }
            /* liberar el conjunto de resultados */
            $resultado->close();
        }
        $new_cantidad = $cantidad_pasada + $_POST['quantity'];
        $res = $mysqli->query("UPDATE usuarios SET cantidad = '$new_cantidad' WHERE Usuario ='$current_user' ");
            }
        }
        //$res = $mysqli->query('UPDATE usuarios SET cantidad = '.($_POST['quantity']+$cantidad_pasada). ' WHERE Usuario = '.$_POST['destinatary']);
        //$res->close();
}
header("Location: login_token.php");
?>