<!DOCTYPE html>
<html lang="en">
    <head>
        <title>You're Not signed up.</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style>
        *{
            margin:0;
            padding:0;
        }

        body {
            font-family: inter;
            background-color:  #e1ebed;

        }

        .container {
            height: 100%;
            width: 1024px;
            margin: 90px auto 0; /* Add margin-top to accommodate fixed navbar */
            background-color: #e1ebed;
            border-radius: 10px;
        }

        a{
            text-decoration: underline;
            color: #0056b3;

        }
    </style>


    <body>

    <div class="container">

    <?php

        //if hindi nakalogin ito maglabas
        echo '<div class = "welcome_container" style = "width: 1000px;padding: 140px; background-color: #">';
        
        echo '<p class = "welcome" style = "margin:150px; color: #007bff; font-size: large;"><a href="login.php">Login</a> or <a href="signup.php"> Sign Up</a> now to join your fellow crimsons in interesting discussions.</p>';
        
        echo '</div>';

    ?>

    </div>

    </body>

</html>