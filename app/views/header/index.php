<nav class="navBar">
      <div class="logo-container">
        <img src="<?php echo ROOT_PATH . '/assets/logo.svg';?>" />
        <a href="/mvcExample/public/">Carmen</a>
      </div>
      <ul class="nav-list" id="nav-list">
        <li class="list-item">
          <a href="/mvcExample/public/home/cgu/">CGU</a>
        </li>
        <li class="list-item">
          <a href="/mvcExample/public/home/faq/">FAQ</a>
        </li>
        <li class="list-item">
          <a href="/mvcExample/public/home/contact/">Contact</a>
        </li>
        <li class="list-item">
          <a href="<?php echo $data['link'];?>" class="button-connexion"><?php echo $data['button'];?></a>
        </li>
      </ul>
      <div class="menu" id="toggle-button" onclick="toggleNav()">
        <div class="menu-line-1"></div>
        <div class="menu-line-2"></div>
        <div class="menu-line-3"></div>
      </div>
</nav>

<script>
    function toggleNav() {
      const burgerMenu = document.getElementById("toggle-button");
      const navListe = document.getElementById("nav-list");
      burgerMenu.classList.toggle("change");
      navListe.classList.toggle("active");
    }
</script>