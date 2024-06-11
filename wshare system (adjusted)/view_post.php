<?php
require_once "functions.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <style>

        *{
            margin: 0;
            padding: 0;
        }

        body {
            font-family: inter;
            background-color: #e1ebed;
            color: #007bff;
            
        }
        
        .container {
            width: 90%;
            margin-left:70px;
            margin-right: 70px;
            padding: 20px;
            background-color: #f0f1f1;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h1, h2, h3, h4, h5, h6 {
            color: #007bff;
        }
        
        .post {
            background-color: #f0f1f1;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .post h3 {
            text-align: center;
            font-size: x-large;
            margin-top: 0;
            margin-bottom: 10px;
        }
        
        .post-content{
            margin-top: 30px;
            color: black;
            margin-bottom: 10px;
            text-align: justify;
        }
        
        .author-info {
            display: flex;
            padding-bottom:30px ;
        }
        
        .author_pic{
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        .authorname{
            color:#007bff;
            font-size: large;
            font-weight: bold;
        }
        
        .timestamp {
            font-size: small;
            opacity: 40%;
            color: black;
        }
        
        .comments {
            background-color: #e1ebed;
            border-radius: 5px;
            padding: 20px;
        }
        
        .commentcontent{
            opacity: 50%;
            text-align: justify;
            color: black;
            margin-bottom: 10px;
            padding: 10px;
        }
        
        .comment-form textarea {
            width: 100%;
            height: 50px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
        }
        
        .comment-form input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        
        .comment-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /*para sa like */
        .like-btn {
            background-color: transparent;
            border: none;
            color: #007bff;
            cursor: pointer;

            transition: 0.4s ease;
        }

        /* Style for like count */
            .like-count {
                opacity: 70%;
                color: #007bff;

            }

            /* Style for like section */
            .lik{
                display: flex;
                align-items: center;
            }

            .bulb:hover{
                height: 30px;
                width: 30px;
            }

            .bulb{
                width: 25px;
                height: 25px;
                padding: 10px;
                transition: 0.4s ease;
            }

        .reply-btn, .shw {
            color: #007bff;
            border: none;
            cursor: pointer;
            background: none;
        }

        .replies {
            padding-left: 20px;
        }

        .reply-form {
            display: flex;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .reply-form textarea {
            width: 96%;
            height: 30px; /* Adjust height as needed */
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            resize: vertical; /* Allow vertical resizing */
        }

        .reply-form input[type="submit"] {
            float: right;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            display: block; /* Ensure button is displayed as block element */
        
        }

        .reply-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .icons{
            padding: 10px;
            height: 20px;
            width: 20px;
        }

        .replylabels{
            display: flex;
        }

        /* Style for back button */
    </style>
</head>
<body>

<div class="container">

    <a class = "backButton" id ="backButton"><div class = "back" style = "display:flex; margin-left:10px;">
        
            <img class = "icons" src = "signoff.svg">
            <p class = "back-label" style="padding-top:10px;color:#007bff">Back</p>
        
    </div></a>

<?php


// Check if post ID is provided in the URL
if (isset($_GET['id'])) {

    $postId = $_GET['id'];
    $post = getPostById($postId);
    $comments = getCommentsByPostId($postId);
    $userProfile = getUserProfileById($post['UserID']);
    $profilePic = $userProfile['ProfilePic'];

    // Display post details
    echo '<div class="post">';

    
        echo '<div class="author-info">';

        
                if (!empty($profilePic)) {
                    echo '<img class = "author_pic" src="' . $profilePic . '" alt="Profile Picture">';
                } else {
                    echo '<img class = "author_pic" src="default_pic.svg" alt="Profile">';
                }

                echo '<div class = "unametime" style = "display:flex; flex-direction: column;">';
                    echo '<p class = "authorname">' . $post['Username'] . '</p>';
                    echo '<p class="timestamp">Posted at: ' . $post['CreatedAt'] . '</p>';
                echo '</div>';

                

        echo '</div>';

        
        echo '<h3>' . $post['Title'] . '</h3>';
        echo '<p class = "post-content">' . $post['Content'] . '</p>';

                                echo '<div class = "lik">';

                                    echo '<form class = "like" action="like_post.php" method="POST">';

                                        echo '<input type="hidden" name="postID" value="' . $post['PostID'] . '" >';

                                        echo '<button type="submit" class="like-btn" name="like"><img class = "bulb" src ="bulb.svg"></button>';

                                    echo '</form>';

                                    echo '<span class="like-count">' . getLikeCount($post['PostID']) . '</span>';

                                    $num_comm = countComments($post['PostID']);

                                    echo '<button class ="like-btn"><img class = "bulb" src = "comment.svg"></button>';

                                    echo '<span class = "like-count"> '. $num_comm .'</span>';
                                    
                                echo '</div>';
        
        echo '</div>';

        // Display comments
        if ($comments) {
            
            echo '<div class="comments">';
                echo '<h4>Comments</h4>';
                foreach ($comments as $comment) {

                    echo '<div class="comment">';
                        echo '<div class="comments_author" style="display: flex; align-items: center;">';
                        echo '<img src="' . $comment['ProfilePic'] . '" style="width: 25px; height:25px; border-radius:50%;">';
                        echo '<p class = "commentcontent"><strong>' . $comment['Username'] . ':</strong> ' . $comment['Content'] . '</p>';
                    echo '</div>';
                    

                    $replies = getRepliesByCommentId($comment['CommentID']);

                    if ($replies) {
                        
                            echo '<button class="shw" data-comment-id="' . $comment['CommentID'] . '"><img class = "bulb" src = "chats.svg"></button>';
                            
                        
                        echo '<div class="replies" style="display: none;">';

                            foreach ($replies as $reply) {
                                
                                echo '<div class="comments_author" style="display: flex; align-items: center;">';
                                    echo '<img src="' . $reply['ProfilePic'] . '" style="width: 25px; height:25px; border-radius:50%;">';
                                    echo '<p><strong>' . $reply['Username'] . ':</strong> ' . $reply['Content'] . '</p>';
                                echo '</div>';
                            }

                        echo '</div>';
                    }

                    echo '<button class="reply-btn" data-comment-id="' . $comment['CommentID'] . '"><img class = "bulb" src = "reply.svg">reply</button>';

                    if (isset($_SESSION['username'])) {
                        
                        
                        echo '<form class="reply-form" style="display: none;" action="reply_process.php" method="POST">
                            <input type="hidden" name="comment_id" value="' . $comment['CommentID'] . '">
                            <textarea name="content" placeholder="Your reply..." required></textarea>
                            <input type="submit" value="Reply">
                        </form>';
                    }

                    // Fetch and display replies for the comment 
                    echo '</div>';
                }
        echo '</div>';
    }

    // Add comment form if user is logged in
    if (isset($_SESSION['username'])) {

        echo '<form class="comment-form" action="comment_for_view_post.php" method="POST">';
            echo '<input type="hidden" name="post_id" value="' . $postId . '">';
            echo '<textarea name="content" placeholder="Comment..." required></textarea>';
            echo '<input type="submit" id = "Comment" value="Comment">';
        echo '</form>';

    } else {

        echo '<p>Please <a href="login.php">login</a> to comment.</p>';
    }

} else {
    // Handle case where post ID is not provided
    echo '<p>Comment Uploaded.</p>';
}
?>

</div>

<script>
    // JavaScript to toggle reply form visibility
    document.querySelectorAll('.reply-btn').forEach(button => {
        button.addEventListener('click', function() {
            const replyForm = this.nextElementSibling;
            if (replyForm.style.display === 'none') {
                replyForm.style.display = 'block';
            } else {
                replyForm.style.display = 'none';
            }
        });
    });

    // JavaScript to toggle replies visibility
</script>

<script>
    document.querySelectorAll('.shw').forEach(button => {
        button.addEventListener('click', function() {
            const replies = this.parentNode.querySelector('.replies');
            if (replies.style.display === 'none' || replies.style.display === '') {
                replies.style.display = 'block';
            } else {
                replies.style.display = 'none';
            }
        });
    });
</script>

<script>
    // JavaScript to handle back button functionality
    document.getElementById('backButton').addEventListener('click', function() {
        // Go back in browser history
        window.history.back();
    });
</script>

</body>
</html>
