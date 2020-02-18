<section id="home-recipes">
  <div class="<?= userLoggedIn() ? 'container-logged' : 'container'?>">
    <div class="recipe-box main-courses">
      <a href="<?= URLROOT . '/recipes/maincourses' ?>"><span class="span-link">
      <span class="description">Dania<br>Główne</span>
      </span></a>
    </div>
    <div class="recipe-box apetisers">
      <a href="<?= URLROOT . '/recipes/apetisers' ?>"><span class="span-link">
      <span class="description">Przystawki</span>
      </span></a>
    </div>
    <div class="recipe-box soups">
      <a href="<?= URLROOT . '/recipes/soups' ?>"><span class="span-link">
      <span class="description">Zupy</span>
      </span></a>
    </div>
    <div class="recipe-box desserts">
      <a href="<?= URLROOT . '/recipes/desserts' ?>"><span class="span-link">
      <span class="description">Desery</span>
      </span></a>
    </div>
    <div class="recipe-box other">
      <a href="<?= URLROOT . '/recipes/other' ?>"><span class="span-link">
      <span class="description">Pozostałe</span>
      </span></a>
    </div>
    <?php if (userLoggedIn()) { ?>
      <div class="recipe-box user-recipes">
        <a href="<?= URLROOT . '/recipes/userrecipes' ?>"><span class="span-link">
        <span class="description">Twoje<br>Przepisy</span>
        </span></a>
      </div>
    <?php } ?>
  </div>
</section>