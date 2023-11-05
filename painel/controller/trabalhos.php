<?php
    $sis 	= new Sistema;
    $wk     = new Trabalhos;

    $acao       = $sis->getParametros()[1]??null;
    $parametro  = $sis->getParametros()[2]??null;
    $post       = $sis->getPost();

    switch ($acao) {
        case 'galeria':
            if ($parametro) {
                # code...
            }
            break;
        
        default:
            if ($post) {
                $cad = $wk->cadastro($post);
                switch ($cad) {
                    case 2:
                        $msg = '
                        <div class="alert alert-success" role="alert">
                            Trabalho cadastrado com sucesso!
                        </div>';
                        break;
                    case 1:
                        $msg = '
                        <div class="alert alert-warning" role="alert">
                            Trabalho já cadastrado.
                        </div>';
                        break;
                    default:
                        $msg = '
                        <div class="alert alert-danger" role="alert">
                            ERRO! Tente novamente ou entre em contato com o suporte.
                        </div>';
                        break;
                }
            }
            $lista = $wk->listar();
            require_once('view/trabalhos/trabalhos.php');
            break;
    }