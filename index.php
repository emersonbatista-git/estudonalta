<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/style.css">
    <title>Listagem de Jogos</title>
    
</head>
<body>
    <?php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    $ordem = $_GET['o'] ?? "n";
    $chave = $_GET['c'] ?? "";
    ?>
    <div id="corpo">
      <?php  include_once "topo.php";?>
        <h1>Escolha seu Jogo</h1>
        <form action="index.php" method="get" id="busca">
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
            <?php
            $q = "select j.cod, j.nome, g.genero, p.produtora, j.capa from jogos j join generos g on j.genero = g.cod join produtoras p on j.produtora = p.cod ";

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
              if (!$busca) {
                echo "<tr><td>Infelizmente a busca deu errado";
              } else {
                  if ($busca->num_rows == 0) {
                    echo "<tr><td>Nenhum registro encontrado";
                  } else {
                    while ($reg=$busca->fetch_object()) {
                      $t = thumb($reg->capa);
                        echo "<tr><td><img src='$t' class='mini'/>";
                        echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
                        echo "[$reg->genero]";
                        echo "<br/>$reg->produtora";
                        echo "<td>Adm";    
                    }
                  }
                } 
              
            ?>
        </table>

    </div>
    <?php include_once "rodape.php";?>
    
</body>
</html>