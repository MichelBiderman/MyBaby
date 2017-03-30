<?php 

 class Produit {
	public $id_produit;
	public $id_categorie;
	public $nom;
	public $ref;
	public $pu;


	public  function __construct($id_produit=0,$id_categorie=0,$nom='',$ref='',$pu=0) {

		$this->id_produit = $id_produit;
		$this->id_categorie = $id_categorie;
		$this->nom = $nom;
		$this->ref = $ref;
		$this->pu = $pu;
	}


	public  function charger() {

		global $connex;
		if (!$this->id_produit) return;
		$connex->req="SELECT * FROM produit WHERE id_produit={$this->id_produit}";
		return $connex->xeq()->ins($this);
	}

	public  function sauver() {

		global $connex;
		if($this->id_produit){
                $connex->req="UPDATE produit SET id_categorie={$this->id_categorie}, nom={$connex->esc($this->nom)}, ref={$connex->esc($this->ref)}, pu={$this->pu}  WHERE id_produit = {$this->id_produit} ";
                return $connex->xeq();
		}
		$connex->req="INSERT INTO produit VALUES(DEFAULT,{$this->id_categorie },{$connex->esc($this->nom) },{$connex->esc($this->ref) },{$this->pu })";
		$connex->xeq();
		$this->id_produit=$connex->pk();
	}


	public  function supprimer() {

		global $connex;
		if (!$this->id_produit) return;
		$connex->req="DELETE FROM produit WHERE id_produit={$this->id_produit}";
		return $connex->xeq();
	}

	public static function tab($where='1',$orderBy='1') {

		global $connex;
		$connex->req="SELECT * FROM produit WHERE {$where} ORDER BY {$orderBy}";
		return $connex->xeq()->tab(__CLASS__);
	}
	public function getCategorie(){
		global $connex;
		$connex->req="SELECT * FROM categorie WHERE id_categorie={$this->id_categorie}";
		return $connex->xeq()->prem('Categorie');
	}


	public  function existe() {

		global $connex;
		if (!$this->id_produit) return;
		$connex->req="SELECT COUNT(*) AS existe FROM produit WHERE id_produit={$this->id_produit}";
		return (bool)$connex->xeq()->prem()->existe;
	}
	public function refExiste(){
		global $connex;
		if (!$this->ref) return;
		$connex->req="SELECT COUNT (*) AS refExiste FROM produit WHERE ref={$this->ref}";
		return (bool)$connex->xeq()->prem()->refExiste;
        }
} 
?>