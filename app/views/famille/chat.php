<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Chat</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/chat.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

  <?php load_header("/header/index", [
    "button" => "Connexion",
    "link" => "/mvcExample/public/connexion/",
  ]); ?>
  
  <div id="chat-box">
    <ul id="message-list">
      <li id="li-chat">
        <a href="#Page_de_détails_du_médecin"><img width="50px", height="50px" src="chat/tete.png" alt="rien"></a> <a id="a_chat" href="#Page_de_détails_du_médecin"> DR.【Nom】</a>
      </li>
    </ul>
    <input type="text" id="chat-input" placeholder="Enter your message here">
    <button id="chat-button">Send</button>
  </div>
  <script>
    // JavaScript code goes here
    var chatInput = document.getElementById('chat-input');
    var chatButton = document.getElementById('chat-button');

    function updateMessageList(message) {
      // Create a new list item with the message
      var listItem = document.createElement('li');
      listItem.innerText = message;
      // Add the new list item to the message list
      var messageList = document.getElementById('message-list');
      messageList.appendChild(listItem);
    }

    chatButton.addEventListener('click', function() {
      // Send the chat message to the server here
      var message = chatInput.value;
      // Clear the input field
      chatInput.value = '';
      // Update the message list with the new message
      updateMessageList(message);
    });
  </script>

  <?php require_once "../app/views/footer/index.php"; ?>


</body>