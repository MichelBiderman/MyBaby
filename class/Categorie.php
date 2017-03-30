<?php 

 class Categorie {
	public $id_categorie;
	public $nom;
	public $description;


	public  function __construct($id_categorie=0,$nom='',$description='') {

		$this->id_categorie = $id_categorie;
		$this->nom = $nom;
		$this->description = $description;
	}


	public  function charger() {

		global $connex;
		if (!$this->id_categorie) return;
		$connex->req="SELECT * FROM categorie WHERE id_categorie={$this->id_categorie}";
		return $connex->xeq()->ins($this);
	}

	public  function sauver() {

		global $connex;
		if($this->id_categorie){
			$connex->req="UPDATE categorie SET nom={$connex->esc($this->nom)}, description={$connex->esc($this->description)}  WHERE id_categorie = {$this->id_categorie} ";
			return $connex->xeq();
		}
		$connex->req="INSERT INTO categorie VALUES(DEFAULT,{$connex->esc($this->nom) },{$connex->esc($this->description) })";
		$connex->xeq();
		$this->id_categorie=$connex->pk();
	}


	public  function supprimer() {

		global $connex;
		if (!$this->id_categorie) return;
		$connex->req="DELETE FROM categorie WHERE id_categorie={$this->id_categorie}";
		return $connex->xeq();
	}

	public static function tab($where='1',$orderBy='1') {

		global $connex;
		$connex->req="SELECT * FROM categorie WHERE {$where} ORDER BY {$orderBy}";
		return $connex->xeq()->tab(__CLASS__);
	}
	public function getTabProduit(){
		global $connex;
		$connex->req="SELECT * FROM produit WHERE id_categorie={$this->id_categorie} ORDER BY nom";
		return $connex->xeq()->tab('Produit');
	}


	public  function existe() {

		global $connex;
		if (!$this->id_categorie) return;
		$connex->req="SELECT COUNT(*) AS existe FROM categorie WHERE id_categorie={$this->id_categorie}";
		return (bool)$connex->xeq()->prem()->existe;
	}
} 
?>