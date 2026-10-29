<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5 PDO</title>
    <style>
        *{ margin: 0 auto; padding: 0 auto; }
        nav{ background-color: black; color: white; padding: 5px; text-align: center}
        body{
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            align-items: center;
            text-align: center;
        }
        .ejercicio{
            padding: 50px;
            margin-top: 10px;
            margin-bottom: 10px;
            width: 1150px;
            border: 1px solid black;
            border-radius: 10px;
            p { font-weight: bold; }
            h2 { font-weight: bold; text-align: center; margin-top: 2%;}
        }
        
        .correcto{background-color: #dce9d5ff;}
        .error{background-color: #e9b8b8ff;}
        footer{
            background-color: black; 
            text-align: center; 
            align-content: center;
            height: 50px; 
            color: white; 
            margin-top: 10%;
            & div a{ color: white; text-decoration: none; }
        }
        footer a img{
            width: 40px;
        }
    </style>
</head>
<body>
    <nav>
        <h2>DWES - Tema 4</h2>
        <h2>Ejercicio 5 PDO</h2>
    </nav>
    <main class="ejercicio">
       <?php
       /**
        * @author: Álvaro Calderón Pérez
        * @since: 29/10/2026
        * Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones
        * insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.
        */
       
        require_once '../config/configDBPDO.php';

        $aDepartamentos=[ // Partimos de una array bidimensional con los datos a introducir en la BBDD
            [
                'CodDepartamentoGuardar' => 'AAA', 
                'DescDepartamentoGuardar' => 'aaaaaaa',
                'VolumenDeNegocioGuardar' => '1000'
            ],
            [
                'CodDepartamentoGuardar' => 'BBB', 
                'DescDepartamentoGuardar' => 'bbbbbbbb',
                'VolumenDeNegocioGuardar' => '1500'
            ],
            [
                'CodDepartamentoGuardar' => 'CCC', 
                'DescDepartamentoGuardar' => 'ccccccccc',
                'VolumenDeNegocioGuardar' => '18000.55'
            ]
        ]; // la fecha es la actual y la fecha de baja vacía
        /**
        * FUNCIÓN REUTILIZABLE PARA NO REPETIR CÓDIGO
        * 
        * @param PDO   $conexion  Objeto de la conexión a la base de datos.
        * @param array $datos     Array bidimensional con los datos de los departamentos.
        * @param bool  $esBorrado (Opcional) Si es true, hace un DELETE. Si es false (por defecto), hace un INSERT.
        */
        function ejecutarTransaccion($conexion, $datos, $esBorrado = false) {
            try {
                // 1. Iniciamos la transacción: las siguientes consultas se agrupan en un paquete lógico
                $conexion->beginTransaction();
                // 2. Recorremos el array de departamentos para preparar cada consulta
                foreach ($datos as $Departamento) {
                    // Comprobamos el interruptor para saber si construimos un DELETE o un INSERT
                    if ($esBorrado) {
                        $sql = 'delete from T02_Departamento where T02_CodDepartamento="'.$Departamento["CodDepartamentoGuardar"].'"';
                    } else {
                        $sql = 'insert into T02_Departamento values ("'.$Departamento["CodDepartamentoGuardar"].'","'.$Departamento["DescDepartamentoGuardar"].'",now(),'.$Departamento["VolumenDeNegocioGuardar"].',null)';
                    }
                    // Mostramos la consulta por pantalla para ver qué se está ejecutando
                    echo '<p>'.$sql.'</p>';
                    // 3. Ejecutamos la consulta en la base de datos
                    $conexion->exec($sql);
                }
                // 4. Si el bucle termina sin errores, confirmamos y guardamos los cambios definitivamente
                $conexion->commit();
                // Preparamos el mensaje de éxito dependiendo de si estábamos borrando o insertando
                $mensaje = $esBorrado ? 'campos borrados' : 'cambios guardados';
                echo "<p class='correcto'>Transacción COMPLETADA y $mensaje (COMMIT).</p>";

            } catch (PDOException $miExceptionPDO) {
                // 5. Si ocurre CUALQUIER error (ej. clave duplicada), deshacemos los cambios anteriores
                $conexion->rollBack();
                // Preparamos el mensaje de error y mostramos el motivo exacto que devuelve PDO
                $mensaje = $esBorrado ? 'No ha borrado' : 'Cambios deshechos';
                echo "<p class='error'>Transacción fallida. $mensaje (ROLLBACK).</p>";
                echo "<p class='error'>Error: " . $miExceptionPDO->getMessage() . "</p>";
            }
        }

        try {
            $miDB = new PDO(DSN, USERNAME, PASSWORD);

            // 2. Transacción Correcta (Insertar)
            echo "<h2>Transacción correcta</h2>";
            ejecutarTransaccion($miDB, $aDepartamentos, false);

            // 3. Transacción Incorrecta (Intentar insertar lo mismo para forzar fallo)
            echo "<h2>Transacción incorrecta</h2>";
            echo "<p>Volver a intentar los mismos insert de antes</p>";
            ejecutarTransaccion($miDB, $aDepartamentos, false);

            // 4. Reset (Borrar lo insertado)
            echo "<h2>Reset</h2>";
            echo "<p>Para poder volver a probar borro los 3 insert </p>";
            ejecutarTransaccion($miDB, $aDepartamentos, true);

        } catch (PDOException $e) {
            // Este catch solo saltaría si fallan las credenciales al conectarse a la BBDD
            echo "<p class='error'>Error al conectar a la base de datos: " . $e->getMessage() . "</p>";
        } finally {
            // Cerramos la conexión al final del todo
            unset($miDB);
        }
       ?>
    </main>
    <footer>
        <div>
            <a href="../../ACPDWESProyectoDWES/indexProyectoDWES.php">Álvaro Calderón Pérez</a>
            <a href="../indexProyectoTema4.php"><img src="../webroot/images/casa_blanca.png" alt="home"></a>
            <time datetime="2026-10-27">27-10-2026</time>
        </div>
    </footer>
</body>
</html>

