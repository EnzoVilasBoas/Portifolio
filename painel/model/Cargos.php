<?php
    
class Cargos extends Dbasis {

    /**
     * Método responsavel por listar todos as materias
     * @return array
     */
    public function lista() {
        $read = Dbasis::read('cargos');
        if ($read->num_rows) {
            return $read;
        }else {
            return 0;
        }
    }

    /**
     * Método responsavel por retornar os dados de um cargo
     * @param int $id
     * @return array
     */
    public function retorna($id) {
        $verf = Dbasis::read('cargos',"id = $id");
        if ($verf->num_rows) {
            foreach ($verf as $v);
            return $v;
        }else {
            return 0;
        }
    }

    /**
     * Método responsavel pela atualização do cargo
     * @param int $id
     * @param array $post
     * @return int
     */
    public function atualiza($id,$post) {
        $verf = Dbasis::read('cargos',"id = $id");
        if ($verf->num_rows) {
            $dados = [
                "cargo" => $post['cargo'],
                "descr" => $post['descr']
            ];
            $up = Dbasis::update('cargos',$dados,"id = $id");
            if ($up) {
                return 1;
            }else {
                return 0;
            }
        }else {
            return 0;
        }
    }

    /**
     * Método responsavel pelo cadastro de cargos
     * @param array $post
     * @return int
     */
    public function cadastro($post) {
        $verf = Dbasis::read('cargos','cargo = "'.$post['cargo'].'"');
        if (!$verf->num_rows) {
            $cad = [
                "cargo" => $post['cargo'],
                "descr"  => $post['descr'],
            ];
            $create = Dbasis::create('cargos',$cad);
            if ($create) {
                return 2;
            }else {
                return 0;
            }
        }else {
            return 1;
        }
    }

    /**
     * Método responsavel pelo questionamento da exclusão do cargo.
     * @param int $id
     * @return string
     */
    public function questExcluir($id) {
        $cargo = Dbasis::read('cargos',"id = $id");
        if ($cargo->num_rows) {
            $verUsuarios = Dbasis::read('usuarios',"cargo = $id");
            if ($verUsuarios->num_rows) {
                foreach ($cargo as $info);
                $info['cod'] = 1;
                return $info;
            }else {
                foreach ($cargo as $info);
                $info['cod'] = 2;
                return $info;
            }
        }
    }

    /**
     * Método responsavel pela exclusão do cargo
     * @param int $id
     * @return int
     */
    public function excluir($id) {
        $cargo = Dbasis::read('cargos',"id = $id");
        if ($cargo->num_rows) {
            $verUsuarios = Dbasis::read('usuarios',"cargo = $id");
            if ($verUsuarios->num_rows) {
                foreach ($verUsuarios as $u) {
                    $u['cargo'] = 0;
                    $atualiza = Dbasis::update('usuarios',$u,"cargo = $id");
                }
            }
            $verAcessos = Dbasis::read('acesso',"cargo = $id");
            if ($verAcessos->num_rows) {
                foreach ($verAcessos as $a) {
                    $acessos = Dbasis::delete('acesso','id = "'.$a['id'].'"');
                }
            }
            $del = Dbasis::delete('cargos',"id = $id");
            if ($del) {
                return 1;
            }else {
                return 0;
            }
        }else {
            return 0;
        }
    }

    /**
     * Método responsavel por retornar todas as permissões.
     * @return array
     */
    public function retornaPerm($cargo=null) {
        if ($cargo) {
            $pesq = Dbasis::read('acesso','cargo = "'.$cargo.'"');
            if ($pesq->num_rows) {
                return $pesq;
            }else {
                return 0;
            }
        }else {
            $dir = "controller";
            if (is_dir($dir)) {
                if ($d = opendir($dir)) {
                    while (($file = readdir($d)) !== false) {
                        // Certifique-se de que não estamos listando os diretórios pai ou atuais
                        if ($file != "." && $file != "..") {
                            $f = explode('.',$file);
                            $perm[] .= $f[0];
                        }
                    }
                    return $perm;
                }            }else {
                return 0;
            }
        }
    }

    /**
     * Método responsavel por vincular permissões a cargos
     * @param int $cargo
     * @param string $acesso
     */
    public function vincular($cargo,$acesso) {
        $verf = Dbasis::read('acesso','cargo = "'.$cargo.'" AND acesso = "'.$acesso.'"');
        if ($verf->num_rows) {
            return 1;
        }else {
            $cad = [
                "cargo"     => $cargo,
                "acesso"    => $acesso,
            ];
            $create = Dbasis::create('acesso',$cad);
            if ($create) {
                return 2;
            }else {
                return 0;
            }
        }
    }

    /**
     * Método responsavel por desfazer o vinculo de uma permissão com um cargo
     * @param int $acesso
     * @return int
     */
    public function removAcesso($acesso) {
        $verf = Dbasis::read('acesso','id = "'.$acesso.'"');
        if ($verf->num_rows) {
            $del = Dbasis::delete('acesso','id = "'.$acesso.'"');
            if ($del) {
                return 1;
            }else {
                return 0;
            }
        }else {
            return 0;
        }
    }
}
