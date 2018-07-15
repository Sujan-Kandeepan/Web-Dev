<div class="container main-container">
    <div class="row">
        <div class="col-8">
            <h2>Your Tweets</h2>
            <?php displayTweets("yours"); ?>
        </div>
        <div class="col-4">
            <?php displaySearch(); ?>
            <?php displayTweetBox(); ?>
        </div>
    </div>
</div>