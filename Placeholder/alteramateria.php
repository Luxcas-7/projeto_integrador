<?php

include("conectadb.php");

session_start();

$nomeusuario = $_SESSION["nomeusuario"];

$id = isset($_GET['id']) ? $_GET['id'] : "";
$sql = "SELECT * FROM contas WHERE con_id = '$id'";

$retorno = mysqli_query($link, $sql);

#PREENCHENDO O ARRAY SEMPRE
while ($tbl = mysqli_fetch_array($retorno)) {
    $id = $tbl[0];
    $materia = $tbl[1];
}

#USUARIO CLICA NO BOTÃO SALVAR
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $materia = $_POST['materia'];

    $sql = "UPDATE materias SET con_mat = '$materia' WHERE mat_id = '$id'";
    mysqli_query($link, $sql);

    echo "<script>window.alert('MATERIA ALTERADA COM SUCESSO!');</script>";
    echo "<script>window.location.href='materias.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>ALTERA MATERIA</title>
</head>
<body>
    <div>
        <ul class="menu">
            <li><a href="contas.php">CADASTRO</a></li>
            <li><a href="listacontas.php">LISTA DE CONTAS</a></li>
            <li><a href="materias.php">MATERIAS</a></li>
            <li><a href="registro.php">REGISTRO</a></li>
            <li><a href="historicoaulas.php">HISTORICO DE AULAS</a></li>
            <?php
            if ($nomeusuario != null) {
            ?>
                <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>
            <?php
            } else {
                echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='login.php';</script>";
            }
            ?>
            <li class="menuloja"><a href="logout.php">SAIR</a></li>
        </ul>
    </div>

    <div>
        <form action="alteramateria.php" method="post">
            
            <label>ALTERAR MATERIA</label>
            <input type="text" name="materia" id="materia"  required>
            <br>

            <input type="submit" name="salvar" id="salvar" value="SALVAR">
        </form>
    </div>
</body>
</html>