<?php
session_start();
$nomeusuario = $_SESSION["nomeusuario"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estiloadm.css">
    <title>PAGINA REPRESENTANTE</title>
</head>
<body>
    <div>
        <ul class="menu">
            <li><a href="listacontasrepresentante.php">LISTA DE CONTAS</a></li>
            <li><a href="registrorepresentante.php">REGISTRO</a></li>
            <li><a href="historicoaulasrepresentante.php">HISTORICO DE AULAS</a></li>
            <?php
            if ($nomeusuario != null) {
            ?>

                <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>
            <?php
            } 
            else{
                echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='../login.php';</script>";
            }
            ?>
            <li class="menuloja"><a href="../logout.php">SAIR</a></li>
        </ul>
    </div>
</body>
</html>