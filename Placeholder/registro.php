<?php
include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $responsavel = $_POST['responsavel'];
    $data = $_POST['data'];
    $topico = $_POST['nome'];
    $conteudo = $_POST['conteudo'];

    $sql ="SELECT COUNT(au_id) FROM aulas WHERE au_respon = '$responsavel' AND au_data = '$data' AND au_nome ='$topico'";
    $retorno = mysqli_query($link, $sql);

    while($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }
    if($cont == 1){
        echo"<script>window.alert('AULA JÁ EXISTE');</script>";
    }
    else{
        $sql = "INSERT INTO aulas (au_respon, au_data, au_topico, au_conteudo, au_ativo) 
        VALUES('$responsavel', '$data', '$topico', '$conteudo', 's')";
        mysqli_query($link, $sql);
        echo"<script>window.alert('AULA REGISTRADA');</script>";
        echo"<script>window.location.href='historicoaulas.php';</script>";
    }
}
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
            <li><a href="contas.php">CADASTRO</a></li>
            <li><a href="listacontas.php">LISTA DE CONTAS</a></li>
            <li><a href="registro.php">REGISTRO</a></li>
            <li><a href="historicoaulas.php">HISTORICO DE AULAS</a></li>
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
            <li class="menuloja"><a href="logout.php">SAIR</a></li>
        </ul>
    </div>

    <div>
        <form action="registro.php" method="post">
            <label>RESPONSAVEL PELO REGISTRO</label>
            <input type="text" name="responsavel" id="responsavel">
            <br>
            <label>DATA REGISTRO</label>
            <input type="text" name="data" id="data">
            <br>
            <label>TOPICO DA AULA</label>
            <input type="text" name="topico" id="nome">
            <br>
            <label>CONTEUDO</label>
            <textarea name="conteudo" id="conteudo" rows="5" resize="none"></textarea>
            <br>
            <input type="submit" name="cadastrar" id="cadastrar" value="CADASTRAR">            
        </form>
    </div>
    
</body>
</html>