<html lang="es"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Indice general de la asignatura">
    <meta name="author" content="Álvaro Calderón Pérez">
    <title>Tema 4-PHP Álvaro Calderón Pérez</title>
    <link rel="stylesheet" href="./webroot/css/estilos.css">
</head>
<body>
    <nav>
        <h2>Tema 4: Técnicas de acceso a datos en PHP</h2>
    </nav>
    <main>
        <div class="tablaScript">
            <table>
                <tbody>
                    <tr class="titulo">
                        <td>Script</td>
                        <td>Código</td>
                    </tr>
                    <tr>
                        <td>Script 1</td>
                        <td><a href="./mostarcodigo/script.sql">Codigo</td>
                    </tr>
                    <tr>
                        <td>Script 2</td>
                        <td><a href="./mostarcodigo/script.sql">Codigo</td>
                    </tr>
                    <tr>
                        <td>Script 3</td>
                        <td><a href="./mostarcodigo/script.sql">Codigo</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tabla">
            <table>
                <tbody>
                    <tr class="titulo">
                        <td>Nº</td>
                        <td>Enunciado</td>
                        <td>Ejecutar PDO</td>
                        <td>Código PDO</td>
                        <td>Ejecutar MySQLi</td>
                        <td>Código MySQLi</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>
                        Conexión a la base de datos con la cuenta usuario y tratamiento de errores.
                        </td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                        Mostrar el contenido de la tabla Departamento y el número de registros
                        </td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                        Formulario para añadir un departamento a la tabla Departamento con validación de entrada y
                        control de errores.

                        </td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>
                        Formulario de búsqueda de departamentos por descripción (por una parte del campo
                        DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos).
                        </td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>
                        Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones
                        insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.
                        </td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>
                        Pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos
                        utilizando una consulta preparada.
                        </td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>
                        Página web que toma datos (código y descripción) de un fichero xml y los añade a la tabla
                        Departamento de nuestra base de datos. (IMPORTAR). El fichero importado se encuentra en el
                        directorio .../tmp/ del servidor.
                        </td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>
                        Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un
                        fichero departamento.xml. (COPIA DE SEGURIDAD / EXPORTAR). El fichero exportado se
                        encuentra en el directorio .../tmp/ del servidor
                        </td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>
                        Aplicación resumen MtoDeDepartamentosTema4. (Incluir PHPDoc y versionado en el repositorio
                        GIT)

                        </td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>
                        Aplicación resumen MtoDeDepartamentos POO y multicapa.
                        </td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                        <td><a href="./codigoPHP/ejercicio01.php">Ejecutar</td>
                        <td><a href="./mostarcodigo/muestraEjercicio01.php">Codigo</td>
                    </tr>                    
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <div>
            <a href="https://github.com/AlvaroCalde/ACPDWESProyectoTema4" target="blank"><img src="/webroot/images/github.png" alt="enlace a github"></a>
            <a href="/">
           Álvaro Calderón Pérez
            </a>
        </div>
    </footer>

</body></html>