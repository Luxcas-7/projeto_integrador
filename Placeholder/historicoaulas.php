<?php

include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

$sql = "SELECT * FROM aulas WHERE au_ativo = 's'";
$retorno = mysqli_query($link, $sql);

$ativo = 's';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ativo = $_POST['ativo'];

    if ($ativo == 's') {
        $sql = "SELECT * FROM aulas WHERE au_ativo = 's' ";
        $retorno = mysqli_query($link, $sql);
    } else {
        $sql = "SELECT * FROM aulas WHERE au_ativo = 'n' ";
        $retorno = mysqli_query($link, $sql);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>HISTORICO DE AULAS</title>
</head>
<body>
    <div>
        <ul class="menu">
            <li><a href="contas.php">CADASTRO</a></li>
            <li><a href="listacontas.php">LISTA DE CONTAS</a></li>
            <li><a href="registro.php">REGISTRO</a></li>
            <li><a href="historicoaulas.php">HISTORICO DE AULAS</a></li>
            <?php
            if ($nomeusuario != null) {
            ?>

                <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>
            <?php
            } 
            else{
                echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='login.php';</script>";
            }
            ?>
            <li class="menuloja"><a href="logout.php">SAIR</a></li>
        </ul>
    </div>

    <div id="background">
        <div class="container">
        <br><br>
            <table border="1">
                <tr>
                    <th>RESPONSAVEL</th>
                    <th>DATA</th>
                    <th>TOPICO</th>
                    <th>CONTEUDO</th>
                    <th>ALTERAR DADOS</th>
                
                </tr>
                <?php
                    while($tbl = mysqli_fetch_array($retorno)){
                ?>
                    <tr>

                        <td><?= $tbl[1]?></td> 

                        <td><?= $tbl[2]?></td>

                        <td><?= $tbl[3]?></td>

                        <td><?= $tbl[4]?></td>

                        <td><a href="alteraaulas.php?id=<?= $tbl[0]?>">

                        <input type="button" value="ALTERAR DADOS"></a></td> 

                    </tr>

                <?php
                    }
                ?>

            </table>

        </div>

    </div>

</body>
</html>