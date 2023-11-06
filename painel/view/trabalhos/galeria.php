<style>
    .A_caixaImagem{
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        align-items: center;
        justify-content: space-evenly;
        align-content: space-around;
    }
    .A_imagem {
        background-color: rgba(0, 0, 0);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .A_lupa {
        background: black;
        opacity: 0%;
        width: 128px;
        height: 72px;
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }
    .A_lupa i {
        opacity: 100%;
        color: white;
        font-size: 22px;
    }
    .A_lupa:hover{
        opacity: 50%;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Galeria</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE ?>/trabalhos">Trabalhos</a></li>
                        <li class="breadcrumb-item active">Galeria</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="A_galeriaMsg"><?= $msg??null ?></div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Cadastro de imagens em : <span class="alert-link"><?= $t['trabalho'] ?></span></h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Imagens</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="imagem[]" multiple>
                                        <label class="custom-file-label" for="customFile">Selecione as imagens</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php if ($lista) : ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listagem de imagens cadastradas</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="A_caixaImagem p-3">
                                    <?php
                                        /* foreach ($lista as $l) {
                                            echo '
                                            <div class="col-sm-2 A_imagem" id="A_imagem'.$l['id'].'">
                                                <img src="'.BASE.'/uploads/galeria/'.$l['imagem'].'" class="img-fluid A_imagemAbrir" data-img="'.$l['id'].'" alt="'.$t['trabalho'].'"/>
                                            </div>';
                                        } */
                                        foreach ($lista as $l) {
                                            echo '
                                            <div class="A_imagem" id="A_imagem'.$l['id'].'">
                                                <div class="A_lupa A_imagemAbrir" data-img="'.$l['id'].'">
                                                    <i class="fas fa-search-plus"></i>
                                                </div>
                                                <img src="'.BASE.'/uploads/galeria/'.$l['imagem'].'" alt="'.$t['trabalho'].'" width="128"/>
                                            </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-warning" role="alert">
                            Ainda não existem imagens cadastradas!
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<div class="A_galeriaModal"></div>