<?php
  require_once APPROOT . '/views/inc/header.php';
  $showcaseText = $data['showcaseText'];
  require_once APPROOT . '/views/inc/subpage_showcase.php';
?>

<section id="recipes-category">
  <div class="container">

    <?php 
      foreach ($data as $recipe): 
        if (is_object($recipe)):
    ?>
      
          <div class="recipe-box">
            <div class="recipe">
              <div>
                <h2><a href="<?= URLROOT . '/recipes/show/' . $recipe->id ?>"><?= $recipe->name ?></a></h2>
              </div>
              <div class="details">
                <div>
                  <i class="fas fa-clock"></i> <?= $recipe->time ?> min.
                </div>
                <div class="<?= $recipe->difficultyColor ?>">
                  <i class="fas fa-chart-line"></i> <?= $recipe->difficulty ?>
                </div>
                <div>
                  <?php if ($data['showcaseText'] == "Twoje przepisy"): ?>
                    <i class="fas fa-book-open"></i> <?= $recipe->category ?>
                  <?php else: ?>
                    <i class="fas fa-user"></i> <?= $recipe->user_name ?>
                  <?php endif; ?>
                </div>
              </div>
              <div>
                <p><?= $recipe->description ?></p>
              </div>
            </div>
          </div>

    <?php 
        endif;
      endforeach;
    ?>

  </div>
</section>
  
<?php  require_once APPROOT . '/views/inc/footer.php' ?>