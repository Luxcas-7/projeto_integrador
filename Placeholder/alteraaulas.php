<?php
include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

$id = $_GET['id'];
$sql = "SELECT * FROM aulas WHERE au_id = '$id'";

$retorno = mysqli_query($link, $sql);

#PREENCHENDO O ARRAY SEMPRE
while ($tbl = mysqli_fetch_array($retorno)) {
    $id = $tbl[0];
    $responsavel = $tbl[1];
    $data = $tbl[2];
    $topico = $tbl[3];
    $conteudo = $tbl[4];
    $ativo = $tbl[5];
}

#USUARIO CLICA NO BOTÃO SALVAR
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $responsavel = $_POST['responsavel'];
    $data = $_POST['data'];
    $topico = $_POST['topico'];
    $conteudo = $_POST['conteudo'];
    $ativo = $_POST['ativo'];

    $sql = "UPDATE aulas SET au_respon = '$responsavel', au_data = '$data', au_topico = '$topico', au_conteudo = '$conteudo', au_ativo = '$ativo'
    WHERE au_id = '$id'";
    echo ($sql);
    mysqli_query($link, $sql);

    // echo "<script>window.alert('USUARIO ALTERADO COM SUCESSO!');</script>";
    // echo "<script>window.location.href='admhome.php';</script>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>ALTERA AULAS</title>
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
                echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='login.php';</script>";
            }
            ?>
            <li class="menuloja"><a href="logout.php">SAIR</a></li>
        </ul>
    </div>

    <div>
        <form action="alteraaulas.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">

            <label>RESPONSAVEL PELO REGISTRO</label>
            <input type="text" name="responsavel" id="responsavel" value="<?=$responsavel?>" required>
            <br>

            <label>DATA REGISTRO</label>
            <input type="text" name="data" id="data" value="<?=$data?>" required>
            <br>

            <label>TOPICO DA AULA</label>
            <input type="text" name="topico" id="nome" value="<?=$topico?>" required>
            <br>

            <label>CONTEUDO</label>
            <textarea name="conteudo" id="conteudo" rows="5" resize="none" ><?=$conteudo?></textarea>
            <br>

            <input type="radio" name="ativo" value="s" <?=$ativo =="s"?"checked":""?>>ATIVO
            <br>

            <input type="radio" name="ativo" value="n" <?=$ativo =="n"?"checked":""?>>INATIVO

            <input type="submit" name="salvar" id="salvar" value="SALVAR">

        </form>
    </div>


</body>

</html>