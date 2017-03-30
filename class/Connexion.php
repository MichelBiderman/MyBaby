<?php

class Connexion {
	private $con=null;
	public $req='';
	private $jeu=null;


	public function __construct($dsn,$id,$mdp){
		$db_options=[PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'",
				PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
			try{
				$this->con=new PDO($dsn,$id,$mdp,$db_options);
			}catch(PDOException $e){
				exit("Erreur, connexion avec la base de données impossible ({$e->getMessage()})");
		}
	}

	public function esc($chaine){
		return $this->con->quote($chaine);
	}
	public function xeq(){
		if(stripos($this->req,"SELECT")===0){
			try{
				$this->jeu=$this->con->query($this->req);
			}catch(PDOException $e){
				exit("Requete incorrecte : {$this->req}");
			}
			return $this;
		}
		try{
			$nb=$this->con->exec($this->req);
		}catch(PDOException $e){
			exit("Requete incorrecte : {$this->req}");
		}
		return $nb;
	}

	public function nb(){
		return $this->jeu->rowCount();
	}

	public function tab($classe="stdClass"){
		$this->jeu->setFetchMode(PDO::FETCH_CLASS | pdo::FETCH_PROPS_LATE,$classe);
		return $this->jeu->fetchAll();
	}

	public function prem($classe="stdClass"){
		$this->jeu->setFetchMode(PDO::FETCH_CLASS | pdo::FETCH_PROPS_LATE,$classe);
		return $this->jeu->fetch();
	}

	public function ins($obj){
		$this->jeu->setFetchMode(PDO::FETCH_INTO,$obj);
		return $this->jeu->fetch();
	}

	public function pk(){
		return $this->con->lastInsertId();
	}
}
?>