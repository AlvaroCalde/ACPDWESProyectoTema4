<!doctype html>
<html lang="es">
    <head>
        <title>Ejercicio 1 PDO</title>
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
                background-color: black; text-align: center; align-content: center;
                height: 50px; color: white; margin-top: 20%;
                & div a{ color: white; text-decoration: none; }
            }
            .azul{
                color: blue;
            }
            .rojo{
                color: red;
            }
        </style>
    </head>
    <body>
        <nav>
            <h2>DWES - Tema 4</h2>
            <h2>Ejercicio 1 PDO</h2>
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
                    
                    // datos correctos
                    try {
                        $miDB = new PDO(DSN,USERNAME,PASSWORD);
                        echo 'Conectado a la BBDD con éxito';
                        echo '<br><br>';

                        echo '<h3>Atributos de la conexión: </h3>';
                        foreach ( $aAtributos as $atributo ) {
                            echo "PDO::ATTR_$atributo: ";
                            try {
                                echo '<span class="azul">'.$miDB->getAttribute( constant( "PDO::ATTR_$atributo" ) ) . "</span><br>";
                            } catch ( PDOException $miExceptionPDO ) {
                                echo '<span class="rojo"> <b>Error: </b>'.$miExceptionPDO->getMessage().' <b>con código de error:</b> '.$miExceptionPDO->getCode()."</span><br>";
                            }
                        }

                    } catch (PDOException $miExceptionPDO) {
                        echo 'Error: '.$miExceptionPDO->getMessage();
                        echo '<br>';
                        echo 'Código de error: '.$miExceptionPDO->getCode();
                    } finally {
                        unset($miDB);
                    }
                    
                    // datos incorrectos
                    echo '<br>';
                    echo "<h3>Eror de conexión por contraseña incorrecta.</h3>";
                    try{
                        $miDB = new PDO(DSN, USERNAME, "yepa");
                    } catch(PDOException $miExceptionPDO2){
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

