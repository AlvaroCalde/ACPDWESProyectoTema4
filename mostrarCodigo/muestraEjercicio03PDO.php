<!doctype html>
<html lang="es">
    <head>
            <meta charset="UTF-8">
        <title>Ejercicio 2 PDO</title>
        <style>
            *{
                margin: 0 auto;
                padding: 0 auto;
            }

            nav{
                background-color: black; 
                color: white;
            }

            footer{
                background-color: black;
                text-align: center;
                align-content: center;
                height: 50px;;
                color: white;
                margin-top: 20%;

                

                & div a{
                    color: white;
                   text-decoration: none; 
                }
            }
            h2{
                text-align: center;
                border-bottom: 2px solid black;
            }
            footer a img{
                width: 40px;
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
                highlight_file("../codigoPHP/ejercicio03PDO.php");
                ?>
            </div>
        </main>
        <footer>
            <div>
                <a href="../indexProyectoTema3.php">
               Álvaro Calderón Pérez
                </a>
                <a href="../indexProyectoTema4.php"><img src="../webroot/images/casa_blanca.png" alt="home"></a>
                <time datetime="2026-10-21">21-10-2026</time>
            </div>
        </footer>
    </body>
</html>

