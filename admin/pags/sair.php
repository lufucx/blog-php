<?php 
    if(session_destroy()){
        redireciona('login', 'success', 2, 'Deslogado com sucesso!');

    } else {
        echo "Erro ao deslogar!";
    }
?>