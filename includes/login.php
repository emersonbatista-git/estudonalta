<?php 
/*Abrir variaveis de sessao. 
Sempre que efetuar um login tem que ter o inicio das variaveis de sessao.
Um espeço na memoria que fica reservado para um usuario. */
session_start();
/*Se o usuario nao foi configiurado(!isset) */
if (!isset($_SESSION['user']))  {
    $_SESSION['user'] = "";
    $_SESSION['nome'] = "";
    $_SESSION['tipo'] ="";
}



function cripto($senha){
    $c = '';
    for($pos = 0; $pos < strlen($senha); $pos++) {
        $letra = ord($senha[$pos]) + 1;
        $c .= chr($letra);
        
    }
    return $c;

}

function gerarHash($senha){
    $txt = cripto($senha);
    $hash = password_hash($txt, PASSWORD_DEFAULT);
    return $hash;  
}

function testarHash($senha, $hash) {
    $ok = password_verify(cripto($senha),$hash);
    return $ok;
}

 // echo gerarHash('admin');

 //echo testarHash('emerson', '$2y$10$H8uRTHUw1YRVm./f5vpn0.k0OhjLk.mklqPIksK5tP4Y5rMoiNOlO');
 //$original = 'emerson';
 //echo "$original --- ";
 //echo cripto($original) . " ---";

 //echo gerarHash($original) . " --- ";

 //Permissoes, para aplicar permissões, verificar se está logado

 //logout
 //Logout

        function logout() {
            unset($_SESSION['user']);
            unset($_SESSION['nome']);
            unset($_SESSION['tipo']);
        }

    //permissao de acesso
        function is_logado() {
            if(empty($_SESSION['user'])) {
                return false;
            }else {
                return true;
            }
        }

        function is_admin(){
            $t = $_SESSION['tipo'] ?? null;
            if (is_null($t)) {
                return false;
            }else {
                if ($t == 'admin') {
                    return true;
                }else {
                    return false;
                }
            }

        }
        function is_editor(){
                 $t = $_SESSION['tipo'] ?? null;
            if (is_null($t)) {
                return false;
            }else {
                if ($t == 'editor') {
                    return true;
                }else {
                    return false;
                }
            }


        }
        



?>