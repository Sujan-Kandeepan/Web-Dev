<?php
    session_start();
    if (array_key_exists("id", $_COOKIE) && $_COOKIE["id"]) {
        $_SESSION["id"] = $_COOKIE["id"];
    }
    if (array_key_exists("id", $_SESSION) && $_SESSION["id"]) {
        $link = mysqli_connect("shareddb-i.hosting.stackcp.net", "secret-diary-sujan-3335665d", "8gwpbidd34", "secret-diary-sujan-3335665d");
        if (mysqli_connect_error()) {
            die("Database Connection Error");
        }
        
        $query = "SELECT `diary` FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $_SESSION["id"])." LIMIT 1";
        $row = mysqli_fetch_array(mysqli_query($link, $query));
        $content = $row["diary"];
    } else {
        header("Location: secret-diary-auth.php");
    }
?>

<!doctype html>
<html lang="en">
    <? include("header.php"); ?>
    <body>
        <nav class="navbar navbar-light bg-light">
          <a class="navbar-brand" href="">Secret Diary</a>
          <form class="form-inline">
            <a class="btn btn-success my-2 my-sm-0" href="secret-diary-auth.php?logout=1">Log out</a>
          </form>
        </nav>

        <div class="container-fluid">
            <textarea class="form-control" id="diary"><? echo $content; ?></textarea>
        </div>
        <? include("script.php"); ?>
    </body>
</html>