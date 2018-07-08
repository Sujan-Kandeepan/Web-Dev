<?php
    require "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;

    $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

    /* DEMO CODE - CREDENTIALS, TIMELINE, SUBMISSION
    $content = $connection->get("account/verify_credentials");
    print_r($content);

    $statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);
    print_r($statuses);

    $statues = $connection->post("statuses/update", ["status" => "This came from my Twitter app, pretty cool!"]);
    print_r($statuses);
    */

    $statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);
    foreach ($statuses as $tweet) {
        if ($tweet->favorite_count > 2) {
            $status = $connection->get("statuses/oembed", ["id" => $tweet->id]);
            //echo $tweet->text." - ".$tweet->favorite_count."<br>";
            //print_r($status);
            echo $status->html;
        }
    }
?>