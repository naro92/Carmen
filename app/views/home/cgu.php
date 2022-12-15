<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>CGU</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/faq.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/header.css"; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH .
          "/style/footer.css"; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

  <?php load_header("/header/index", [
    "button" => "Connexion",
    "link" => ROOT_PATH . "/connexion/",
  ]); ?>
  <h1>Conditions Générales d'Utilisation</h1>
  <p class="description-faq">Conditions générales d'utilisations de notre service :</p>
  <div class="cgu-container">
  <div class="cgu">

<h2>Accès au site</h2>
<p>L'accès au site est réservé aux patients, aux familles, aux médecins et aux administrateurs autorisés. L'utilisation de ce site web et des services offerts par ce site web seront soumises à l'acceptation des CGU. Si vous n'acceptez pas les CGU, vous ne pouvez pas accéder à ce site web ou à ses services.</p>

<h2>Utilisation du site</h2>
<p>Vous êtes autorisé à utiliser ce site web uniquement à des fins légales. Vous acceptez de ne pas utiliser ce site web à des fins illégales ou interdites par les CGU.</p>


<h2>Utilisation des informations du site</h2>
<p>Les informations présentes sur le site, telles que les constantes vitales des patients et les bilans médicaux, ne doivent être utilisées qu'à des fins médicales et ne doivent pas être partagées avec des tiers sans l'autorisation des patients concernés.</p>

<h2>Utilisation des fonctionnalités du site</h2>
<p>Les patients et les familles peuvent utiliser les fonctionnalités de discussion avec les médecins pour obtenir des informations médicales ou poser des questions. Les médecins peuvent accéder aux constantes vitales des patients pour suivre leur état de santé. Les administrateurs peuvent gérer les chambres, les capteurs et les patients.</p>

<h2>Responsabilité</h2>
<p>Nous ne sommes pas responsables des dommages causés par l'utilisation incorrecte ou abusive du site ou des informations qu'il contient.</p>

<h2>Modifications des conditions d'utilisation</h2>
<p>Nous nous réservons le droit de modifier ces conditions d'utilisation à tout moment sans préavis.</p>

<h2>Droit applicable</h2>
<p>Les CGU sont régies par les lois de votre pays et les lois applicables.</p>

<h2>Contact</h2>
<p>Si vous avez des questions concernant ces CGU, veuillez nous contacter à l'adresse suivante : contact@hopital.com.</p>


  </div>
</div>

<?php require_once "../app/views/footer/index.php"; ?>
</body>