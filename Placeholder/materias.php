<?php
include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

$sql = "SELECT * FROM materias WHERE mat_ativo = 's'";
$retorno = mysqli_query($link, $sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $materia = $_POST['materia'];

    $sql = "SELECT COUNT(mat_id) FROM materias WHERE mat_mat ='$materia'";
    $retorno = mysqli_query($link, $sql);

    while ($tbl = mysqli_fetch_array($retorno)) {
        $cont = $tbl[0];
    }
    if ($cont == 1) {
        echo "<script>window.alert('MATERIA JÁ EXISTE');</script>";
    } else {
        $sql = "INSERT INTO materias (mat_mat, mat_ativo) 
        VALUES( '$materia', 's')";
        mysqli_query($link, $sql);
        echo "<script>window.alert('MATERIA CADASTRADO');</script>";
        echo "<script>window.location.href='materias.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\estiloadm.css">
    <title>CADASTRO DE USUARIOS</title>
</head>

<body>
    <div>
        <ul class="menu">
            <li><a href="contas.php">CADASTRO</a></li>
            <li><a href="listacontas.php">LISTA DE CONTAS</a></li>
            <li><a href="materias.php">MATERIAS</a></li>
            <li><a href="registro.php">REGISTRO</a></li>
            <li><a href="historicoaulas.php">HISTORICO DE AULAS</a></li>
            <?php
            if ($nomeusuario != null) {
            ?>

                <li class="profile">OLA <?= strtoupper($nomeusuario) ?></li>
            <?php
            } else {
                echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='login.php';</script>";
            }
            ?>
            <li class="menuloja"><a href="logout.php">SAIR</a></li>
        </ul>
    </div>

    <div class="container">

        <br>

        <table border="1">

            <tr style="background-color: rgb(192, 100, 231);">
                <th>MATERIA</th>
                <th>ALTERAR</th>
                <th>DELETAR</th>
            </tr>

            <?php
            while ($tbl = mysqli_fetch_array($retorno)) {
            ?>
                <tr>
                    <td><?= $tbl[1] ?></td>

                    <td><a href="alteramateria.php?id=<?= $tbl[0] ?>">

                    <input type="button" value="ALTERAR MATERIA"></a></td>

                    <center>
                    <td>
                        
                        <form action="deletarmateria.php?id=<?= $tbl[0] ?>" method="post" style="background-color:#ddd;
                            border-right: 0px;
                            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                            margin:auto;
                            margin-left:90px;
                            padding: 0px;
                            width: 0px">

                            <div>
                                <input type="submit" name="deletar" id="deletar" value="DELETAR MATERIA">
                            </div>

                        </form>
                        
                    </td>
                    </center>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <div>
        <form action="materias.php" method="post">

            <label>NOME DA UC</label>
            <input type="text" name="materia" id="materia">
            <br>

            <input type="submit" name="cadastrar" id="cadastrar" value="CADASTRAR">

        </form>
    </div>


</body>

</html>