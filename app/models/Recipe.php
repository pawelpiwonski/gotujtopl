<?php
  class Recipe extends Database {

    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function add($data) {
      $this->db->dbQuery('INSERT INTO recipes(user_id, name, description, ingredients, recipe, time, quantity, difficulty, category, private) VALUES(:user_id, :name, :description, :ingredients, :recipe, :time, :quantity, :difficulty, :category, :private)');
      $this->db->dbBind(':user_id', $_SESSION['userId']);
      $this->db->dbBind(':name', $data['name']);
      $this->db->dbBind(':description', $data['description']);
      $this->db->dbBind(':ingredients', $data['ingredients']);
      $this->db->dbBind(':recipe', $data['recipe']);
      $this->db->dbBind(':time', $data['time']);
      $this->db->dbBind(':quantity', $data['quantity']);
      $this->db->dbBind(':difficulty', $data['difficulty']);
      $this->db->dbBind(':category', $data['category']);
      $this->db->dbBind(':private', $data['private']);
      return $this->db->dbExecute() ? true : false;
    }

    public function edit($data) {
      $this->db->dbQuery('UPDATE recipes SET name = :name, description = :description, ingredients = :ingredients, recipe = :recipe, time = :time, quantity = :quantity, difficulty = :difficulty, category = :category, private = :private WHERE id = :id');
      $this->db->dbBind(':name', $data['name']);
      $this->db->dbBind(':description', $data['description']);
      $this->db->dbBind(':ingredients', $data['ingredients']);
      $this->db->dbBind(':recipe', $data['recipe']);
      $this->db->dbBind(':time', $data['time']);
      $this->db->dbBind(':quantity', $data['quantity']);
      $this->db->dbBind(':difficulty', $data['difficulty']);
      $this->db->dbBind(':category', $data['category']);
      $this->db->dbBind(':private', $data['private']);
      $this->db->dbBind(':id', $data['id']);
      return $this->db->dbExecute() ? true : false;
    }
    
    public function getRecipesByCategory(int $category) {
      $this->db->dbQuery('SELECT recipes.id, name, description, time, difficulty, private, login as user_name FROM recipes INNER JOIN users ON user_id = users.id WHERE category = :category AND private = 0 AND deleted_by_user = 0 AND visible = 1 ORDER BY name DESC');
      $this->db->dbBind(':category', $category);
      return $this->db->dbFetchAll();
    }

    public function getUserRecipes(int $userId) {
      $this->db->dbQuery('SELECT recipes.id, name, description, time, difficulty, category, private, login as user_name FROM recipes INNER JOIN users ON user_id = users.id WHERE user_id = :user_id AND private = 0 AND deleted_by_user = 0 AND visible = 1 ORDER BY name DESC');
      $this->db->dbBind(':user_id', $userId);
      return $this->db->dbFetchAll();
    }

    public function getRecipe(int $id) {
      $this->db->dbQuery('SELECT recipes.id, user_id, name, description, ingredients, recipe, time, quantity, difficulty, category, private, recipes.created_at, login as user_name FROM recipes INNER JOIN users ON user_id = users.id WHERE recipes.id = :id AND private = 0 AND deleted_by_user = 0 AND visible = 1 ORDER BY name DESC');
      $this->db->dbBind(':id', $id);
      return $this->db->dbFetch();
    }

    public function delete($id) {
      $this->db->dbQuery('DELETE FROM recipes WHERE id = :id');
      $this->db->dbBind(':id', $id);
      if ($this->db->dbExecute()) {
        return true;
      } else {
        return false;
      }
    }

    public function addToFavourites($recipeId) {
      $this->db->dbQuery('INSERT INTO favourites(user_id, recipe_id) VALUES(:user_id, :recipe_id)');
      $this->db->dbBind(':user_id', $_SESSION['userId']);
      $this->db->dbBind(':recipe_id', $recipeId);
      if ($this->db->dbExecute()) {
        return true;
      } else {
        return false;
      }
    }

    public function getFavourites() {
      $this->db->dbQuery('SELECT recipe_id FROM favourites WHERE user_id = :user_id');
      $this->db->dbBind(':user_id', $_SESSION['userId']);
      return $this->db->dbFetchAll();
    }

    public function removeFromFavourites($recipeId) {
      $this->db->dbQuery('DELETE FROM favourites WHERE user_id = :user_id AND recipe_id = :recipe_id');
      $this->db->dbBind(':user_id', $_SESSION['userId']);
      $this->db->dbBind(':recipe_id', $recipeId);
      if ($this->db->dbExecute()) {
        return true;
      } else {
        return false;
      }
    }

  }