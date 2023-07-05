<?php

    ## ARQUIVO DE ACESSO AO BANCO DE DADOS ##
    ## ALERTA EM MODO PROFISSIONAL ARQUIVO DEVE-SE MANTER OCULTO E PROTEGIDO ##

    ## LOCALIZA O PC OU SERVIDO COM O BANCO ##
    $servidor = "localhost:3307";

    ## NOME DO BANCO ##
    $banco = "projeto_integrador";

    ## USUARIO DE ACESSO ##
    $usuario = "administrador";

    ## SENHA DO USUARIO ##
    $senha = "123";

    ## LINK DE CONEXÃO ##
    $link = mysqli_connect($servidor, $usuario, $senha, $banco);

?>