<?php

include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

$sql = "SELECT * FROM contas WHERE con_cargo = 'Aluno'";
$retorno = mysqli_query($link, $sql);

$cargo = 'Aluno';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $cargo = $_POST['cargo'];

    if ($cargo == 'Aluno') 
    {
        $sql = "SELECT * FROM contas WHERE con_cargo = 'Aluno' ";
        $retorno = mysqli_query($link, $sql);
    } 
    else if ($cargo == 'Contribuinte')
    {
        $sql = "SELECT * FROM contas WHERE con_cargo = 'Contribuinte' ";
        $retorno = mysqli_query($link, $sql);
    }
    else if ($cargo == 'Representante')
    {
        $sql = "SELECT * FROM contas WHERE con_cargo = 'Representante' ";
        $retorno = mysqli_query($link, $sql);
    }
    else if ($cargo == 'Docente')
    {
        $sql = "SELECT * FROM contas WHERE con_cargo = 'Docente' ";
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

    <div id="background">

        <form action="listacontas.php" method="post" id="radio">

            <input type="radio" name="cargo" class="radio" value="Aluno" required 
            onclick="submit()" <?=$cargo =='Aluno'?"checked":""?>>ALUNOS

            <input type="radio" name="cargo" class="radio" value="Contribuinte" required 
            onclick="submit()" <?=$cargo =='Contribuinte'?"checked":""?>>CONTRIBUINTE

            <input type="radio" name="cargo" class="radio" value="Representante" required 
            onclick="submit()" <?=$cargo =='Representante'?"checked":""?>>REPRESENTANTE

            <input type="radio" name="cargo" class="radio" value="Docente" required 
            onclick="submit()" <?=$cargo =='Docente'?"checked":""?>>DOCENTES

        </form>

        <div class="container">

            <br>

            <table border="1">

                <tr style="background-color: rgb(192, 100, 231);">
                    <th>NOME</th>
                    <th>CARGO</th>
                    <th>NUMERO</th>
                    <!-- <th>TORNAR CONTRIBUINTE</th> -->
                    <th>ALTERAR</th>
                    <th>DELETAR</th>
                </tr>

                <?php
                    while($tbl = mysqli_fetch_array($retorno))
                    {
                ?>
                    <tr>

                        <td><?= $tbl[1]?></td> 

                        <td><?= $tbl[2]?></td>

                        <td><?= $tbl[3]?></td>
                        <!-- 
                        <td>
                            <form action="sorteio.php?id=<?= $tbl[0]?>" method="post" 
                            style="background-color:#ddd;
                            border-right: 0px;
                            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                            margin:auto;
                            margin-left:95px;
                            padding: 0px;
                            width: 0px">

                                <div>
                                    <input type="submit" name="tornar" id="tornar" value="TORNAR CONTRIBUINTE" >                    
                                </div> 
                                
                            </form>

                        </td> 
                        -->

                        <td><a href="alteracontas.php?id=<?= $tbl[0]?>">

                        <input type="button" value="ALTERAR CONTAS"></a></td>

                        <td>
                            <form action="deletarcontas.php?id=<?= $tbl[0]?>" method="post" 
                            style="background-color:#ddd;
                            border-right: 0px;
                            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                            margin:auto;
                            margin-left:35px;
                            padding: 0px;
                            width: 0px">

                                <div>
                                    <input type="submit" name="deletar" id="deletar" value="DELETAR" >                    
                                </div> 
                                
                            </form>

                        </td>

                    </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>

    <br>

    <div>

        <form action="reset.php" method="post">

            <div>
                <center>
            
                <input type="submit" name="reset" id="reset" value="RESET">

                </center>
            </div>

        </form>

    </div>

</body>
</html>