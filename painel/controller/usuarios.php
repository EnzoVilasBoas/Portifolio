<?php
    $sis 	= new Sistema;
    $us     = new Usuarios;
    $cg     = new Cargos;

    $acao       = $sis->getParametros()[1]??null;
    $parametro  = $sis->getParametros()[2]??null;
    $post       = $sis->getPost();

    switch ($acao) {
        case 'excluir':
            if ($parametro == "verf") {
                $del = $us->retorna($post['user']);
                switch ($del) {
                    default:
                        echo '
                        <div class="modal fade A_usuarioModal'.$del['id'].'" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Excluir <span class="alert-link">'.$del['nome'].'</span></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Você está prestes a excluir o '.$del['cargo'].' : <span class="alert-link">'.$del['nome'].'</span></p>
                                        <p>Deseja prosseguir com essa ação?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary A_excluirUsuario" data-dismiss="modal" data-usuario="' . $del['id'] . '">Prosseguir</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        break;
                    case 0:
                        echo '
                        <div class="modal fade A_usuarioModal'.$post['user'].'" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><span class="alert-link">ERRO!</span></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Usuario não encontrado, tente novamente ou entre em contato com o suporte.</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        break;
                }
            }else {
                $del = $us->excluirUsuario($post['user']);
                switch ($del) {
                    case 1:
                        echo '
                        <div class="alert alert-success" role="alert">
                            Usuario excluido com sucesso.
                        </div>';
                        break;
                    default:
                        echo '
                        <div class="alert alert-danger" role="alert">
                            ERRO! Tente novamente ou entre em contato com o suporte.
                        </div>';
                        break;
                }
            }
            break;
        case 'atualizar':
            if ($parametro) {
                if ($post) {
                    $up = $us->atualiza($parametro,$post);
                    switch ($up) {
                        case 2:
                            $msg = '
                            <div class="alert alert-success" role="alert">
                                Usuario atualizado com sucesso.
                            </div>';
                            break;
                        case 1:
                            $msg = '
                            <div class="alert alert-warning" role="alert">
                                As senhas não coicidem
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
                $u = $us->retorna($parametro);
                $cargos = $cg->lista();
                require_once('view/usuarios/atualizar.php');
            }
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
                            As senhas não coicidem
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