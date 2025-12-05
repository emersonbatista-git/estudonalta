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
    <title>Edição de Dados do Usuário</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>
   
    <div id="corpo">
        <?php 
        /*conferir se está logado*/
        if(!is_logado()) {
            echo msg_erro("Efetue <a href='user-login.php'>login</a>!");

        }else {
            if(!isset($_POST['usuario'])) {
                include "user-edit-form.php";
            }else {
                $usuario = $_POST['usuario'] ?? null;
                $nome = $_POST['nome'] ?? null;
                $tipo = $_POST['tipo'] ?? null;
                $senha1 = $_POST['senha1'] ?? null;
                $senha2 = $_POST['senha2'] ?? null;

                /*Gravar no banco */ 
                $q = "update usuarios set usuario ='$usuario', nome = '$nome'";
                /*Função para verificar se está vazia, empty.
                Na senha irá concatenar com o update, por isso o .= e a continuação do comando update */
                if (empty($senha1) || is_null($senha1)) {
                    echo msg_aviso("Senha antiga foi mantida.");
                }else {
                    if ($senha1 === $senha2) {
                        $senha = gerarHash($senha1);
                        $q .= " , senha='$senha'";
                    }else {
                        echo msg_erro("Senhas não conferem. Senha anterior mantida.");
                    }
                }

                /*Iremos agora colocar o where.
                Onde usuario é igual ao usuario da sessao */

                $q .= " where usuario = '" . $_SESSION['user'] . "'";

                if ($banco->query($q)) {
                    echo msg_sucesso("Usuario alterado com sucesso!");
                    logout();
                    echo msg_aviso("Efetue <a href= 'user-login.php'>login</a> novamente.");

                } else {
                    echo msg_erro("Não foi possivel alterar dados.");
                }



                
            }
        }
        
        ?>
       <?php echo voltar()?>

    </div>
     
    <?php require_once "rodape.php"; ?>
        
    </body>
    

    <html>