<?php 
echo "<header>";
echo "<p class='pequeno'>";
/*Se usuario vazio(empty) */
if (empty($_SESSION['user'])) {
   echo "<a href= 'user-login.php'>Entrar</a>";
}else {
    echo "Olá, <strong>" . $_SESSION['nome'] . "</strong> | ";
    echo "<a href = 'user-edit.php'>Meus dados</a> | ";
    if (is_admin()){
        echo "<a href='user-new.php'>Novo usuario</a> | ";
        echo "novo jogo | ";
    }
    echo "<a href='user-logout.php'>Sair</a>";
}

echo "</p>";
echo "</header>";


?>