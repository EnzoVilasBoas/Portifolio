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
                                <div class="row">
                                    <?php
                                        foreach ($lista as $l) {
                                            echo '
                                            <div class="col-sm-2">
                                                <img src="'.BASE.'/uploads/galeria/'.$l['imagem'].'" class="img-fluid mb-2" alt="'.$t['trabalho'].'"/>
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
<div class="A_cargoModal"></div>