<?php 

class Usuario{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setIdusuario($idusuario){
		 $this->idusuario = $idusuario;
	}

	public function setDeslogin($deslogin){
		 $this->deslogin = $deslogin;
	}

	public function setDessenha($dessenha){
		 $this->dessenha = $dessenha;
	}

	public function setDtcadastro($dtcadastro){
		 $this->dtcadastro = $dtcadastro;
	}

	public function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(

			":ID" => $id


		));

		if(count($results) > 0){
			$row = $results[0];



			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}

	}

	public function login($login, $senha){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(

			":LOGIN" => $login,
			":SENHA" => $senha


		));
		
		if(count($results) > 0){
			$row = $results[0];



			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}
		else{

			echo "errado";
		}
	}
	public function insert() {
	
		$sql = new Sql();

		$sql->query("INSERT INTO tb_usuarios (deslogin, dessenha) VALUES (:LOGIN, :PASSWORD)", array(

		'LOGIN' => $this->getDeslogin(),
		'PASSWORD' => $this->getDessenha(),
		));

	}
	public function update($login,$senha) {
		$this->setDeslogin($login);
		$this->setDessenha($senha);
	
		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID", array(

		'LOGIN' => $this->getDeslogin(),
		'SENHA' => $this->getDessenha(),
		':ID' => $this->getIdusuario()
		));

	}

	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
		':ID' => $this->getIdusuario()
		));
		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
	}

	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");




	}
	public function __toString(){

		return json_encode(array(
			"idusuario" => $this->getIdusuario(),
			"deslogin" => $this->getDeslogin(),
			"dessenha" => $this->getDessenha(),
			"dtcadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")

		));
	}
	public function __construct($login = "",$senha = ""){
		$this->setDeslogin($login);
		$this->setDessenha($senha);

	}
}

 ?>