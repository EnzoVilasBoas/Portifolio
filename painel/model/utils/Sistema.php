<?php
class Sistema extends Dbasis{
	private $post;
	private $url;
	private $parametros;
		
	public function __construct(){
		$this->post = !empty($_POST)?$this->serializaPost($_POST):[];
		$this->url  = !empty($_GET)?$this->serializaGet($_GET):[];
		$this->parametros  = $this->setUrl(implode('/',$this->url));
	}
	
	private function setUrl($parametros){
		$this->parametros =  explode('/',$parametros);
		return array_filter($this->parametros);
	}
	
	private function serializaPost($post){
		return filter_input_array(INPUT_POST,$post,FILTER_DEFAULT) ;
	}

	private function serializaGet($get){
		return filter_input_array(INPUT_GET,FILTER_DEFAULT) ;
	}

	/**
	 * Método responsavel por verificar o acesso do usuario.
	 * @param array $cargo
	 * @param string $acesso
	 * @return bool
	 */
	public function acesso($cargo,$acesso) {
		$verf = Dbasis::read('acesso','cargo = "'.$cargo.'" AND acesso = "'.$acesso.'"');
		if ($verf->num_rows) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	/**
	 * Método responsável por retornar os dados limpos do post
	 * @return array
	 * **/
	public function  getPost(){
		return $this->post;
	}

	/**
	 * Método responsável por retornar os parametros passados na url
	 * @return array
	 * **/
	public function getParametros(){
		return $this->parametros;
	}

	/**
	 * Método responsável por verificar se o email é valido.
	 * @param string $mail
	 * @return bool
	 */
	public function valMail($email){
		if(preg_match('/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/',$email)){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * Método responsável por verificar se o CPF é valido.
	 * @param string $cpf
	 * @return bool
	 */
	public function valCpf($cpf){
		$cpf = preg_replace('/[^0-9]/','',$cpf);
		$digitoA = 0;
		$digitoB = 0;
		for($i = 0, $x = 10; $i <= 8; $i++, $x--){
			$digitoA += $cpf[$i] * $x;
		}
		for($i = 0, $x = 11; $i <= 9; $i++, $x--){
			if(str_repeat($i, 11) == $cpf){
				return false;
			}
			$digitoB += $cpf[$i] * $x;
		}
		$somaA = (($digitoA%11) < 2 ) ? 0 : 11-($digitoA%11);
		$somaB = (($digitoB%11) < 2 ) ? 0 : 11-($digitoB%11);
		if($somaA != $cpf[9] || $somaB != $cpf[10]){
			return false;	
		}else{
			return true;
		}
	}

	/**
	 * Método responsável por carregar os arquivos do controller
	 * **/
	public function getHome($autUser){
		$url = filter_input(INPUT_GET,'url',FILTER_DEFAULT);
		if ($url !== null) {
			$url = explode('/', $url);
			$url[0] = (empty($url[0]) ? 'home' : $url[0]);
			$acesso = $this->acesso($autUser['cargo'],$url[0]);
			if ($acesso) {
				if(file_exists("controller/".$url[0].'.php')){
					require_once("controller/".$url[0].'.php');
				}else{
					require_once('view/404.php');
				}
			}else {
				require_once('view/403.php');
			}
		}else {
			if(file_exists("controller/home.php")){
				require_once("controller/home.php");
			}else{
				require_once('view/404.php');
			}
		}
	}

	/**
	 * Método responsável por transformar string em url
	 * @param string $string
	 * @return string
	 * **/
	public function setUri($string){
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
		$b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';	
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($a), $b);
		$string = strip_tags(trim($string));
		$string = str_replace(" ","-",$string);
		$string = str_replace(array("-----","----","---","--"),"-",$string);
		return strtolower(utf8_encode($string));
	}

	/**
	 * Método responsável por somar as visitas ao pet
	 * @param int $petId
	 */
	public function setViews($petId){
		$pet = read('pets',"WHERE id = $petId");
		
		foreach($pet as $p);
			$views = $p['visitas'];
			$views = $views +1;
			$dataViews = array(
				'visitas' => $views
			);
			update('pets',$dataViews,"id = $petId");
	}


	/**
	 * Método responsável por ligar e desligar log
	 * @param bool $bool
	 * **/
	public function log($bool){		
		if($bool){
			putenv('LOG=TRUE');
			define("LOG",getenv('LOG'));
		}else{
			putenv('LOG=FALSE');
			define("LOG",getenv('LOG'));
		}
	}
	/**
	 * Método responsável por ligar e desligar debug
	 * @param bool $bool
	 * **/
	public function debug($bool){		
		if($bool){
			error_reporting(E_ALL);
			ini_set("display_errors", 1);

		}else{
			ini_set("display_errors", 0);
		}
	}

	/**
	 * Método responsavel por resumir os textos de uma variavel
	 * @param string $texto
	 * @param int $limite
	 * @return string
	 */
	public function resume($texto,$limite){
		$texto = trim($texto);
		$texto = strip_tags($texto);
		if (strlen($texto) > $limite) {
			$texto = substr($texto, 0, $limite);
			$texto = rtrim($texto);
		}
		return $texto;
	}

	/**
	 * Método responsável por verificar a autenticação do usuári
	 * @param int $id
	 * @return array
	 * **/
	public function AutUser($id){
		if ($id) {
			$idusuario = filter_var($id,FILTER_VALIDATE_INT);
			$readAutUser = Dbasis::read('usuarios', 'id="'.$idusuario.'"');
			if ($readAutUser){
				foreach ($readAutUser as $autUser);
				header('Authorization: '.md5('Portfolio'));
				unset($autUser['senha']);
				return $autUser;
			}else{
				unset($_SESSION['AutUser']);
				header('Location: '.BASE.'/login.php');
			}
		}else {
				unset($_SESSION['AutUser']);
				header('Location: '.BASE.'/login.php');
		}

	}

	/**
	 * Método responsável pelo envio de emails
	 * @param string $assunto
	 * @param string $mensagem
	 * @param string $destino
	 * @return bool
	 */
	public function sendMail($assunto,$mensagem,$destino){
		require_once 'mail/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPSecure = 'ssl';
		//$mail->SMTPDebug = 2;
		$mail->Host = MAILHOST; 
		$mail->Port = MAILPORT; 
		$mail->SMTPAuth = true;
		$mail->Username = MAILUSER;
		$mail->Password = MAILPASS;
		$mail->setFrom(MAILUSER, utf8_decode(TITULO));
		$mail->addAddress(utf8_decode($destino));
		$mail->Subject = utf8_decode($assunto);
		$mail->msgHTML(utf8_decode($mensagem));
		if (!$mail->send()) {
			return false;
		} else {
			return true;
		}
		$mail->clearAddresses();
	}

	/**
	 * Método responsavel pelo tratamento da API
	 */
	public function api() {
		$param = $this->getParametros(); 
		if (end($param) == 'api') {
			if(file_exists('controller/'.$this->getParametros()[0].'.php')){
				require_once('controller/'.$this->getParametros()[0].'.php');
			}else{
				return 404;
			}
			die;
		}
	}
	

	
}