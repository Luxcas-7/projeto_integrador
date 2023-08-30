<?php

include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

$sql = "SELECT * FROM aulas WHERE au_ativo = 's'";
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
    <style> 

        table.dataTable {
            width: 80%;
            margin: 0 auto;
            clear: both;
            border-collapse: separate;
            border-spacing: 0;
        }
        table.dataTable tbody tr {
            background-color: #fff;
        }
        table.dataTable tbody tr.selected {
            background-color: #b0bed9;
        }
        table.dataTable tbody td {
            padding: 15px 10px;
        }
        table.dataTable.display tbody td {
            border-top: 1px solid #ddd;
        }
        table.dataTable td {
            box-sizing: content-box;
        } 

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>HISTORICO DE AULAS</title>
</head>
<body>
    <div>
        <ul class="menu">
            <li><a href="listacontasaluno.php">LISTA DE CONTAS</a></li>
            <li><a href="historicoaulasaluno.php">HISTORICO DE AULAS</a></li>
            <?php
            if ($nomeusuario != null) 
            {
            ?>

                <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>
            <?php
            } 
            else
            {
                echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='login.php';</script>";
            }
            ?>
            <li class="menuloja"><a href="logout.php">SAIR</a></li>
        </ul>
    </div>

    <br>

    <div id="background">
        <div class="container">
        <input id="gfg" type="text" placeholder="Procure por aqui:" style="background-color: #ffffff; border: none; border-radius: 3px; box-sizing: border-box; display: block; font-size: 16px; margin-bottom: 10px; margin-left: 160px; padding: 10px; width: 1265px;">
        <br>
            <table border="1" class="display dataTable no-footer">
                <tr style="background-color: rgb(192, 100, 231)">

                    <th>NOME</th>
                    <th>DATA</th>
                    <th>TOPICO</th>
                    <th>CONTEUDO</th>
                
                </tr>

                <tbody id="geeks">
                    
                    <?php
                        while($tbl = mysqli_fetch_array($retorno))
                        {

                    ?>
                        <tr>

                            <td><?= $tbl[1]?></td> 

                            <td><?= $tbl[2]?></td>

                            <td><?= $tbl[3]?></td>

                            <td>    
                            
                                <input type="button" value="CONTEUDO COMPLETO" 
                                onclick="window.open('namarra.php?id=<?= $tbl[0]?>', '_Blank', 
                                'resizable=no top=300px width=300px height=300px')">

                            </td>

                        </tr>

                    <?php
                        }                        
                    ?>

                </tbody>

            </table>

            <script>
                $(document).ready(function() {
                    $("#gfg").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#geeks tr").filter(function() {
                            $(this).toggle($(this).text()
                            .toLowerCase().indexOf(value) > -1)
                        });
                    });
                });
            </script>

        </div>

    </div>

</body>
</html>