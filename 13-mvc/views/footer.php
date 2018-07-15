        <footer class="footer">
            <div class="container">
                <p>&copy; Sujan Kandeepan, 2018</p>
            </div>
        </footer>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

        <!-- Modal -->
        <div class="modal fade" id="auth-modal" tabindex="-1" role="dialog" aria-labelledby="auth-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auth-modal-title">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" id="auth-alert"></div>
                        <form>
                            <input type="hidden" id="auth-mode" value="login">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email address">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a id="auth-toggle">Sign Up</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="auth-button">Login</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $("#auth-alert").hide();
            $("#tweet-success").hide();
            $("#tweet-error").hide();
            
            if (window.location.search.indexOf("page=timeline") != -1) {
                $("#timeline").addClass("active");
            } else if (window.location.search.indexOf("page=yourtweets") != -1) {
                $("#yourtweets").addClass("active");
            } else if (window.location.search.indexOf("page=publicprofiles") != -1) {
                $("#publicprofiles").addClass("active");
            }
            
            $("#auth-toggle").click(function() {
                if ($("#auth-mode").val() == "login") {
                    $("#auth-mode").val("signup");
                    $("#auth-modal-title").html("Sign Up");
                    $("#auth-button").html("Sign Up");
                    $("#auth-toggle").html("Login")
                } else {
                    $("#auth-mode").val("login");
                    $("#auth-modal-title").html("Login");
                    $("#auth-button").html("Login");
                    $("#auth-toggle").html("Sign Up")
                }
            });
            
            $("#auth-button").click(function() {
                $.ajax({
                    type: "post",
                    url: "actions.php?action=auth",
                    data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&auth-mode=" + $("#auth-mode").val(),
                    success: function(result) {
                        if (result == "success") {
                            location.assign("/mvc");
                        } else {
                            $("#auth-alert").html(result).show();
                        }
                    }
                });
            });
            
            $(".toggle-follow").click(function(e) {
                e.preventDefault();
                var id = $(this).attr("data-userid");
                $.ajax({
                    type: "post",
                    url: "actions.php?action=toggle-follow",
                    data: "userid=" + id,
                    success: function(result) {
                        if (result == "followed") {
                            $("a[data-userid=" + id + "]").html("Unfollow");
                        } else if (result == "unfollowed") {
                            $("a[data-userid=" + id + "]").html("Follow");
                        }
                    }
                });
            });
            
            $("#post-tweet").click(function() {
                $.ajax({
                    type: "post",
                    url: "actions.php?action=post-tweet",
                    data: "tweet-content=" + $("#tweet-content").val(),
                    success: function(result) {
                        if (result == "success") {
                            $("#tweet-success").show();
                            $("#tweet-error").hide();
                        } else {
                            $("#tweet-error").html(result).show();
                            $("#tweet-success").hide();
                        }
                    }
                });
            });
        </script>
    </body>
</html>