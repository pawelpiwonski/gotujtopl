<?php

  $showcaseText = $data['recipe']->category;

  require_once APPROOT . '/views/inc/header.php';
  require_once APPROOT . '/views/inc/subpage_showcase.php';

  // prp($data);

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
    </div>
  </div>
</section>

<?php require_once APPROOT . '/views/inc/footer.php' ?>