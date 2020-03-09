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
        <div class="add-note">
          <form action="<?= URLROOT . '/recipes/editnote/' . $data['recipe']->id ; ?>" class="my-form" method="POST">
            <div class="note">
              <label for="note">Twoja notatka: </label>
              <textarea name="note" rows="8"><?= $data['recipe']->note ?></textarea>
              <span class="err-text"><?= $data2['noteErr']; ?></span>
            </div>
            <div class="add-note-button">
              <input type="submit" value="Zapisz" class="btn">
            </div>
            <div class="cancel-note-button">
              <a href="<?= URLROOT . '/recipes/show/' . $data['recipe']->id ?>" class="btn">Anuluj</a>
            </div>
          </form>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require_once APPROOT . '/views/inc/footer.php' ?>