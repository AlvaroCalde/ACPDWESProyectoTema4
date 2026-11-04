<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 8 XML PDO</title>
    <link rel="stylesheet" href="../webroot/css/estilos08PDO.css">
</head>
<body>
    <nav>
        <h2>DWES - Tema 4</h2>
        <h2>Ejercicio 8 XML PDO</h2>
    </nav>
    <main class="ejercicio">
       <div class="buscador">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2 style="margin-top: 0;">Copia de Seguridad (XML)</h2>
                <p style="margin-bottom: 20px; color: #555;">Exportar todos los departamentos a un archivo XML.</p>
                <button type="submit" name="exportar">Generar y Exportar departamentos.xml</button>
            </form>  
        </div>

        <?php
        /**
        * @author: Álvaro Calderón Pérez
        * @since: 29/10/2026
        * Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un
        * fichero departamento.xml. (COPIA DE SEGURIDAD / EXPORTAR). El fichero exportado se
        * encuentra en el directorio .../tmp/ del servidor.
        * 
        */
        if (isset($_REQUEST['exportar'])) {

            // Archivo con las variables de conexion a la base de datos
            require_once '../config/configDBPDO.php';

            try {
                // Instanciacion del objeto PDO para conectar a MariaDB
                $miDB = new PDO(DSN, USERNAME, PASSWORD);

                // Consulta SQL para obtener TODOS los campos de los departamentos
                $sql = 'SELECT T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenDeNegocio, T02_FechaBajaDepartamento FROM T02_Departamento';
                $consultaPreparada = $miDB->prepare($sql);
                $consultaPreparada->execute();

                // Si hay registros, comenzamos a generar el XML
                if ($consultaPreparada->rowCount() > 0) {

                    // Instanciamos el objeto DOMDocument (versión 1.0, codificación UTF-8)
                    $documentoXML = new DOMDocument('1.0', 'UTF-8');
                    // Formatear la salida para que el XML tenga saltos de línea (sea legible)
                    $documentoXML->formatOutput = true;
                    // Creamos el elemento raiz departamentos y lo añadimos al documento
                    $raiz = $documentoXML->createElement('departamentos');

                    // Añade un nuevo hijo al final de los hijos
                    $documentoXML->appendChild($raiz);

                    // Recorremos los registros de la base de datos
                    while ($oDepartamento = $consultaPreparada->fetchObject()) {

                        // Creamos el departamento para cada registro
                        $sDepartamento = $documentoXML->createElement('departamento');

                        // 1. CÓDIGO
                        $sCodigo = $documentoXML->createElement('CodDepartamento');
                        $sCodigo->appendChild($documentoXML->createTextNode($oDepartamento->T02_CodDepartamento));
                        $sDepartamento->appendChild($sCodigo);

                        // 2. DESCRIPCIÓN
                        $sDescripcion = $documentoXML->createElement('DescDepartamento');
                        $sDescripcion->appendChild($documentoXML->createTextNode($oDepartamento->T02_DescDepartamento));
                        $sDepartamento->appendChild($sDescripcion);

                        // 3. FECHA DE CREACIÓN
                        $sFechaCreacion = $documentoXML->createElement('FechaCreacionDepartamento');
                        $sFechaCreacion->appendChild($documentoXML->createTextNode($oDepartamento->T02_FechaCreacionDepartamento));
                        $sDepartamento->appendChild($sFechaCreacion);

                        // 4. VOLUMEN DE NEGOCIO 
                        $sVolumen = $documentoXML->createElement('VolumenDeNegocio');
                        $sVolumen->appendChild($documentoXML->createTextNode($oDepartamento->T02_VolumenDeNegocio));
                        $sDepartamento->appendChild($sVolumen);

                        // 5. FECHA DE BAJA
                        $sFechaBaja = $documentoXML->createElement('FechaBajaDepartamento');
                        // Si la fecha de baja es null, ponemos un texto vacío en el XML para evitar errores
                        $valorFechaBaja = !empty($oDepartamento->T02_FechaBajaDepartamento) ? $oDepartamento->T02_FechaBajaDepartamento : '';
                        $sFechaBaja->appendChild($documentoXML->createTextNode($valorFechaBaja));
                        $sDepartamento->appendChild($sFechaBaja);

                        // Colgamos el departamento completo de la raiz departamentos
                        $raiz->appendChild($sDepartamento);
                    }

                    // Preparamos el directorio /tmp/
                    $directorioTMP = dirname(__DIR__) . '/tmp/';

                    // Ruta completa absoluta para que el servidor guarde el archivo
                    $rutaFicheroGuardar = $directorioTMP . 'departamentos.xml';

                    // Guardamos el archivo XML generado en el servidor
                    $documentoXML->save($rutaFicheroGuardar);

                    // Ruta relativa que el navegador necesita para encontrar el archivo desde 'codigoPHP'
                    $rutaEnlaceWeb = '../tmp/departamentos.xml';

                    // Mostramos el mensaje y el enlace web
                    echo "<div class='mensaje-exito'>";
                    echo "<h3>Exportacion completada con exito.</h3>";
                    echo "<p>El archivo se ha guardado en: <b>{$rutaFicheroGuardar}</b></p>";
                    echo "<a href='{$rutaEnlaceWeb}' target='_blank' style='color: #155724; font-weight: bold; text-decoration: underline;'>Ver archivo XML</a>";
                    echo "</div>";

                } else {
                    echo "<div class='error'><p>No hay departamentos para exportar.</p></div>";
                }
            } catch (PDOException $miExceptionPDO) {
                // Captura errores de PDO
                echo "<div class='error'>";
                echo "<h3 style='margin-top:0;'>Error en la base de datos.</h3>";
                echo "<p><b>Mensaje:</b> " . $miExceptionPDO->getMessage() . "</p>";
                echo "<p><b>Código:</b> " . $miExceptionPDO->getCode() . "</p>";
                echo "</div>";
            } finally {
                // Cierra la conexión a la base de datos
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