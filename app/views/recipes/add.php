<?php

  $showcaseText = 'nowy przepis';

  require_once APPROOT . '/views/inc/header.php';
  require_once APPROOT . '/views/inc/subpage_showcase.php';

?>
  
  <div class="container">
    <div class="wide-form-container">
      <div class="title">Dodaj przepis</div>
      <form action="<?= URLROOT . '/recipes/add'; ?>" class="my-form" method="POST">
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
              <label for="quantity">Ilość: </label>
              <select name="quantity">
                <option value="1" <?= $data['selectQuantity'][0] ?>>dla 1 osoby</option>
                <option value="2" <?= $data['selectQuantity'][1] ?>>dla 2 osób</option>
                <option value="3" <?= $data['selectQuantity'][2] ?>>dla 3 osób</option>
                <option value="4" <?= $data['selectQuantity'][3] ?>>dla 4 osób</option>
                <option value="5" <?= $data['selectQuantity'][4] ?>>dla 5 osób</option>
                <option value="6" <?= $data['selectQuantity'][4] ?>>dla 6 osób</option>
                <option value="7" <?= $data['selectQuantity'][4] ?>>dla 7 osób</option>
                <option value="8" <?= $data['selectQuantity'][4] ?>>dla 8 osób</option>
                <option value="9" <?= $data['selectQuantity'][4] ?>>dla 9 osób</option>
                <option value="10" <?= $data['selectQuantity'][4] ?>>dla 10 osób</option>
              </select>
            </div>
            <div>
              <label for="category">Kategoria:</label>
              <select name="category">
                <option value="0" <?= $data['selectCategory'][0] ?>>dania główne</option>
                <option value="1" <?= $data['selectCategory'][1] ?>>przystawki</option>
                <option value="2" <?= $data['selectCategory'][2] ?>>zupy</option>
                <option value="3" <?= $data['selectCategory'][3] ?>>desery</option>
                <option value="4" <?= $data['selectCategory'][4] ?>>pozostałe</option>
              </select>
            </div>
            <div>
              <label for="difficulty">Poziom trundości: </label>
              <select name="difficulty">
                <option value="0" <?= $data['selectDifficulty'][0] ?>>łatwy</option>
                <option value="1" <?= $data['selectDifficulty'][1] ?>>średni</option>
                <option value="2" <?= $data['selectDifficulty'][2] ?>>trundy</option>
              </select>
            </div>
            <div>
              <label for="private">Typ przepisu: </label>
              <select name="private">
                <option value="0" <?= $data['selectPrivate'][0] ?>>widoczny</option>
                <option value="1" <?= $data['selectPrivate'][1] ?>>ukryty</option>
              </select>
            </div>
            <div>
              <input type="submit" value="Dodaj przepis" class="btn">
            </div>
            <div>
              <a href="<?= URLROOT . '/recipes' ?>" class="btn btn-2">Anuluj</a>
            </div>
          </div>
        </form>
    </div>
  </div>

<?php require_once APPROOT . '/views/inc/footer.php' ?>