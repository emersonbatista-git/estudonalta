<!DOCTYPE html>
    <?php
  /*Irá chamar a conexao com o banco e carregar as infoirmações nesta pagina, funções e login*/ 
  require_once "includes/banco.php";
  require_once "includes/funcoes.php";
  require_once "includes/login.php";
  
  
  ?>
  
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulo da Pagina</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>

    
    <div id="corpo">
        <?php 
        logout();
        echo msg_sucesso("Usuario desconectado com sucesso");
        echo voltar();
        ?>

    </div>
    
        
    </body>

    <html>