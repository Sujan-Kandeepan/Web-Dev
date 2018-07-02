<?php
    // Connecting to the database
    $link = mysqli_connect("shareddb-i.hosting.stackcp.net", "users-sujan-333766c3", "nvrkj61pgv", "users-sujan-333766c3");
    if (mysqli_connect_error()) {
        die("Connection failed!");
    }

    // Retrieving data
    $query = "SELECT * FROM users";
    if ($result = mysqli_query($link, $query)) {
        $row = mysqli_fetch_array($result);
        echo "<p>";
        print_r($row);
        echo "</p>";
        echo "<p>Your email is ".$row["email"]." and your password is ".$row["password"].".</p>";
    }

    // Inserting and updating data
    //$query = "INSERT INTO `users` (`email`, `password`) VALUES ('sujank@rogers.com', 'password1'), ('janank@rogers.com', 'password2')";
    //$query = "UPDATE `users` SET `password` = 'password1' WHERE `email` = 'sujank@rogers.com' LIMIT 1";

    // Looping through data
    $query = "SELECT * FROM users WHERE `id` >= 2 AND `email` LIKE '%K@Rogers.Com' OR `name` = '".mysqli_real_escape_string($link, "Rob O'Grady")."'";
    if ($result = mysqli_query($link, $query)) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<p>";
            print_r($row);
            echo "</p>";
        }
    }

    // User form example
    if (array_key_exists("name", $_POST) && array_key_exists("email", $_POST) && array_key_exists("password", $_POST)
        && $_POST["name"] != "" && $_POST["email"] != "" && $_POST["password"] != "") {
        $count = 0;
        $query = "SELECT `id` FROM users WHERE `email` = '".mysqli_real_escape_string($link, $_POST['email'])."'";
        $result = mysqli_query($link, $query)
        if (mysqli_num_rows($result) == 0) {
            $query = "INSERT INTO users (`name`, `email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";
            if ($success = mysqli_query($link, $query)) {
                echo "<p>Sign-up successful!</p>";
            } else {
                echo "<p>An error occurred while signing up.</p>";
            }
        } else {
            echo "<p>Error: A user with that email already exists!</p>";
        }
    } else {
        echo "<p>One or more fields is empty!</p>";
    }
?>

<html>
    <head>
        <title>MySQL</title>
    </head>
    <body>
        <form method="post">
            <label>Sign-up: </label>
            <input type="text" name="name" id="name" placeholder="Name">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="password" id="password" placeholder="Password">
            <input type="submit">
        </form>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
        <script>
            $("form").submit(function(e) {
                e.preventDefault();
                if ($("#name").val() == "" || $("#email").val() == "" || $("#password").val() == "") {
                    alert("One or more fields is empty!");
                    return false;
                } else {
                    $("form").unbind("submit").submit();
                    return true;
                }
            });
        </script>
    </body>
</html>
