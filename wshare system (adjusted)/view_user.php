<?php
require_once 'functions.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Check if username is provided in the URL parameter
if (!isset($_GET['username'])) {
    header('Location: index.php');
    exit;
}

// Get the username from the URL parameter
$username = $_GET['username'];

// Get user profile information
$user = getUserByUsername($username);

// Get posts created by the user
$user_posts = getUserPosts($username);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="./css/left-navbar.css">

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: inter;
            background-color: #e1ebed;
            justify-content: center;
        }

        .container {
            height: 100%;
            width: 1024px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0f1f1;
            border-radius: 10px;
        }

        h1{
            padding-bottom: 30px ;
            color: #007bff;
            margin: 10px;
        }

        .username{
            font-size:xx-large;
            color: #007bff;
            margin: 10px;
        }


        h3{
            color: #007bff;
            margin: 10px;
        }
        
        .email{
            color: #007bff;
            margin: 10px;
        }
        .bio{
            margin: 10px;
        }

        form {
            padding: 10px;
        }

        .photo{
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 10px;
            text-align: left;
            color: #2b2e4a;
            padding-top: 20px;
        }


        .profile_pic{
            height: 250px; 
            width: 250px; 
            border-radius: 150px; 
            background-color:transparent;
        }

        .non-nav-icon{
            
            border: none;
            cursor: pointer;
        }

        .non-nav-icon-img{
            height: 25px;
            width: 25px;
            border-radius: 20px;
        }

        .view-post{
            display: flex;
            flex-wrap: wrap;

            b{

                padding: 10px;
            }
        }

        @media (min-width: 768px) {
            .container {
                width: 750px;
            }
        }

        @media (min-width: 992px) {
            .container {
                width: 970px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                width: 1170px;
            }
        }
    </style>
</head>
<body>


        

<div class="container">

    <a class = "backButton" id ="backButton"><div class = "back" style = "display:flex; margin-bottom:30px;">
            
            <img class = "icons" src = "signoff.svg">
            <p class = "back-label" style="padding-top: 15px;color:#007bff">Back</p>
        
    </div></a>

    <h1>Profile</h1>
        <?php
            if ($user['ProfilePic']) {
                                echo '<div class = "photo" >';
                                echo '<img class = "profile_pic" src="' . $user['ProfilePic'] . '">';
                                echo '</div>';
                            } else {
                                echo '<div class = "photo" >';
                                echo '<img class = "profile_pic" src="default_pic.svg">';
                                echo '</div>';
                            }
        ?>

    <p class = "username"><b><?php echo $user['Username']; ?></b></p>

    <p class = "email"><b><?php echo $user['Email']; ?></b></p>
    
    <br>
    <h3>Bio</h3>
        <p class = "bio" id="bio"><?php echo htmlspecialchars($user['Bio']); ?></p>
    <br>
    <br>
    <h3 style="text-align:left;"><?php echo $user['Username']; ?>'s Posts</h3>

    <ul>
        <?php 
            if($user_posts){
                
                foreach ($user_posts as $post){

                    echo'    <li>';   
                    echo'        <div class="view-post">';
                    echo'           <b>'.$post['Title'].'</b>';
                    echo'           <form action="view_post.php" method="GET">   
                                        <input type="hidden" name="id" value="'.$post['PostID'].'">
                                        <button class = "non-nav-icon" type="submit"><img class = "non-nav-icon-img" src="view.svg"></button>
                                    </form>';
                    echo'        </div>';
                    echo'    </li>';
                }

            } else {
                echo'<p class = "no-post-yet" style = "color: #007bff; margin: 20px; text-align:center;"><b>No post yet.<b></p>';
            }
        ?>
        
    </ul>
    
    
    
    <br>
</div>


<script>
    // JavaScript to handle back button functionality
    document.getElementById('backButton').addEventListener('click', function() {
        // Go back in browser history
        window.history.back();
    });
</script>
</body>
</html>
