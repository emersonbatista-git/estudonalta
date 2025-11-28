<?php 
//A variavel $arq irá receber o nome do arquivo e variavel $caminho irá receber este valor//
//A condição ira checar se o camiho é nulo ou se existe o caminho //

function thumb ($arq) {
    $caminho = "fotos/$arq";
    if (is_null($arq) || !file_exists($caminho)) {
        return "fotos/indisponivel.png";

    }else{
        return $caminho;
    }
}


?>