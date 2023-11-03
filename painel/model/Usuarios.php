<?php

class Usuarios extends Dbasis {

    /**
     * Método responsavel por listar os usuarios do sistema
     * @return array
     */
    public function listar() {
        $read = Dbasis::select('*,usuarios.id','usuarios','INNER JOIN cargos ON cargos.id = usuarios.cargo');
        //$read = Dbasis::read('usuarios');
        if ($read->num_rows) {
            return $read;
        }else {
            return 0;
        }
    }

    /**
     * Método responsavel por retornar os dados do usuario
     * @param int $id
     * @return array
     */
    public function retorna($id) {
        $read = Dbasis::read('usuarios'."id = $id");
        if ($read->num_rows) {
            foreach ($read as $r);
            return $r;
        }else {
            return 0;
        }
    }

    /**
     * Método responsavel pelo cadastro de novos usuarios
     * @param array $post
     * @return int
     */
    public function cadastro($post) {
        $verEmail = Dbasis::read('usuarios','email = "'.$post['email'].'"');
        if ($verEmail->num_rows) {
            return 1;
        }else {
            if ($post['senha1'] == $post['senha2']) {
                if(!empty($_FILES['avatar']['tmp_name'])){
                    $imagem = $_FILES['avatar'];
                    $pasta  = 'uploads/avatar/';
                    $tmp    = $imagem['tmp_name'];
                    $exp    = explode(".",$imagem['name']);
                    $ext    = end($exp);
                    $nome   = md5(time()).'.'.$ext;
                    Dbasis::uploadImage($tmp, $nome, '160','160', $pasta);
                    $post['avatar'] = $nome;
                }
                $dados = [
                    "nome"  => $post['nome'],
                    "email"  => $post['email'],
                    "cargo"  => $post['cargo'],
                    "avatar"  => $post['avatar'],
                    "senha"  => md5($post['senha2'])
                ];
                $cad = Dbasis::create('usuarios',$dados);
                if ($cad) {
                    return 3;
                }else {
                    return 0;
                }
            }else {
                return 2;
            }
        }
    }
}