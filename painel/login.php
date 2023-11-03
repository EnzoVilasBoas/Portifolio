<?php
    ob_start();
    session_start();

    require_once('config/iniSis.php');
    require_once('config/autoload.php');

    $sis = new Sistema;

    $sis->debug(TRUE);
    $sis->log(TRUE);

    $aut = new AutUser;
    
    $cookie = $aut->verificaCookie();
    if ($cookie) {
        switch ($cookie) {
            case 1:
                $msg = 
                '<div class="alert alert-success" role="alert">
                    Autenticado com sucesso, Redirecionando...
                    <meta http-equiv="refresh" content="5;url='.BASE.'">
                </div>';
                break;
            case 2:
                $msg = 
                '<div class="alert alert-warning" role="alert">
                    Cookie invalido, realize o login novamente.
                </div>';
                break;
            default:
                $msg = 
                '<div class="alert alert-danger" role="alert">
                    <span class="alert-link">ERRO</span>! Tente novamente ou entre em contato com  o suporte.
                </div>';
                break;
        }
    }
    
    $post = $sis->getPost();
    if ($post) {
        $login = $aut->login($post);
        switch ($login) {
            case 1:
                $msg = 
                '<div class="alert alert-success" role="alert">
                    Autenticado com sucesso, Redirecionando...
                    <meta http-equiv="refresh" content="5;url='.BASE.'">
                </div>';
                break;
            case 2:
                $msg = 
                '<div class="alert alert-warning" role="alert">
                    E-mail ou senha incorretos, verifique e tente novamente.
                </div>';
                break;
            default:
                $msg = 
                '<div class="alert alert-danger" role="alert">
                    <span class="alert-link">ERRO</span>! Tente novamente ou entre em contato com  o suporte.
                </div>';
                break;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= TITULO ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= BASE ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE ?>/dist/css/adminlte.min.css">
</head>
<style>
    /* FUNÇÃO CHECKBOX FAKE */
    .custom-checkbox {
        display: none;
    }

    .custom-checkbox+label {
        position: relative;
        width: 20px;
        height: 20px;
        border: 2px solid #ccc;
        border-radius: 50%;
        cursor: pointer;
        margin-right: 3%;
    }

    .custom-checkbox:checked+label {
        background-color: #007bff;
        border-color: #007bff;
    }

    .custom-checkbox:checked+label::after {
        content: "\2713";
        /* Código unicode do "tick" */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
    }
</style>

<body class="hold-transition login-page" style="background: linear-gradient( 115deg, #001669, #007296 1%, #007296 11%, #015673 15%, #000 23.57%, transparent 23.57%, transparent 100% ),linear-gradient( 109deg, transparent, #2d8427 23.57%, #205a06 41%, #000 45%, transparent 45%, transparent 100% ),linear-gradient( 109deg, transparent, #e79a07 45%, #e79a07 50%, #e79a07 52%, #444 55%, transparent 45%, transparent 100% ),linear-gradient( 109deg, transparent, #288ab1 55%, #288ab1 68%,  #000 73%, transparent 73%,transparent 100% ),linear-gradient( 109deg, transparent, #de491e 73%, #de491e 100% );">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h2"><?= TITULO ?></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Login necessario para acessar o sistema!</p>
                <?= $msg ?? null ?>
                <form action="<?= BASE ?>/login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="E-mail" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Senha" name="senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="checkbox" name="persistente" class="custom-checkbox" id="persistente">
                        <label for="persistente"></label>
                        <span>Manter minha conta logada</span>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    <a href="forgot-password.html">Esqueci minha senha</a>
                </p>
            </div>
        </div>
    </div>
    <script src="<?= BASE ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= BASE ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE ?>/dist/js/adminlte.min.js"></script>
</body>

</html>
<?php
ob_end_flush();
?>