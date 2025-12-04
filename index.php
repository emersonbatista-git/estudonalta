<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Jogos</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>
  <?php
  /*Irá chamar a conexao com o banco e carregar as infoirmações nesta pagina, funcoes e login*/ 
  require_once "includes/banco.php";
  require_once "includes/funcoes.php";
  require_once "includes/login.php";
  /*Criar a variavel $ordem para receber parametro "o"*/
  $ordem = $_GET['o'] ?? "n";
  /*Criar a variavel $chave para receber a pesquisa do usuario*/ 
  $chave = $_GET['c'] ?? "";
   
  ?>
    <div id="corpo">
      <?php require_once "topo.php";?>
        <h1>Escolha seu Jogo</h1>
   
<!--Inserir a barra de pesquisa -->
      <form action="index.php" method="get" id="busca">
<!--Envia a informação para o proprio arquivo e criei o parametro "o" que irá receber as informações como nome(n), produtora(p), etc..
Para trazer a seleção e ordenar temos que inseri as duas variaveis, utilizamos o &
index.php?o=n&c=  -->
          Ordenar: 
          <a href="index.php?o=n&c=<?php echo $chave;?>">Nome</a> |
          <a href="index.php?o=p&c=<?php echo $chave;?>">Produtora</a> | 
          <a href="index.php?o=n1&c=<?php echo $chave;?>">Nota Alta</a> |
          <a href="index.php?o=n2&c=<?php echo $chave;?>">Nota Baixa</a> |
          <a href="index.php?">Mostrar Todos</a> |
       Buscar: <input type="text" name="c" size="10" maxlength="40"/>
               <input type="submit" value="Ok"> 
      </form>
      <table class="listagem">
       <!-- Como irei executar um select dentro do html, tenho que utilizar a supertag php.
        Irei criar uma variavel $q para receber um join de varias tabelas, com isso irei mostrar os nomes com referencia aos codigos
        No select irei colocar somente o que preciso mostrar
        Tambem irei colocar o switch para checar a ordenação que o usuario escolheu
        Recebe a informação de $ordem e de acordo com o escolhido pegar o resultado de $q concatena com a ordenação -->
        <?php 
           $q = "select j.cod, j.nome, g.genero, p.produtora, j.capa from jogos j join generos g on j.genero = g.cod join produtoras p on j.produtora = p.cod ";
        /*Conferi o que foi digitado na busca e trazer o resultado*/ 
           if (!empty ($chave)) {
              $q .= "WHERE j.nome like '%$chave%' OR p.produtora like '%$chave%' OR g.genero like '%$chave%'  ";
            }

           switch ($ordem) {
              case "p":
                $q .= "ORDER BY p.produtora";
                break;
              case "n1":
                $q .= "ORDER BY j.nota DESC";
                break;
                case "n2":
                $q .= "ORDER BY j.nota ASC";
                break;
                default:
                $q .= "ORDER BY j.nome";
                break;

            }
           $busca = $banco->query($q);
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
              echo "<tr><td><img src='$t' class='mini' />";
              //Irei transformar o nome em um link
              //detalhes.php?cod=$reg->cod passei a referencia que o cod vai ser igual ao cod do banco de dados, com isso ele irá trazer o codigo do jogo que for selecionado//
              echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
              /*Se colocar para exibir o genero, irá trazer o codigo ao invez do nome.para resonver vamos alterar o select para buscar em mais tabelas*/ 
              echo " [$reg->genero]";
              echo "</br>";
              echo "($reg->produtora)";
              if (is_admin()){
                echo "<td>";
                echo "<i class='material-icons'>add_circle</i> ";
                echo " <i class='material-icons'>edit</i> ";
                echo "<i class='material-icons'>delete</i> ";
              }elseif (is_editor()){
                echo " <i class='material-icons'>edit</i> ";

                      }

                  
                  
            }

           }
           //Apaguei os antigos tr e td que foram utilizados como referencia, agora serão utilizados os do script//

        ?>
        

        

      </table>
        

    </div>
    <?php include_once "rodape.php";?>
</body>
</html>