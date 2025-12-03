<?php 
echo "<header>";
echo "<p class='pequeno'>";
/*Se usuario vazio(empty) */
if(empty($_SESSION['user'])) {
   echo "<a href= 'user-login.php'>Entrar</a>";
}else {
    echo "Olá, <strong>" . $_SESSION['nome'] . "</strong> | ";
    echo "Sair";
}

echo "</p>";
echo "</header>";


?>