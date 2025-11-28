<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Jogos</title>
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body>
  <?php
  /*Irá chamar a conexao com o banco e carregar as infoirmações nesta pagina*/ 
  require_once "includes/banco.php";
  /* Irá chamar a pagina de funcoes */
  require_once "includes/funcoes.php";
  ?>
    <div id="corpo">
        <h1>Escolha seu Jogo</h1>
      <table class="listagem">
       <!-- Como irei executar um select dentro do html, tenho que utilizar a supertag php-->
        <?php 
           $busca = $banco->query("select *from jogos order by nome");
           if ($busca->num_rows == 0) {
            echo "<tr><td>Nenhum registro encontrado";
            
           }else {
            //Criei uma variavel $reg para receber o resultado do select//
            while ($reg=$busca->fetch_object()) {
            //Para exibir, escoli apenas o que quero mostrar do meu select//
            //Irei informar o caminho das fotos com referencia o nome do arquivo salvo no banco de dados na coluna capa <img src='fotos/$reg->capa' class='mini' /> //
            //Irei colocar uma função para checar se carregou o arquivo de imagem, caso nao encontar irá buscar uma imagem padrao.
            //Primeiro cria uma variavel que irá receber o resultado da função. com isso irei exibir apenas a variavel ao inves do caminho, uma vez que a funcao irá retornar o caminho//
            $t = thumb($reg->capa);
              echo "<tr><td><img src='$t' class='mini' /><td>$reg->nome";
              echo "<td>Adm";

            }

           }
           //Apaguei os antigos tr e td que foram utilizados como referencia, agora serão utilizados os do script//

        ?>
        

        

      </table>
        

    </div>
</body>
</html>