<?php 

/*Conectar no banco e carregar todo o banco de dados em $banco*/
$banco = new mysqli("localhost","root","","bd_games");

/*Criar uma referencia para caso dê erro ao conectar */
if($banco->connect_errno) {
    echo "<p>Não foi possivel conectar!";
    die();
}

?>