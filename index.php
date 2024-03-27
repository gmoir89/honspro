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
    h1 {
      font-family: "Raleway", sans-serif
    }

    body,
    html {
      height: 100%
    }

    .bgimg {
      background-image: url('/photo.jpg');
      min-height: 100%;
      background-position: center;
      background-size: cover;
    }

    .comment-box {
      background-color: rgba(255, 255, 255, 0.8);
      /* Adjust transparency as needed */
      max-width: 500px;
      margin: 50px auto;
      padding: 20px;
      border-radius: 10px;
    }

    textarea {
      width: 100%;
      height: 100px;
      resize: none;
    }
  </style>
</head>

<body>

  <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
    <div class="w3-display-topleft w3-padding-large w3-xlarge">
      UWS
    </div>
    <div class="w3-display-middle">
      <h1 class="w3-jumbo w3-animate-top">COMING SOON</h1>
      <hr class="w3-border-grey" style="margin:auto;width:40%">
      <p class="w3-large w3-center">Graeme Moir</p>
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
      $conn = mysqli_connect("localhost", "root", "", "hons");

      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      // Fetch comments from database
      $sql = "SELECT * FROM comments ORDER BY created_at DESC";
      $result = mysqli_query($conn, $sql);

      // Display comments
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<strong>" . $row['name'] . "</strong>: " . $row['comment'] . "<br>";
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