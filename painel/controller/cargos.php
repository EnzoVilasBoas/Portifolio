<?php
    $sis 	= new Sistema;
    $cg     = new Cargos;

    $acao       = $sis->getParametros()[1]??null;
    $parametro  = $sis->getParametros()[2]??null;
    $post       = $sis->getPost();

    switch ($acao) {
        case 'excluir':
            if ($parametro == 'verf') {
                if ($post) {
                    $del = $cg->questExcluir($post['cargo']);
                    switch ($del['cod']) {
                        case 2:
                            echo '
                            <div class="modal fade A_cargoModal'.$del['id'].'" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Excluir <span class="alert-link">'.$del['cargo'].'</span></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Você está prestes a excluir o cargo : <span class="alert-link">'.$del['cargo'].'</span></p>
                                            <p>Deseja prosseguir com essa ação?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-primary A_excluirCargo" data-dismiss="modal" data-cargo="' . $del['id'] . '">Prosseguir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            break;
                        case 1:
                            echo '
                            <div class="modal fade A_cargoModal'.$del['id'].'" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Excluir <span class="alert-link">'.$del['cargo'].'</span></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Você está prestes a excluir o cargo : <span class="alert-link">'.$del['cargo'].'</span></p>
                                            <p>Este cargo possui usuarios vinculados, ao prosseguir todos teram seu acesso restrito até que sejam atualizados.</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-primary A_excluirCargo" data-dismiss="modal" data-cargo="' . $del['id'] . '">Prosseguir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            break;
                        default:
                            echo '
                            <div class="modal fade A_cargoModal'.$del['id'].'" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><span class="alert-link">ERRO!</span></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Cargo não encontrado, tente novamente ou entre em contato com o suporte.</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            break;
                    }
                }
            }else {
                if ($post) {
                    $del = $cg->excluir($post['cargo']);
                    switch ($del) {
                        case 1:
                            echo '
                            <div class="alert alert-success" role="alert">
                                Cargo excluido com sucesso!
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
            }
            break;

        case 'gerenciar':
            if ($parametro) {
                if ($post) {
                    $cad = $cg->vincular($parametro,$post['acesso']);
                    switch ($cad) {
                        case 2:
                            $msg = '
                            <div class="alert alert-success" role="alert">
                                Permissão vinculada com sucesso.
                            </div>';
                            break;
                        case 1:
                            $msg = '
                            <div class="alert alert-warning" role="alert">
                                Esse permissão já se encontra vinculada!
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
                $lista = $cg->retornaPerm($parametro);
                $perms = $cg->retornaPerm();
                require_once('view/cargos/gerenciar.php');
            }
            break;
        case 'acesso':
            if ($post) {
                $del = $cg->removAcesso($post['acesso']);
                switch ($del) {
                    case 1:
                        echo '
                        <div class="alert alert-success" role="alert">
                            Permissão removida com sucesso!
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
                    $up = $cg->atualiza($parametro,$post);
                    switch ($up) {
                        case 1:
                            $msg = '
                            <div class="alert alert-success" role="alert">
                                Cargo atualizado com sucesso!
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
                $c = $cg->retorna($parametro);
                require_once('view/cargos/atualizar.php');
            }
            break;
        default:
            if ($post) {
                $cad = $cg->cadastro($post);
                switch ($cad) {
                    case 2:
                        $msg = '
                        <div class="alert alert-success" role="alert">
                            Cargo cadastrado com sucesso.
                        </div>';
                        break;
                    case 1:
                        $msg = '
                        <div class="alert alert-warning" role="alert">
                            Esse cargo já se encontra cadastrado!
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
            $lista = $cg->lista();
            require_once('view/cargos/cargos.php');
            break;
    }
