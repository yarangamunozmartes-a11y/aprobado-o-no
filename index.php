<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafío: Ejercicio Integrador PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="box">
        <h2>📝 Ingreso de Notas</h2>
        <form action="index.php" method="POST">
            
            <div class="form-group">
                <label>Alumno 1</label>
                <input type="text" name="nombres[]" placeholder="Nombre" required style="margin-bottom: 8px;">
                <input type="number" name="notas[]" placeholder="Nota (0-20)" min="0" max="20" required>
            </div>

            <div class="form-group">
                <label>Alumno 2</label>
                <input type="text" name="nombres[]" placeholder="Nombre" required style="margin-bottom: 8px;">
                <input type="number" name="notas[]" placeholder="Nota (0-20)" min="0" max="20" required>
            </div>

            <div class="form-group">
                <label>Alumno 3</label>
                <input type="text" name="nombres[]" placeholder="Nombre" required style="margin-bottom: 8px;">
                <input type="number" name="notas[]" placeholder="Nota (0-20)" min="0" max="20" required>
            </div>

            <input type="submit" name="procesar" value="Calcular Resultados 📊">
        </form>
    </div>

    <?php
    // Condicional: Verificamos si el usuario envió el formulario
    if (isset($_POST['procesar'])) {
        
        // Capturamos los datos que viajan en Arrays desde el formulario
        $listaNombres = $_POST['nombres'];
        $listaNotas = $_POST['notas'];

        // FUNCION: Empaquetamos toda la lógica del desafío matemático
        function analizarNotas($nombres, $notas) {
            // Inicializamos variables de control
            $sumaTotal = 0;
            $notaMayor = -1; // Empezamos bajo para asegurar capturar la primera nota
            $alumnoMayor = "";
            $aprobados = 0;
            $desaprobados = 0;
            $totalAlumnos = count($notas);

            // Ciclo para recorrer el Array y procesar elemento por elemento
            for ($i = 0; $i < $totalAlumnos; $i++) {
                $notaActual = $notas[$i];
                $nombreActual = $nombres[$i];

                // 1. Acumulamos para la suma total
                $sumaTotal += $notaActual;

                // 3. Condicional para encontrar la Nota Mayor y su Alumno
                if ($notaActual > $notaMayor) {
                    $notaMayor = $notaActual;
                    $alumnoMayor = $nombreActual;
                }

                // 4 y 5. Condicional para contar Aprobados y Desaprobados (Nota mínima aprobatoria: 11)
                if ($notaActual >= 11) {
                    $aprobados++;
                } else {
                    $desaprobados++;
                }
            }

            // 2. Calculamos el promedio general de los nombres ingresados
            $promedio = $sumaTotal / $totalAlumnos;

            // Retornamos todos los resultados procesados en un Array asociativo
            return [
                'suma' => $sumaTotal,
                'promedio' => round($promedio, 2),
                'nota_mayor' => $notaMayor,
                'alumno_mayor' => $alumnoMayor,
                'aprobados' => $aprobados,
                'desaprobados' => $desaprobados
            ];
        }

        // Llamamos a la función pasándole los arreglos del formulario
        $resultados = analizarNotas($listaNombres, $listaNotas);
        ?>

        <div class="box">
            <h2>📈 Resultados del Análisis</h2>
            
            <div class="resultado-item">
                <strong>1. Suma Total de Notas:</strong> <?php echo $resultados['suma']; ?>
            </div>

            <div class="resultado-item">
                <strong>2. Promedio General:</strong> <?php echo $resultados['promedio']; ?>
            </div>

            <div class="resultado-item">
                <strong>3. Nota Mayor:</strong> <?php echo $resultados['nota_mayor']; ?> 
                <small>(Pertenece a: <em><?php echo $resultados['alumno_mayor']; ?></em>)</small>
            </div>

            <div class="resultado-item aprobado">
                <strong>4. Alumnos Aprobados:</strong> <?php echo $resultados['aprobados']; ?>
            </div>

            <div class="resultado-item desaprobado">
                <strong>5. Alumnos Desaprobados:</strong> <?php echo $resultados['desaprobados']; ?>
            </div>
        </div>

    <?php 
    } // Fin del condicional 
    ?>

</body>
</html>