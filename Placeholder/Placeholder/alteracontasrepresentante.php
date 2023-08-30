<?php

include("conectadb.php");

session_start();

$nomeusuario = $_SESSION["nomeusuario"];

$id = isset($_GET['id']) ? $_GET['id'] : "";
$sql = "SELECT * FROM contas WHERE con_id = '$id'";

$retorno = mysqli_query($link, $sql);

#PREENCHENDO O ARRAY SEMPRE
while ($tbl = mysqli_fetch_array($retorno)) {
    $id = $tbl[0];
    $nome = $tbl[1];
    $cargo = $tbl[2];
    $numero = $tbl[3];
    $senha = $tbl[4];
}

#USUARIO CLICA NO BOTÃO SALVAR
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $numero = $_POST['numero'];
    $senha = $_POST['senha'];

    $sql = "UPDATE contas SET con_nome = '$nome', con_cargo = '$cargo', con_numero = '$numero', con_senha = '$senha'
    WHERE con_id = '$id'";
    mysqli_query($link, $sql);

    echo "<script>window.alert('CONTA ALTERADA COM SUCESSO!');</script>";
    echo "<script>window.location.href='listacontasrepresentante.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>ALTERA CONTAS</title>
</head>
<body>
    <div>
        <ul class="menu">
            <li><a href="listacontasrepresentante.php">LISTA DE CONTAS</a></li>
            <li><a href="registrorepresentante.php">REGISTRO</a></li>
            <li><a href="historicoaulasrepresentante.php">HISTORICO DE AULAS</a></li>
            <?php
            if ($nomeusuario != null) {
            ?>
                <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>
            <?php
            } else {
                echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='login.php';</script>";
            }
            ?>
            <li class="menuloja"><a href="logout.php">SAIR</a></li>
        </ul>
    </div>

    <div>
        <form action="alteracontasrepresentante.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">

            <label>NOME DO USUARIO</label>
            <input type="text" name="nome" id="nome" value="<?= $nome ?>" required>
            <br>

            <label>CARGO DO USUARIO</label>
            <input type="text" name="cargo" id="cargo" value="<?= $cargo ?>" list="ListaCargo" required>
            <datalist id="ListaCargo">
                <option>Aluno</option>
                <option>Contribuinte</option>
                <option>Representante</option>
                <option>Docente</option>
            </datalist>
            <br>

            <label>NUMERO DO USUARIO</label>
            <input type="number" name="numero" id="nome" value="<?= $numero ?>" required>
            <br>

            <label>SENHA</label>
            <input type="password" name="senha" id="senha" value="<?= $senha ?>" >
            <br>

            <input type="submit" name="salvar" id="salvar" value="SALVAR">

        </form>
    </div>
</body>
</html>