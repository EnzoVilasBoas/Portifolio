<?php
    $sis 	= new Sistema;
    $wk     = new Trabalhos;

    $acao       = $sis->getParametros()[1]??null;
    $parametro  = $sis->getParametros()[2]??null;
    $post       = $sis->getPost();

    switch ($acao) {
        case 'galeria':
            switch ($parametro) {
                case 'abrir':
                    if ($post) {
                        $img = $wk->retornaImagem($post['img']);
                        if ($img) {
                            echo '
                            <div class="modal fade A_galeriaModal'.$img['id'].'" >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Visualização ampliada</span></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="'.BASE.'/uploads/galeria/'.$img['imagem'].'" width="760" style="border:2px solid black"/>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger A_excluirImagem" data-img="'.$img['id'].'" data-dismiss="modal">Excluir</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }else {
                            # code...
                        }
                    }
                    break;
                case 'excluir':
                    if ($post) {
                        $del = $wk->excluirImagem($post['img']);
                        switch ($del) {
                            case 1:
                                echo '
                                <div class="alert alert-success" role="alert">
                                    Imagem excluida com sucesso!
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
                default:
                    if ($parametro) {
                        $t = $wk->retorna($parametro);
                        if ($t) {
                            if ($_FILES) {
                                $cad = $wk->cadastraGaleria($parametro);
                                switch ($cad) {
                                    case 1:
                                        $msg = '
                                        <div class="alert alert-success" role="alert">
                                            Imagens cadastradas com sucesso!
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
                            $lista = $wk->retornaGaleria($parametro);
                            require_once('view/trabalhos/galeria.php');
                        }else {
                            require_once('view/404.php');
                        }
                    }
                    break;
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