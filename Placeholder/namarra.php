<?php

include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

$id = isset($_GET['id'])? $_GET['id'] : "";
$sql = "SELECT * FROM aulas WHERE au_id = '$id' AND au_ativo = 's'";

$retorno = mysqli_query($link, $sql);

$ativo = 's';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $ativo = $_POST['ativo'];

    if ($ativo == 's') 
    {
        $sql = "SELECT * FROM aulas WHERE au_ativo = 's' ";
        $retorno = mysqli_query($link, $sql);
    } 
    else
    {
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
    <link rel="stylesheet" href="css\estiloadm.css">  
</head>

<body>  

    <div id="background">

        <div class="container">

        <br><br>
        
            <table border="1">
                
                <?php
                    while($tbl = mysqli_fetch_array($retorno))
                    {
                ?>
                    <tr>
                        
                        <td>    
                        
                            <?= $tbl[4]?>

                        </td>

                    </tr>

                <?php
                    }
                ?>

            </table>

        </div>

    </div>

</body>

</html>