<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Atualizar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE ?>/trabalhos">Trabalhos</a></li>
                        <li class="breadcrumb-item active">Atualizar</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="A_trabalhoMsg"><?= $msg??null ?></div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Atualização do trabalho: <span class="alert-link"><?= $t['trabalho'] ?></span></h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <form method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputTrabalho">Trabalho</label>
                                    <input type="text" class="form-control" id="InputTrabalho" value="<?= $t['trabalho'] ?>" name="trabalho">
                                </div>
                                <div class="form-group">
                                    <label for="InputTrabalho">Tags</label>
                                    <span>(Separado por ',')</span>
                                    <input type="text" class="form-control" id="InputTrabalho" value="<?= $t['tags'] ?>" name="tags">
                                </div>
                                <div class="form-group">
                                    <label for="TrabalhoDesc">Descrição</label>
                                    <textarea class="form-control" id="TrabalhoDesc" name="descr" placeholder="Descrição do projeto"><?= $t['descr'] ?></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<div class="A_cargoModal"></div>