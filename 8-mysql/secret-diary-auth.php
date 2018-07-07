<?php
    session_start();

    $error = "";

    if (array_key_exists("logout", $_GET)) {
        unset($_SESSION);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";
    } else if ((array_key_exists("id", $_SESSION) && $_SESSION["id"] == "1") || (array_key_exists("id", $_COOKIE) && $_COOKIE["id"] == "1")) {
        header("Location: secret-diary-home.php");
    }

    if (array_key_exists("submit", $_POST)) {
        $link = mysqli_connect("shareddb-i.hosting.stackcp.net", "secret-diary-sujan-3335665d", "8gwpbidd34", "secret-diary-sujan-3335665d");
        if (mysqli_connect_error()) {
            die("Database Connection Error");
        }
        
        if (!$_POST["email"]) {
            $error .= "<br>An email address is required.";
        }
        if (!$_POST["password"]) {
            $error .= "<br>A password is required.";
        }
        
        if ($error != "") {
            $error = "<p>There were error(s) in your form: ".$error."</p>";
        } else {
            if ($_POST["sign-up"] == "1") {
                $email = mysqli_real_escape_string($link, $_POST["email"]);
                $password = mysqli_real_escape_string($link, $_POST["password"]);
                $query = "SELECT `id` from `users` WHERE `email` = '".$email."' LIMIT 1";
                $result = mysqli_query($link, $query);
                if (mysqli_num_rows($result) > 0) {
                    $error = "<p>That email address is taken.</p>";
                } else {
                    $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".$email."', '".$password."')";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        $error = "<p>Could not sign you up - please try again later.</p>";
                    } else {
                        $query = "UPDATE `users` SET `password` = '".md5(md5(mysqli_insert_id($link)).$password)."' WHERE `id` = ".mysqli_insert_id($link)." LIMIT 1";
                        $result = mysqli_query($link, $query);
                        $_SESSION["id"] = mysqli_insert_id($link);
                        if (array_key_exists("stay-logged-in", $_POST) && $_POST["stay-logged-in"] == "1") {
                            setcookie("id", mysqli_insert_id($link), time() + 60*60*24*365);
                        }
                        header("Location: secret-diary-home.php");
                    }
                }
            } else {
                $email = mysqli_real_escape_string($link, $_POST["email"]);
                $query = "SELECT * FROM `users` WHERE `email` = '".$email."'";
                $result = mysqli_query($link, $query);
                $row = mysqli_fetch_array($result);
                if (array_key_exists("id", $row)) {
                    $password = md5(md5($row["id"]).mysqli_real_escape_string($link, $_POST["password"]));
                    if ($password == $row["password"]) {
                        $_SESSION["id"] = $row["id"];
                        if (array_key_exists("stay-logged-in", $_POST) && $_POST["stay-logged-in"] == "1") {
                            setcookie("id", $row["id"], time() + 60*60*24*365);
                        }
                        header("Location: secret-diary-home.php");
                    } else {
                        $error = "<p>That email/password combination could not be found.</p>";
                    }
                }
            }
        }
    }
?>

<!doctype html>
<html lang="en">
    <? include("header.php"); ?>
    <body>
        <div class="container" id="auth-container">
            <h1>Secret Diary</h1>
            <p>Store your thoughts permanently and securely.</p>
            
            <div class="alert alert-danger" id="error"><? echo $error; ?></div>

            <form method="post" id="sign-up-form">
                <p>Interested? Sign up now!</p>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Your email">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Your password">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="stay-logged-in" value="1">
                    <label class="form-check-label" for="stay-logged-in">Stay logged in</label>
                </div>
                <div class="form-group">
                    <input class="form-control" type="hidden" name="sign-up" value="1">
                </div>
                <input class="btn btn-success" type="submit" name="submit" value="Sign Up!">
                <p><a class="toggle-form">Log In</a></p>
            </form>

            <form method="post" id="log-in-form">
                <p>Log in using your username and password.</p>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Your email">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Your password">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="stay-logged-in" value="1">
                    <label class="form-check-label" for="stay-logged-in">Stay logged in</label>
                </div>
                <div class="form-group">
                    <input class="form-control" type="hidden" name="sign-up" value="0">
                </div>
                <input class="btn btn-success" type="submit" name="submit" value="Log In!">
                <p><a class="toggle-form">Sign Up</a></p>
            </form>
        </div>
        
        <? include("script.php") ?>
    </body>
</html>



