<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= URLROOT . '/public/css/style.css' ?>">
  <link rel="stylesheet" media="screen and (max-width:768px)" href="<?= URLROOT . '/public/css/mobile.css' ?>">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <title>GotujTo</title>
  <script src="https://kit.fontawesome.com/103382ecff.js" crossorigin="anonymous"></script>
</head>
<body>

  <nav id="main-nav">
    <div class="container">
      <div class="logo">
        gotuj<span class="logo-2">to</span><span class="logo-3">.pl</span>
      </div>
      <?php require APPROOT . '/views/inc/menu.php' ?>
    </div>
  </nav>