<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 7 PDO</title>
    <link rel="stylesheet" href="../webroot/css/estilos08PDO.css">
</head>
<body>
    <nav>
        <h2>DWES - Tema 4</h2>
        <h2>Ejercicio 7 PDO</h2>
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

                // Calculamos la ruta del archivo XML en la carpeta tmp
                $directorioTMP = dirname(__DIR__) . '/tmp/';
                $rutaFicheroXML = $directorioTMP . 'departamentos.xml';

                // Comprobamos si el archivo existe antes de intentar hacer nada
                if (file_exists($rutaFicheroXML)) {

                    require_once '../config/configDBPDO.php';

                    try {
                        // Instanciacion del objeto PDO
                        $miDB = new PDO(DSN, USERNAME, PASSWORD);
                        // Habilitar excepciones (muy importante para que el try/catch y las transacciones funcionen bien)
                        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Instanciamos DOMDocument y cargamos el archivo XML
                        $documentoXML = new DOMDocument();

                        // Carga el archivo XML desde un fichero
                        $documentoXML->load($rutaFicheroXML);

                        // Obtenemos una lista con todos los elementos departamento
                        $listaDepartamentosXML = $documentoXML->getElementsByTagName('departamento');

                        // Verificamos que el XML no este vacio
                        if ($listaDepartamentosXML->length > 0) {

                            // Iniciamos la transaccion
                            $miDB->beginTransaction();

                            $sqlInsert = 'INSERT INTO T02_Departamento VALUES (:codigo, :descripcion, :fechaCreacion, :volumen, :fechaBaja)';
                            $sentenciaPreparada = $miDB->prepare($sqlInsert);

                            $registrosImportados = 0;

                            // Recorremos cada departamento del XML
                            foreach ($listaDepartamentosXML as $departamento) {

                                // Extraemos los valores leyendo los hijos del XML
                                $codigo = $departamento->getElementsByTagName('CodDepartamento')->item(0)->nodeValue;
                                $descripcion = $departamento->getElementsByTagName('DescDepartamento')->item(0)->nodeValue;
                                
                                // OJO: Comprobamos si las etiquetas de fecha y volumen existen para evitar errores si importamos un XML antiguo
                                $fechaCreacion = $departamento->getElementsByTagName('FechaCreacionDepartamento')->item(0) ? $departamento->getElementsByTagName('FechaCreacionDepartamento')->item(0)->nodeValue : date('Y-m-d H:i:s');
                                $volumen = $departamento->getElementsByTagName('VolumenDeNegocio')->item(0) ? $departamento->getElementsByTagName('VolumenDeNegocio')->item(0)->nodeValue : null;
                                
                                // Para la fecha de baja, si viene vacía (''), la convertimos a null real para la BD
                                $nodoFechaBaja = $departamento->getElementsByTagName('FechaBajaDepartamento')->item(0);
                                $fechaBaja = ($nodoFechaBaja && $nodoFechaBaja->nodeValue !== '') ? $nodoFechaBaja->nodeValue : null;

                                // Ejecutamos pasando un array asociativo emparejando el nombre con la variable
                                $sentenciaPreparada->execute([
                                    ':codigo' => $codigo, 
                                    ':descripcion' => $descripcion, 
                                    ':fechaCreacion' => $fechaCreacion, 
                                    ':volumen' => $volumen, 
                                    ':fechaBaja' => $fechaBaja
                                ]);

                                $registrosImportados++;
                            }

                            // Si el bucle termina sin errores, confirmamos la transacción
                            $miDB->commit();

                            echo "<div class='mensaje-exito'>";
                            echo "<h3>Importación completada con éxito.</h3>";
                            echo "<p>Se han importado <b>{$registrosImportados}</b> departamentos desde el archivo XML a la base de datos.</p>";
                            echo "</div>";

                        } else {
                            echo "<div class='error'>El archivo XML está vacío o no tiene el formato correcto.</div>";
                        }
                    } catch (PDOException $miExceptionPDO) {
                        // Si ocurre un error, deshacemos todos los cambios
                        $miDB->rollBack();

                        echo "<div class='error'>";
                        echo "<h3 style='margin-top:0;'>Error al importar en la base de datos.</h3>";
                        
                        // Controlamos el error de clave duplicada (si intentas importar un departamento que ya existe)
                        if ($miExceptionPDO->getCode() == 23000) {
                             echo "<p>Has intentado importar un departamento cuyo código ya existe en la base de datos.</p>";
                        } else {
                            echo "<p>La transacción ha sido cancelada. Ningún registro ha sido importado.</p>";
                            echo "<p><b>Mensaje:</b> " . $miExceptionPDO->getMessage() . "</p>";
                            echo "<p><b>Código:</b> " . $miExceptionPDO->getCode() . "</p>";
                        }
                        echo "</div>";
                    } finally {
                        unset($miDB);
                    }
                } else {
                     echo "<div class='error'><h3 style='margin-top:0;'>Archivo no encontrado</h3><p>No se encuentra el archivo departamentos.xml en la carpeta tmp.</p></div>";
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

