<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Wshare</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: inter;
            background: url(students_background.png);
            background-size: cover;
            background-blend-mode: overlay;
            background-attachment: fixed;
        }

        .container {
            max-width: 400px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 30px;
            padding-bottom: 50px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .create {
            text-align: center;
            margin: 10px;
        }

        @media screen and (max-width: 758px) {
            .container {
                margin: 20px;
            }
            body {
                justify-content: left;
            }
        }

    </style>
</head>

<body style="background: url(students_background.png); background-size:cover; background-blend-mode:overlay; background-attachment:fixed">

    <!--<div class="logo" style="margin:20px; text-align:center;"><a href = "../wshare landing page/landing page (FINAL).php" style="color:#f0f1f1; text-decoration:none;">Wshare</a></div>-->

    <div class="container">

        <h1 style="padding-bottom: 50px; color: #007bff">Login</h1>

        <form action="login_process.php" method="POST">
            <input type="text" id="username" name="username" placeholder="username..." required><br><br>
            <input type="password" id="password" name="password" placeholder="password..." required><br><br>
            <input class = "btn" type="submit" value="Login" style="width: 100%; padding: 10px 20px;border: none;border-radius: 5px;cursor: pointer;display: block;margin: 20px auto;">
        </form>

        
        <p class = "create" style = "text-align:center; margin:10px;">not signed in? <a href="signup.php" style="text-decoration: none; color: #007bff;">create an account</a></p>
        <p class = "create" style = "text-align:center; margin:10px;">I forgot my <a href="login.php" style="text-decoration: none; color: #007bff;">password</a></p>
        <p class = "create" style = "text-align:center; margin:10px;">back to <a href="../wshare landing page/landing page (FINAL).php" style="text-decoration: none; color: #007bff;">main page</a></p>
    </div>
</body>

</html>

