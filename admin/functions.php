<?php
require_once 'db_connection.php';

// Function to get all users
function getAllUsers() {
    global $conn;
    $sql = "SELECT * FROM Users";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}


// Function to get all posts and their authors
function getAllPosts() {
    global $conn;
    $sql = "SELECT Posts.*, Users.Username FROM Posts JOIN Users ON Posts.UserID = Users.UserID";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get comments by post ID
function getCommentsByPostId($postId) {
    global $conn;
    $sql = "SELECT Comments.*, Users.Username FROM Comments JOIN Users ON Comments.UserID = Users.UserID WHERE PostID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to delete a post by ID
function deletePost($postId) {
    global $conn;
    
    // Delete associated comments first
    $deleteCommentsQuery = "DELETE FROM Comments WHERE PostID = ?";
    $stmt = $conn->prepare($deleteCommentsQuery);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    
    // Then delete the post
    $deletePostQuery = "DELETE FROM Posts WHERE PostID = ?";
    $stmt = $conn->prepare($deletePostQuery);
    $stmt->bind_param("i", $postId);
    $result = $stmt->execute();

    // Return true if deletion was successful, otherwise false
    return $result;
}

?>

