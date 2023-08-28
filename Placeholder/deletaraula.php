<?php
include("conectadb.php");

$id = isset($_GET['id'])? $_GET['id'] : "";
$sql = "SELECT * FROM aulas WHERE au_id = '$id'";

$retorno = mysqli_query($link, $sql);

if($_SERVER['REQUEST_METHOD']=='POST' ) {

    while($tbl = mysqli_fetch_array($retorno))
    {
        $del = "DELETE FROM aulas WHERE au_id = '$id'";
        mysqli_query($link,$del);
        echo"<script>window.alert('AULAS DELETADAS');</script>";
        echo"<script>window.location.href='historicoaulas.php';</script>";
    }
}
?>