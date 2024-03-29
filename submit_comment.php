<?php
// Connect to MySQL database
$conn = mysqli_connect("localhost", "root", "p]*(q/7QfB.LmlOY", "hons");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare SQL statement
    $sql = "INSERT INTO comments (name, comment) VALUES (?, ?)";
    
    // Prepare the SQL statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $name, $comment);

        // Set parameters and execute the statement
        $name = $_POST["name"];
        $comment = $_POST["comment"];
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php"); // Redirect back to the main page after submission
            exit();
        } else {
            echo "Error: Unable to execute statement.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Unable to prepare statement.";
    }
}

// Close database connection
mysqli_close($conn);
?>