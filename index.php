<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" context="text/html; charset=UTF-8"> 
        <title></title>
    </head>
    <body>
        <?php
        
          if(!isset($_GET['board'])) {
            echo 'No board parameter given';
          } else {
            $squares = $_GET['board'];
            if(winner('x', $squares)) echo 'You win.';
            else if(winner('o', $squares)) echo 'I win.';
            else echo 'No winner yet.';
          }
        ?>
    </body>
</html>

<?php
  function winner($token, $position) {
    $won = false;
    for($row = 0; $row < 3; $row++) {
      if ($position[3 * $row] == $token && 
          $position[3 * $row + 1] == $token &&
          $position[3 * $row + 2] == $token) {
        return true;
      }
    }
    
    for($col = 0; $col < 3; $col++) {
      if ($position[$col] == $token && 
          $position[$col + 3] == $token &&
          $position[$col + 6] == $token) {
        return true;
      }
    }
    
    if ($position[0] == $token &&
        $position[4] == $token &&
        $position[8] == $token) {
      return true;
    } else if ($position[2] == $token &&
               $position[4] == $token &&
               $position[6] == $token) {
      return true;
    }
    return $won;
  }
?>