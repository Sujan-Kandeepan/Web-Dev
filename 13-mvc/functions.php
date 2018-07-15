<?php
    session_start();

    $link = mysqli_connect("shareddb-i.hosting.stackcp.net", "twitter-sujan-3335a443", "password", "twitter-sujan-3335a443");
    if (mysqli_connect_error()) {
        print_r(mysqli_connect_error());
        exit();
    }

    if (array_key_exists("function", $_GET) && $_GET["function"] == "logout") {
        session_unset();
    }

    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'minute'),
            array(1 , 'second')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    function displayTweets($type) {
        global $link;
        if ($type == "public") {
            $whereClause = "";
        } else if ($type == "following") {
            if (array_key_exists("id", $_SESSION) && $_SESSION["id"] > 0) {
                $query = "SELECT * FROM `following` WHERE `follower` = ".mysqli_real_escape_string($link, $_SESSION["id"]);
                $result = mysqli_query($link, $query);
                $whereClause = "";
                while ($row = mysqli_fetch_assoc($result)) {
                    $whereClause .= ($whereClause == "" ? "WHERE " : " OR ")."`userid` = ".$row['following'];

                }
                if ($whereClause == "") {
                    $whereClause = "FALSE";
                }
            } else {
                $whereClause = "FALSE";
            }
        } else if ($type == "yours") {
            if (array_key_exists("id", $_SESSION) && $_SESSION["id"] > 0) {
                $whereClause = "WHERE `userid` = ".mysqli_real_escape_string($link, $_SESSION["id"]);
            } else {
                $whereClause = "FALSE";
            }
        } else if ($type == "search") {
            $whereClause = "WHERE `tweet` LIKE '%".mysqli_real_escape_string($link, $_GET["query"])."%'";
            echo "<h2>Showing results for '".mysqli_real_escape_string($link, $_GET["query"])."'</h2>";
        } else if (is_numeric($type)) {
            $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $type)." LIMIT 1";
            $userQueryResult = mysqli_query($link, $userQuery);
            $user = mysqli_fetch_assoc($userQueryResult);
            echo "<h2>Tweets from ".mysqli_real_escape_string($link, $user["email"])."</h2>";
            
            $whereClause = "WHERE `userid` = ".mysqli_real_escape_string($link, $type);
        }
        
        $query = "SELECT * FROM `tweets` ".$whereClause." ORDER BY `datetime` DESC LIMIT 10";
        $result = mysqli_query($link, $query);
        if ($whereClause == "FALSE" || mysqli_num_rows($result) == 0) {
            echo "There are no tweets to display.";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $userQuery = "SELECT * FROM `users` WHERE `id` = ".mysqli_real_escape_string($link, $row["userid"])." LIMIT 1";
                $userQueryResult = mysqli_query($link, $userQuery);
                $user = mysqli_fetch_assoc($userQueryResult);
                
                $btnstring = "Follow";
                if (array_key_exists("id", $_SESSION) && $_SESSION["id"] > 0) {
                    $followQuery = "SELECT * FROM `following` WHERE `follower` = ".mysqli_real_escape_string($link, $_SESSION["id"])." AND `following` = ".mysqli_real_escape_string($link, $user["id"])." LIMIT 1";
                    $followQueryResult = mysqli_query($link, $followQuery);
                    if (mysqli_num_rows($followQueryResult) > 0) {
                        $btnstring = "Unfollow";
                    }
                }
                
                echo "<div class='tweet'><strong><a href='?page=publicprofiles&userid=".$user["id"]."' style='color: darkblue'>".$user["email"]."</a></strong> <span class='time'>".time_since(time() - strtotime($row["datetime"]))." ago</span><br>".$row["tweet"]."<br><a class='toggle-follow' data-userid='".$row["userid"]."' href=''>".$btnstring."</a></div>";
            }
        }
    }

    function displaySearch() {
        echo '<form class="form-inline">
          <div class="form-group mx-0 mb-2 col-lg-9 pl-lg-0 center-block">
            <input type="hidden" name="page" value="search">
            <input type="text" class="form-control" id="search" name="query" style="width: 100%" placeholder="Search tweets">
          </div>
          <button type="submit" class="btn btn-outline-info mb-2 col-lg-3">Search</button>
        </form>';
    }

    function displayTweetBox() {
        if (array_key_exists("id", $_SESSION) && $_SESSION["id"] > 0) {
            echo '<div class="alert alert-success" id="tweet-success" style="margin-top: 10px">Tweet posted successfully!</div>
            <div class="alert alert-danger" id="tweet-error" style="margin-top: 10px"></div>
        <div class="form">
          <div class="form-group" style="margin-top: 10px">
            <textarea class="form-control" id="tweet-content" rows="3"></textarea>
          </div>
          <button class="btn btn-info btn-block" id="post-tweet">Post Tweet</button>
        </div>';
        }
    }

    function displayUsers() {
        global $link;
        $query = "SELECT * FROM `users` LIMIT 10";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p><a href='?page=publicprofiles&userid=".$row["id"]."'>".$row["email"]."</a></p>";
        }
    }
?>