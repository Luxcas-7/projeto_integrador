<?php
include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

$sql = "SELECT * FROM aulas WHERE au_ativo = 's'";
$retorno = mysqli_query($link, $sql);

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $numero = $_POST['numero'];
    $senha = $_POST['senha'];

    $sql ="SELECT COUNT(con_id) FROM contas WHERE con_nome ='$nome' AND con_senha = '$senha'";
    $retorno = mysqli_query($link, $sql);

    while($tbl = mysqli_fetch_array($retorno))
    {
        $cont = $tbl[0];
    }
    if($cont == 1)
    {
        echo"<script>window.alert('USUARIO JÁ EXISTE');</script>";
    }
    else
    {
        $sql = "INSERT INTO contas (con_nome, con_cargo, con_numero, con_senha, con_ativo) 
        VALUES('$nome', '$cargo', '$numero', '$senha', 's')";
        mysqli_query($link, $sql);
        echo"<script>window.alert('USUARIO CADASTRADO');</script>";
        echo"<script>window.location.href='listacontas.php';</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $ativo = $_POST['ativo'];

    if ($ativo == 's') 
    {
        $sql = "SELECT * FROM contas WHERE con_ativo = 's' ";
        $retorno = mysqli_query($link, $sql);
    } 
    else
    {
        $sql = "SELECT * FROM contas WHERE con_ativo = 'n' ";
        $retorno = mysqli_query($link, $sql);
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
            if ($nomeusuario != null)
             {
            ?>

                <li class="profile">OLA <?= strtoupper($nomeusuario) ?></li>
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

    <div>
        <form action="contas.php" method="post">
        
            <label>NOME USUARIO</label>
            <input type="text" name="nome" id="nome">
            <br>
          
            <label>CARGO USUARIO</label>
            <input type="text" name="cargo" id="cargo" list="ListaCargo">
                <datalist id="ListaCargo">
                    <option>Aluno</option>
                    <option>Representante</option>
                    <option>Docente</option>
                </datalist>
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