<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trabalhos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE ?>">Home</a></li>
                        <li class="breadcrumb-item active">Trabalhos</li>
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
                    <?php if ($lista) : ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listagem de trabalhos cadastrados</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Trabalho</th>
                                            <th>Descrição</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($lista as $l) {
                                            echo '
                                            <tr id="A_trabalho' . $l['id'] . '">
                                                <td>' . $l['id'] . '</td>
                                                <td>' . $l['trabalho'] . '</td>
                                                <td>' . $sis->resume($l['descr'],50) . '</td>
                                                <td>
                                                    <a href="'.BASE.'/trabalhos/galeria/' . $l['id'] . '" class="btn btn-primary" title="Gerenciar galeria"><i class="fas fa-image"></i></a>
                                                    <a href="'.BASE.'/trabalhos/atualizar/' . $l['id'] . '" class="btn btn-primary" title="Atualizar cadastro"><i class="fas fa-pen"></i></a>
                                                    <a class="btn btn-primary A_PergExcluirTrabalho" title="Excluir trabalho" data-cargo="' . $l['id'] . '"><i class="fas fa-trash"></i></a>
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
                            Ainda não existem trabalhos cadastrados!
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Cadastro de trabalhos</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <form method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputTrabalho">Trabalho</label>
                                    <input type="text" class="form-control" id="InputTrabalho" placeholder="Trabalho" name="trabalho">
                                </div>
                                <div class="form-group">
                                    <label for="TrabalhoDesc">Descrição</label>
                                    <textarea class="form-control" id="TrabalhoDesc" name="descr" placeholder="Descrição do projeto"></textarea>
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