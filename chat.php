<?php

  session_start();
  
    if (!isset($_SESSION['Logged']))
  {
    header('Location: index.html');
    exit();
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>chat</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <header>
    <h1>chat</h1>
    <a href="logout.php">log out!</a>
    <b>Messages will be cleaned once a week!!</b>
    </header>
    <main>

    <div id="container">
    <form id="message-form">
     <label for="user">Username:</label>
     <input type="text" id="user" name="user" value="<?php echo $_SESSION['user']; ?>" disabled>

      <label for="message">Message:</label>
      <input type="text" id="message" name="message" required>

      <button type="submit" id="b2">Send</button>
    </form>

    <div id="message-list"></div>
    </div>
    </main>

    <script>
      $(document).ready(function() {
        // Displaying the list of messages on startup
        fetchMessages();

        // Form support for sending messages
        $("#message-form").submit(function(e) {
          e.preventDefault();
          var user = $("#user").val();
          var message = $("#message").val();
          $.ajax({
            type: "POST",
            url: "post.php",
            data: { user: user, message: message },
            success: function() {
              $("#message-form")[0].reset();
              fetchMessages();
            }
          });
        });

        // Downloading the list of messages every 5 seconds
        setInterval(fetchMessages, 5000);
      });

      // Retrieving the list of messages from the database
      function fetchMessages() {
        $.ajax({
          url: "get.php",
          success: function(data) {
            $("#message-list").html(data);
          }
        });
      }
    </script>
  </body>
</html>

