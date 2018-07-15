<div class="container main-container">
    <div class="row">
        <div class="col-8">
            <?php if (array_key_exists("userid", $_GET) && $_GET["userid"]) {
                displayTweets($_GET["userid"]);
             } else { ?>
                <h2>Active Users</h2>
                <?php displayUsers(); ?>
            <?php } ?>
        </div>
        <div class="col-4">
            <?php displaySearch(); ?>
            <?php displayTweetBox(); ?>
        </div>
    </div>
</div>