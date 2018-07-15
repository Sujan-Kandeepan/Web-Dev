<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link rel="stylesheet" href="views/styles.css">

        <title>Hello, world!</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/mvc">Twitter</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" id="timeline" href="?page=timeline">Your Timeline</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="yourtweets" href="?page=yourtweets">Your Tweets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="publicprofiles" href="?page=publicprofiles">Public Profiles</a>
                    </li>
                </ul>
                <div class="form-inline my-2 my-lg-0">
                    <?php if(array_key_exists("id", $_SESSION) && $_SESSION["id"] > 0) { ?>
                        <a class="btn btn-outline-success my-2 my-sm-0" href="?function=logout">Logout</a>
                    <?php } else { ?>
                        <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#auth-modal">Login/Signup</button>
                    <?php } ?>
                </div>
            </div>
        </nav>