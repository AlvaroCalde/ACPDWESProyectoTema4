<!DOCTYPE html>
<html lang="es">
<head>
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
                        <td>Ficheros utilizados</td>
                        <td>Código</td>
                    </tr>
                    <tr>
                        <td>Script Creación</td>
                        <td><a href="./mostrarCodigo/muestraScriptCrear.php" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>Script Carga Inicial</td>
                        <td><a href="./mostrarCodigo/muestraScriptCarga.php" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>Script Delete</td>
                        <td><a href="./mostrarCodigo/muestraScriptDelete.php" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>ConfigDBPDO</td>
                        <td><a href="./mostrarCodigo/muestraconfigDBPDO.php" class="btn btn-codigo">Codigo</a></td>
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
                        <td>Conexión a la base de datos con la cuenta usuario y tratamiento de errores.</td>
                        <td><a href="./codigoPHP/ejercicio01PDO.php" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="./mostrarCodigo/muestraEjercicio01PDO.php" class="btn btn-codigo">Codigo</a></td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Mostrar el contenido de la tabla Departamento y el número de registros</td>
                        <td><a href="./codigoPHP/ejercicio02PDO.php" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="./mostrarCodigo/muestraEjercicio02PDO.php" class="btn btn-codigo">Codigo</a></td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.</td>
                        <td><a href="./codigoPHP/ejercicio03PDO.php" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="./mostrarCodigo/muestraEjercicio03PDO.php" class="btn btn-codigo">Codigo</a></td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento.</td>
                        <td><a href="./codigoPHP/ejercicio04PDO.php" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="./mostrarCodigo/muestraEjercicio04PDO.php" class="btn btn-codigo">Codigo</a></td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones insert y una transacción</td>
                        <td><a href="./codigoPHP/ejercicio05PDO.php" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="./mostrarCodigo/muestraEjercicio05PDO.php" class="btn btn-codigo">Codigo</a></td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos utilizando una consulta preparada.</td>
                        <td><a href="./codigoPHP/ejercicio06PDO.php" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="./mostrarCodigo/muestraEjercicio06PDO.php" class="btn btn-codigo">Codigo</a></td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Página web que toma datos (código y descripción) de un fichero xml y los añade a la tabla Departamento de nuestra base de datos.</td>
                        <td>
                            <a href="./codigoPHP/ejercicio07PDO.php" class="btn btn-ejecutar">Ejecutar XML</a>
                            <a href="" class="btn btn-ejecutar">Ejecutar JSON</a>
                        </td>
                        <td>
                            <a href="./mostrarCodigo/muestraEjercicio07PDO.php" class="btn btn-codigo">Codigo XML</a>
                            <a href="" class="btn btn-codigo">Codigo JSON</a>
                        </td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un fichero departamentos.xml/departamentos.json.</td>
                        <td>
                            <a href="./codigoPHP/ejercicio08PDO.php" class="btn btn-ejecutar">Ejecutar XML</a>
                            <a href="./codigoPHP/ejercicio08JSONPDO.php" class="btn btn-ejecutar">Ejecutar JSON</a>
                        </td>
                        <td>
                            <a href="./mostrarCodigo/muestraEjercicio08PDO.php" class="btn btn-codigo">Codigo XML</a>
                            <a href="./mostrarCodigo/muestraEjercicio08PDO.php" class="btn btn-codigo">Codigo JSON</a>
                        </td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                    </tr>                 
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <div>
            <a href="https://github.com/AlvaroCalde/ACPDWESProyectoTema4" target="blank"><img src="/webroot/images/github.png" alt="enlace a github"></a>
            <a href="/">Álvaro Calderón Pérez</a>
        </div>
    </footer>
</body>
</html>