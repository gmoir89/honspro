<!DOCTYPE html>
<html>

<head>
  <title>Landing Page</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <style>
    body,
    h1,
    h2,
    h3,
    small {
      font-family: "Raleway", sans-serif;
      color: white;
      text-align: center;
    }

    body,
    html {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .bgimg {
      background-image: url('/photo.jpg');
      min-height: 100vh;
      background-position: center;
      background-size: cover;
      margin: 0;
      padding-top: 20vh;
      padding-bottom: 20vh;
    }

    .welcome-heading {
      margin-top: 1vh;
    }

    .comment-box {
      background-color: rgba(255, 255, 255, 0.8);
      max-width: 500px; /* Adjust width for smaller screens */
      margin: auto;
      padding: 20px;
      border-radius: 10px;
      height: 50vh; /* Adjust height for smaller screens */
      overflow-y: auto;
      padding-bottom: 10vh; /* Adjust padding for smaller screens */
      color: black;
    }

    .comment-box h2,
    .comment-box h3,
    .comment-box small {
      color: black;
    }

    /* Media Query for smaller screens */
    @media screen and (max-width: 768px) {
      .welcome-heading {
        margin-top: 10px; /* Adjust margin for smaller screens */
      }
      .comment-box {
        max-width: 90%;
        height: 40vh; /* Adjust height for smaller screens */
        padding-bottom: 5vh; /* Adjust padding for smaller screens */
      }
    }
  </style>
</head>

<body>

  <div class="bgimg w3-animate-opacity w3-text-white">
    <h1 class="welcome-heading">Welcome to Graeme's Raspberry Pi</h1>
    <div class="w3-display-topleft w3-padding-large w3-xlarge">
      UWS
    </div>
    <div class="w3-display-bottomleft w3-padding-large">
      Powered by <a href="https://www.raspberrypi.org/" target="_blank">Raspberry Pi</a>
    </div>

    <!-- Comment Box -->
    <div class="comment-box">
      <h2>Comment Section</h2>
      <form action="submit_comment.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="comment">Comment:</label><br>
        <textarea id="comment" name="comment" rows="4" required></textarea><br>
        <button type="submit">Submit</button>
      </form>
      <hr>
      <h3>Comments: </h3>
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

// Delete comment if delete request is received
if (isset($_GET['delete_comment_id']) && is_numeric($_GET['delete_comment_id'])) {
    $deleteCommentId = $_GET['delete_comment_id'];
    $sql = "DELETE FROM comments WHERE id = $deleteCommentId";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php"); // Redirect back to the main page after deletion
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

      // Fetch comments from database
      $sql = "SELECT * FROM comments ORDER BY created_at DESC";
      $result = mysqli_query($conn, $sql);

      // Display comments
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<strong class='comment'>" . $row['name'] . "</strong>: <span class='comment'>" . $row['comment'] . "</span><br>";
          echo " <a href='index.php?delete_comment_id=" . $row['id'] . "'>Delete</a><br>";
          echo "<form action='update_comment.php' method='post'>";
          echo "<input type='hidden' name='comment_id' value='" . $row['id'] . "'>";
          echo "<input type='text' name='updated_comment' value='" . $row['comment'] . "'>";
          echo "<button type='submit'>Update</button>";
          echo "</form>";
          echo "<br>";
          echo "<small>" . $row['created_at'] . "</small><br><br>"; 
        }
      } else {
        echo "No comments yet.";
      }

      // Close database connection
      mysqli_close($conn);
      ?>

    </div>
  </div>

</body>

</html>