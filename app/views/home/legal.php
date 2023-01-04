<?php
function load_header($view, $data = [])
{
  require_once "../app/views/" . $view . ".php";
} ?>

<head>
        <title>Mentions légales</title>
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
  "button" => ucfirst($data["dashboard"]),
  "link" => ROOT_PATH . "/" . $data["dashboard"],
]); ?>
  <div class="legal-notice">
      <h1>Mentions légales</h1>
      <p>
        Propriétaire et éditeur du site : SSH<br>
        Adresse : 10 rue de Vanve<br>
        Téléphone : 0123456789<br>
        Email : contact@carmen.wstr.fr
      </p>
      <p>
        Directeur de la publication : [Nom et prénom du directeur de la publication]
      </p>
      <p>
        Nom du site : Carmen
      </p>
      <p>
        Hébergeur du site : WebStrator<br>
        Adresse : 141 avenue de Lavaur 81100 Castres
      </p>
      <p>
        Le site est destiné aux administrateurs, au personnel hospitalier, aux patients et aux familles.
      </p>
      <p>
        Conformément au Règlement général sur la protection des données (RGPD), nous vous informons que ce site ne fait pas usage de cookies. Cependant, le site internet peut collecter des données personnelles telles que le nom, prénom, date de naissance, adresse e-mail. Ces données sont sécurisée et peuvent être transmises à l'hopital utilisant notre service.
      </p>
      <p>
        Les informations contenues sur ce site sont fournies en toute bonne foi et sont censées être exactes au moment de leur publication. Toutefois, nous ne pouvons garantir l'exactitude, la complétude ou l'actualité des informations. Nous vous conseillons de vérifier l'exactitude et l'actualité des informations auprès de nous ou de la source indiquée.
      </p>
      <p>
        Le contenu de ce site est protégé par la législation en vigueur sur les droits d'auteur et la propriété intellectuelle. Toute reproduction, modification, diffusion ou utilisation du contenu de ce site à des fins commerciales ou non commerciales est interdite sans l'autorisation préalable et écrite de SSH.
      </p>
      <p>
        Le site peut contenir des liens vers des sites tiers. Nous n'avons aucun contrôle sur le contenu de ces sites et déclinons toute responsabilité quant à leur contenu. L'inclusion de liens vers ces sites ne signifie pas que nous approuvons leur contenu.
      </p>
    </div>

    <?php require_once "../app/views/footer/index.php"; ?>

</body>