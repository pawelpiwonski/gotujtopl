<?php

  $showcaseText = 'Twój przepis';

  require_once APPROOT . '/views/inc/header.php';
  require_once APPROOT . '/views/inc/subpage_showcase.php';

?>
  
  <div class="container">
    <div class="wide-form-container">
      <div class="title">Zmień przepis</div>
      <form action="<?= URLROOT . '/recipes/edit/' . $data['id']; ?>" class="my-form" method="POST">
          <div class="form-group">
            <label for="name">Nazwa dania: </label>
            <input type="text" id="name" name="name" value="<?= $data['name']; ?>" maxlength="40">
            <span class="err-text"><?= $data['nameErr']; ?></span>
          </div>
          <div class="form-group">
            <label for="description">Krótki opis: </label>
            <textarea name="description" rows="2" class="short" maxlength="150"><?= $data['description']; ?></textarea>
            <span class="err-text"><?= $data['descriptionErr']; ?></span>
          </div>
          <div class="form-group">
            <label for="ingredients">Składniki (wpisz każdy składnik w nowej linii): </label>
            <textarea name="ingredients" rows="8"><?= $data['ingredients']; ?></textarea>
            <span class="err-text"><?= $data['ingredientsErr']; ?></span>
          </div>
          <div class="form-group">
            <label for="recipe">Sposób przyrządzenia: </label>
            <textarea name="recipe" rows="10"><?= $data['recipe']; ?></textarea>
            <span class="err-text"><?= $data['recipeErr']; ?></span>
          </div>
          <div class="form-group">
            <div>
              <label for="time">Czas przygotowania (min): </label>
              <input type="text" id="time" name="time" maxlength="4" value="<?= $data['time']; ?>">
              <span class="err-text"><?= $data['timeErr']; ?></span>
            </div>
            <div>
              <label for="quantity">Ilość porcji: </label>
              <input type="text" id="quantity" name="quantity" maxlength="2" value="<?= $data['quantity']; ?>">
              <span class="err-text"><?= $data['quantityErr']; ?></span>
            </div>
            <div>
              <label for="category">Kategoria:</label>
              <select name="category">
                <option value="0" <?= $data['category'] == 0 ? 'selected' : '' ?>>dania główne</option>
                <option value="1" <?= $data['category'] == 1 ? 'selected' : '' ?>>przystawki</option>
                <option value="2" <?= $data['category'] == 2 ? 'selected' : '' ?>>zupy</option>
                <option value="3" <?= $data['category'] == 3 ? 'selected' : '' ?>>desery</option>
                <option value="4" <?= $data['category'] == 4 ? 'selected' : '' ?>>pozostałe</option>
              </select>
            </div>
            <div>
              <label for="difficulty">Poziom trundości: </label>
              <select name="difficulty">
                <option value="0" <?= $data['difficulty'] == 0 ? 'selected' : '' ?>>łatwy</option>
                <option value="1" <?= $data['difficulty'] == 1 ? 'selected' : '' ?>>średni</option>
                <option value="2" <?= $data['difficulty'] == 2 ? 'selected' : '' ?>>trudny</option>
              </select>
            </div>
            <div>
              <label for="private">Typ przepisu: </label>
              <select name="private">
                <option value="0" <?= $data['private'] == 0 ? 'selected' : '' ?>>widoczny</option>
                <option value="1" <?= $data['private'] == 1 ? 'selected' : '' ?>>ukryty</option>
              </select>
            </div>
            <div>
              <input type="submit" value="Zapisz zmiany" class="btn btn-2">
            </div>
            <div>
              <a href="<?= URLROOT . '/recipes/show/' . $data['id'] ?>" class="btn btn-3">Anuluj</a>
            </div>
          </div>
        </form>
    </div>
  </div>

<?php require_once APPROOT . '/views/inc/footer.php' ?>