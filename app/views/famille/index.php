<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Famille</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/famille.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

  <?php load_header("/header/index", [
    "button" => "Deconnexion",
    "link" => "/public/connexion/deconnexion",
  ]); ?>
  <div class="bvn">
      <div class="message_bvn">
        <h1>
          Bienvenue <br />
          <?php echo $data["prenom"]; ?>
        </h1>
        <p>Votre tableau de bord pour accéder à toutes nos fonctionnalités</p>
      </div>
      <div class="img_bvn">
        <img src="<?php echo ROOT_PATH . "/assets/hp.png"; ?>" />
      </div>
    </div>

    <div class="bilan_container">
      <div class="titre-container">
        <div class="main_text">
          <h1>Bilans quotidiens</h1>
          <p>accédez aux bilans de santé de <br />[nom] grâce à Carmen</p>
          <a href="/public/famille/rapports" class="button_bilan">Bilans</a>
        </div>
      </div>
      <div class="description-container">
        <div class="card-description">
          <img src="<?php echo ROOT_PATH . "/assets/bilan_3.png"; ?>" />
          <p>• Un hôpital connecté grâce aux outils du numérique</p>
          <p>• Une solution adapté pour la famille et les médecins</p>
        </div>
        <div class="card-description">
          <img src="<?php echo ROOT_PATH . "/assets/bilan_1.png"; ?>" />
          <p>• Des bilans mis à jours régulièrement</p>
          <p>• Des médecins à votre disposition</p>
        </div>
        <div class="card-description">
          <img src="<?php echo ROOT_PATH . "/assets/bilan_2.png"; ?>" />
          <p>• Une solution quand vous ne pouvez pas vous déplacer</p>
          <p>• Une communication plus rapide avec l'hôpital</p>
        </div>
      </div>
    </div>

    <div class="chat_container">
      <div class="info_chat">
        <div class="info_chat_1">
          <div class="title_container">
            <h1>Chat en direct</h1>
          </div>
          <p>Une question sur un bilan de <br />santé?</p>
          <p>Accédez au chat en direct avec <br />le médecin traitant</p>
        </div>
        <p>Un moyen efficace de rentrer en contact avec l'hôpital</p>
        <hr />
      </div>
      <div class="img_chat">
        <img src="<?php echo ROOT_PATH . "/assets/chat.png"; ?>" />
        <a href="#chat" class="button_chat">Chat</a>
      </div>
    </div>

    <div class="faq_container">
      <div class="title_container">
        <h1>Foire aux questions</h1>
        <img src="<?php echo ROOT_PATH . "/assets/faq1.png"; ?>" />
      </div>
      <div class="faq_info_container">
        <h1>Une question?</h1>
        <p>Accédez à notre FAQ</p>
        <p id="faq_p">
          Des sujets diverses et variées sur le monde hospitalier
        </p>
        <hr />
        <div class="button_container">
          <a href="/public/home/faq" class="button_faq">FAQ</a>
          <img src="<?php echo ROOT_PATH . "/assets/faq2.png"; ?>" />
        </div>
      </div>
    </div>

    <?php require_once "../app/views/footer/index.php"; ?>

</body>