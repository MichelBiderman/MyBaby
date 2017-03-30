<?php
class GrandeCategorie implements Databasable{
	public $id_grande_categorie;
	public $nom;
	
	public function __construct($id_grande_categorie=0,$nom=''){
		$this->id_grande_categorie=$id_grande_categorie;
		$this->nom=$nom;
	}
	
	public function charger(){
		global $connex;
		if(!$this->id_categorie)return;
		$connex->req="SELECT * FROM categorie WHERE id_grande_categorie={$this->id_grande_categorie}";
		return $connex->xeq()->ins($this);
	}
	
	public function sauver(){
		global $connex;
		if($this->id_categorie){
			$connex->req="UPDATE grande_categorie SET nom={$connex->esc($this->nom)} WHERE id_grande_categorie={$this->id_grande_categorie}";
			return $connex->xeq();
		}
		else{
			$connex->req="INSERT INTO grande_categorie VALUES(NULL,{$connex->esc($this->nom)})";
			$connex->xeq();
			$this->id_categorie=$connex->pk();
		}
	}
		
	public function supprimer(){
		global $connex;
		if(!$this->id_categorie)return 0;
		$connex->req="DELETE FROM grande_categorie WHERE id_grande_categorie={$this->id_grande_categorie}";
		return $connex->xeq();
	}
	
	public static function tab($where='1',$orderBy='1'){
		global $connex;
		$connex->req="SELECT * FROM grande_categorie WHERE {$where} ORDER BY {$orderBy}";
		return $connex->xeq()->tab(__CLASS__);
	}
	
	public function getTabCategorie(){
		global $connex;
		$connex->req="SELECT * FROM categorie WHERE id_grande_categorie={$this->id_grande_categorie} ORDER BY nom";
		return $connex->xeq()->tab('Categorie');
	}
	
	public function existe(){
		global $connex;
		$connex->req="SELECT COUNT(*) AS existe FROM grande_categorie WHERE id_grande_categorie={$this->id_grande_categorie}";
		return (bool)$connex->xeq()->prem()->existe;
	}
}