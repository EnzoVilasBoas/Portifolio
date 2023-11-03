<?php
    $sis 	= new Sistema;
    $us     = new Usuarios;

    $acao       = $sis->getParametros()[1]??null;
    $parametro  = $sis->getParametros()[2]??null;
    $post       = $sis->getPost();

    switch ($acao) {
        case 'value':
            # code...
            break;
        
        default:
            if ($post) {
                # code...
            }
            $lista = $us->listar();
            require_once('view/usuarios/usuarios.php');
            break;
    }