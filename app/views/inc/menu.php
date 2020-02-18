<div class="menu">
  <div class="menu-ul">
    <ul>
      <li><a href="<?= URLROOT ?>" class="btn">Strona Główna</a></li>
      <li><a href="<?= URLROOT . '/recipes/index' ?>" class="btn">Przepisy</a></li>
      <?php 
        if (isset($_SESSION['userId'])) {
          echo '<li><a href="' . URLROOT . '/recipes/add" class="btn">Dodaj przepis</a></li>';
          echo '<li><a href="' . URLROOT . '/users/logout" class="btn">Wyloguj</a></li>';
        } else {
          echo '<li><a href="' . URLROOT . '/users/login" class="btn">Logowanie</a></li>';
          echo '<li><a href="' . URLROOT . '/users/register" class="btn">Rejestracja</a></li>';
        }
      ?>
    </ul>
  </div>
</div>