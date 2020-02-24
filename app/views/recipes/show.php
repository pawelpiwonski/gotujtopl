<?php

  $showcaseText = $data['recipe']->category;

  require_once APPROOT . '/views/inc/header.php';
  require_once APPROOT . '/views/inc/subpage_showcase.php';

?>

<section id="recipe">
  <div class="container">
    <div class="recipe-container">
      <div class="user-date">
        <?= $data['recipe']->user_name ?> <?= $data['recipe']->created_at ?> 
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
        <?php if(isset($_SESSION['userId'])): ?>
          <a href="<?= URLROOT . '/recipes' ?>"><i class="far fa-star"></i> dodaj do ulubionych</a>
          <a href="<?= URLROOT . '/recipes' ?>"><i class="fas fa-star"></i> usuń z ulubionych</a>
        <?php endif; ?>
      </div>      
      <div class="description">
        <?= $data['recipe']->description ?>
      </div>
      <div class="details">
        <div>
          Czas przygotowania:
          <span><i class="fas fa-clock"></i> <?= $data['recipe']->time ?> min.</span>
        </div>
        <div>
          Poziom trudności:
          <span><i class="fas fa-chart-line"></i> <?= $data['recipe']->difficulty ?></span>
        </div>
        <div>
          Szacunkowa ilość:
          <span><i class="fas fa-utensils"></i> dla <?= $data['recipe']->quantity ?> <?= $data['recipe']->quantity == 1 ? 'osoby' : 'osób' ?></span>
        </div>
      </div>
      <div class="recipe">
        <?= nl2br($data['recipe']->recipe) ?>
      </div>
      <?php if(isset($_SESSION['userId'])): ?>
        <div class="bottom-buttons">
          <ul>
            <?php if($_SESSION['userId'] == $data['recipe']->user_id): ?>
            <li><a href="<?= URLROOT . '/recipes' ?>" class="btn"><i class="far fa-edit"></i> edytuj przepis</a></li>
            <li>
              <form action="<?= URLROOT . '/recipes/delete/' . $data['recipe']->id; ?>" method="Post">
                <button type="submit" class="btn">
                  <i class="far fa-trash-alt"></i> usuń przepis
                </button>
              </form>
            </li>
            <?php else: ?>
              <li></li>
              <li></li>
            <?php endif; ?>
            <li><a href="<?= URLROOT . '/recipes' ?>" class="btn"><i class="far fa-comment-alt"></i> dodaj notatkę</a></li>
          </ul>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require_once APPROOT . '/views/inc/footer.php' ?>