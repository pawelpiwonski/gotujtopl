<?php
  require_once APPROOT . '/views/inc/header.php';
  $showcaseText = 'logowanie';
  require_once APPROOT . '/views/inc/subpage_showcase.php'
?>
  
  <div class="container">
    <div class="form-container">
      <div>Zaloguj się</div>
      <form action="<?= URLROOT.'/users/login'; ?>" class="my-form" method="POST">
        <div class="form-group">
          <label for="login">Login: </label>
          <input type="text" id="login" name="login" value="<?= $data['login']; ?>" class="<?= (!empty($data['loginErr']) ? 'input-err' : ''); ?>">
          <span class="err-text"><?= $data['loginErr']; ?></span>
        </div>
        <div class="form-group">
          <label for="password">Hasło: </label>
          <input type="password" id="password" name="password" value="<?= $data['password']; ?>" class="<?= (!empty($data['passwordErr']) ? 'input-err' : ''); ?>">
          <span class="err-text"><?= $data['passwordErr']; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" value="Zaloguj" class="btn">
            <a href="<?= URLROOT ?>" class="btn btn-2">Anuluj</a>
        </div>
      </form>
    </div>
  </div>

<?php require_once APPROOT . '/views/inc/footer.php' ?>