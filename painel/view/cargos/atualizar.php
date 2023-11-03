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
                        <li class="breadcrumb-item"><a href="<?= BASE ?>/cargos">Cargos</a></li>
                        <li class="breadcrumb-item active">Atualizar</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="A_cargoMsg"><?= $msg??null ?></div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Atualização do cargo : <span class="alert-link"><?= $c['cargo'] ?></span></h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <form method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputCargo">Cargo</label>
                                    <input type="text" class="form-control" id="InputCargo" value="<?= $c['cargo'] ?>" name="cargo">
                                </div>
                                <div class="form-group">
                                    <label for="InputDesc">Descrição</label>
                                    <input type="text" class="form-control" id="InputDesc" value="<?= $c['descr'] ?>" name="descr">
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