<?php
    session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Guess My Number</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
    <form id="formularioIndex" action="" method="POST">
        <label for="modalidad" class="label">Escoge la modalidad de juego:</label>
        <select id="modalidad" name="modalidad" size="1">
            <option disabled selected value> Selecciona una opción</option>
            <option value="primeraModalidad">Primera modalidad</option>
            <option value="segundaModalidad">Segunda modalidad</option>    
        </select>
        <br/>
        <br/>
        <label for="posibilidad" class="label">Selecciona el nivel de dificultad:</label>
        <select id="posibilidad" name="posibilidad" size="1">
            <option value="10">Del 1 al 10</option>
            <option value="50">Del 1 al 50</option>
            <option value="100">Del 1 al 100</option>
        </select> 
        <br />
        <br />
        <!--<input value="Seleccionar" type="submit" name="submit" class="button" id="buttonIndex">-->
        <button type="submit" name="submit" class="button" id="buttonIndex">Seleccionar</button>
    </form>  
    </body>
</html>

<script>
    document.getElementById('modalidad').onchange = function() {
        var modalidad = document.getElementById('modalidad').value;
        document.getElementById('formularioIndex').action = '/GuessMyNumber/' + modalidad + '.php';
    };
</script>

<!--
    Control de errores:
        Gestionar errores como los números fuera de rango i otros
        que se puedan encontrar.

    Primera modalidad:
        A la primera modalitat, l’aplicació troba el número que algú ha pensat, 
        cal implementar una estratègia que minimitzi el nombre d’intents. 
        Habitualment, el punt mig del rang, ja que ens permet eliminar el màxim 
        nombre de números en cada intent. Quan resten pocs números, podeu afegir 
        un cert grau d’atzar controlat. El joc acaba quan l’aplicació troba el 
        nostre número i ens diu el número d’intents que ha necessitat. 
        En cada iteració, només podem respondre si és el numero correcte, 
        més petit o més gran.

        Generar un número aleatorio.

        setcookie('partida',$_POST['posibilidad']);
        $_COOKIE['partida'] = $_POST['posibilidad'];          
        setCookie('posibilidad', rand(1,$_COOKIE['partida']));

        Crear cookies o variable para punto medio del rango.
        setCookie('puntoMedio', ($_COOKIE['posibilidad'])/2);
        $puntoMedio = ($_COOKIE['posibilidad'])/2;

    Segunda modalidad: (DONE)
        A la segona modalitat, els papers s’inverteixen, som nosaltres 
        que hem de trobar el número que ha inventat la màquina en el mínim 
        número d’intents possibles.

    Tres niveles de juego: (DONE)
        -Primer nivel del 1 al 10
        -Segundo nivel del 1 al 50
        -Tercer nivel deel 1 al 100

    Funciones necesarias:
        rand(m, n) retorna un número aleatori entre m i n ambdós inclosos.
        max(a, b, ...) retorna el número més gran.
        min(a, b, ...) retorna el número més petit.

    Utilizar una función rand para el nivel de juego.
    Modificar el número máximo pasando el valor.
    del nivel de juego a través del formulario.

-->