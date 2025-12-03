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
    <title>Login de usuario</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

      <style>
        td {
            padding: 6px;
        }
      </style>
</head>
<body>

    
    <div id="corpo">
<!--Pegar usuario e senha -->
        <?php 
        $u = $_POST['usuario'] ?? null ;
        $s = $_POST['senha'] ?? null;
            if (is_null($u) || is_null($s)) {
                require_once "user-login-form.php";
            }else {
                $q = "SELECT usuario, nome, senha, tipo from usuarios where usuario = '$u' LIMIT 1 ";
                $busca = $banco->query($q);
                 if(!$busca) {
                    echo msg_erro('Falha ao acessar o banco!');
                 }else{
                    if ($busca->num_rows > 0){
                          $reg = $busca->fetch_object();
                    if(testarHash($s, $reg->senha)) {
                        echo msg_sucesso('Logado com sucesso!');
                        $_SESSION['user'] = $reg->usuario;
                        $_SESSION['nome'] = $reg->nome;
                        $_SESSION['tipo'] = $reg->tipo;

                    }else{
                        echo msg_erro('Senha invalida');
                    }
                                   
                 }else {
                    echo msg_erro('Usuario não encontrado');
                 }
            }
        }
        echo voltar();
        ?>

    </div>
    
        
    </body>

    <html>
        