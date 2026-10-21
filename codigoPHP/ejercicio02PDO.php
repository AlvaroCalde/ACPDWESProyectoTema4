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
                margin-top: 20%;
                & div a{ color: white; 
                         text-decoration: none; }
            }
            
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
                    require_once '../config/configDB00.php';
                    
                    $aAtributos = array(
                        "AUTOCOMMIT", "ERRMODE", "CASE", "CLIENT_VERSION", "CONNECTION_STATUS",
                        "ORACLE_NULLS", "PERSISTENT", "PREFETCH", "SERVER_INFO", "SERVER_VERSION",
                        "TIMEOUT"
                    );
                    
                    // variable para contar el numero de registros recuperados de la BBDD
                    $numRegistros = 0;
                                                          
                    try {
                        $miDB = new PDO(DSN,USERNAME,PASSWORD);
                        echo 'Conectado a la BBDD con éxito';
                        echo '<br><br>';

                        $consulta = $miDB->query('SELECT * FROM T02_Departamento');
                        
                        echo '<table>';
                        echo '<tr class="titulo">';
                        echo '<td>T02_CodDepartamento</td>';
                        echo '<td>T02_DescDepartamento</td>';
                        echo '<td>T02_FechaCreaciónDepartamento</td>';
                        echo '<td>T02_FechaBajaDeparamento</td>';
                        echo '<td>T02_VolumenDeNegocio</td>';
                        echo '</tr>';
                        
                        while ($registro = $consulta ->fetch()){
                            echo '<tr>';
                            echo '<td>'.$registro['T02_CodDepartamento'].'</td>';
                            echo '<td>'.$registro["T02_DescDepartamento"].'</td>';
                            // construimos la fecha a partir de la que hay en la bbdd y luego mostramos sólo dia mes y año
                            $oFecha = new DateTime($registro["T02_FechaCreacionDepartamento"]);
                            echo '<td>'.$oFecha->format('d/m/Y').'</td>';
                            // formateamos el float para que se vea en €
                            echo '<td>'.number_format($registro["T02_VolumenDeNegocio"],2,',','.').' €</td>';
                            if (is_null($registro["T02_FechaBajaDepartamento"])) {
                                echo '<td></td>';
                            } else {
                                $oFecha = new DateTime($registro["T02_FechaBajaDepartamento"]);
                                echo '<td>'.$oFecha->format('d/m/Y').'</td>';
                            }
                            echo '</tr>';
                            $numRegistros++;
                        }
                        
                        echo '</table>';

                        echo '<h3>Número de registros: '.$numRegistros.'</h3>';


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
                <a href="../indexProyectoTema4.php" color="white">Álvaro Calderón Pérez</a>
                <time datetime="2026-10-16">16-10-2026</time>
            </div>
        </footer>
    </body>
</html>

