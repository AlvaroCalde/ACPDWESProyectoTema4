<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 6 PDO</title>
    <style>
        *{ margin: 0 auto; padding: 0 auto; }
        nav{ background-color: black; color: white; padding: 5px; text-align: center}
        body{
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            align-items: center;
            text-align: center;
        }
        .ejercicio{
            padding: 50px;
            margin-top: 10px;
            margin-bottom: 10px;
            width: 1150px;
            border: 1px solid black;
            border-radius: 10px;
            p { font-weight: bold; }
            h2 { font-weight: bold; text-align: center; margin-top: 2%;}
        }
         table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        td, th { border: 1px solid black; padding: 8px; text-align: center; }
        .titulo th { font-weight: bold; background-color: #ddd; }
        
        .correcto{background-color: #dce9d5ff;}
        .error{background-color: #e9b8b8ff;}
        footer{
            background-color: black; 
            text-align: center; 
            align-content: center;
            height: 50px; 
            color: white; 
            margin-top: 10%;
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
        <h2>Ejercicio 6 PDO</h2>
    </nav>
    <main class="ejercicio">
       <?php
            /**
        * @author: Álvaro Calderón Pérez
        * @since: 29/10/2026
        * Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones
        * insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.
        */
        require_once '../config/configDBPDO.php';


            try {
                // Instanciamiento del objeto PDO para establecer la conexion con mariadb
                $miDB = new PDO(DSN, USERNAME, PASSWORD);
                
                $aDepartamentos = [
                    [
                        "codDepartamento" => "AAA",
                        "descripcionDepartamento" => "aaaaaaa",
                        "volumenDepartamento" => 1000
                    ],
                    [
                        "codDepartamento" => "BBB",
                        "descripcionDepartamento" => "bbbbbbbb",
                        "volumenDepartamento" => 1500
                    ],
                    [
                        "codDepartamento" => "CCC",
                        "descripcionDepartamento" => "ccccccccc",
                        "volumenDepartamento" => 18000.55
                    ]
                ];

                $miDB->beginTransaction(); 

                // Preparacion de la sentencia SQL utilizando signos de interrogacion
                $sqlInsert = 'INSERT INTO T02_Departamento VALUES (:codDepartamento, :desDepartamento, NOW(), :volumenNegocioDepartamento, NULL)';
                $sentenciaPreparada = $miDB->prepare($sqlInsert);

                // El execute debe recibir un array asociativo
                foreach ($aDepartamentos as $departamento) {
                    $sentenciaPreparada->execute([
                        "codDepartamento" => $departamento["codDepartamento"],
                        "desDepartamento" => $departamento["descripcionDepartamento"],
                        "volumenNegocioDepartamento" => $departamento["volumenDepartamento"]
                    ]);
                    echo '<p>Insertado departamento con código: <b>' . $departamento["codDepartamento"] . '</b></p>';
                }

                $miDB->commit(); // Confirma los cambios y los consolida

                echo '<div class="mensaje-exito">Transaccion completada. Todos los registros se han añadido correctamente.</div>';

                $consulta = $miDB->query('SELECT * FROM T02_Departamento');

                echo '<table class="tabla-departamentos" style="margin: 15px auto;">';
                echo '<thead>';
                echo '<tr>';
                echo '<th class="texto-centro">Código</th>';
                echo '<th>Descripción</th>';
                echo '<th class="texto-centro">Fecha de Alta</th>';
                echo '<th class="texto-derecha">Volumen de Negocio</th>';
                echo '<th class="texto-centro">Fecha de Baja</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($oDepartamento = $consulta->fetchObject()) {
                    echo '<tr>';
                    echo '<td class="texto-centro"><b>' . $oDepartamento->T02_CodDepartamento . '</b></td>';
                    echo '<td>' . $oDepartamento->T02_DescDepartamento . '</td>';

                    // Formateo de la fecha de alta a formato español (d/m/Y)
                    $fechaCreacionDepartamento = new DateTime($oDepartamento->T02_FechaCreacionDepartamento);
                    echo '<td class="texto-centro">' . $fechaCreacionDepartamento->format('d/m/Y') . '</td>';

                    // Formateo del numero a moneda española
                    echo '<td class="texto-derecha">' . number_format($oDepartamento->T02_VolumenDeNegocio, 2, ',', '.') . ' €</td>';

                    // Comprobacion en la fecha de baja
                    if (is_null($oDepartamento->T02_FechaBajaDepartamento)) {
                        echo '<td class="texto-centro">-</td>';
                    } else {
                        $fechaBajaDepartamento = new DateTime($oDepartamento->T02_FechaBajaDepartamento);
                        echo '<td class="texto-centro">' . $fechaBajaDepartamento->format('d/m/Y') . '</td>';
                    }
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';

            } catch (PDOException $miExcepcionPDO) { 
                if (isset($miDB) && $miDB->inTransaction()) {
                    $miDB->rollBack();
                }

                echo '<div class="error" style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; border: 1px solid #f5c6cb;">';
                echo 'Transacción cancelada.<br/>';
                echo 'Código del error: ' . $miExcepcionPDO->getCode() . '<br/>';
                echo 'Mensaje de error: ' . $miExcepcionPDO->getMessage();
                echo '</div>';
            } finally {
                // Cierra la conexion con la base de datos
                unset($miDB);
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

