<?php
    $json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=YOUR_API_KEY");
    $array = json_decode($json);
    print_r($json);
?>

<html>
    <head>
        <title>Geocoding An Address</title>
    </head>
    <body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
            $.ajax({
                url: "https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=YOUR_API_KEY",
                type: "GET",
                success: function(data) {
                    $.each(data["results"][0]["address_components"], function(key, value) {
                        if (value["types"].indexOf("country") != -1) {
                            alert(value["long_name"]);
                        }
                    })
                }
            });
        </script>
    </body>
</html>