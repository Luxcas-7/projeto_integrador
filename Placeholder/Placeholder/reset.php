<?php
include("conectadb.php");
if($_SERVER['REQUEST_METHOD']=='POST' ) {

    $retornaaluno = "UPDATE contas SET con_cargo = 'Aluno' WHERE con_cargo = 'Contribuinte' ";
    mysqli_query($link, $retornaaluno);
    echo"<script>window.alert('ALUNOS RESETADOS');</script>";
    echo"<script>window.location.href='listacontas.php';</script>";

}
