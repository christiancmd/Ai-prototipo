<?php
$pag_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1; ///Pagina actual 

function getDataUsers(mysqli $conn, $pag_actual, $reg_per_page): array //Obtener los datos de los usuarios
{
    $offset = ($pag_actual - 1) * $reg_per_page;

    $sql = "SELECT IDuser, Full_name, Email, Name_user, Service FROM usuarios WHERE rol_id = 2 LIMIT $reg_per_page OFFSET $offset";
    $stmt = $conn->prepare($sql);//Preparamos la consulta
    $stmt->execute();// ejecutamos la consulta
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //Obtenemos los resultados de la consulta
    $dataUser = array(); // Inicializar el array

    //$result_sql = $conexion->query(query: $sql);
    $index = 0;

    // Usar fetchAll() para resultados más limpios
    if (count($result) > 0) {
        foreach ($result as $row) {
            $index++; //Incrementamos el indice
            $usuarios[$index] = $row; //Guardamos los datos en el array
        }
    }
    return !isset($usuarios) ? array() : $usuarios;

}

$users = getDataUsers(conn: $conexion, pag_actual: $pag_actual, reg_per_page: $reg_per_page); //Obtener los datos de los usuarios


function countUsers(mysqli $conexion): int      //Calcular el total de paginas
{
    $sql = "SELECT COUNT(*) as total FROM usuarios WHERE rol_id = 2";
    $result_sql = $conexion->query(query: $sql);
    $total = $result_sql->fetch_assoc();
    return intval(value: $total['total']);
}
$reg_per_page = 10;
$pag_users = array_chunk($users, $reg_per_page);


$count_users = countUsers(conexion: $conexion); //Calcular el total de paginas
$total_pag = ceil(num: $count_users / 10);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <div class="pagination">

        <?php
        // Mostrar enlaces de paginación
        $rango = 2; // Número de enlaces a mostrar antes y después de la página actual
        if ($pag_actual > 1) {
            echo "<a class='link-table' href='?pagina=" . ($pag_actual - 1) . "'>Anterior</a> ";
        }
        // Mostrar enlaces de páginas cercanas
        for ($i = max(1, $pag_actual - $rango); $i <= min($pag_actual + $rango, $total_pag); $i++) {
            if ($i == $pag_actual) {
                echo "<strong class='link-num' >$i</strong> "; // Resalta la página actual
            } else {
                echo "<a class='link-num' href='?pagina=$i'>$i</a> ";
                echo "
            <script>
                document.addEventListener('DOMContentLoaded', (event) => {
                const url = new URL(window.location.href);
                console.log(url);
                url.searchParams.delete('filtro');
                window.history.replaceState({}, document.title, url);
                });
            </script> 
        ";
            }
        }
        // Mostrar enlace "Siguiente"
        if ($pag_actual < $total_pag) {
            echo "<a class='link-table' href='?pagina=" . ($pag_actual + 1) . "'>Siguiente</a>";
        }

        ?>
    </div>


</body>

</html>