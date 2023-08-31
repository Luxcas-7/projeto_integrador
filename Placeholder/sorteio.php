<?php

include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $SBS = "SELECT COUNT(con_id) FROM contas WHERE con_ativo = 's' AND con_cargo = 'Aluno'";
    $retorno = mysqli_query($link, $SBS);

    while ($tbl = mysqli_fetch_array($retorno)) {
        $seq = ($tbl[0]);

        for($for =1; $for <6; $for++){

            if($seq == 1)
            {
                $for-1;
            }
            else 
            {
                $random = rand(1, $seq);
                $up = "UPDATE contas SET con_cargo = 'Contribuinte' WHERE con_id = '$random' AND con_cargo = 'Aluno'";
                echo($up);
                mysqli_query($link, $up);
            }

        }

        // echo "<script>window.alert('ALUNOS SELECIONADOS');window.close();</script>";
    }
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

        <div>
            <center> <input type="submit" name="sorteio" id="sorteio" value="SORTEAR"> </center>
        </div>

    </form>

</body>