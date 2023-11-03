<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE ?>">Home</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="A_usuarioMsg"><?= $msg??null ?></div>
            <div class="row">
                <div class="col-12">
                    <?php if ($lista) : ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listagem de usuarios cadastrados</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Cargo</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($lista as $l) {
                                            echo '
                                            <tr id="A_cargo' . $l['id'] . '">
                                                <td>' . $l['id'] . '</td>
                                                <td>' . $l['nome'] . '</td>
                                                <td>' . $l['email'] . '</td>
                                                <td>' . $l['cargo'] . '</td>
                                                <td>
                                                    <a href="'.BASE.'/usuarios/atualizar/' . $l['id'] . '" class="btn btn-primary" title="Atualizar cadastro"><i class="fas fa-pen"></i></a>
                                                    <a class="btn btn-primary A_PergExcluirUsuario" title="Excluir usuario" data-cargo="' . $l['id'] . '"><i class="fas fa-trash"></i></a>
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
                            Ainda não existem usuarios cadastrados!
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Cadastro de usuario</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <form method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputNome">Nome</label>
                                    <input type="text" class="form-control" id="InputNome" placeholder="Nome" name="nome">
                                </div>
                                <div class="form-group">
                                    <label for="InputEmail">Email</label>
                                    <input type="email" class="form-control" id="InputEmail" placeholder="Email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="SelectCargo">Cargo</label>
                                    <select class="form-control" name="cargo" id="SelectCargo">
                                        <option disabled selected>Selecione um cargo</option>
                                        <?php
                                            foreach ($cargos as $c) {
                                                echo '<option value="'.$c['id'].'">'.$c['cargo'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                        <label class="custom-file-label" for="customFile">Selecione um avatar</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputSenhaUm">Senha</label>
                                    <input type="password" class="form-control" id="InputSenhaUm" placeholder="Senha" name="senha1">
                                    <span id="AlertSenhaUm">*A senha deve ter mais de 8 caracteres</span>
                                </div>
                                <div class="form-group">
                                    <label for="InputSenhaDois">Confirme sua senha</label>
                                    <input type="password" class="form-control" id="InputSenhaDois" placeholder="Confirme sua senha" name="senha2">
                                    <span id="AlertSenhaDois">*As senhas devem coincidir</span>
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
<div class="A_usuarioModal"></div>