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

    /**
     * Método responsavel por retornar os dados de um trabalho
     * @param int $id -- ID do trabalho
     * @return array
     */
    public function retorna($id) {
        $read = Dbasis::read('trabalhos',"id = $id");
        if ($read->num_rows) {
            foreach ($read as $r);
            return $r;
        }else {
            return 0;
        }
    }

    /**
     * Método responsavel por retornar as imagens da galeria
     * @param int $id -- ID do trabalho
     * @return array
     */
    public function retornaGaleria($id) {
        $read = Dbasis::read("galeria","trabalho = $id");
        if ($read->num_rows) {
            return $read;
        }else {
            return 0;
        }
    }

    /**
     * Método responsavel por cadastrar as imagens na galeria
     * @param int $trabalho -- ID do trabalho ao qual a imagem  é vinculada
     */
    public function cadastraGaleria($trabalho) {
        $verf = Dbasis::read("trabalhos","id = $trabalho");
        if ($verf->num_rows) {
            for ($i = 0; $i < count($_FILES['imagem']["tmp_name"]); $i++) {
                $pasta  = 'uploads/galeria/';
                $tmp    = $_FILES['imagem']['tmp_name'][$i];
                $exp    = explode(".",$_FILES['imagem']['name'][$i]);
                $ext    = end($exp);
                $nome   = md5(time().$_FILES['imagem']['tmp_name'][$i]).'.'.$ext;
                Dbasis::uploadImage($tmp, $nome, '1280',NULL, $pasta);
                $imagem = $nome;
                
                $dados = [
                    "trabalho"  => $trabalho,
                    "imagem"  => $imagem
                ];

                $cad = Dbasis::create("galeria",$dados);
            }
            return 1;
        }else {
            return 0;
        }
    }

}
