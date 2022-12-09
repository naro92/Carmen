<?php
function load_header($view, $data = []){
        require_once '../app/views/' . $view . '.php';
    }
?>

<head>
        <title>CGU</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH . '/style/faq.css'; ?>" />
        <link rel="stylesheet" href="<?php echo ROOT_PATH . '/style/header.css'; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

  <?php load_header('/header/index', ['button' => 'Connexion', 'link' => ROOT_PATH . '/connexion/']); ?>
  <h1>Conditions Générales d'Utilisation</h1>
  <p class="description-faq">Conditions générales d'utilisations de notre service :</p>
  <div class="cgu-container">
  <div class="cgu">
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at sollicitudin odio. Vestibulum sed facilisis lorem. Proin condimentum, metus scelerisque euismod pellentesque, quam nunc laoreet dui, a molestie velit neque id massa. Cras purus lorem, cursus quis orci interdum, maximus ullamcorper nulla. Donec convallis nisi in rutrum venenatis. Sed commodo, arcu vitae condimentum placerat, eros eros fringilla purus, at placerat lectus nisi eu leo. Mauris dignissim risus a dui luctus, in ultrices tellus elementum. Phasellus facilisis enim vitae pulvinar bibendum. Ut condimentum et tellus vel aliquet. Nulla facilisi. Maecenas sagittis ligula sit amet risus gravida porttitor. Aenean sollicitudin fringilla porttitor. Etiam posuere nisl et facilisis rutrum. Praesent et volutpat magna.

Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque hendrerit elementum nunc, nec tincidunt diam faucibus ac. Vestibulum at enim ullamcorper, gravida ante hendrerit, ornare enim. Sed eleifend dui vel risus ornare, eget varius tellus commodo. Maecenas non interdum leo. Phasellus vel augue ut quam efficitur eleifend in sit amet lacus. Nam at blandit felis. Curabitur a dolor eu ex vulputate maximus eu non velit. Nam eget lacus ut ligula ultricies cursus in consequat mauris. Sed nec pulvinar enim, ac auctor lectus. Donec mi mauris, viverra id nisi ac, ullamcorper malesuada dui. Vivamus scelerisque mauris ut mollis eleifend. Proin tempor elit libero. Proin dolor enim, elementum eget pulvinar feugiat, mattis ac erat.

Etiam ac eros sit amet turpis placerat aliquam. In vitae cursus metus. Duis ultricies nisi non tempus tempus. Maecenas scelerisque bibendum magna nec blandit. Pellentesque aliquam aliquam libero, sed maximus eros malesuada vitae. Pellentesque condimentum odio varius iaculis maximus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur et mauris orci. Donec mattis, tellus at fermentum sagittis, orci odio scelerisque odio, a facilisis sapien diam vel neque. Etiam a risus massa. Fusce purus lectus, scelerisque ut est ut, imperdiet rhoncus nisl. Aliquam non elementum urna. Mauris non porta odio. Nam nec tincidunt eros. Fusce egestas est eu urna cursus, sit amet laoreet quam malesuada.
  </div>
</div>

<?php require_once "../app/views/footer/index.php"; ?>
</body>