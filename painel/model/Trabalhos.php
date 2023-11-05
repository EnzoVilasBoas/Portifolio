<?php
    
class Trabalhos extends Dbasis {

    /**
     * Método responsavel pelo cadastro de trabalhos
     * @param array $post
     */
    public function cadastro($post) {
        $verf = Dbasis::read('trabalhos','trabalho = "'.$post['trabalho'].'"');
        if ($verf->num_rows) {
            return 1;
        }else {
            $dados = [
                "trabalho"  => $post['trabalho'],
                "descr"  => $post['descr'],
                "tags"  => $post['tags'],
            ];
            $cad = Dbasis::create('trabalhos',$dados);
            if ($cad) {
                return 2;
            }else {
                return 0;
            }
        }
    }

    /**
     * Método responsavel pela listagem dos trabalhos
     * @return array
     */
    public function listar() {
        $read = Dbasis::read('trabalhos');
        if ($read->num_rows) {
            return $read;
        }else {
            return 0;
        }
    }

}
