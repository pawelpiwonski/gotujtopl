<?php
  class Recipes extends Controller {

    public function __construct() {
      $this->recipeModel = $this->model('recipe');
    }

    public function index() {
      $this->view('recipes/index');
    }   

    public function mainCourses() {
      $data = $this->recipeModel->getRecipesByCategory(0);
      $this->assignDifficultyAndColor($data);
      $data['showcaseText'] = 'dania główne';
      $this->view('recipes/category', $data);
    }   

    public function apetisers() {
      $data = $this->recipeModel->getRecipesByCategory(1);
      $this->assignDifficultyAndColor($data);
      $data['showcaseText'] = 'przystawki';
      $this->view('recipes/category', $data);
    }   

    public function soups() {
      $data = $this->recipeModel->getRecipesByCategory(2);
      $this->assignDifficultyAndColor($data);
      $data['showcaseText'] = 'zupy';
      $this->view('recipes/category', $data);
    }   

    public function desserts() {
      $data = $this->recipeModel->getRecipesByCategory(3);
      $this->assignDifficultyAndColor($data);
      $data['showcaseText'] = 'desery';
      $this->view('recipes/category', $data);
    }   

    public function other() {
      $data = $this->recipeModel->getRecipesByCategory(4);
      $this->assignDifficultyAndColor($data);
      $data['showcaseText'] = 'pozostałe';
      $this->view('recipes/category', $data);
    }   

    public function userRecipes() {
      redirectIfNotLoggedIn();
      $data = $this->recipeModel->getUserRecipes($_SESSION['userId']);
      $this->assignDifficultyAndColor($data);
      $this->assignCategory($data);
      $data['showcaseText'] = 'Twoje przepisy';
      $this->view('recipes/category', $data);
    }

    public function show($id) {
      $recipe = $this->recipeModel->getRecipe($id[0]);
      $data = ['recipe' => $recipe];
      $this->assignDifficultyAndColor($data);
      $this->assignCategory($data);
      $data['recipe']->ingredients = explode(PHP_EOL, $data['recipe']->ingredients);
      array_splice($data['recipe']->ingredients, 30);
      $data['recipe']->favourite = $this->checkIfFavourite($id[0]);
      $this->view('recipes/show', $data);
    }

    private function assignDifficultyAndColor($data) {
      foreach ($data as $recipe) {
        switch ($recipe->difficulty) {
          case 0:
            $recipe->difficulty = "łatwy";
            $recipe->difficultyColor = "green";
            break;
          case 1:
            $recipe->difficulty = "średni";
            $recipe->difficultyColor = "orange";
            break;
          case 2:
            $recipe->difficulty = "trudny";
            $recipe->difficultyColor = "red";
            break;
        }
      }
      return $data;
    }

    private function assignCategory($data) {
      foreach ($data as $recipe) {
        switch ($recipe->category) {
          case 0:
            $recipe->category = "dania główne";
            break;
          case 1:
            $recipe->category = "przystawki";
            break;
          case 2:
            $recipe->category = "zupy";
            break;
          case 3:
            $recipe->category = "desery";
            break;
          case 4:
            $recipe->category = "pozostałe";
            break;          
        }
      }
    }

    public function add() {
      redirectIfNotLoggedIn();

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'name' => trim($_POST['name']),
          'description' => trim($_POST['description']),
          'ingredients' => trim($_POST['ingredients']),
          'recipe' => trim($_POST['recipe']),
          'time' => trim($_POST['time']),
          'quantity' => trim($_POST['quantity']),
          'difficulty' => trim($_POST['difficulty']),
          'category' => trim($_POST['category']),
          'private' => trim($_POST['private']),
          'nameErr' => '',
          'descriptionErr' => '',
          'ingredientsErr' => '',
          'recipeErr' => '',
          'timeErr' => ''
        ];

        if (empty($data['name'])) {
          $data['nameErr'] = 'Podaj nazwę';
        }
        if (empty($data['description'])) {
          $data['descriptionErr'] = 'Podaj opis';
        }
        if (empty($data['ingredients'])) {
          $data['ingredientsErr'] = 'Podaj składniki';
        }
        if (empty($data['recipe'])) {
          $data['recipeErr'] = 'Podaj przepis';
        }
        if (empty($data['time'])) {
          $data['timeErr'] = 'Podaj czas';
        }
        if (empty($data['quantity'])) {
          $data['quantityErr'] = 'Podaj ilość';
        }

        if (empty($data['nameErr']) && empty($data['descriptionErr']) && empty($data['ingredientsErr']) && empty($data['recipeErr']) && empty($data['timeErr'])) {
          if ($this->recipeModel->add($data)) {
            redirect('recipes');
          } else {
            exit('Nie udało się dodać przepisu');
          }
        } else {
          $this->view('recipes/add', $data);
        }

      } else {
        $data = [
          'name' => '',
          'description' => '',
          'ingredients' => '',
          'recipe' => '',
          'time' => '',
          'quantity' => '',
          'difficulty' => '',
          'category' => '',
          'private' => '',
          'nameErr' => '',
          'descriptionErr' => '',
          'ingredientsErr' => '',
          'recipeErr' => '',
          'timeErr' => ''
        ];
        $this->view('recipes/add', $data);
      }
    }

    public function delete($id) {
      redirectIfNotLoggedIn();

      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $recipe = $this->recipeModel->getRecipe($id[0]);
        if ($recipe->user_id == $_SESSION['userId']) {
          if (!$this->recipeModel->delete($id[0])) {
            exit ('Błąd przy usuwaniu przepisu');
          }
        }
      }

      redirect('');
    }

    public function edit($id) {
      redirectIfNotLoggedIn();

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'name' => trim($_POST['name']),
          'description' => trim($_POST['description']),
          'ingredients' => trim($_POST['ingredients']),
          'recipe' => trim($_POST['recipe']),
          'time' => trim($_POST['time']),
          'quantity' => trim($_POST['quantity']),
          'difficulty' => trim($_POST['difficulty']),
          'category' => trim($_POST['category']),
          'private' => trim($_POST['private']),
          'id' => $id[0],
          'nameErr' => '',
          'descriptionErr' => '',
          'ingredientsErr' => '',
          'recipeErr' => '',
          'timeErr' => ''
        ];

        if (empty($data['name'])) {
          $data['nameErr'] = 'Podaj nazwę';
        }
        if (empty($data['description'])) {
          $data['descriptionErr'] = 'Podaj opis';
        }
        if (empty($data['ingredients'])) {
          $data['ingredientsErr'] = 'Podaj składniki';
        }
        if (empty($data['recipe'])) {
          $data['recipeErr'] = 'Podaj przepis';
        }
        if (empty($data['time'])) {
          $data['timeErr'] = 'Podaj czas';
        }
        if (empty($data['quantity'])) {
          $data['quantityErr'] = 'Podaj ilość';
        }

        if (empty($data['nameErr']) && empty($data['descriptionErr']) && empty($data['ingredientsErr']) && empty($data['recipeErr']) && empty($data['timeErr'])) {
          if ($this->recipeModel->edit($data)) {
            $redirectLocation = 'recipes/'; 
            redirect('recipes/show/' . $id[0]);
          } else {
            exit('Nie udało się zmienić przepisu');
          }
        } else {
          $this->view('recipes/edit', $data);
        }

      } else {
        $recipe = $this->recipeModel->getRecipe($id[0]);

        if ($recipe->user_id != $_SESSION['userId']) {
          redirect('');
        }

        $data = [
          'name' => $recipe->name,
          'description' => $recipe->description,
          'ingredients' => $recipe->ingredients,
          'recipe' => $recipe->recipe,
          'time' => $recipe->time,
          'quantity' => $recipe->quantity,
          'difficulty' => $recipe->difficulty,
          'category' => $recipe->category,
          'private' => $recipe->private,
          'id' => $id[0]
        ];

        $this->view('recipes/edit', $data);
      }
    }

    public function addToFavourites($recipeId) {
      redirectIfNotLoggedIn();

      if (!$this->checkIfFavourite($recipeId[0])) {
        if ($this->recipeModel->addToFavourites($recipeId[0])) {
          redirect('recipes/show/' . $recipeId[0]);
        } else {
          exit('Nie udało się dodać przepisu do ulubionych');
        }
      } else {
        exit('Przepis już jest w ulubionych');
      }
    }

    public function checkIfFavourite($recipeId) {

      $favourites = $this->recipeModel->getFavourites();
      foreach ($favourites as $favourite) {
        if ($recipeId == $favourite->recipe_id) {
          return true;
        }
      }
      return false;
    }

    public function removeFromFavourites($recipeId) {
      redirectIfNotLoggedIn();

      if ($this->checkIfFavourite($recipeId[0])) {
        if ($this->recipeModel->removeFromFavourites($recipeId[0])) {
          redirect('recipes/show/' . $recipeId[0]);
        } else {
          exit('Nie udało się usunąć przepisu z ulubionych');
        }
      } else {
        exit('Przepis nie jest w ulubionych');
      }
    }

    public function addNote($recipeId) {
      redirectIfNotLoggedIn();

      $recipe = $this->recipeModel->getRecipe($recipeId[0]);
      $data = ['recipe' => $recipe];
      $this->assignDifficultyAndColor($data);
      $this->assignCategory($data);
      $data['recipe']->ingredients = explode(PHP_EOL, $data['recipe']->ingredients);
      array_splice($data['recipe']->ingredients, 30);
      $data['recipe']->favourite = $this->checkIfFavourite($recipeId[0]);
      $data['note'] = '';
      $this->view('recipes/add_note', $data);
    }
    
  }