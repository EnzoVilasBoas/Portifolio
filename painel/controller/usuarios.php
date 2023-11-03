<?php
    $sis 	= new Sistema;
    $us     = new Usuarios;
    $cg     = new Cargos;

    $acao       = $sis->getParametros()[1]??null;
    $parametro  = $sis->getParametros()[2]??null;
    $post       = $sis->getPost();

    switch ($acao) {
        case 'value':
            # code...
            break;
        
        default:
            if ($post) {
                $cad = $us->cadastro($post);
                switch ($cad) {
                    case 3:
                        $msg = '
                        <div class="alert alert-success" role="alert">
                            Usuario cadastrado com sucesso.
                        </div>';
                        break;
                    case 2:
                        $msg = '
                        <div class="alert alert-warning" role="alert">
                            As senhas mão coicidem
                        </div>';
                        break;
                    case 1:
                        $msg = '
                        <div class="alert alert-warning" role="alert">
                            Já existe um usuario com esse email.
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
            $lista = $us->listar();
            $cargos = $cg->lista();
            require_once('view/usuarios/usuarios.php');
            break;
    }