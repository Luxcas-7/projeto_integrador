<?php
include("conectadb.php");

$id = isset($_GET['id'])? $_GET['id'] : "";
$sql = "SELECT * FROM contas WHERE con_id = '$id'";

$retorno = mysqli_query($link, $sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    echo"<script>window.confirm('QUER DELETAR');</script>";
    
    while($tbl = mysqli_fetch_array($retorno))
    {            
        $del = "DELETE FROM contas WHERE con_id = '$id'";
        mysqli_query($link,$del);
        echo"<script>window.alert('CONTA DELETADA');window.location.href='listacontas.php';</script>";
    }

}
    
?>