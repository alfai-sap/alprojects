<?php
require_once 'functions.php';

if (isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];
    
    if (deletePost($postId)) {
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo "Failed to delete post.";
    }
} else {
    echo "Post ID not specified.";
}
?>
