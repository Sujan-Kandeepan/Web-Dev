<?php
    setcookie("customerId", "1234", time() + 60 * 60 * 24 * 5); //initialize
    setcookie("customerId", "1234", time() - 60 * 60); //unset on next page load
    setcookie("customerId", "5678", time() + 60 * 60 * 24 * 5); //update
    echo $_COOKIE["customerId"];
?>