<?php
    
class Blog extends Dbasis {

    /**
     * Método responsavel por listar todos as materias
     * @return array
     */
    public function lista() {
        $read = Dbasis::read('blog','id != 0');
        if ($read->num_rows) {
            return $read;
        }else {
            return 0;
        }
    }

    /**
     * Método responsavel por retornar os dados da materia
     * @param int $idMateria
     * @return array
     */
    public function retorna($idMateria) {
        $materia = Dbasis::read('blog',"id = $idMateria");
        if ($materia->num_rows) {
            foreach ($materia as $u);
            return $u;
        }else {
            return 0;
        }
    }

}
