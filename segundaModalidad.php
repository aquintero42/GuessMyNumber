<?php
  session_start();
  $_SESSION['posibilidad'] = $_POST['posibilidad'];

  if ( !isset($_SESSION["secretNumber"]) ) {
    $_SESSION["secretNumber"] = rand(1,$_SESSION['posibilidad']);
    $secretNumber = $_SESSION["secretNumber"];
  } else {
    $secretNumber = $_SESSION["secretNumber"];
  }

?>
<!DOCTYPE HTML>
<html>
  <head>
      <meta charset="utf-8">
      <title>Segunda modalidad</title>
      <link rel="stylesheet" href="./style.css">
  </head>
  <body>
    <h1>Segunda modalidad</h1>
    <div id="formularioSegundaModalidad">
      <h4>Introduce un número del 1 al <?= $_SESSION["posibilidad"] ?></h2>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      Número: <input type="text" name="fnumber">
      <input type="hidden" name="posibilidad" value="<?= $_POST['posibilidad'] ?>">
      <input type="submit" name="submit" value="Confirmar" class="button" id="botonConfirmar">
      <?php

        if (!isset($_SESSION['intentos'])) { 
          $_SESSION['intentos'] = 0;
        }
        echo "<br>";

        if (isset($_POST['fnumber'])) {
          $number = htmlspecialchars($_POST['fnumber']);
        } else {
          $number = null;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($number)) {
            echo "No puedes introducir un campo vacío";
          } else {
            if ($number == $secretNumber) {
              $_SESSION['intentos'] = $_SESSION['intentos']+1;
              echo "Has acertado el número " . $secretNumber . "<br>";
              echo "Intentos: " . $_SESSION['intentos'] . "<br>";
            } elseif ($number > $secretNumber) {
              echo "El número a adivinar es más pequeño que " . $number;
              $_SESSION['intentos'] = $_SESSION['intentos']+1;
            } elseif ($number < $secretNumber) {
              echo "El número a adivinar es más grande que " . $number;
              $_SESSION['intentos'] = $_SESSION['intentos']+1;
            }
          } 
        }

        if ( isset($_POST['volverIndice']) ) {
          session_unset();
          session_destroy();
          header("Location: index.php");    
        }

      ?>

      </form>
      <form action="" method="POST">
      <button type='submit' name='volverIndice' value='volverIndice' class="button" id="volverAJugar">Volver a selección de modalidad</button>
      <?php
        if ( isset($_POST['volverIndice']) ) {
          session_unset();
          session_destroy();
          header("Location: index.php");    
        }      
      ?>
    </form>      
    </div>
  </body>
</html>