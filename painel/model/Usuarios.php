<?php

class Usuarios extends Dbasis {

    /**
     * Método responsavel por listar os usuarios do sistema
     * @return array
     */
    public function listar() {
        $read = Dbasis::read('usuarios');
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
}