<?php
  require_once APPROOT . '/views/inc/header.php';
  $showcaseText = 'rejestracja';
  require_once APPROOT . '/views/inc/subpage_showcase.php'
?>
  
  <div class="container">
    <div class="form-container">
      <div>Nowe konto</div>
      <form action="<?= URLROOT.'/users/register'; ?>" class="my-form" method="POST">
        <div class="form-group">
          <label for="login">Login: </label>
          <input type="text" id="login" name="login" value="<?= $data['login']; ?>" class="<?= (!empty($data['loginErr']) ? 'input-err' : ''); ?>">
          <span class="err-text"><?= $data['loginErr']; ?></span>
        </div>
        <div class="form-group">
          <label for="email">Email: </label>
          <input type="email" id="email" name="email" value="<?= $data['email']; ?>" class="<?= (!empty($data['emailErr']) ? 'input-err' : ''); ?>">
          <span class="err-text"><?= $data['emailErr']; ?></span>
        </div>
        <div class="form-group">
          <label for="password">Hasło: </label>
          <input type="password" id="password" name="password" value="<?= $data['password']; ?>" class="<?= (!empty($data['passwordErr']) ? 'input-err' : ''); ?>">
          <span class="err-text"><?= $data['passwordErr']; ?></span>
        </div>
        <div class="form-group">
          <label for="confirm_password">Potwierdź hasło: </label>
          <input type="password" id="confirm_password" name="confirm_password" value="<?= $data['confirm_password']; ?>" class="<?= (!empty($data['confirm_passwordErr']) ? 'input-err' : ''); ?>">
          <span class="err-text"><?= $data['confirm_passwordErr']; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" value="Utwórz konto" class="btn">
            <a href="<?= URLROOT ?>" class="btn btn-2">Anuluj</a>
        </div>
      </form>
    </div>
  </div>

<?php require_once APPROOT . '/views/inc/footer.php' ?>