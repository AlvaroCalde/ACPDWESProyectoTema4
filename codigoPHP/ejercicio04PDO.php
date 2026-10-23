<!doctype html>
<html lang="es">
    <head>
        <title>Ejercicio 4 PDO</title>
        <style>
            input[type="text"],input[type="date"],input[type="number"]{ background-color: #fff9c4; }
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
            table { border-collapse: collapse; width: 100%; margin-top: 20px; }
            td, th { border: 1px solid black; padding: 8px; text-align: center; }
            .titulo th { font-weight: bold; background-color: #ddd; }
            .exito { color: green; font-weight: bold; text-align: center; margin-bottom: 15px;}
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
                    
                    $sql2 = "SELECT * FROM T02_Departamento";

                     //inicialización de variables
                    $aErrores = [
                        'T02_DescDepartamento' => '',
                    ];
                    $aRespuestas = [
                        'T02_DescDepartamento' => '',
                    ];
                    
                    
                    
                    $entradaOK = true;
                    
                     //Para cada campo del formulario se valida la entrada y se actua en consecuencia
                    if (isset($_REQUEST['enviar'])) {
                        $aErrores['T02_DescDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['T02_DescDepartamento'], 50, 1, 1);

                        foreach ($aErrores as $campo => $valorCampo) {
                            if ($valorCampo != null) {
                                $entradaOK = false; 
                            }
                        }
                    } else {
                        $entradaOK = false;
                    }

                    //Tratamiento del formulario
                    if ($entradaOK) {
                        $aRespuestas['T02_DescDepartamento'] = $_REQUEST['T02_DescDepartamento'];
                        $desc='%'. $aRespuestas['T02_DescDepartamento'] . '%';                    
                        $sql = "SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE '$desc'";
                        

                        try {
                            $miDB = new PDO(DSN, USERNAME, PASSWORD);                           

                            $resultado = $miDB->query($sql);
                            echo '<table>';
                            echo '<tr class="titulo">';
                            echo '<th>Código</th>';
                            echo '<th>Descripción</th>';
                            echo '<th>Fecha de Creación</th>';
                            echo '<th>Volumen de Negocio</th>';
                            echo '<th>Fecha de Baja</th>';                       
                            echo '</tr>';
                            
                            if($resultado->rowCount()==0){
                                $resultado=$miDB->query($sql2);
                                while ($Departamento = $resultado->fetchObject()){
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
                                while ($Departamento = $resultado->fetchObject()){
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
                            }
                        
                            // Botón para volver al formulario
                            echo '<br><a href="' . $_SERVER['PHP_SELF'] . '"><button>Volver al formulario</button></a>';
                        
                        } catch (PDOException $miExceptionPDO) {
                            echo 'Error: '.$miExceptionPDO->getMessage();
                            echo '<br>';
                            echo 'Código de error: '.$miExceptionPDO->getCode();
                        } finally {
                            unset($miDB);
                        }
                    } else {
                        //si hay algún error se vuelve a mostrar el formulario
                    ?>
                    <section>
                        <h2>Rellena el formulario.</h2>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            
                            <label for="T02_DescDepartamento">Descripción del departamento a buscar: </label>
                            <span class="error"><?php echo $aErrores['T02_DescDepartamento'] ?></span>
                            <input class="obligatorio" name="T02_DescDepartamento" id="T02_DescDepartamento" type="text" value="<?php echo $_REQUEST['T02_DescDepartamento'] ?? ''; ?>"><br>
                            <br>                                                      
                            <button type="submit" name="enviar">Enviar</button>
                            <a href="../indexProyectoTema4.php"><button type="button">Cancelar</button></a>
                        </form>  
                    </section>
                        <?php
                    }
                ?>
            </div>
        </main>
        <footer>
            <div>
                <a href="../../ACPDWESProyectoDWES/indexProyectoDWES.php" color="white">Álvaro Calderón Pérez</a>
                <a href="../indexProyectoTema4.php"><img src="../webroot/images/casa_blanca.png" alt="home"></a>
                <time datetime="2026-10-23">23-10-2026</time>
            </div>
        </footer>
    </body>
</html>      

