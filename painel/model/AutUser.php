<?php

class AutUser extends Dbasis
{
    public function verificaCookie()
    {
        if (isset($_COOKIE['Enzo'])) {
            $dadosUsuario = json_decode($_COOKIE['Enzo'], true);
            $verifica = Dbasis::read('usuarios','email = "'.$dadosUsuario['email'].'"');
            if ($verifica->num_rows) {
                foreach ($verifica as $v);
                unset($v['senha']);
                $_SESSION['AutUser'] = $v;
                return 1;
            }else {
                setcookie('Enzo', '', time() - 3600, '/');
                return 2;
            }
        }
    }

    /**
     * Método responsável por logar os usuarios
     * @param array $dados
     * @return int
     * **/
    public function login($dados)
    {
        $verifica = Dbasis::read('usuarios','email = "'.$dados['email'].'" AND senha = "'.md5($dados['senha']).'"');
        if ($verifica->num_rows) {
            foreach ($verifica as $dadosUsuario);
            unset($dadosUsuario['senha']);
                if ($dados['persistente']??null) {
                    $json = json_encode($dadosUsuario);
                    $tempoExpiracao = time() + (30 * 24 * 60 * 60); // 30 dias em segundos
                    setcookie('Enzo', $json, $tempoExpiracao, '/');
                }
                $_SESSION['AutUser'] = $dadosUsuario;
                return 1;
        }else {
            setcookie('Enzo', '', time() - 3600, '/');
            return 2;
        }
    }

    /**
     * Método responsável por verificar os emails dos clientes
     * @param string $cpf
     * @return string
     * **/
    public function ativaUsuario($cpf)
    {
        $cpf = base64_decode($cpf);
        $verf = read('usuarios','WHERE cpf = "'.$cpf.'"');
        if ($verf->num_rows) {
            $cad = [
                "status"    => 1
            ];
            update('usuarios',$cad,'cpf = "'.$cpf.'"');
            return true;
        }else{
            return false;
        }
    }

    /**
     * Método responsável cadastrar emails na newsletter
     * @param string $email
     * @return string
     * **/
    public function cadastraEmail($email)
    {
        $verf = read('newsletter','WHERE email = "'.$email.'"');
        if ($verf->num_rows) {
            foreach ($verf as $v);
            if ($v['status'] == 1) {
                echo "Esse email já se encontra cadastrado e ativo.";
            }elseif ($v['status'] == 2) {
                echo "Esse email já se encontra, porem inativo, estamos ativando ele para você.";
            }
        }else{
            $cad = [
                "email"     =>  $email,
                "status"    => 1

            ];
            $resposta = create('newsletter',$cad);
            if ($resposta) {
                echo "Email cadastrado, fique ligado que estaremos te notificando a cada novidade.";
            }else {
                echo "ERRO! tente novamente ou entre em contato com o suporte.";
            }
        }
    }

    /**
     * Método responsável inserir contas 
     * @param array $post
     * @return string
     * **/
    public function setClient($post)
    {
        $verf = read('usuarios','WHERE email = "'.$post['email'].'"');
        if ($verf->num_rows) {
            return false;
        }else{
            create('usuarios', $post);
            sleep(1);
            $user = read('usuarios','WHERE email = "'.$post['email'].'"');
            foreach ($user as $u );
            $up = [
                "idComprador"  =>  $u['id']
            ];
            update('carrinho',$up,'idComprador = "'.session_id().'"');
            $assunto 			=	'[Evoove] Confirme seu cadastro!';
            $mensagem			=	'<!DOCTYPE html>
            <html>
            <head>
                <title> '.TITULO.'</title>
                <meta charset="utf-8"/>
                <meta name="author" content="Ignazio Balbo Neto" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />
                <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
                <style type="text/css">
                    body {font-family:montserrat;}
                    .top{background-color: #F5F5F5; width: 100%;height: 80px;position: absolute;top: 0;left: 0;}
                    .meio{padding-top: 5%;padding-left: 10%;padding-right: 10%;}
                    .meio p{color:#000 !important;text-align: center;}
                    .meio h1 {text-align: center;}
                    .rodape{background-color: #000;color: #fff; width: 100%;position: absolute;bottom: 0;left: 0;}
                    .rodape a{color:#F5F5F5;font-size: 12px;}
                </style>
            </head>
            <body>
                <div>
                    <div class="top">
                        <center><img src="https://evoove.com.br/2022/img/logo.png" width="120px"></center>
                                
                    </div>
                    <div class="meio">
                        <h1 >'.$post['nome'].'</h1>
                        <hr>
                        <div style="clear: both;"></div>
                        <p>Vimos que você realizou seu cadastro em nossa loja más antes de liberar o acesso do seu usuario precisamos que você confirme esse email por <a href="'.BASE.'/cadastro/ativar/'.base64_encode($post['cpf']).'">aqui</a>.</p>
                        <p>Caso não tenha sido você que realizou o cadastro pedimos que desconsidere o email.</p>
                    </div>
                    <div class="rodape">
                        <center><img src="https://evoove.com.br/2022/img/logo-dark.png" width="150px"></center>
                        <div style="clear: both;"></div>
                        <hr style="width: 80%;margin-left: 10%;margin-right: 10%;margin-top: 20px">
                        <p style="float: left;width: 40%;text-align: right;">
                            <a href="https://colavoto.com.br/colavoto/politica22.html">Politica de privacidade</a>
                        </p>
                        <p style="float: right;width: 40%">
                            <a href="https://colavoto.com.br/colavoto/termos22.html">Termos de uso</a>
                        </p>
                    </div>
                </div>
            </body>
            </html>';
            $destino 			=	$post['email'];
            $nomeDestino		=	$post['nome'];
            sendMail($assunto,$mensagem,$destino,$nomeDestino);
            return true;
        }
    }

    /**
     * Método responsável por retornar usuários
     * @param int $id
     * @return array
     * **/
    public function getClient($id = null,$email=null)
    {
        // $nome_conta = str_replace(" ","%",$nome_conta);
        $where      = ($id ? "WHERE id = $id":($email ? "WHERE email = '$email'":""));
        $usuario     = read('clientes', $where.' ORDER BY nome ASC');
        if ($usuario) {
            return $usuario;
        } else {
            return false;
        }
    }

    /**
     * Método responsável por verificar se o cliente já tem cadastro
     * @param int $id
     * @return array
     * **/
    public function verClient($id)
    {   
        $usuario     = read('compras','WHERE id = "'.$id.'" ORDER BY nome ASC');
        foreach ($usuario as $user);
            $verf = read('clientes','WHERE email = "'.$user['email'].'"');
        if ($verf->num_rows) {
            return false;
        } else {
            return $usuario;
        }
    }

    /**
     * Método responsável por verificar se já existe cadastro com a conta google
     * @param string $email
     * @return array
     * **/
    public function verGoogle($email)
    {   
        $verifica     = read('usuarios','WHERE email = "'.$email.'"');
        if ($verifica->num_rows) {
            foreach ($verifica as $dadosUsuario);
            unset($dadosUsuario['senha']);
            if ($dadosUsuario['status'] == 1) {
                    $json = json_encode($dadosUsuario);
                    $tempoExpiracao = time() + (30 * 24 * 60 * 60); // 30 dias em segundos
                    setcookie('Evoove', $json, $tempoExpiracao, '/');
                    $_SESSION['AutUser'] = $dadosUsuario;
                return 3;
            }else {
                return 2;
            }
        }else {
            setcookie('Evoove', '', time() - 3600, '/');
            return 1;
        }
    }
}