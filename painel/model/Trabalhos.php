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
     * @param int $id ID do trabalho
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
     * @param int $id ID do trabalho
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
     * Método responsavel por retornar os dados de uma imagem da galeria
     * @param int $imagem ID da imagem cadastrada
     * @return string
     */
    public function retornaImagem($imagem) {
        $read = Dbasis::read("galeria","id = $imagem");
        if ($read->num_rows) {
            foreach ($read as $r);
            return $r;
        }else {
            return 0;
        }
    }

    /**
     * Método responsavel por cadastrar as imagens na galeria
     * @param int $trabalho ID do trabalho ao qual a imagem  é vinculada
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
                Dbasis::uploadImage($tmp, $nome, '1280','720', $pasta);
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

    /**
     * Método responsavel por excluir imagens da galeria
     * @param int $imagem ID da imagem a ser excluida
     * @return int
     */
    public function excluirImagem($imagem) {
        $verf = Dbasis::read("galeria","id = $imagem");
        if ($verf->num_rows) {
            foreach ($verf as $v);
            $img = "uploads/galeria/".$v['imagem'];
            if (file_exists($img)) {
                if (unlink($img)) {
                    $del = Dbasis::delete("galeria","id = $imagem");
                    if ($del) {
                        return 1;
                    }else {
                        return 0;
                    }
                } else {
                    return 0;
                }
            }else {
                return 0;
            }
        }else {
            return 0;
        }
    }



}
