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
      $this->view('recipes/show', $data);
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
          'timeErr' => '',
          'selectQuantity' => ['', '', '', '', '', '', '', '', '', ''],
          'selectDifficulty' => ['', '', ''],
          'selectCategory' => ['', '', '', '', ''],
          'selectPrivate' => ['', ''],
        ];

        if (empty($data['name'])) {
          $data['nameErr'] = 'Wpisz nazwę';
        }
        if (empty($data['description'])) {
          $data['descriptionErr'] = 'Wpisz opis';
        }
        if (empty($data['ingredients'])) {
          $data['ingredientsErr'] = 'Wpisz składniki';
        }
        if (empty($data['recipe'])) {
          $data['recipeErr'] = 'Wpisz przepis';
        }
        if (empty($data['time'])) {
          $data['timeErr'] = 'Wpisz czas';
        }
        switch ($data['difficulty']) {
          case 0:
            $data['selectDifficulty'][0] = 'selected';
            break;
          case 1:
            $data['selectDifficulty'][1] = 'selected';
            break;
          case 2:
            $data['selectDifficulty'][2] = 'selected';
            break;
        }
        switch ($data['category']) {
          case 0:
            $data['selectCategory'][0] = 'selected';
            break;
          case 1:
            $data['selectCategory'][1] = 'selected';
            break;
          case 2:
            $data['selectCategory'][2] = 'selected';
            break;
          case 3:
            $data['selectCategory'][3] = 'selected';
            break;
          case 4:
            $data['selectCategory'][4] = 'selected';
            break;
        }
        switch ($data['private']) {
          case 0:
            $data['selectPrivate'][0] = 'selected';
            break;
          case 1:
            $data['selectPrivate'][1] = 'selected';
            break;
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
          'timeErr' => '',
          'selectQuantity' => ['', '', '', '', '', '', '', '', '', ''],
          'selectDifficulty' => ['', '', ''],
          'selectCategory' => ['', '', '', '', ''],
          'selectPrivate' => ['', ''],
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

      redirect('recipse/index');
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
  }