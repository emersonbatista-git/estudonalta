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
    <title>Cadastrar novo usuário</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>

    
    <div id="corpo">
        
        <?php 
        if (!is_admin()) {
            echo msg_erro('Área restrita! Você não é adminiistrador');
        }else {
            if (!isset($_POST['usuario'])) {
                require "user-new-form.php";
            }else {
                $usuario = $_POST['usuario'] ?? null;
                $nome = $_POST['nome'] ?? null;
                $senha1 = $_POST['senha1'] ?? null;
                $senha2 = $_POST['senha2'] ?? null;
                $tipo = $_POST['tipo'] ?? null;

                if($senha1 === $senha2) {
                    $senha = gerarHash($senha1);
                    $q = "INSERT INTO usuarios (usuario, nome, senha, tipo) VALUES ('$usuario', '$nome','$senha','$tipo')";
                    if ($banco->query($q)) {
                        echo msg_sucesso("Usuario $nome cadastrado com sucesso!");
                    }else{
                        echo msg_erro("Não foi possivel criar o usuario $usuario.");
                    }
                    

                }else {
                    echo msg_erro("Senhas não conferem!");
                }

                
            }
            

        }
        echo voltar();
        ?>

    </div>
    
        
    </body>

    <html>