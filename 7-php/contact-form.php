<?php
    $error = "";
    $success = "";
    
    if ($_POST) {
        $error = "";
        
        if (!$_POST["email"]) {
            $error .= "<br>The email field is required.";
        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
          $error .= "<br>".$_POST["email"]." is not a valid email address.";
        }
        
        if (!$_POST["subject"]) {
            $error .= "<br>The subject field is required.";
        }
        
        if (!$_POST["content"]) {
            $error .= "<br>The content field is required.";
        }
        
        if ($error != "") {
            $error = "<strong>There were error(s) in your form:</strong>".$error;
        } else {
            $recipient = "sujank@rogers.com";
            $subject = $_POST["subject"];
            $content = $_POST["content"];
            $headers = "From: ".$_POST["email"];
            
            if (mail($recipient, $subject, $content, $headers)) {
                $success = "Your message was sent, we'll get back to you ASAP!";
            } else {
                $error = "Your email could not be sent.";
            }
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

        <title>Hello, world!</title>
    </head>
    <body>
        <div class="container">
            <h1>Get in touch!</h1>
            
            <div class="alert alert-danger" id="error" role="alert"><? echo $error; $error = ""; ?></div>
            <div class="alert alert-success" id="success" role="alert"><? echo $success; $success = ""; ?></div>
            
            <form method="post">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your email address">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject">
                </div>
                <div class="form-group">
                    <label for="content">What would you like to ask us?</label>
                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                  </div>
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        
        <script type="text/javascript">
            
            if ($("#error").html() == "") {
                $("#error").hide();
            }
            if ($("#success").html() == "") {
                $("#success").hide();
            }
        
            $("form").submit(function(e){
                var error = "";
                
                if ($("#email").val() == "") {
                    error += "<br>The email field is required.";
                }
                
                if ($("#subject").val() == "") {
                    error += "<br>The subject field is required.";
                }
                
                if ($("#content").val() == "") {
                    error += "<br>The content field is required.";
                }
                
                if (error != "") {
                    error = "<strong>There were error(s) in your form:</strong>" + error;
                    $("#error").html(error);
                    $("#error").show();
                    $("#success").hide();
                    return false;
                } else {
                    $("#error").hide();
                    $("#success").show();
                    $("form").unbind("submit").submit();
                    return true;
                }
            });
        
        </script>
    </body>
</html>