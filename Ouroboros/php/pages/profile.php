<?php $title = 'Ouroboros'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'Profile'; ?>
<!DOCTYPE html>
<html>
<head>
  <?php include('includes/head.php'); ?>
  <?php
    // Initialize the session
    // If session variable is not set it will redirect to login page
    session_start();
    if(!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['UUID']) || empty($_SESSION['UUID'])){
      header("location: ../../index.php");
      exit;
    }
  ?>
</head>
<body>
  <?php include('includes/nav-bar.php'); ?>
  <div class="content">
    <h1><?php 
    echo $_SESSION['username']; 
    ?></h1>
    
    <?php
      require_once '../json_manager.php';
    /*
    $user->gamerTag = $username;
      $user->name = $name;
      $user->lastname = $lastname;
      $user->age = (int)$age;
      $user->gender = $gender;*/

      echo "<h2>Games:</h2><ol>";
      if(isset($_SESSION['game_name'])) {
        $games = explode(",", $_SESSION['game_name']);

        for($i = 0; $i < sizeof($games); $i++) {
          echo "<li>" . $games[$i] . "</li>";
        }
        
        echo "</ol>";
      }else {

    $user = getUser($_SESSION['username'], $_SESSION['UUID']);
      echo "<h2>Name: " . $user->name . "</h2>";
      echo "<h2>Last Name: " . $user->lastname . "</h2>";
      echo "<h7>UUID: " . $user->UUID . "</h7>";
        foreach ($user->games as $key) {
          echo "<li>" . $key . "</li>";
        }
      }
    ?>

    <?php
    if(isset($_SESSION['game_name'])):?>
    <h2>Add Variable</h2>
      <form action="../game/addVariableToGame.php" method = "get">
        <div class="container">
          <label for="variable"><b>variable</b></label>
          <input type="text" placeholder="Enter Username" name="variable" required>

          <label for="value"><b>value</b></label>
          <input type="text" placeholder="Enter Password" name="value" required>

          <label for="game"><b>Game</b></label><br>
          <select name="game">
            <?php 
              $games = explode(",", $_SESSION['game_name']);

              for($i = 0; $i < sizeof($games); $i++) {
                echo "<option value=\"" . $games[$i] . "\">" . $games[$i] . "</option>";
              }
             ?>
          </select>
              
          <button type="submit">Add</button>
        </div>
      </form>
    <?php endif;?>

  </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>