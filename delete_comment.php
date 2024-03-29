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

    // Prepare SQL statement
    $sql = "DELETE FROM comments WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $commentId);
    
    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to the main page after deletion
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    // Close statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Redirect to an error page or handle the case when comment ID is not provided
    header("Location: error.php");
    exit();
}
?>