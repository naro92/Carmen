<?php
if(isset($_POST['action']) && $_POST['action'] == 'message') {
  //get message
  $message = $_POST['message'];
  // Save the message to database

  // Get the latest messages from the database
  $query = "SELECT * FROM messages ORDER BY id DESC LIMIT 10";
  $result = mysqli_query($con,$query);
  $messages = array_reverse(mysqli_fetch_all($result));
  // Send the latest messages to the client
  echo json_encode(array(
    'type' => 'messages',
    'messages' => $messages
  ));
  exit;
}

?>
