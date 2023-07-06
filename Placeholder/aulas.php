<?php
include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = $_POST['data'];
    $nome = $_POST['nome'];
    $conteudo = $_POST['conteudo'];

    $sql ="SELECT COUNT(au_id) FROM aulas WHERE au_data = '$data' AND au_nome ='$nome'";
    $retorno = mysqli_query($link, $sql);

    while($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }
    if($cont == 1){
        echo"<script>window.alert('AULA JÁ EXISTE');</script>";
    }
    else{
        $sql = "INSERT INTO aulas (au_data, au_nome, au_conteudo, au_ativo) 
        VALUES('$data', '$nome', '$conteudo', 's')";
        mysqli_query($link, $sql);
        echo"<script>window.alert('AULA REGISTRADA');</script>";
        echo"<script>window.location.href='aulas.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>AULAS</title>
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

            } else {
                echo "<script>window.alert('USUARIO NÃO AUTENTICADO');
                        window.location.href='login.php';</script>";
            }
            ?>
        </ul>
    </div>

    <div>
        <form action="contas.php" method="post">
            <label>DATA AULA</label>
            <input type="text" name="data" id="data">
            <br>
            <label>NOME AULA</label>
            <input type="text" name="nome" id="nome">
            <br>
            <label>CONTEUDO AULA</label>
            <textarea name="conteudo" id="conteudo" rows="5" resize="none"></textarea>
            <br>
            <input type="submit" name="cadastrar" id="cadastrar" value="CADASTRAR">            
        </form>
    </div>
    
</body>
</html>