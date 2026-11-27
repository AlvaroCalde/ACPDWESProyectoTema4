<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 7 JSON PDO</title>
    <link rel="stylesheet" href="../webroot/css/estilos08PDO.css">
</head>
<body>
    <nav>
        <h2>DWES - Tema 4</h2>
        <h2>Ejercicio 7 JSON PDO</h2>
    </nav>
    <main class="ejercicio">
       <div class="buscador">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2 style="margin-top: 0;">Restaurar copia</h2>
                <p style="margin-bottom: 20px; color: #555;">Importar todos los departamentos desde un archivo XML.</p>
                <button type="submit" name="importar">Importar departamentos.xml</button>
            </form>  
        </div>

        <?php
            /**
            * @author: Álvaro Calderón Pérez
            * @since: 29/10/2026
            * Página web que toma datos de un fichero xml y los añade a la tabla
            * Departamento de nuestra base de datos. (IMPORTAR). 
            */
            if (isset($_REQUEST['importar'])) {

                // Calculamos la ruta del archivo JSON en la carpeta tmp
                $rutaFicheroJSON = $_SERVER["DOCUMENT_ROOT"] . '/ACPDWESProyectoTema4/tmp/departamentos.json';

                // Comprobamos si el archivo existe
                if (file_exists($rutaFicheroJSON)) {

                    // Leetodo el contenido del archivo JSON como una unica cadena de texto
                    $textoJSON = file_get_contents($rutaFicheroJSON);

                    // Convierte el texto JSON a un array asociativo de PHP
                    // https://www.php.net/manual/es/function.json-decode.php
                    $aDepartamentos = json_decode($textoJSON, true);

                    // Verificamos que el JSON no este vacio y sea un array valido
                    if (is_array($aDepartamentos) && count($aDepartamentos) > 0) {

                        require_once '../config/configDBPDO.php';

                        try {
                            // Instanciacion del objeto PDO
                            $miDB = new PDO(HOST, USER, PASS);

                            // Iniciamos la transaccion para asegurar que o se importan todos, o ninguno
                            $miDB->beginTransaction();

                            // Preparamos la consulta de insercion
                            $sqlInsert = 'INSERT INTO T02_Departamento VALUES (:CodDepartamento, :DescDepartamento, :FechaCreacionDepartamento, :VolumenDeNegocio, :FechaBajaDepartamento)';
                            $sentenciaPreparada = $miDB->prepare($sqlInsert);

                            $registrosImportados = 0;

                            // Recorremos cada departamento del array PHP
                            foreach ($aDepartamentos as $departamento) {

                                // Extraemos los valores. Si FechaBaja esta vacia, le asignamos null.
                                $codigo = $departamento['CodDepartamento'];
                                $descripcion = $departamento['DescDepartamento'];
                                $fecha = $departamento['FechaCreacionDepartamento'];
                                $volumen = $departamento['VolumenDeNegocio'];
                                $fechaBaja = (!empty($departamento['FechaBajaDepartamento'])) ? $departamento['FechaBajaDepartamento'] : null;

                                // Ejecutamos la consulta preparada pasando un array asociativo con los nombres de los campos
                                $sentenciaPreparada->execute([
                                    ':CodDepartamento' => $codigo,
                                    ':DescDepartamento' => $descripcion,
                                    ':FechaCreacionDepartamento' => $fecha,
                                    ':VolumenDeNegocio' => $volumen,
                                    ':FechaBajaDepartamento' => $fechaBaja
                                ]);

                                $registrosImportados++;
                            }

                            // Si el bucle termina sin errores, confirmamos la transacción
                            $miDB->commit();

                            echo "<div class='mensaje-exito'>";
                            echo "<h3>Importación completada con éxito.</h3>";
                            echo "<p>Se han importado <b>{$registrosImportados}</b> departamentos desde el archivo JSON a la base de datos.</p>";
                            echo "</div>";
                        } catch (PDOException $miExceptionPDO) {
                            // Si ocurre un error, deshacemos todos los cambios
                            $miDB->rollBack();

                            echo "<div class='error'>";
                            echo "<h3 style='margin-top:0;'>Error al importar en la base de datos.</h3>";
                            echo "<p>La transaccion ha sido cancelada. Ningun registro ha sido importado.</p>";
                            echo "<p><b>Mensaje:</b> " . $miExceptionPDO->getMessage() . "</p>";
                            echo "<p><b>Código:</b> " . $miExceptionPDO->getCode() . "</p>";
                            echo "</div>";
                        } finally {
                            unset($miDB);
                        }
                    }
                }
            }
            
        ?>
    </main>
    <footer>
        <div>
            <a href="../../ACPDWESProyectoDWES/indexProyectoDWES.php">Álvaro Calderón Pérez</a>
            <a href="../indexProyectoTema4.php"><img src="../webroot/images/casa_blanca.png" alt="home"></a>
        </div>
    </footer>
</body>
</html>

