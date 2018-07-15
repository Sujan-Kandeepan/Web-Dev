<div class="container main-container">
    <div class="row">
        <div class="col-8">
            <h2>Tweets From Your Followers</h2>
            <?php displayTweets("following"); ?>
        </div>
        <div class="col-4">
            <?php displaySearch(); ?>
            <?php displayTweetBox(); ?>
        </div>
    </div>
</div>