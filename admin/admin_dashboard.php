<?php
require_once 'db_connection.php';

$sort_order_posts = 'asc'; // Default value for sorting forum posts
$sort_order_comments = 'asc'; // Default value for sorting comments

function sort_order($sort_order) {
    return ($sort_order === 'desc') ? 'DESC' : 'ASC';
}

$row_limit = isset($_POST['row_limit']) ? $_POST['row_limit'] : 10; // Default row limit is 10

// Search functionality for user profiles
if (isset($_POST['search_user'])) {
    $search_term = $_POST['search_term'];
    $user_sql = "SELECT Users.UserID, Users.Username, Users.Email, 
            COUNT(DISTINCT Posts.PostID) AS PostsCount, COUNT(DISTINCT Comments.CommentID) AS CommentsCount
            FROM Users 
            LEFT JOIN Posts ON Users.UserID = Posts.UserID 
            LEFT JOIN Comments ON Users.UserID = Comments.UserID 
            WHERE Users.Username LIKE '%$search_term%'
            OR Users.Email LIKE '%$search_term%'
            GROUP BY Users.UserID";
} else {
    $user_sql = "SELECT Users.UserID, Users.Username, Users.Email, 
            COUNT(DISTINCT Posts.PostID) AS PostsCount, COUNT(DISTINCT Comments.CommentID) AS CommentsCount
            FROM Users 
            LEFT JOIN Posts ON Users.UserID = Posts.UserID 
            LEFT JOIN Comments ON Users.UserID = Comments.UserID 
            GROUP BY Users.UserID";
}

$sort_users = isset($_POST['sort_users']) ? $_POST['sort_users'] : 'username';
$sort_order_users = isset($_POST['sort_order_users']) ? $_POST['sort_order_users'] : 'asc';
$sort_order_users = sort_order($sort_order_users);

// Apply sorting
$user_sql .= " ORDER BY $sort_users $sort_order_users";

// Add limit to user query
$user_sql .= " LIMIT $row_limit";

$user_profiles_result = $conn->query($user_sql);

// Display user profiles in table rows
$user_profiles = [];
if ($user_profiles_result->num_rows > 0) {
    while ($row = $user_profiles_result->fetch_assoc()) {
        $user_profiles[] = $row;
    }
}

// Search functionality for forum posts
if (isset($_POST['search_forum'])) {
    $search_post = $_POST['search_post'];
    $post_sql = "SELECT Posts.PostID, Posts.UserID, Users.Username, Posts.Title, Posts.Content, Posts.CreatedAt
            FROM Posts 
            LEFT JOIN Users ON Posts.UserID = Users.UserID 
            WHERE (Posts.Title LIKE '%$search_post%' OR Posts.Content LIKE '%$search_post%')";
    
    // Add condition to filter posts by searched user's ID if available
    if (!empty($search_username)) {
        $post_sql .= " AND Users.Username = '$search_username'";
    }
} else {
    $post_sql = "SELECT Posts.PostID, Posts.UserID, Users.Username, Posts.Title, Posts.Content, Posts.CreatedAt
            FROM Posts 
            LEFT JOIN Users ON Posts.UserID = Users.UserID";
}

// Apply sorting
$post_sql .= " ORDER BY Posts.CreatedAt $sort_order_posts";

// Add limit to post query
$post_sql .= " LIMIT $row_limit";

$forum_posts_result = $conn->query($post_sql);

// Display forum posts in table rows
$forum_posts = [];
if ($forum_posts_result->num_rows > 0) {
    while ($row = $forum_posts_result->fetch_assoc()) {
        $forum_posts[] = $row;
    }
}

// Search functionality for comments
if (isset($_POST['search_comments'])) {
    $search_comment = $_POST['search_comment'];
    $comment_sql = "SELECT Comments.CommentID, Comments.PostID, Comments.UserID, Users.Username, Comments.Content, Comments.CreatedAt
            FROM Comments 
            LEFT JOIN Users ON Comments.UserID = Users.UserID 
            WHERE Comments.Content LIKE '%$search_comment%'";
    
    // Add condition to filter comments by searched user's ID if available
    if (!empty($search_username)) {
        $comment_sql .= " AND Users.Username = '$search_username'";
    }
} else {
    $comment_sql = "SELECT Comments.CommentID, Comments.PostID, Comments.UserID, Users.Username, Comments.Content, Comments.CreatedAt
            FROM Comments 
            LEFT JOIN Users ON Comments.UserID = Users.UserID";
}

// Apply sorting
$comment_sql .= " ORDER BY Comments.CreatedAt $sort_order_comments";

// Add limit to comment query
$comment_sql .= " LIMIT $row_limit";

$comments_result = $conn->query($comment_sql);

// Display comments in table rows
$comments = [];
if ($comments_result->num_rows > 0) {
    while ($row = $comments_result->fetch_assoc()) {
        $comments[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #007bff;
            text-align: left;
            padding: 8px;
        }

        th {
            color: #F0F1F1;
            background-color: #007bff;
        }

        h1 {
            margin: 0;
            text-align: center;
            width: 100%;
            height: 100px;
            background-color: #007bff;
            color: #F0F1F1;
            font-size: 50px;
            font-weight: bold;
            padding-top: 20px;
        }

        h2{
            color: #007bff;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        .searchbar {
            width: 500px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .sbtn {
            background-color: #007bff;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100px;
        }

        button.delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button.delete-btn:hover {
            background-color: #c82333;
        }

    </style>
</head>
<body style="background-color: #F0F1F1;">

    <h1>Wshare Admin Dashboard</h1>

    <h2>User Profiles</h2>
            <form method="post">

                <input class="searchbar" type="text" name="search_term" placeholder="Search by username or email"> <!-- Update name to search_term -->
                <button class="sbtn" type="submit" name="search_user">Search</button>
                <button class="sbtn" type="submit" name="refresh">Refresh</button>
                <br>
                <label for="sort_users" style = "color:#007bff;">Sort by:</label>
                <select id="sort_users" name="sort_users">
                    <option value="username">Username</option>
                    <option value="created_at">Created At</option>
                </select>
                <select name="sort_order_users">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <button class="sbtn" type="submit" name="sort_user" style = "border-radius: 50px;">Sort</button>
                
                <br>
                <label for="row_limit" style = "color:#007bff;">Row Limit:</label>
                <select id="row_limit" name="row_limit">

                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>

                </select>

            </form>

            <br>
            
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Posts Count</th>
            <th>Comments Count</th>
            <th>Action</th>
        </tr>
        <?php foreach ($user_profiles as $user_profile): ?>
            <tr>
                <td><?= $user_profile['UserID'] ?></td>
                <td><?= $user_profile['Username'] ?></td>
                <td><?= $user_profile['Email'] ?></td>
                <td><?= $user_profile['PostsCount'] ?></td>
                <td><?= $user_profile['CommentsCount'] ?></td>
                <td><a href='#'>Disable</a> | <a href='#'>Enable</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Forum Posts</h2>
    <form method="post">
        <input class="searchbar" type="text" name="search_post" placeholder="Search by title">
        <button class="sbtn" type="submit" name="search_forum">Search</button>
    </form>
    <table>
        <tr>
            <th>Post ID</th>
            <th>User ID</th>
            <th>Username</th>
            <th>Title</th>
            <th>Content</th>
            <th>Created At</th>
        </tr>
        <?php foreach ($forum_posts as $forum_post): ?>
            <tr>
                <td><?= $forum_post['PostID'] ?></td>
                <td><?= $forum_post['UserID'] ?></td>
                <td><?= $forum_post['Username'] ?></td>
                <td><?= $forum_post['Title'] ?></td>
                <td><?= $forum_post['Content'] ?></td>
                <td><?= $forum_post['CreatedAt'] ?></td>
                <td>
                <form action="delete_post.php" method="POST" onsubmit="return confirmDelete();">
                    <input type="hidden" name="post_id" value="<?= $forum_post['PostID'] ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Comments</h2>
    <form method="post">
        <input class="searchbar" type="text" name="search_comment" placeholder="Search by content">
        <button class="sbtn" type="submit" name="search_comments">Search</button>
    </form>
    <table>
        <tr>
            <th>Comment ID</th>
            <th>Post ID</th>
            <th>User ID</th>
            <th>Username</th>
            <th>Content</th>
            <th>Created At</th>
        </tr>
        <?php foreach ($comments as $comment): ?>
            <tr>
                <td><?= $comment['CommentID'] ?></td>
                <td><?= $comment['PostID'] ?></td>
                <td><?= $comment['UserID'] ?></td>
                <td><?= $comment['Username'] ?></td>
                <td><?= $comment['Content'] ?></td>
                <td><?= $comment['CreatedAt'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


    <script>
        function confirmDelete() {
            var result = confirm("Are you sure you want to delete this post?");
            if (result) {
                // User confirmed, submit the form
                return true;
            } else {
                // User canceled, do nothing
                return false;
            }
        }
    </script>


</body>
</html>
