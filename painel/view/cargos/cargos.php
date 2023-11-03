<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cargos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE ?>">Home</a></li>
                        <li class="breadcrumb-item active">Cargos</li>
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
                    <?php if ($lista) : ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listagem de cargos cadastrados</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cargo</th>
                                            <th>Descrição</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($lista as $l) {
                                            echo '
                                            <tr id="A_cargo' . $l['id'] . '">
                                                <td>' . $l['id'] . '</td>
                                                <td>' . $l['cargo'] . '</td>
                                                <td>' . $l['descr'] . '</td>
                                                <td>
                                                    <a href="'.BASE.'/cargos/gerenciar/' . $l['id'] . '" class="btn btn-primary" title="Gerenciar permissões"><i class="fas fa-wrench"></i></a>
                                                    <a href="'.BASE.'/cargos/atualizar/' . $l['id'] . '" class="btn btn-primary" title="Gerenciar permissões"><i class="fas fa-pen"></i></a>
                                                    <a class="btn btn-primary A_PergExcluirCargo" title="Excluir cargo" data-cargo="' . $l['id'] . '"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-warning" role="alert">
                            Ainda não existem cargos cadastrados!
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Cadastro de cargos</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <form method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputCargo">Cargo</label>
                                    <input type="text" class="form-control" id="InputCargo" placeholder="Cargo" name="cargo">
                                </div>
                                <div class="form-group">
                                    <label for="InputDesc">Descrição</label>
                                    <input type="text" class="form-control" id="InputDesc" placeholder="Descrição do cargo" name="descr">
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
        </div><!-- /.container-fluid -->
    </section>
</div>
<div class="A_cargoModal"></div>