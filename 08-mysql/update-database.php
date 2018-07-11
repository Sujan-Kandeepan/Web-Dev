<?php
    session_start();
    if(array_key_exists("content", $_POST)) {
        $link = mysqli_connect("shareddb-i.hosting.stackcp.net", "secret-diary-sujan-3335665d", "8gwpbidd34", "secret-diary-sujan-3335665d");
        if (mysqli_connect_error()) {
            die("Database Connection Error");
        }
        
        $query = "UPDATE `users` SET `diary` = '".mysqli_real_escape_string($link, $_POST["content"])."' WHERE `id` = ".mysqli_real_escape_string($link, $_SESSION["id"])." LIMIT 1";
        mysqli_query($link, $query);
    }
?>