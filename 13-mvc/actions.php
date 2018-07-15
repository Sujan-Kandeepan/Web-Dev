<?php
    include("functions.php");
    
    if ($_GET["action"] == "auth") {
        $error = "";
        if ($_POST["email"] == "") {
            $error = "An email address is required!";
        } else if ($_POST["password"] == "") {
            $error = "A password is required!";
        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $error = "Please enter a valid email address!";
        }
        
        if ($error != "") {
            echo $error;
            exit();
        }
        
        if($_POST["auth-mode"] == "signup") {
            $query = "SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link, $_POST["email"])."' LIMIT 1";
            $result = mysqli_query($link, $query);
            if (mysqli_num_rows($result) > 0) {
                $error = "That email address is already taken!";
            } else {
                $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST["email"])."', '".mysqli_real_escape_string($link, $_POST["password"])."')";
                if (mysqli_query($link, $query)) {
                    $_SESSION["id"] = mysqli_insert_id($link);
                    $query = "UPDATE `users` SET `password` = '".md5(md5($_SESSION["id"]).$_POST["password"])."' WHERE `id` = ".$_SESSION["id"]." LIMIT 1";
                    mysqli_query($link, $query);
                    echo "success";
                    
                } else {
                    $error = "Couldn't create user - please try again later.";
                }
            }
        } else {
            $query = "SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link, $_POST["email"])."' LIMIT 1";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_assoc($result);
            if ($row["password"] == md5(md5($row["id"]).$_POST["password"])) {
                echo "success";
                $_SESSION["id"] = $row["id"];
            } else {
                $error = "Could not find that username/password combination - please try again.";
            }
        }
        
        if ($error != "") {
            echo $error;
            exit();
        }
    }

    if ($_GET["action"] == "toggle-follow") {
        $query = "SELECT * FROM `following` WHERE `follower` = ".mysqli_real_escape_string($link, $_SESSION["id"])." AND `following` = ".mysqli_real_escape_string($link, $_POST["userid"])." LIMIT 1";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $query = "DELETE FROM `following` WHERE `id` = ".mysqli_real_escape_string($link, $row["id"])." LIMIT 1";
            $result = mysqli_query($link, $query);
            echo "unfollowed";
        } else {
            $query = "INSERT INTO `following` (`follower`, `following`) VALUES (".mysqli_real_escape_string($link, $_SESSION["id"]).", ".mysqli_real_escape_string($link, $_POST["userid"]).")";
            $result = mysqli_query($link, $query);
            echo "followed";
        }
    }

    if ($_GET["action"] == "post-tweet") {
        if(!$_POST["tweet-content"]) {
            echo "Tweet cannot be empty!";
        } else if (strlen($_POST["tweet-content"]) > 280) {
            echo "Character limit exceeded!";
        } else {
            $query = "INSERT INTO `tweets` (`tweet`, `userid`, `datetime`) VALUES ('".mysqli_real_escape_string($link, $_POST["tweet-content"])."', ".mysqli_real_escape_string($link, $_SESSION["id"]).", NOW())";
            $result = mysqli_query($link, $query);
            echo "success";
        }
    }
?>