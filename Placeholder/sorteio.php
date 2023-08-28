<?php

include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $SBS = "SELECT (con_nome) FROM contas WHERE con_ativo = 's' AND con_cargo = 'Aluno'";
    $retorno = mysqli_query($link,$SBS);

    // while ($tbl = mysqli_fetch_array($retorno)) {
    //     $seq = ($tbl[0]);

    //     $random = rand(1, $seq);
    //     $contri = "SELECT con_nome FROM contas WHERE con_id = $random";
    //     $nome = mysqli_query($link, $contri);
    //     while($tbln = mysqli_fetch_array($nome)){
    //         echo($tbln[0]);
    //     }
    //     // echo "<script>window.alert('ALUNOS SELECIONADOS');window.close();</script>";
    // }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
</head>

<body>

    <p> Deseja sortear os Contribuintes?</p>

    <form action="sorteio.php" method="post">

        <?php
            while($tbl = mysqli_fetch_array($retorno))
            {
                $random = rand(1, $seq);
        ?>

            <div>
                <center> <input type="submit" name="sorteio" id="sorteio" value="SORTEAR"> </center>
            </div>

        <?php
            }
        ?>

    </form>

</body>