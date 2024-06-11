<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up to Wshare</title>
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
            background-color: #f2f2f2;
            background: url(students_background.png); 
            background-size: cover; 
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
            font-size: small;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #passwordToggle {
            margin-left: 10px;
            cursor: pointer;
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
            background-color: #007bff;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
        }

        .checkbox-container input[type="checkbox"] {
            margin: 10px;
        }

        a{
            color: #007bff;
        }

        label{
            font-family: inter;
        }
        @media screen and (max-width: 758px) {
            .container {
                margin: 20px;
            }

            .pass {
                width: calc(100% - 50px);
            }

            #passwordToggle {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
        }

        
    </style>

</head>

<body>

    <div class="container">

        <h1 style="padding-bottom: 50px; color: #007bff">Sign Up</h1>

        <form action="signup_process.php" method="POST">
            <input type="text" id="username" name="username" placeholder="username..." required><br><br>
            <input type="email" id="email" name="email" placeholder="wmsu email..." pattern="[a-zA-Z]{2}(2018|2019|202\d){1}\d{5}@wmsu.edu.ph" title="Email must be in the format 'xx2024#####@wmsu.edu.ph'" required><br><br>
            <input class = "pass" type="password" id="password" name="password" placeholder="password..." style = "width: 340px; float:left;"required>
            <button id="passwordToggle" type = "button" onclick="togglePassword(event)" style = "margin-bottom: 40px; height:35px; border:none; color:#007bff; background-color: transparent;">show</button>
            
            <div class="checkbox-container">
                <input type="checkbox" id="termsCheckbox" name="termsCheckbox" required><p style="font-size: small;">I agree to the <a href="tos.php">Terms of Service</a> and <a href="pp.php">Privacy Policy</a></p>
                
            </div>
            
            <input class="btn" type="submit" value="Sign Up" style="width: 100%;">
        </form>

        <p class = "create" style = "text-align:center; margin:30px;">already have an account? <a href="login.php" style="text-decoration: none; color: #007bff;">log in</a></p>
        <p class = "create" style = "text-align:center; margin:20px;">back to <a href="../wshare system (adjusted)/ landing page (FINAL).php" style="text-decoration: none; color: #007bff;">main page</a></p>
    </div>
    
    <script>
        function togglePassword(event) 
        
        {
            event.preventDefault();
            var passwordField = document.getElementById("password");
            var passwordToggle = document.getElementById("passwordToggle");

            if (passwordField.type === "password") 
            
            {
                passwordField.type = "text";
                passwordToggle.textContent = "hide";
            } 
            
            else 
            
            {
                passwordField.type = "password";
                passwordToggle.textContent = "show";
            }
        }
    </script>

</body>

</html>
