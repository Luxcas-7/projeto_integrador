<?php

include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $SBS = "SELECT COUNT(con_id) FROM contas WHERE con_ativo = 's'";
    $retorno = mysqli_query($link, $SBS);

    

    while ($tbl = mysqli_fetch_array($retorno)) {
        $seq = ($tbl[0]);

        $for = 1;

        while ($for != 6) {
            $random = rand(1, $seq);
            $clk="SELECT con_cargo FROM contas WHERE con_id='$random'";
            $cont= mysqli_query($link, $clk);
            if($cont = "con_cargo = 'Contribuinte'")
            {
                
            }
            else{
                $up = "UPDATE contas SET con_cargo = 'Contribuinte' WHERE con_id = '$random' AND con_cargo = 'Aluno'";
                mysqli_query($link, $up);
                $for++;
            }
            
        }

        echo"<script>window.alert('ALUNOS SELECIONADOS');window.close();</script>";
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