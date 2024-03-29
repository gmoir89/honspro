<?php
// Check if comment ID and updated comment content are provided via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment_id']) && isset($_POST['updated_comment'])) {
    $commentId = $_POST['comment_id'];
    $updatedComment = $_POST['updated_comment'];

    // Connect to MySQL database
    $conn = mysqli_connect("localhost", "root", "p]*(q/7QfB.LmlOY", "hons");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement
    $sql = "UPDATE comments SET comment = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "si", $updatedComment, $commentId);
    
    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to the main page after update
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Redirect to an error page or handle the case when comment ID or updated comment are not provided
    header("Location: error.php");
    exit();
}
?>