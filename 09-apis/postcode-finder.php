<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

        <title>Postcode Finder</title>
    </head>
    <body>
        <div class="container">
            <h1>Postcode Finder</h1>
            <p>Enter a partial address to get the postcode.</p>
            
            <div class="alert alert-success" role="alert" id="message"></div>
            
            <form>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" class="form-control" placeholder="Enter partial address">
                </div>
                <button class="btn btn-primary" id="submit">Submit</button>
            </form>
        </div>

        <!-- Dependencies -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        
        <script type="text/javascript">
            $("#message").hide();
            
            function error() {
                $("#message").show()
                $("#message").removeClass("alert-success");
                $("#message").addClass("alert-warning");
                $("#message").html("Could not find postcode!");
            }
            
            $("#submit").click(function() {
                event.preventDefault();
                
                $.ajax({
                    url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + encodeURIComponent($("#address").val()) + "&key=YOUR_API_KEY",
                    type: "GET",
                    success: function(data) {
                        console.log(data);
                        if (data["status"] == "OK") {
                            var found = false;
                            $.each(data["results"][0]["address_components"], function(key, value) {
                                if (value["types"][0] == "postal_code") {
                                    $("#message").show()
                                    $("#message").removeClass("alert-warning");
                                    $("#message").addClass("alert-success");
                                    $("#message").html("The postcode for this address is <strong>" + value["long_name"] + "</strong>.");
                                    found = true;
                                }
                            });
                            
                            if (!found) {
                                error();
                                $("#message").html("Please be more specific with your address!");
                            }
                        } else {
                            error();
                        }
                    },
                    fail: function() {
                        error();
                    }, error: function() {
                        error();
                    }
                });
            });
        </script>
    </body>
</html>