<?php
    // Introduction
    echo "Hello world!\n";

    // Variables
    $name = "Sujan";
    echo "<p>My name is $name!</p>";

    $string1 = "<p>This is the first part";
    $string2 = "of a sentence.</p>";
    echo $string1." ".$string2;

    $myNumber = 45;
    $calculation = $myNumber * 31 / 97 + 4;
    echo "<p>The result of the calculation is ".$calculation.".</p>";

    $myBoolTrue = true;
    $myBoolFalse = false;
    echo "<p>True and false are represented as '".$myBoolTrue."' and '".$myBoolFalse."'.</p>";

    $variableName = "name";
    echo "<p>The value of <em>name</em> is ".$$variableName.".</p>";

    // Arrays
    $myArray = array("Sujan", "Janan", "Sujatha", "Kandeepan");
    echo "<p>";
    print_r($myArray);
    echo "</p>";
    echo "<p>".$myArray[2]."</p>";

    $anotherArray[0] = "pizza";
    $anotherArray[1] = "ice cream";
    $anotherArray[5] = "chocolate";
    $anotherArray["favorite"] = "samosa";
    echo "<p>";
    print_r($anotherArray);
    echo "</p>";

    $thirdArray = array(
        "France" => "French",
        "USA" => "English",
        "Germany" => "German"
    );
    echo "<p>";
    print_r($thirdArray);
    echo "</p>";

    echo "<p>The size of the array is ".sizeof($thirdArray).".</p>";

    $myArray[] = "Last person";
    echo "<p>";
    print_r($myArray);
    echo "</p>";

    unset($thirdArray["France"]);
    echo "<p>";
    print_r($thirdArray);
    echo "</p>";

    // If statements
    $user = "sujan";
    $age = 19;
    if ($user == "sujan" && $age >= 18) {
        echo "<p>You may proceed.</p>";
    } else {
        echo "<p>You may not proceed.</p>";
    }

    // For/foreach loops
    for ($i = 10; $i >= 0; $i--) {
        echo $i."<br>";
    }
    echo "<br>";

    $family = array("Sujan", "Janan", "Sujatha", "Kandeepan");
    for ($i = 0; $i < sizeof($family); $i++) {
        echo $family[$i]."<br>";
    }
    echo "<br>";

    foreach ($family as $key => $value) {
        if ($key != 3) {
            $family[$key] = $value." Kandeepan";
        } else {
            $family[$key] = $value." Sivananthan";
        }
        echo "Array item ".$key." is ".$family[$key].".<br>";
    }
    echo "<br>";

    // While loops
    $i = 0;
    while ($i < 10) {
        echo $i."<br>";
        $i++;
    }
    echo "<br>";

    $i = 0;
    while ($i < sizeof($family)) {
        echo $family[$i]."<br>";
        $i++;
    }
    echo "<br>";

    // GET variables
    echo "<p>";
    print_r($_GET);
    echo "</p>";
    if (array_key_exists("name", $_GET)) {
        echo "<p>Hello ".$_GET["name"]."!</p>";
    }

    if (array_key_exists("number", $_GET)) {
        $number = $_GET["number"];
        $message = "$number is prime!";
        for ($i = 2; $i < $number; $i++) {
            if ($number % $i == 0) {
                $message = "$number is not prime!";
            }
        }
        if ($number < 1 || !ctype_digit($number)) {
            $message = "Invalid input!";
        }
        echo "<p>".$message."</p>";
    }

    // POST variables
    print_r($_POST);

    $usernames = array("Sujan", "Janan", "Sujatha", "Kandeepan");
    if (array_key_exists("username", $_POST)) {
        $username = $_POST["username"];
        $found = false;
        foreach ($usernames as $value) {
            if ($username == $value) {
                $found = true;
            }
        }
        if ($found) {
            echo "<p>Welcome, ".$_POST["username"].".</p>";
        } else {
            echo "<p>Username not found.</p>";
        }
    }

    // Sending email
    $recipient = "sujank@rogers.com";
    $subject = "I hope this works!";
    $body = "-Sent from my PHP site";
    $headers = "From: sujank@rogers.com";
    $sent = false; //mail($recipient, $subject, $body, $headers);
    if ($sent) {
        echo "<p>Mail sent!</p>";
    } else {
        echo "<p>Send failed.</p>";
    }
?>

<form>
    <input type="text" name="name" placeholder="Enter your name">
    <input type="submit">
</form>

<form>
    <input type="text" name="number" placeholder="Enter a number">
    <input type="submit" value="Is It Prime?">
</form>

<form method="post">
    <input type="text" name="something" placeholder="Enter something to post">
    <input type="submit" value="Post">
</form>

<form method="post">
    <input type="text" name="username" placeholder="Enter your username">
    <input type="submit" value="Verify">
</form>