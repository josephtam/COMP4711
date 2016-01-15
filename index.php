<!DOCTYPE html>

<html>
  <head>
    <meta http-equiv="Content-Type" context="text/html; charset=UTF-8"> 
    <title>Tic-Tac-Toe</title>
    <link rel="stylesheet" type="text/css" href="Styles/style.css">
  </head>
  <body>
    <h1>Tic-Tac-Toe Game</h1>
    <?php
      if(!isset($_GET['board'])) {
       $squares = '---------';
      } else {
        $squares = $_GET['board'];
      }
      $game = new Game($squares);
      if($squares == '---------') {
        $game->display();
      } else {
        if($game->pick_move() == -1) {
          echo '<div class="msg">A Tie!</div>';
        } else if($game->winner('x')) {
          echo '<div class="msg">You win!</div>';
        } else if($game->winner('o')) {
          echo '<div class="msg">I win!</div>';
        } else {
          $game->display();
        }
      }  
    ?>
    <br />
    <div id="restart"><a href="/COMP4711">Restart Game</a></div>
  </body>
</html>

<?php
  class Game {
    var $position;
    function __construct($squares) {
      $this->position = str_split($squares);
    }
    
    /* Displays the tic tac toe grid */
    function display() {
      echo '<table cols="3" style="font-size:large; font-weight:bold;">';
      echo '<tr>';
      for($pos = 0; $pos < 9; $pos++) {
        echo $this->show_cell($pos);
        if($pos % 3 == 2) echo '</tr><tr>';
      }
      echo '</tr>';
      echo '</table>';
    }
    
    /* Processes the contents of each table cell */
    function show_cell($which) {
      $token = $this->position[$which];
      //deal with the easy case
      if($token <> '-') {
        return '<td>' . $token . '</td>';
      }
      //now the hard one
      $this->newposition = $this->position; // copy the original
      $this->newposition[$which] = 'x'; // this would be their move
      $move = implode($this->newposition); // make a string from the board array
      $link = '/COMP4711?board=' . $move; // this is what we want the link to be
      // so return a cell containing an anchor and showing a hyphen
      return '<td><a class="cell" href="' . $link . '">-</a></td>';
    }
    
    /*
     * Checks all possible winning areas on the grid and to determine if the 
     * player is about to win
     */
    function can_win($pos1, $pos2, $pos3) {
      $xCount = 0;
      $mtCount = 0;
      $mtPos = -1;
      
      if($this->position[$pos1] == 'o' ||
         $this->position[$pos2] == 'o' ||
         $this->position[$pos3] == 'o') {
        return -1;
      } 
      
      if($this->position[$pos1] == '-') {
        if($mtPos != -1) {
          return -1;
        } else {
          $mtPos = $pos1;
        }
      }
      
      if($this->position[$pos2] == '-') {
        if($mtPos != -1) {
          return -1;
        } else {
          $mtPos = $pos2;
        }
      }
      
      if($this->position[$pos3] == '-') {
        if($mtPos != -1) {
          return -1;
        } else {
          $mtPos = $pos3;
        }
      }
      return $mtPos;
    }
    
    /* Prevents the player from winning if possible, otherwise fills the next
     * available position
     */
    function pick_move() {
      for($row = 0; $row < 3; $row++) {
        if(($pos = $this->can_win(3 * $row, 3 * $row + 1, 3 * $row + 2)) != -1) {
          $this->position[$pos] = 'o';
          return;
        }
      }
      
      for($col = 0; $col < 3; $col++) {
        if(($pos = $this->can_win($col, $col + 3, $col + 6)) != -1) {
          $this->position[$pos] = 'o';
          return;
        }
      }
      
      if(($pos = $this->can_win(0, 4, 8)) != -1) {
        $this->position[$pos] = 'o';
        return;
      }
      
      if(($pos = $this->can_win(2, 4, 6)) != -1) {
        $this->position[$pos] = 'o';
        return;
      }
      
      for($pos = 0; $pos < 9; $pos++) {
        if($this->position[$pos] == '-') {
          $this->position[$pos] = 'o';
          return;
        }
      }
      return -1;
    }
    
    /*
     * Checks to see if there is a winner
     */
    function winner($token) {
      $won = false;
      for($row = 0; $row < 3; $row++) {
        if ($this->position[3 * $row] == $token && 
            $this->position[3 * $row + 1] == $token &&
            $this->position[3 * $row + 2] == $token) {
          return true;
        }
      }
    
      for($col = 0; $col < 3; $col++) {
        if ($this->position[$col] == $token && 
            $this->position[$col + 3] == $token &&
            $this->position[$col + 6] == $token) {
          return true;
        }
      }
    
      if ($this->position[0] == $token &&
          $this->position[4] == $token &&
          $this->position[8] == $token) {
        return true;
      }
      
      if ($this->position[2] == $token &&
          $this->position[4] == $token &&
          $this->position[6] == $token) {
        return true;
      }
      return $won;
    }
  }
?>