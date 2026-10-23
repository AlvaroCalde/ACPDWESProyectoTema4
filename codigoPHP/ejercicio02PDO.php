<!doctype html>
<html lang="es">
    <head>
        <title>Ejercicio 2 PDO</title>
        <style>
            input[type="text"],input[type="date"],input[type="number"]{ background-color: #fff9c4; }
            *{ margin: 0 auto; padding: 0 auto; }
            nav{ background-color: black; color: white; }
            span{ color: red; }
            .ejercicio{
                padding: 50px;
                margin-top: 10px;
                margin-bottom: 10px;
                width: 1150px;
                border: 1px solid black;
                border-radius: 10px;
                p { font-weight: bold; }
            }
            footer{
                background-color: black; 
                text-align: center; 
                align-content: center;
                height: 50px; 
                color: white; 
                margin-top: 15%;
                & div a{ color: white; 
                         text-decoration: none; }
            }
            footer a img{
                width: 40px;
            }
            table { border-collapse: collapse; width: 100%; margin-top: 20px; }
            td, th { border: 1px solid black; padding: 8px; text-align: center; }
            .titulo th { font-weight: bold; background-color: #ddd; }
        </style>
    </head>
    <body>
        <nav>
            <h2>DWES - Tema 4</h2>
            <h2>Ejercicio 2 PDO</h2>
        </nav>
        <main>
            <div class="ejercicio">
                <?php
                    require_once '../config/configDBPDO.php';
                                  
                    $sql='SELECT * FROM T02_Departamento';
                                                                      
                    try {
                        $miDB = new PDO(DSN,USERNAME,PASSWORD);
                        echo 'Tabla departamentos con query';
                        echo '<br><br>';

                        $consulta = $miDB->query($sql);
                        
                        echo '<table>';
                        echo '<tr class="titulo">';
                        echo '<td>Código</td>';
                        echo '<td>Descripción</td>';
                        echo '<td>FechaCreación</td>';
                        echo '<td>VolumenDeNegocio</td>';
                        echo '<td>FechaBaja</td>';                       
                        echo '</tr>';
                        
                        // Utilizamos fetchObject()
                        while ($Departamento = $consulta->fetchObject()){
                            echo '<tr>';
                            // Accedemos a los campos como propiedades del objeto
                            echo '<td>'.$Departamento->T02_CodDepartamento.'</td>';
                            echo '<td>'.$Departamento->T02_DescDepartamento.'</td>';
                            
                            // construimos la fecha a partir de la que hay en la bbdd y luego mostramos sólo dia mes y año
                            $oFechaCreacion = new DateTime($Departamento->T02_FechaCreacionDepartamento);
                            echo '<td>'.$oFechaCreacion->format('d/m/Y').'</td>';
                            
                            // formateamos el float para que se vea en €
                            echo '<td>'.number_format($Departamento->T02_VolumenDeNegocio,2,',','.').' €</td>';
                            
                            if (is_null($Departamento->T02_FechaBajaDepartamento) || empty($Departamento->T02_FechaBajaDepartamento)) {
                                    echo '<td>Activo</td>';
                                } else {
                                    $oFechaBaja = new DateTime($Departamento->T02_FechaBajaDepartamento);
                                    echo '<td>' . $oFechaBaja->format('d/m/Y') . '</td>';
                                }
                            echo '</tr>';
                        }
                        
                        echo '</table>';

                        echo '<h3>Número de registros: '.$consulta->rowCount().'</h3>';

                    } catch (PDOException $miExceptionPDO) {
                        echo 'Error: '.$miExceptionPDO->getMessage();
                        echo '<br>';
                        echo 'Código de error: '.$miExceptionPDO->getCode();
                    } finally {
                        unset($miDB);
                    }
                ?>
            </div>
        </main>
        <footer>
            <div>
                <a href="../../ACPDWESProyectoDWES/indexProyectoDWES.php" color="white">Álvaro Calderón Pérez</a>
                <a href="../indexProyectoTema4.php"><img src="../webroot/images/casa_blanca.png" alt="home"></a>
                <time datetime="2026-10-21">21-10-2026</time>
            </div>
        </footer>
    </body>
</html>

