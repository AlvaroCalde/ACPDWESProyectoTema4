<!doctype html>
<html lang="es">
    <head>
        <title>Ejercicio 3 PDO</title>
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
            .nuevaFila { background-color: #FFEA80; }
            
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
            <h2>Ejercicio 3 PDO</h2>
        </nav>
        <main>
            <div class="ejercicio">
                <?php
                
                    setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'spanish');
                    
                    require_once '../core/231018libreriaValidacion.php';
                    require_once '../config/configDBPDO.php';

                     //inicialización de variables
                    $aErrores = [
                        'T02_CodDepartamento' => '',
                        'T02_DescDepartamento' => '',
                        'T02_FechaCreacionDepartamento' => '',
                        'T02_VolumenDeNegocio' => ''
                    ];
                    $aRespuestas = [
                        'T02_CodDepartamento' => '',
                        'T02_DescDepartamento' => '',
                        'T02_FechaCreacionDepartamento' => '',
                        'T02_VolumenDeNegocio' => ''
                    ];
                    
                    $fechaActual = date('Y-m-d'); 
                    $entradaOK = true;
                    
                    if (isset($_REQUEST['enviar'])) {//se cumple si el boton es submit
                        $aErrores['T02_CodDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['T02_CodDepartamento'], 80, 1, 1);
                        $aErrores['T02_DescDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['T02_DescDepartamento'], 50, 1, 1);
                        $aErrores['T02_FechaCreacionDepartamento'] = validacionFormularios::validarFecha($_REQUEST['T02_FechaCreacionDepartamento'], $fechaActual, "1900-01-01", 1);                      
                        $aErrores['T02_VolumenDeNegocio'] = validacionFormularios::comprobarFloatMonetarioES($_REQUEST['T02_VolumenDeNegocio'], PHP_FLOAT_MAX, 0, 1);

                        //recorre el array de errores para detectar si hay alguno
                        foreach ($aErrores as $campo => $valorCampo) {
                            if ($valorCampo != null) {
                                $entradaOK = false; 
                            }
                        }
                    } else {
                        //Si no se ha aceptado el formulario
                        $entradaOK = false;
                    }

                    //Tratamiento del formulario
                    if ($entradaOK) {
                        //Rellenamos el array de respuesta con los valores que ha introducido el usuario
                        $aRespuestas['T02_CodDepartamento'] = $_REQUEST['T02_CodDepartamento'];
                        $aRespuestas['T02_DescDepartamento'] = $_REQUEST['T02_DescDepartamento'];
                        $aRespuestas['T02_FechaCreacionDepartamento'] = $_REQUEST['T02_FechaCreacionDepartamento'];
                        $aRespuestas['T02_VolumenDeNegocio'] = floatval(str_replace(',', '.', $_REQUEST['T02_VolumenDeNegocio']));

                        try {
                            $miDB = new PDO(DSN, USERNAME, PASSWORD);
                            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            $sqlInsert = <<<sql
                                INSERT INTO T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenDeNegocio, T02_FechaBajaDepartamento)
                                VALUES (?, ?, ?, ?, null)
                            sql;
                            
                            $consultaInsert = $miDB->prepare($sqlInsert);
                            $consultaInsert->bindParam(1, $aRespuestas['T02_CodDepartamento']);
                            $consultaInsert->bindParam(2, $aRespuestas['T02_DescDepartamento']);
                            $consultaInsert->bindParam(3, $aRespuestas['T02_FechaCreacionDepartamento']);
                            $consultaInsert->bindParam(4, $aRespuestas['T02_VolumenDeNegocio']);
                            
                            if($consultaInsert->execute()){
                                echo '<p class="exito">¡El departamento ha sido insertado correctamente en la Base de Datos!</p>';
                            }
                            
                            $sqlSelect = "SELECT * FROM T02_Departamento";
                            $consultaSelect = $miDB->query($sqlSelect);
                        
                            echo '<table>';
                            echo '<tr class="titulo">';
                            echo '<th>Código</th>';
                            echo '<th>Descripción</th>';
                            echo '<th>Fecha de Creación</th>';
                            echo '<th>Volumen de Negocio</th>';
                            echo '<th>Fecha de Baja</th>';                       
                            echo '</tr>';

                            while ($Departamento = $consultaSelect->fetchObject()){                              
                                // Comprobamos si el código de esta fila es igual al que acabamos de insertar para resaltarlo
                                if ($Departamento->T02_CodDepartamento === $aRespuestas['T02_CodDepartamento']) {
                                    echo '<tr class="nuevaFila">'; 
                                } else {
                                    echo '<tr>'; 
                                }
                                
                                // Datos básicos
                                echo '<td>' . htmlspecialchars($Departamento->T02_CodDepartamento) . '</td>';
                                echo '<td>' . htmlspecialchars($Departamento->T02_DescDepartamento) . '</td>';

                                // Procesamiento de Fecha de Creación
                                if (!empty($Departamento->T02_FechaCreacionDepartamento)) {
                                    $oFechaCreacion = new DateTime($Departamento->T02_FechaCreacionDepartamento);
                                    echo '<td>' . $oFechaCreacion->format('d/m/Y') . '</td>';
                                } else {
                                    echo '<td>Desconocida</td>';
                                }

                                // Formateamos el float para que se vea en €
                                echo '<td>' . number_format((float)$Departamento->T02_VolumenDeNegocio, 2, ',', '.') . ' €</td>';

                                // Procesamiento de Fecha de Baja
                                if (is_null($Departamento->T02_FechaBajaDepartamento) || empty($Departamento->T02_FechaBajaDepartamento)) {
                                    echo '<td>Activo</td>';
                                } else {
                                    $oFechaBaja = new DateTime($Departamento->T02_FechaBajaDepartamento);
                                    echo '<td>' . $oFechaBaja->format('d/m/Y') . '</td>';
                                }
                                echo '</tr>';
                            }

                            echo '</table>';
                        
                            echo '<br><a href="' . $_SERVER['PHP_SELF'] . '"><button>Volver a insertar otro</button></a>';
                        
                        } catch(PDOException $ePDO) {
                            if ($ePDO->getCode() == 23000) {
                                echo '<p style="color:red; text-align:center;">Error: El código del departamento ya existe en la Base de Datos.</p>';
                                echo '<br><a href="' . $_SERVER['PHP_SELF'] . '"><button>Volver</button></a>';
                            } else {
                                echo 'Error al conectarse o insertar: ' . $ePDO->getMessage();
                            }
                        } finally {
                            unset($miDB);
                        }

                    } else {
                        // Mostrar formulario
                    ?>
                    <section>
                        <h2>Rellena el formulario.</h2>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

                            <label for="T02_CodDepartamento">Código de departamento: </label>
                            <span class="error"><?php echo $aErrores['T02_CodDepartamento'] ?></span>
                            <input class="obligatorio" name="T02_CodDepartamento" id="T02_CodDepartamento" type="text" value="<?php echo !empty($_REQUEST['T02_CodDepartamento']) ? htmlspecialchars($_REQUEST['T02_CodDepartamento']) : ''; ?>"><br>
                            <br>
                            
                            <label for="T02_DescDepartamento">Descripción del departamento: </label>
                            <span class="error"><?php echo $aErrores['T02_DescDepartamento'] ?></span>
                            <input class="obligatorio" name="T02_DescDepartamento" id="T02_DescDepartamento" type="text" value="<?php echo !empty($_REQUEST['T02_DescDepartamento']) ? htmlspecialchars($_REQUEST['T02_DescDepartamento']) : ''; ?>"><br>
                            <br>
                            
                            <label for="T02_FechaCreacionDepartamento">Introduzca fecha de creación: </label>
                            <span class="error"><?php echo $aErrores['T02_FechaCreacionDepartamento'] ?></span>
                            <input type="date" name="T02_FechaCreacionDepartamento" id="T02_FechaCreacionDepartamento" max="<?php echo $fechaActual; ?>" value="<?php echo !empty($_REQUEST['T02_FechaCreacionDepartamento']) && empty($aErrores['T02_FechaCreacionDepartamento']) ? htmlspecialchars($_REQUEST['T02_FechaCreacionDepartamento']) : ''; ?>"><br>
                            <br>
                            
                            <label for="T02_VolumenDeNegocio">Introduzca el volumen del negocio: </label>
                            <span class="error"><?php echo $aErrores['T02_VolumenDeNegocio'] ?></span>
                            <input type="text" name="T02_VolumenDeNegocio" id="T02_VolumenDeNegocio" title="Usar comas para separar decimales" value="<?php echo !empty($_REQUEST['T02_VolumenDeNegocio']) ? htmlspecialchars($_REQUEST['T02_VolumenDeNegocio']) : ''; ?>"><br>
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
                <a href="../../ACPDWESProyectoDWES/indexProyectoDWES.php">Álvaro Calderón Pérez</a>
                <a href="../indexProyectoTema4.php"><img src="../webroot/images/casa_blanca.png" alt="home"></a>
                <time datetime="2026-10-21">21-10-2026</time>
            </div>
        </footer>
    </body>
</html>            