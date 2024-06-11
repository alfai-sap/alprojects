<?php
    require_once 'functions.php';
    session_start();


    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit;
    }


    $username = $_SESSION['username'];

    // Handle profile picture upload
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_picture"])) {
        $target_dir = "uploads/"; // Directory where uploaded images will be stored
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);

        if ($check !== false) {
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only JPG, JPEG, PNG files are allowed.";
            } else {
                // Move uploaded file to specified directory
                if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {

                    // Update user's profile picture path in the database
                    updateUserProfilePicture($username, $target_file);

                    // Redirect back to profile page
                    header('Location: user_profile.php');
                    exit;
                    
                } else {

                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            echo "File is not an image.";
        }
    }

    // Get user profile information gamit ito 
    $user = getUserByUsername($username);
    $userID = $user['UserID']; 

    // Get posts created by the user
    $user_posts = getUserPosts($username);


    $id = getUserIdByUsername($username);
    $uid = $id;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wshare Profile</title>
    <link rel="stylesheet" href="./css/left-navbar.css">

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: inter;
            background-color: #e1ebed; 
            justify-content:center;
        }

        .logo-navbar{
    list-style: none;
    display: flex;
    height: 80px;
    position: fixed;
    z-index: 999;
    width:200px;
    background-color: transparent; 
}

.logo-navbar-in-left{
    list-style: none;
    display: flex;
    height: 80px;
    width: 400px;
     
}

.logo-nav{
    border: none;
    font-weight: bolder;
    font-size: x-large;
    display:flex;
    padding: 10px;
    cursor: pointer;
    background-color: transparent;
}

.logo-left-nav{
    border: none;
    font-weight: bolder;
    display:flex;
    padding: 10px;
    cursor: pointer;
    background-color: transparent;
}

.logo-nav p{
    text-decoration: none;
    align-self: center;
    margin: 5px;
    padding: 12px;
    color: #0056b3;
}

.logo-navbar li a{
    text-decoration: none;
}

.toggle-icon{
    padding: 15px;
    height: 30px;
    width: 30px;
   
}

        .container {
            margin-top: 100px; /* Adjust as needed based on navbar height */
            width: 1024px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0f1f1;
            border-radius: 10px;
        }

        h1{
            color: #007bff; 
            padding: 10px;

            margin-bottom: 100px;
        }


        .profile_pic{
            height: 250px; 
            width: 250px; 
            border-radius: 150px; 
            background-color:transparent;
        }

        form {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .logout {
            margin: 10px;
            height: 30px;
            width: 30px;
        }

        #bio {
            width: 96%;
            padding: 10px;
            margin: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
            font-family: inter;
            font-size: 16px;
        }

        /* Style for the edit button */
        .savebio {
            width: fit-content; /* Set width to fit content */
            padding: 10px;
            background-color: #007bff;
            margin: 10px auto; /* Set margin to auto to horizontally center */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block; /* Ensure the button is displayed as a block element */
        }

        /* Hover effect for the edit button */
        #editBioBtn:hover {
            background-color: #0056b3;
        }

        .btn-container {
            display: flex;
            justify-content: right;
            margin-top: 20px;
        }

        .edit-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-btn:hover {
            background-color: #0056b3;
        }

        .pfp-elements{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            width: 100%;
        }

        .change-pfp-btn{
            border: none;
            cursor: pointer;
              
            
        }

        .change-pfp-input{
            align-self: center;
        }

        .change-pfp-btn-upload{
            padding: 10px;
                height: 30px;
                width: 30px;
        }

        .change-pfp-btn-icon{
                padding: 10px;
                height: 20px;
                width: 20px;
                
        }

        .choose-pfp-file{
            display: flex;
            padding: 10px;
        }

        .save-bio-btn{
            border: none;
            cursor: pointer;
        }

        .save-bio-btn-icon{
            padding: 10px;
            height: 20px;
            width: 20px;
            border-radius: 20px;
        }

        .uname-elements{
            width: 100%;
        }

        .uname-elem{
            display: flex;
        }

        .Profile-uname{
            color: #007bff;
            padding-top: 40px;
            padding-bottom: 20px;
            font-size:xx-large;
        }

        .Profile-email{

            font-size: medium;
            b{
                color: #007bff;
            }
        }

        .choose-pfp{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .forms{
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .profile-form {
            width: 400px;
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .profile-form label {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .profile-btn {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .profile-btn:hover {
            background-color: #0056b3;
        }


        .non-nav-icon{
            
            border: none;
            cursor: pointer;
        }

        .non-nav-icon-img{
            padding: 10px;
            height: 25px;
            width: 25px;
            border-radius: 20px;
        }

        .user-posts{
            display: flex;
            width: 100%;
        }

        .user-posts b{
            padding: 35px;
        }

        .options-post{
            display: flex;

        }

        

        @media screen and (max-width: 768px) {
            .container {
                width: 90%;
            }

            .navbar {
                width: 90%;
            }
        }



        
    </style>

</head>

<body>

                <ul class = "logo-navbar">
                    <li>
                                <button id ="logo-nav" class="logo-nav" ><img class = "toggle-icon" src = "menu.svg"></button> 
                    </li>

                    <li>
                        <a href = "index.php">
                            <div class="logo-nav">
                                <p class = "logo-label-nav">Wshare</p>
                            </div>
                        </a>
                    </li>

                </ul>



                <ul class="left-navbar" id="left-navbar">
                    
                    <ul class = "logo-navbar-in-left">
                        <li>
                                    <button id ="logo-left-nav" class="logo-nav" ><img class = "toggle-icon" src = "menu.svg"></button> 
                        </li>

                        <li>
                            <a href = "index.php">
                                <div class="logo-nav">
                                    <p class = "logo-label-nav">Wshare</p>
                                </div>
                            </a>
                        </li>

                    </ul>
                        

                    <li>
                        <a href="user_profile.php">

                            <div class = "left-nav">
                                <?php 

                                    $username = $_SESSION['username'];
                                    $user = getUserByUsername($username);
                                    
                                    if (!empty($user['ProfilePic'])): 
                                ?>
                                    <img class = "login_user_pic" src="<?php echo $user['ProfilePic']; ?>">
                                <?php else: ?>

                                    <img class = "login_user_pic" src="default_pic.svg" >
                                <?php endif; ?>

                                <?php echo '<h3 class = "username-nav">Welcome,  <b>' . $_SESSION['username'] . '</b>!</h3>';?>
                            </div>
                        </a>
                
                    </li>

                    <li>
                        <a href = "index.php">
                            <div class = "left-nav">
                                <img class = "icons" src = "homepage.svg">
                                <p class = "label_nav">Home</p>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <div class = "left-nav">
                                <img class = "icons" src = "chats2.svg">
                                <p class = "label_nav">Chats</p>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="search_users.php">
                            <div class = "left-nav">
                                <img class = "icons" src = "searchpeople.svg">
                                <p class = "label_nav">Search a User</p>
                            </div>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#">
                            <div class = "left-nav">
                                <img class = "icons" src = "twopeople.svg">
                                <p class = "label_nav">Network</p>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="logout.php">
                            <div class = "left-nav">
                                <img class = "icons" src = "logout.svg">
                                <p class = "label_nav">Logout</p>
                            </div>
                        </a>
                    </li>
                </ul><br>


    <div class="container">

        <h1>Your Profile</h1>
        
        
        <div class = "pfp-elements">

            <div class = "pfp-elements-child">
                <?php if (!empty($user['ProfilePic'])): ?>
                    <img class = "profile_pic" src="<?php echo $user['ProfilePic']; ?>" alt="Profile Picture">
                <?php else: ?>
                    <img class = "profile_pic" src="default_pic.svg">
                <?php endif; ?>

                <button class = "change-pfp-btn" id="change-pfp-btn" onclick="toggleEditPhoto()" ><img class = "change-pfp-btn-icon" src = "edit.svg"></button>
            </div>

        </div>

        <div class="choose-pfp">
            <form class = "change_pfp" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" id = "change_pfp" style = "display:none;">
                <div class="choose-pfp-file">
                    <input type="file" class = "change-pfp-input" name="profile_picture" id="profile_picture" accept="image/*" style="align-self:center;" required>
                    <button type="submit" class = "change-pfp-btn" name="submit" onclick = "toggleShowChangePfp()"><img class = "change-pfp-btn-upload" src = "upload.svg"></button>
                </div>
            </form>
        </div>
        
        
        <div class = "uname-elements">
            <div class="uname-elem">
                <p class = "Profile-uname"><b><?php echo $user['Username']; ?></b></p>
                <button class = "save-bio-btn" id="editBtn" onclick="toggleEdituname()" ><img class = "save-bio-btn-icon" src = "edit.svg"></button>
            </div>

            <p class = "Profile-email"><b><?php echo $user['Email']; ?></b></p>
        </div>
        
        <div class="forms">
            <form action="new_uname_email.php" method="post" class="profile-form" id="username" style="display: none;">

                <label for="new_username">New Username:</label>
                <input type="text" id="new_username" name="new_username" class="profile-input" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="profile-input" required>

                <button type="submit" name="submit" class="profile-btn">Update Username</button>
            </form>
        </div>

        
        <h3  class = "pfp-label" style="color: #007bff; text-align: left; padding-top:50px;">Bio</h3>       

        <form class = "bioForm" id="bioForm" action="functions.php" method="POST">

            <input type="hidden" name="userID" value="<?php echo $uid; ?>">

            <textarea id="bio" name="bio" rows="4" cols="50" style = "background-color:#f0f1f1;"><?php echo htmlspecialchars($user['Bio']); ?></textarea>

            <div class="btn-container">

            <button class="save-bio-btn" type="submit" name="submit">Update Bio</button>

            </div>

        </form>

        

        <h3  class = "pfp-label" style="color: #007bff; text-align: left; padding-bottom:40px; padding-top:20px;">Your Posts</h3>

        <ul>
            <?php foreach ($user_posts as $post): ?>
                

                    <li style="list-style: none; width:100%; color: #2b2e4a; padding:10px; display: flex; align-items:center;">
                    
                        <div class="user-posts">


                            <b class = "post_title"><?php echo $post['Title']; ?></b>

                            <div class="options-post">

                                <form action="view_post.php" method="GET">
                                    <input type="hidden" name="id" value="<?php echo $post['PostID']; ?>">
                                    <button class = "non-nav-icon" type="submit"><img class = "non-nav-icon-img" src="view.svg"></button>
                                </form>

                                <form action="edit_post.php" method="GET">
                                    <input type="hidden" name="post_id" value="<?php echo $post['PostID']; ?>">
                                    <button class = "non-nav-icon" type="submit"><img class = "non-nav-icon-img" src="edit.svg"></button>
                                </form>
                                
                                <button class = "non-nav-icon" onclick="confirmDelete(<?php echo $post['PostID']; ?>)"><img class = "non-nav-icon-img" src="delete.svg"></button>

                            </div>

                        </div>
                    </li>
               
            <?php endforeach; ?>
        </ul>
        <br>
        <br>
        <br>
        <br>


    </div>


    <script>
    
        function confirmDelete(postId) {
            if (confirm("Are you sure you want to delete this post?")) {
                window.location.href = "delete_post.php?id=" + postId;
            }
        }

    
        function toggleEdituname() {
            var formsContainer = document.getElementById("username");
            if (formsContainer.style.display === "none") {
                formsContainer.style.display = "flex";
            } else {
                formsContainer.style.display = "none";
            }
        }
    

    
            function toggleEditPhoto() {

                var formsContainer = document.getElementById("change_pfp");
                if (formsContainer.style.display === "none") {
                    formsContainer.style.display = "block";
                    
                } else {
                    formsContainer.style.display = "none";
                }
        }


        function toggleShowChangePfp() {
               

                var formsContainer = document.getElementById("change_pfp");
                if (formsContainer.style.display === "none") {
                    formsContainer.style.display = "block";
                    editbtn.style.display = "none";
                } else {
                    formsContainer.style.display = "none";
                    editbtn.style.display = "block";

                }
        }
    </script>

    <script>
        document.getElementById('logo-nav').addEventListener('click', function() {
            var element = document.getElementById('left-navbar');
                if (element.style.display === 'none') {
                        element.style.display = 'block';
                        
                } else {
                        element.style.display = 'none';
                }
            }
        );                    
    </script>

    <script>
        document.getElementById('logo-left-nav').addEventListener('click', function() {
            var element = document.getElementById('left-navbar');
                if (element.style.display === 'none') {
                        element.style.display = 'block';
                        
                } else {
                        element.style.display = 'none';
                }
            }
        );                    
    </script>

</body>

</html>
