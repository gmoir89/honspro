<?php
// Connect to MySQL database
$conn = mysqli_connect("localhost", "root", "p]*(q/7QfB.LmlOY", "hons");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $comment = $_POST["comment"];

    // Insert comment into database
    $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php"); // Redirect back to the main page after submission
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>