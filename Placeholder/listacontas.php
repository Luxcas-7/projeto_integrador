<?php

include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

$sql = "SELECT * FROM contas WHERE con_cargo = 'Aluno'";
$retorno = mysqli_query($link, $sql);

$ativo = 's';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ativo = $_POST['ativo'];

    if ($ativo == 's') {
        $sql = "SELECT * FROM contas WHERE con_cargo = 'Aluno' ";
        $retorno = mysqli_query($link, $sql);
    } else {
        $sql = "SELECT * FROM contas WHERE con_cargo = 'Professor' ";
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
    <title>LISTA DE CONTAS</title>
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

        <form action="listacontas.php" method="post">

            <input type="radio" name="ativo" class="radio" value="s" required 
            onclick="submit()" <?=$ativo =='s'?"checked":""?>>ALUNOS

            <input type="radio" name="ativo" class="radio" value="n" required 
            onclick="submit()" <?=$ativo =='n'?"checked":""?>>PROFESSORES

        </form>

        <div class="container">

        <br>
            <table border="1">

                <tr>
                    <th>NOME</th>
                    <th>CARGO</th>
                    <th>NUMERO</th>
                </tr>

                <?php
                    while($tbl = mysqli_fetch_array($retorno)){
                ?>
                    <tr>

                        <td><?= $tbl[1]?></td> 

                        <td><?= $tbl[2]?></td>

                        <td><?= $tbl[3]?></td>

                    </tr>

                <?php
                    }
                ?>

            </table>

        </div>

    </div>

</body>
</html>