<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Indice general de la asignatura">
    <meta name="author" content="Álvaro Calderón Pérez">
    <title>Tema 4-PHP Álvaro Calderón Pérez</title>
    <link rel="stylesheet" href="./webroot/css/estilos.css">
    
    <style>
        /* Estilo base para todos los botones */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin: 2px;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Botones de "Ejecutar" (Verde) */
        .btn-ejecutar {
            background-color: #28a745;
            color: white;
            border: 1px solid #218838;
        }

        .btn-ejecutar:hover {
            background-color: #218838;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
            color: white;
        }

        /* Botones de "Código" (Azul) */
        .btn-codigo {
            background-color: #007bff;
            color: white;
            border: 1px solid #0069d9;
        }

        .btn-codigo:hover {
            background-color: #0069d9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
            color: white;
        }

        /* ESTILO PARA BOTONES APAGADOS (Sin enlace válido) */
        .btn[href=""], 
        .btn[href="#"], 
        .btn:not([href]) {
            background-color: #6c757d !important; /* Gris */
            color: #d3d3d3 !important;
            border: 1px solid #5c636a !important;
            pointer-events: none; /* Evita que el ratón haga clic */
            opacity: 0.65; /* Aspecto deshabilitado */
            box-shadow: none !important;
            transform: none !important;
        }
        
        /* Centrar el contenido de las celdas */
        .tabla td, .tablaScript td {
            vertical-align: middle;
        }
    </style>
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
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Página web que toma datos (código y descripción) de un fichero xml y los añade a la tabla Departamento de nuestra base de datos.</td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un fichero departamento.xml.</td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Aplicación resumen MtoDeDepartamentosTema4. (Incluir PHPDoc y versionado en el repositorio GIT)</td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Aplicación resumen MtoDeDepartamentos POO y multicapa.</td>
                        <td><a href="" class="btn btn-ejecutar">Ejecutar</a></td>
                        <td><a href="" class="btn btn-codigo">Codigo</a></td>
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