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
        <?php require_once "topo.php";?>
        <?php
        //Criei uma variavel $c para pegar o codigo que veio da url

        $c = $_GET['cod'] ?? 0;
        //Select para trazer o codigo igual ao codigo que passei//
        $busca = $banco->query("select *from jogos where cod='$c'");
        
        ?>
        <h1>Detalhes do Jogo</h1>
<!--Criei uma tabela com a 1 coluna com 3 linhas e as demias com 1 linha-->
<table class="detalhes">
   <?php 
   /*Conferir se a busca deu certo e se é igual de 1, quero apenas um registro
   Utilizei a variavel $reg para receber o resultado do select*/
    if (!$busca) {
        echo "<tr><td>Busca falhou!";
    }else {
        if($busca->num_rows == 1) {
            $reg = $busca->fetch_object();
        /*Criar uma variavel para receber atravez da funcao thump o nome do arquivo de foto*/ 
            $t = thumb($reg->capa);
        
        /*Exibir o que eu quero na tela
        rowspan = 3 fez que a primeira celula ocupasse 3 linhas*/
             echo "<tr><td rowspan='3'><img src='$t' class='full' />";
             echo "<td><h2>$reg->nome</h2>";
             echo "Nota: ". number_format($reg->nota ,"1") . "/10.0";
                     if (is_admin()){
                echo " <i class='material-icons'>add_circle</i> ";
                echo " <i class='material-icons'>edit</i> ";
                echo " <i class='material-icons'>delete</i> ";
              }elseif (is_editor()){
                echo " <i class='material-icons'>edit</i> ";

                      }
             echo " <tr><td>$reg->descricao";
             
        }else {
            echo "<tr><td>Nenhum registro encontrado!";
        }
    }
  
    
    ?>

</table>
<!--Incluir função voltar -->
    <?php echo voltar()?>

    </div>
     <?php include_once "rodape.php";?>
</body>
</html>