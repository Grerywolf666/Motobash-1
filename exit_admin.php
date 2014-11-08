<?php if($_REQUEST[exit_admin])
{
    setcookie("id", "", time() + 3600*24*30*12, "/");
            setcookie("hash", "", time() + 3600*24*30*12, "/");
            header("Location: garaj.php"); exit();
            //echo "YES!";
}?>