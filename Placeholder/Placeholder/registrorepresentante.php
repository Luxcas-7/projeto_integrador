<?php
include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $responsavel = $_POST['responsavel'];
    $data = $_POST['data'];
    $topico = $_POST['topico'];
    $conteudo = $_POST['conteudo'];

    $sql ="SELECT COUNT(au_id) FROM aulas WHERE au_respon = '$responsavel' AND au_data = '$data' AND au_topico ='$topico' AND au_ativo = 's'";
    $retorno = mysqli_query($link, $sql);

    while($tbl = mysqli_fetch_array($retorno))
    {
        $cont = $tbl[0];
    }
    if($cont == 1){
        echo"<script>window.alert('AULA JÁ EXISTE');</script>";
    }
    else
    {
        $sql = "INSERT INTO aulas (au_respon, au_data, au_topico, au_conteudo, au_ativo) 
        VALUES('$responsavel', '$data', '$topico', '$conteudo', 's')";
        mysqli_query($link, $sql);
        echo"<script>window.alert('AULA REGISTRADA');</script>";
        echo"<script>window.location.href='historicoaulasrepresentante.php';</script>";
    }
}

$conta = "SELECT * FROM contas WHERE con_ativo ='s'";
$nome = mysqli_query($link, $conta);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>REGISTROS</title>
</head>
<body>
    <div>
        <ul class="menu">
            <li><a href="listacontasrepresentante.php">LISTA DE CONTAS</a></li>
            <li><a href="registrorepresentante.php">REGISTRO</a></li>
            <li><a href="historicoaulasrepresentante.php">HISTORICO DE AULAS</a></li>
            <?php
            if ($nomeusuario != null) 
            {
            ?>

                <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>
            <?php

            }
            else
            {
                echo "<script>window.alert('USUARIO NÃO AUTENTICADO');
                        window.location.href='login.php';</script>";
            }
            ?>
            <li class="menuloja"><a href="logout.php">SAIR</a></li>
        </ul>
    </div>

    <div>
        <form action="registrorepresentante.php" method="post">

            <label>RESPONSAVEL PELO REGISTRO</label>
            <input type="text" name="responsavel" id="responsavel" list="ListaNome">
                <datalist id="ListaNome">
                    <?php
                        while($tbl = mysqli_fetch_array($nome))
                        {
                    ?>
                        <option><?= $tbl[1]?></option>
                    <?php
                    } 
                    ?>
                </datalist>
            <br>

            <label>DATA REGISTRO</label>
            <input type="date" name="data" id="data">
            <br>

            <label>TOPICO DA AULA</label>
            <input type="text" name="topico" id="nome" list="ListaTopico">
                <datalist id="ListaTopico">
                    <option>Matematica</option>
                    <option>Portugues</option>
                    <option>Fisica</option>
                    <option>Quimica</option>
                    <option>Biologia</option>
                    <option>Historia</option>
                    <option>Geografia</option>
                    <option>Artes</option>
                    <option>Educação Fisica</option>
                    <option>Sociologia</option>
                    <option>Filosofia</option>
                </datalist>
            <br>

            <label>CONTEUDO</label>
            <textarea name="conteudo" id="conteudo" rows="10" resize="none"></textarea>
            <br>

            <input type="submit" name="cadastrar" id="cadastrar" value="CADASTRAR">            
        </form>
    </div>
    
</body>
</html>