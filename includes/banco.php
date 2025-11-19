<?php 
//CONEXAO COM O BANCO DE DADOS
$banco = new mysqli("localhost", "root","","bd_games");
if($banco->connect_errno) {
    echo "<p>Encontrei em erro $banco->errno --> $banco->connect_error</p>";
    die();
}
//FORMATAÇÃO PARA ACENTUAÇÃO
$banco-> query("SET NAMES 'UTF8'");
$banco-> query("SET character_set_connection=UTF8");
$banco-> query("SET character_set_client=UTF8");
$banco-> query("SET character_set_results=UTF8");
?>