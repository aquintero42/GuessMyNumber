<?php
    session_start();
    $_SESSION['posibilidad'] = $_POST['posibilidad'];
    if ( !isset($_SESSION["rangoMedio"]) ) {
      $_SESSION["rangoMedio"] = floor((min(1,$_SESSION['posibilidad']) + max(1,$_SESSION['posibilidad']))/2);
      $rangoMedio = $_SESSION["rangoMedio"];
    } else {
      $rangoMedio = $_SESSION["rangoMedio"];
    }       
?>
<!DOCTYPE HTML>  
<html>
    <head>
        <meta charset="utf-8">
        <title>Primera modalidad: Adivinar número</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
      <h1>Primera modalidad</h1>
      <div id="formularioPrimeraModalidadRespuesta">
      <h2 class="titulos">Utiliza los botones de forma adecuada</h2>
      <h2 class="titulos">Procura pulsar el botón de confirmación después de seleccionar una respuesta</h2>    
      <form id="primeraModalidad" action="primeraModalidad.php" method="POST">
          <input type="hidden" id="posibilidad" name="posibilidad" value="<?= $_SESSION['posibilidad'] ?>">
          <div>
            <h2 id="elNumeroEs">¿El número es más grande que <?= $rangoMedio ?>?</h2>
            <button type="submit" id="buttonConfirm" class="button">Confirmar selección</button>
          </div>
          <button type="submit" id="numeroIgual" name="numeroIgual" class="button">El número es correcto</button>
          <button type="submit" id="numeroMasPequeño" name="numeroMasPequeño" class="button">Más pequeño</button>
          <button type="submit" id="numeroMasGrande" name="numeroMasGrande" class="button">Más grande</button>


          <?php
            if (!isset($_SESSION['intentosMaquina'])) { 
              $_SESSION['intentosMaquina'] = 0;
            }

            if ( isset($_POST['numeroIgual'])) {
              $_SESSION['intentosMaquina'] = $_SESSION['intentosMaquina']+1;
              echo "Has acertado el número, enhorabuena. <br>";
              echo "Intentos: " . $_SESSION['intentosMaquina'] . "<br>";
            } elseif ( isset($_POST['numeroMasGrande']) ) {
              $_SESSION['intentosMaquina'] = $_SESSION['intentosMaquina']+1;
              $_SESSION['rangoMedio'] = floor($_SESSION['rangoMedio'] + $_SESSION['rangoMedio']/2);
              echo "Has seleccionado más grande, pulsa el botón confirmar";
            } elseif ( isset($_POST['numeroMasPequeño']) ) {
              $_SESSION['intentosMaquina'] = $_SESSION['intentosMaquina']+1;
              $_SESSION['rangoMedio'] = floor($_SESSION['rangoMedio']/2);
              echo "Has seleccionado más pequeño, pulsa el botón confirmar";
            } elseif ( $_SESSION['rangoMedio'] > $_SESSION['posibilidad']) {
              $_SESSION['rangoMedio'] = $_SESSION['posibilidad'];
            }

          ?>
      </form>
      <form action="" method="POST">
        <button type='submit' name='volverIndice' value='volverIndice' class="button" id="volverInicio">Volver a selección de modalidad</button>
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