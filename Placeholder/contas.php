<?php
include("conectadb.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $numero = $_POST['numero'];
    $senha = $_POST['senha'];

    $sql ="SELECT COUNT(con_id) FROM contas WHERE con_nome ='$nome' AND con_senha = '$senha'";
    $retorno = mysqli_query($link, $sql);

    while($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }
    if($cont == 1){
        echo"<script>window.alert('USUARIO JÁ EXISTE');</script>";
    }
    else{
        $sql = "INSERT INTO contas (con_nome, con_cargo, con_numero, con_senha, con_ativo) 
        VALUES('$nome', '$cargo', '$numero', '$senha', 's')";
        mysqli_query($link, $sql);
        echo"<script>window.alert('USUARIO CADASTRADO');</script>";
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
    <title>CADASTRO DE USUARIOS</title>
</head>
<body>
    <div>
        <ul class="menu">
            <li><a href="contas.php">CADASTRA USUARIO</a></li>
            <li><a href="aulas.php">AULAS</a></li>
            <li><a href="listaaulas.php">LISTA DE AULAS</a></li>
            <li class="menuloja"><a href="./areacliente/loja.php"> GOJO >>>> SUKUNA </a></li>
        </ul>
    </div>

    <div>
        <form action="contas.php" method="post">
            <label>NOME USUARIO</label>
            <input type="text" name="nome" id="nome" >
            <br>
            <label>CARGO USUARIO</label>
            <input type="text" name="cargo" id="cargo">
            <br>
            <label>NÚMERO USUARIO</label>
            <input type="number" name="numero" id="numero">
            <br>
            <label>SENHA</label>
            <input type="password" name="senha" id="senha">
            <br>
            <input type="submit" name="cadastrar" id="cadastrar" value="CADASTRAR">
            
        </form>
    </div>

    
</body>
</html>