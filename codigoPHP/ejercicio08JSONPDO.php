<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 8 JSON PDO</title>
    <link rel="stylesheet" href="../webroot/css/estilos08PDO.css">
</head>
<body>
    <nav>
        <h2>DWES - Tema 4</h2>
        <h2>Ejercicio 8 JSON PDO</h2>
    </nav>
    <main class="ejercicio">
       <div class="buscador">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2 style="margin-top: 0;">Copia de Seguridad (JSON)</h2>
                <p style="margin-bottom: 20px; color: #555;">Exportar todos los departamentos a un archivo JSON.</p>
                <button type="submit" name="exportar">Generar y Exportar departamentos.json</button>
            </form>  
        </div>
        <?php
        if (isset($_REQUEST['exportar'])) {
            /**
                * @author: Álvaro Calderón Pérez    
             * @since: 04/11/2026
             * Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un fichero departamento.xml. (COPIA DE SEGURIDAD / EXPORTAR). El fichero exportado se encuentra en el directorio .../tmp/ del servidor. 
             */ 
        
             // importamos el archivo con los datos de conexión
             require_once '../config/configDBPDO.php';
             $numRegistros = 0;
             try {
                $miDB = new PDO(DSN,USERNAME,PASSWORD);
                $sql = "select * from T02_Departamento";

                $consulta = $miDB->prepare($sql);
                $consulta->execute();

                // inicializo el array vacio para que no me de error después en json_encode en caso de que no haya registros en la bbdd.
                $aDepartamentos=[];
                $indice = 0;
                while ($Departamento = $consulta->fetchObject()) {
                    $aDepartamentos[$indice]=[
                        'CodDepartamento' => $Departamento->T02_CodDepartamento,
                        'DescDepartamento' => $Departamento->T02_DescDepartamento,
                        'FechaCreacionDepartamento' => $Departamento->T02_FechaCreacionDepartamento,
                        'VolumenDeNegocio' => $Departamento->T02_VolumenDeNegocio,
                        // Si la fecha de baja es NULL en la DB, la convertimos a 'NULL' para la exportación
                        'FechaBajaDepartamento' => $Departamento->T02_FechaBajaDepartamento ?? 'null'
                    ];
                    $indice++;
                }
                
                $rutaFicheroGuardar = $_SERVER["DOCUMENT_ROOT"] . '/ACPDWESProyectoTema4/tmp/' . 'departamentos.json';

                // https://www.php.net/manual/es/json.constants.php
                // JSON_PRETTY_PRINT sirve para que después al visualizarlo haga saltos de linea, sino se ve todo en una sola
                $json = json_encode($aDepartamentos,JSON_PRETTY_PRINT);
                $jsonGenerado=file_put_contents($rutaFicheroGuardar,$json);
                if ($jsonGenerado !== false) {
                    // Ruta absoluta web que el navegador necesita para encontrar el archivo
                    $rutaEnlaceWeb = '/ACPDWESProyectoTema4/tmp/departamentos.json';

                    // Mostramos el mensaje y el enlace web
                    echo "<div class='mensaje-exito'>";
                    echo "<h3>Exportacion completada con exito.</h3>";
                    echo "<p>El archivo se ha guardado en: <b>{$rutaFicheroGuardar}</b></p>";
                    echo "<a href='{$rutaEnlaceWeb}' target='_blank' style='color: #155724; font-weight: bold; text-decoration: underline;'>Ver archivo JSON</a>";
                    echo "</div>";
                } else {
                    echo "<div class='error'>Error: No se pudo escribir el archivo JSON. Verifica los permisos de la carpeta.</div>";
                }
                

            } catch (PDOException $miExceptionPDO) {
                echo '<p class="error">ERROR al exportar datos a JSON</p>';
                echo 'Error: '.$miExceptionPDO->getMessage();
                echo '<br>';
                echo 'Código de error: '.$miExceptionPDO->getCode();
            } finally {
                unset($miDB);
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
