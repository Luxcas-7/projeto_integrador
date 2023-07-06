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
    <title>LISTA DE AULAS</title>
</head>
<body>
    <div>
        <ul class="menu">
            <li><a href="contas.php">CADASTRA USUARIO</a></li>
            <li><a href="aulas.php">AULAS</a></li>
            <li><a href="listaaulas.php">LISTA DE AULAS</a></li>
            <li class="menuloja"><a href="./areacliente/loja.php"> GOJO >>>> SUKUNA </a></li>
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
        </ul>
    </div>

    <div id="background">
        <div class="container">
        <br><br>
            <table border="1">
                <tr>
                    <th>DATA</th>
                    <th>NOME</th>
                    <th>CONTEUDO</th>
                </tr>
                <?php
                    while($tbl = mysqli_fetch_array($retorno)){
                ?>
                    <tr>

                        <td><?= $tbl[1]?></td> 

                        <td><?= $tbl[2]?></td>

                        <td><?= $tbl[3]?></td>

                        <!-- <td><a href="alteracliente.php?id=<?= $tbl[0]?>"> -->

                        <input type="button" value="ALTERAR DADOS"></a></td> 

                        <td><?=$check =($tbl[4] == 's')?"SIM":"NÃO"?></td> 

                    </tr>

                <?php
                    }
                ?>

            </table>

        </div>

    </div>

</body>
</html>