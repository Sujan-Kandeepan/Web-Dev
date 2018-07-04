<?php
    session_start();
    //$_SESSION["username"] = "sujankandeepan";
    //echo $_SESSION["username"];
    if ($_SESSION["email"]) {
        echo "<p>You are logged in!</p>";
    } else {
        header("Location: index.php");
    }
?>