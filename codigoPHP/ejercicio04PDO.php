<!doctype html>
<html lang="es">
    <head>
        <title>Ejercicio 4 PDO</title>
        <style>
            input[type="text"] { background-color: #fff9c4; }
            *{ margin: 0 auto; padding: 0 auto; }
            nav{ background-color: black; color: white; }
            span.error { color: red; display: block; font-size: 13px; min-height: 16px; }
            .ejercicio{
                padding: 50px;
                margin-top: 10px;
                margin-bottom: 10px;
                width: 1150px;
                border: 1px solid black;
                border-radius: 10px;
                p { font-weight: bold; }
            }
            .buscador {
                background-color: #f2f2f2;
                padding: 20px;
                border-radius: 8px;
                margin-bottom: 30px;
                text-align: center;
                border: 1px solid #ccc;
            }
            table { border-collapse: collapse; width: 100%; margin-top: 20px; }
            td, th { border: 1px solid black; padding: 8px; text-align: center; }
            .titulo th { font-weight: bold; background-color: #ddd; }
            .sin-resultados { text-align: center; color: red; font-size: 18px; margin-top: 20px; }
            
            footer{
                background-color: black; 
                text-align: center; 
                align-content: center;
                height: 50px; 
                color: white; 
                margin-top: 20%;
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
            <h2>Ejercicio 4 PDO</h2>
        </nav>
        <main>
            <div class="ejercicio">
                <?php
                    setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'spanish');
                    
                    require_once '../core/231018libreriaValidacion.php';
                    require_once '../config/configDBPDO.php';

                    // Estructura estándar de arrays para el formulario
                    $aErrores = [
                        'T02_DescDepartamento' => ''
                    ];
                    $aRespuestas = [
                        'T02_DescDepartamento' => ''
                    ];
                    

                    $entradaOK = true;
                    
                    if (isset($_REQUEST['buscar'])) {
                        // Comprobamos la entrada, pasando 0 al final para que sea OPCIONAL
                        $aErrores['T02_DescDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['T02_DescDepartamento'], 50, 1, 0);
                        
                        // Recorremos el array de errores
                        foreach ($aErrores as $campo => $valorCampo) {
                            if ($valorCampo != null) {
                                $entradaOK = false; 
                            }
                        }
                        
                        // Si todo es correcto, guardamos la respuesta y activamos la búsqueda
                        if ($entradaOK) {
                            $aRespuestas['T02_DescDepartamento'] = $_REQUEST['T02_DescDepartamento'];

                        }
                    } else {
                        $entradaOK = false;
                    }
                ?>
                

                <section class="buscador">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <label for="T02_DescDepartamento">Buscar por Descripción del Departamento:</label><br><br>
                        
                        <input type="text" name="T02_DescDepartamento" id="T02_DescDepartamento" placeholder="Deja vacío para ver todos" value="<?php echo isset($_REQUEST['T02_DescDepartamento']) ? htmlspecialchars($_REQUEST['T02_DescDepartamento']) : ''; ?>">
                        <span class="error"><?php echo $aErrores['T02_DescDepartamento']; ?></span>
                        <br>
                        
                        <button type="submit" name="buscar">Buscar</button>
                        <a href="../indexProyectoTema4.php"><button type="button">Volver</button></a>
                    </form>  
                </section>

                <?php
                    
                        try {
                            $miDB = new PDO(DSN, USERNAME, PASSWORD);
                            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            $busqueda = $aRespuestas['T02_DescDepartamento'];
                            
                            $sqlSelect = "SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE '%$busqueda%'";
                            $consultaSelect = $miDB->query($sqlSelect);
                            
                            // Comprobamos si hay resultados
                            if ($consultaSelect->rowCount() > 0) {
                                echo '<table>';
                                echo '<tr class="titulo">';
                                echo '<th>Código</th>';
                                echo '<th>Descripción</th>';
                                echo '<th>Fecha de Creación</th>';
                                echo '<th>Volumen de Negocio</th>';
                                echo '<th>Fecha de Baja</th>';                       
                                echo '</tr>';

                                while ($Departamento = $consultaSelect->fetchObject()){                              
                                    echo '<tr>'; 
                                    
                                    echo '<td>' . htmlspecialchars($Departamento->T02_CodDepartamento) . '</td>';
                                    echo '<td>' . htmlspecialchars($Departamento->T02_DescDepartamento) . '</td>';

                                    if (!empty($Departamento->T02_FechaCreacionDepartamento)) {
                                        $oFechaCreacion = new DateTime($Departamento->T02_FechaCreacionDepartamento);
                                        echo '<td>' . $oFechaCreacion->format('d/m/Y') . '</td>';
                                    } else {
                                        echo '<td>Desconocida</td>';
                                    }

                                    echo '<td>' . number_format((float)$Departamento->T02_VolumenDeNegocio, 2, ',', '.') . ' €</td>';

                                    if (is_null($Departamento->T02_FechaBajaDepartamento) || empty($Departamento->T02_FechaBajaDepartamento)) {
                                        echo '<td>Activo</td>';
                                    } else {
                                        $oFechaBaja = new DateTime($Departamento->T02_FechaBajaDepartamento);
                                        echo '<td>' . $oFechaBaja->format('d/m/Y') . '</td>';
                                    }
                                    echo '</tr>';
                                }
                                echo '</table>';
                            } else {
                                echo '<p class="sin-resultados">No se ha encontrado ningún departamento con esa descripción.</p>';
                            }
                        
                        } catch(PDOException $ePDO) {
                            echo '<p class="error">Error al conectarse a la base de datos: ' . $ePDO->getMessage() . '</p>';
                        } finally {
                            unset($miDB);
                        }
                    
                ?>
            </div>
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