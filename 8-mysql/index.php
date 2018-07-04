<?php
    // Starting session
    session_start();
    
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

    // Storing passwords securely
    $row["id"] = 75;
    echo "Secure password hash: ".md5(md5($row["id"])."password");
?>