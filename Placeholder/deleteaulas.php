<?php

include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

$id = isset($_GET['id'])? $_GET['id'] : "";
$sql = "DELETE * FROM aulas WHERE au_id = '$id' AND au_ativo = 's'";

$delete = 's';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $delete = $_POST['delete'];

    if ($delete == 'sim' || 's') 
    {
        $sql = "DELETE * FROM aulas WHERE au_ativo = 's'";
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

            <label>DELETAR A ENTRADA?</label>
            <input type="prompt" nome="delete" id="delete">

            <br>

            <input type="submit" name="cadastrar" id="cadastrar" value="CADASTRAR">

        </div>

    </div>

</body>

</html>