<?php
    $weather = "";
    $city = "";
    if (array_key_exists("city", $_GET) && $_GET["city"]) {
        $json = file_get_contents("https://samples.openweathermap.org/data/2.5/weather?q=".urlencode($_GET["city"])."&appid=d64d576442c3bacb2957ea83d4e2f820");
        $array = json_decode($json, true);
        
        if ($array["cod"] == 200) {
            $weather = "The weather in ".$_GET["city"]." is currently '".$array["weather"][0]["description"]."'.";

            $temp = intval($array["main"]["temp"] - 273.15);
            $weather .= " The temperature is ".$temp."&deg;C";

            $wind = intval($array["wind"]["speed"] / 3.6 * 100) / 100;
            $weather .= " and the wind speed is ".$wind." km/h.";
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

        <title>What's The Weather?</title>
        
        <style type="text/css">
            
            body {
                background: none;
            }
        
            html { 
                background: url(images/background.jpg) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            
            input {
                margin: 15px 0;
            }
            
            label {
                font-size: 120%;
            }
            
            .alert {
                margin-top: 75px;
            }
            
            .container {
                margin-top: 80px;
                text-align: center;
                max-width: 450px;
            }
        
        </style>
    </head>
    <body>
        <div class="container">
            <h1>What's The Weather?</h1>
            
            <form>
              <div class="form-group">
                <label for="city">Enter the name of a city.</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Eg. Toronto, Melbourne" value="<? if (array_key_exists("city", $_GET) && $_GET['city']) { echo $_GET['city']; } ?>">
              </div>
              <button type="submit" class="btn btn-info">Submit</button>
            </form>
            
            <div class="alert alert-success" role="alert"><? if ($weather) { echo $weather; } ?></div>
            <div class="alert alert-danger" role="alert"><? if (array_key_exists("city", $_GET) && !$weather) { echo "Could not find weather for this city."; } ?></div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        </body>
    
        <script type="text/javascript">
            $(".alert").each(function(alert) {
                if ($(this).html() == "") {
                    $(this).hide();
                }
            });
        </script>
</html>