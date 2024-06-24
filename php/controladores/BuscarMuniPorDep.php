<?php
require_once '../controladores/config.php';

if (isset($_GET['idDepartamento'])) {
    $conn = conectarDB();
    $idDepartamento = intval($_GET['idDepartamento']);
    $munQuery = 'SELECT * FROM municipio WHERE idDepartamento = ? ORDER BY 1';
    $stmt = $conn->prepare($munQuery);
    $stmt->bind_param("i", $idDepartamento);
    $stmt->execute();
    $resultMun = $stmt->get_result();

    if ($resultMun->num_rows > 0) {
        echo '<option value="null">municipio</option>';
        while ($datosMun = $resultMun->fetch_assoc()) {
            echo '<option value="'. $datosMun['idMunicipio']. '">' . $datosMun['municipio'] . '</option>';
        }
    } else {
        echo '<option value="null">No hay municipios disponibles</option>';
    }
    $stmt->close();
    $conn->close();
}
?>
