<?php

  $showcaseText = $data['recipe']->category;

  require_once APPROOT . '/views/inc/header.php';
  require_once APPROOT . '/views/inc/subpage_showcase.php';
  
?>

<section id="recipe">
  <div class="container">
    <div class="recipe-container">
      <div class="user">
        dodany przez: <?= $data['recipe']->user_name ?> 
      </div>
      <div class="name">
        <h2><?= $data['recipe']->name ?></h2>
      </div>
      <div class="ingredients">
        Składniki:
        <ul>
          <?php
            foreach ($data['recipe']->ingredients as $ingredient) {
              echo '<li>' . $ingredient . '</li>';
            }
          ?>
        </ul>
      </div>
      <div class="top-buttons">
        <?php if (isset($_SESSION['userId'])): ?>
          <?php if (!$data['recipe']->favourite): ?>
            <a href="<?= URLROOT . '/recipes/addtofavourites/' . $data['recipe']->id ?>"> dodaj do ulubionych</a>
          <?php else: ?>
            <a href="<?= URLROOT . '/recipes/removefromfavourites/' . $data['recipe']->id ?>"> usuń z ulubionych</a>
          <?php endif; ?>
        <?php endif; ?>
      </div>      
      <div class="description">
        <?= $data['recipe']->description ?>
      </div>
      <div class="details">
        <div>
          Czas przygotowania:
          <span><?= $data['recipe']->time ?> min.</span>
        </div>
        <div>
          Poziom trudności:
          <span><?= $data['recipe']->difficulty ?></span>
        </div>
        <div>
          Szacunkowa ilość:
          <span>dla <?= $data['recipe']->quantity ?> os.</span>
        </div>
      </div>
      <div class="recipe">
        <?= nl2br($data['recipe']->recipe) ?>
      </div>
      <?php if (isset($_SESSION['userId'])): ?>
        <div class="bottom-buttons">
          <ul>
            <?php if ($_SESSION['userId'] == $data['recipe']->user_id): ?>
            <li><a href="<?= URLROOT . '/recipes/edit/' . $data['recipe']->id ?>" class="btn"></i> edytuj przepis</a></li>
            <li>
              <form action="<?= URLROOT . '/recipes/delete/' . $data['recipe']->id; ?>" method="Post">
                <button type="submit" class="btn">
                  usuń przepis
                </button>
              </form>
            </li>
            <?php else: ?>
              <li></li>
              <li></li>
            <?php endif; ?>
            <li><a href="<?= URLROOT . '/recipes' ?>" class="btn">dodaj notatkę</a></li>
          </ul>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require_once APPROOT . '/views/inc/footer.php' ?>