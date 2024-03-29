<?php
// Check if comment ID is provided via GET request
if (isset($_GET['comment_id']) && is_numeric($_GET['comment_id'])) {
    $commentId = $_GET['comment_id'];

    // Connect to MySQL database
    $conn = mysqli_connect("localhost", "root", "p]*(q/7QfB.LmlOY", "hons");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete comment from database
    $sql = "DELETE FROM comments WHERE id = $commentId";
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the main page after deletion
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Redirect to an error page or handle the case when comment ID is not provided
    header("Location: error.php");
    exit();
}
?>