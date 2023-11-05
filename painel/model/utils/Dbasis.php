<?php
class Dbasis{

    /**
     * Método responsavel por gera logs de erros do MySql
     * @param string $arquivo
     * @param string $mensagem
     */
    private function LogAcesso($arquivo,$mensagem){
        $arquivo 		= fopen($arquivo, 'a');
        $novoArquivo 	= $mensagem."\n";
        fwrite($arquivo,utf8_decode($novoArquivo));
        fclose($arquivo);
    }

    /**
     * Método responsável por cadastros nas tabelas
     * @param string $tabela
     * @param array $datas
     */
    public function create($tabela, array $datas)
    {
        $conn = mysqli_connect(HOST, USER, PASS, DBSA) or die('Erro ao conectar: ' . mysqli_connect_error($conn));
        $fields = implode(", ", array_keys($datas));
        $values = "'" . implode("', '", array_values($datas)) . "'";
        $qrCreate = "INSERT INTO {$tabela} ($fields) VALUES ($values)";
        if (LOG){
            $stCreate   =  mysqli_query($conn, $qrCreate) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>'
                . Dbasis::logAcesso(BASE.'/logbderro.txt', "ERRO NO CREATE, " . $_SERVER['REQUEST_URI'] . ", DATA: " . date('Y-m-d H:i:s') . " , TABELA: $tabela, QUERY:  $qrCreate  " . mysqli_error($conn)));
        } else {
            $stCreate   = mysqli_query($conn, $qrCreate)  or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>');
        }
        if (isset($stCreate)) {
            return mysqli_insert_id($conn);
        }
    }

    /**
     * Método responsavel pela leitura da tabela
     * @param string $tabela
     * @param string $cond
     */
    public function read($tabela, $cond = NULL)
    {
        $conn = mysqli_connect(HOST, USER, PASS, DBSA) or die('Erro ao conectar: ' . mysqli_connect_error($conn));
        if ($cond) {
            $qrRead = "SELECT * FROM {$tabela} WHERE {$cond}";
        }else {
            $qrRead = "SELECT * FROM {$tabela}";
        }
        if (LOG){
            $stRead   =  mysqli_query($conn, $qrRead) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>'
                . Dbasis::logAcesso(BASE.'/logbderro.txt', "ERRO NA READ, " . $_SERVER['REQUEST_URI'] . ", DATA: " . date('Y-m-d H:i:s') . " , TABELA: $tabela, QUERY:  $stRead  " . mysqli_error($conn)));
        } else {
            $stRead   = mysqli_query($conn, $qrRead)  or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>');
        }
        if (isset($stRead)) {
            return $stRead;
        }
    }

    /**
     * Método responsavel pelas atualizações
     * @param string $tabela
     * @param array $datas
     * @param string $where
     */
    public function update($tabela, array $datas, $where)
    {
        $conn = mysqli_connect(HOST, USER, PASS, DBSA) or die('Erro ao conectar: ' . mysqli_connect_error($conn));
        foreach ($datas as $fields => $values) {
            $campos[] = "$fields = '$values'";
        }
        $campos = implode(", ", $campos);
        $qrUpdate = "UPDATE " . $tabela . " SET " . $campos . " WHERE " . $where;
    
        if (LOG) {
            $stUpdate = mysqli_query($conn, $qrUpdate) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>'
                . Dbasis::logAcesso(BASE.'/logbderro.txt', "ERRO NO UPDATE, " . $_SERVER['REQUEST_URI'] . ", DATA: " . date('Y-m-d H:i:s') . " , TABELA: $tabela, QUERY:  $stUpdate  " . mysqli_error($conn)));
        } else {
            $stUpdate = mysqli_query($conn, $qrUpdate) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>');
        }
        if (isset($stUpdate)) {
            return TRUE;
        }
    }

    /**
     * Método responsavel pelas exclusões nas tabelas
     * @param string $tabela
     * @param string $where
     */
    public function delete($tabela, $where)
    {
        $conn = mysqli_connect(HOST, USER, PASS, DBSA) or die('Erro ao conectar: ' . mysqli_connect_error($conn));
        $qrDelete = "DELETE FROM {$tabela} WHERE {$where}";
        if (LOG) {
            $stDelete = mysqli_query($conn, $qrDelete)  or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>'
                . Dbasis::logAcesso(BASE.'/logbderro.txt', "ERRO NO UPDATE, " . $_SERVER['REQUEST_URI'] . ", DATA: " . date('Y-m-d H:i:s') . " , TABELA: $tabela, QUERY:  $stDelete  " . mysqli_error($conn)));
        } else {
            $stDelete = mysqli_query($conn, $qrDelete) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>');
        }
        if (isset($stDelete)) {
            return TRUE;
        }
    }

    /**
     * Método responsavel pelas ligações avançadas entre tabelas
     * @param array $campo
     * @param string $tabela
     * @param string $cond
     */
    public function select($campo, $tabela, $cond = NULL)
    {
        $conn = mysqli_connect(HOST, USER, PASS, DBSA) or die('Erro ao conectar: ' . mysqli_connect_error($conn));
        $qrRead = "SELECT {$campo} FROM {$tabela} {$cond}";
    
        if (LOG) {
            $stRead = mysqli_query($conn, $qrRead) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>'
                . Dbasis::logAcesso(BASE.'/logbderro.txt', "ERRO NO SELECT, " . $_SERVER['REQUEST_URI'] . ", DATA: " . date('Y-m-d H:i:s') . " , TABELA: $tabela, QUERY:  $stRead  " . mysqli_error($conn)));
        } else {
            $stRead = mysqli_query($conn, $qrRead) or die('<div class="alert alert-danger">Falha na execução do comando. Entre em contato com o suporte!</div>');
        }
        if (isset($stRead)) {
            return $stRead;
        }
    }

    /**
	 * Método responsável pelo upload de imagens para o servidor
	 * @param string $tmp
	 * @param string $nome
	 * @param int $widht
	 * @param int $height
	 * @param string $pasta
	 */
	public function uploadImage($tmp, $nome, $width, $height=NULL, $pasta){
	
		$ext  = pathinfo($pasta.$nome);
		switch (strtolower($ext['extension'])){
			case 'jpg'; $img = imagecreatefromjpeg($tmp);break;
			case 'jpeg'; $img = imagecreatefromjpeg($tmp);break;
			case 'png'; $img = imagecreatefrompng($tmp);break;
			case 'gif'; $img = imagecreatefromgif($tmp);break;
		}
	
		$x = imagesx($img);
		$y = imagesy($img);
		if ($height == NULL) {
			$height = ($width * $y)/$x;
		}
		$nova = imagecreatetruecolor($width, $height);
		imagealphablending($nova,false);
		imagesavealpha ($nova,true);
		imagecopyresampled($nova, $img, 0, 0, 0, 0, $width, $height, $x, $y);
	
		switch (strtolower($ext['extension'])){
			case 'jpg';  imagejpeg($nova, $pasta.$nome, 100);break;
			case 'jpeg'; imagejpeg($nova, $pasta.$nome, 100);break;
			case 'png';  imagepng($nova, $pasta.$nome);break;
			case 'gif';  imagegif($nova, $pasta.$nome);break;
		}
		imagedestroy($img);
		imagedestroy($nova);
	
	}


    /**
     * Método responsável pelo upload de múltiplas imagens para o servidor
     * @param array $files Array associativo de arquivos ($_FILES['name_of_input_field'])
     * @param int $width Largura desejada para a imagem
     * @param int $height Altura desejada para a imagem (opcional)
     * @param string $pasta Diretório de destino para as imagens
     */
    public function uploadImage2($files, $width, $height = NULL, $pasta) {
        for ($i = 0; $i < count($files['name']); $i++) {
            $tmp = $files['tmp_name'][$i];;
            $exp    = explode(".",$files['name'][$i]);
            $ext    = end($exp);
            $nome   = md5(time()).'.'.$ext;

            $ext = pathinfo($pasta.$nome);
            switch (strtolower($ext['extension'])) {
                case 'jpg':
                case 'jpeg':
                    $img = imagecreatefromjpeg($tmp);
                    break;
                case 'png':
                    $img = imagecreatefrompng($tmp);
                    break;
                case 'gif':
                    $img = imagecreatefromgif($tmp);
                    break;
                default:
                    continue 2; // Skip files with unsupported extensions
            }

            $sx = imagesx($img);
            $sy = imagesy($img);
            if ($height == NULL) {
                $height = ($width * $sy) / $sx;
            }

            $nova = imagecreatetruecolor($width, $height);
            imagealphablending($nova, false);
            imagesavealpha($nova, true);
            imagecopyresampled($nova, $img, 0, 0, 0, 0, $width, $height, $sx, $sy);

            switch (strtolower($ext['extension'])) {
                case 'jpg':
                case 'jpeg':
                    imagejpeg($nova, $pasta.$nome, 100);
                    break;
                case 'png':
                    imagepng($nova, $pasta.$nome);
                    break;
                case 'gif':
                    imagegif($nova, $pasta.$nome);
                    break;
            }

            imagedestroy($img);
            imagedestroy($nova);
        }
    }

}