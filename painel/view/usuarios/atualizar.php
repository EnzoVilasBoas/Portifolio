<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Atualização</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE ?>/usuarios">Usuarios</a></li>
                        <li class="breadcrumb-item active">Atualização</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Atualização do <?= $u['cargo'] ?>: <span class="alert-link"><?= $u['nome'] ?></span></h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <form method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputNome">Nome</label>
                                    <input type="text" class="form-control" id="InputNome" value="<?= $u['nome'] ?>" name="nome">
                                </div>
                                <div class="form-group">
                                    <label for="InputEmail">Email</label>
                                    <input type="email" class="form-control" id="InputEmail" value="<?= $u['email'] ?>" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="SelectCargo">Cargo</label>
                                    <select class="form-control" name="cargo" id="SelectCargo">
                                        <option selected value="<?= $u['cargoId'] ?>">Altere o cargo</option>
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
                                        <input type="hidden" class="custom-file-input" id="customFile" name="avatarOld" value="<?= $u['avatar'] ?>">
                                        <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                        <label class="custom-file-label" for="customFile">Selecione um avatar</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputSenhaUm">Senha</label>
                                    <input type="password" class="form-control" id="InputSenhaUm" placeholder="Nova senha" name="senha1">
                                    <span id="AlertSenhaUm">*A senha deve ter mais de 8 caracteres</span>
                                </div>
                                <div class="form-group">
                                    <label for="InputSenhaDois">Confirme sua senha</label>
                                    <input type="hidden" class="form-control" id="InputSenhaDois" value="<?= $u['senha'] ?>" name="senhaOld">
                                    <input type="password" class="form-control" id="InputSenhaDois" placeholder="Confirme sua nova senha" name="senha2">
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