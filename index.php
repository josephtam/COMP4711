<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" context="text/html; charset=UTF-8"> 
        <title></title>
    </head>
    <body>
        <?php
          $name = 'Jim';
          $what = 'geek';
          $level = 10;
          echo 'Hi my name is ' . $name . ' and I am level ' . $level . ' ' .
                  $what;
          
          $hoursworked = $_GET['hours'];
          //$hoursworked = 10;
          $rate = 12;
          
          if ($hoursworked > 40) {
            $total = $hoursworked * $rate * 1.5;
          } else {
            $total = $hoursworked * $rate;
          }
          echo '<br/>';
          echo ($total > 0) ? 'You owe me ' . $total : "You're welcome";
        ?>
    </body>
</html>
