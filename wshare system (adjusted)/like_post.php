<?php
require_once 'db_connection.php'; // Assuming you have a file for database connection
require_once 'functions.php'; // Assuming you have a file for other functions

session_start();

$id = getUserIdByUsername($_SESSION['username']);

// Main code block to handle the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['like']) && isset($_POST['postID'])) {
        $postID = $_POST['postID'];
        // Perform the like/unlike action
        $likeCount = toggleLike($postID, $id);

        if ($likeCount !== false) {
            // Return the updated like count
            header('location: index.php');
            exit;
            echo json_encode(['success' => true, 'likeCount' => $likeCount]);
        } else {
            // Return an error message if the like action failed
            echo json_encode(['success' => false, 'message' => 'Failed to toggle like status.']);
        }
    } else {
        // Return an error message if post ID or like action is missing
        echo json_encode(['success' => false, 'message' => 'Missing post ID or like action.']);
    }
}

?>