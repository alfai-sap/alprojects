<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <style>
        body {
            font-family: inter;
            margin: 0;
            padding: 0;

            background-color: #e1ebed;
        }
        
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f0f1f1;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            color: #007bff;
        }
        
        form {
            margin-top: 20px;
        }
        
        label {
            padding-top: 30px;
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color:#007bff;
        }
        
        input[type="text"],
        textarea {
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
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px;
        }
        
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Your Post</h1>
        <?php
            // Check if the post ID is provided in the URL
            if (isset($_GET['post_id'])) {
                $postID = $_GET['post_id'];

                // Fetch post details from the database
                // Include your database connection script
                require_once 'db_connection.php';

                $query = "SELECT * FROM Posts WHERE PostID = '$postID'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $post = mysqli_fetch_assoc($result);
        ?>

        <form action="edit_post_process.php" method="post">
            <input type="hidden" name="post_id" value="<?php echo $post['PostID']; ?>">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" value="<?php echo $post['Title']; ?>" readonly><br>
            <label for="content">Content:</label><br>
            <textarea id="content" name="content" rows="4" cols="50"><?php echo $post['Content']; ?></textarea><br>
            <input type="submit" value="Save Changes">
        </form>
        
        <?php
            } else {
                echo "Post not found.";
            }

            // Close database connection
            mysqli_close($conn);
            } 
            
            else 
            
            {
                echo "Post ID not provided.";
            }
        ?>

    </div>
</body>
</html>
