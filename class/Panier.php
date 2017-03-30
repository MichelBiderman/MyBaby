<?php
 class Panier {
	public $id_panier;
	public $id_user;
	public $id_produit;
	public $quantite;
    public $termine;


	public  function __construct($id_panier=0,$id_user=0,$id_produit=0,$quantite=0, $termine=0) {
		$this->id_panier = $id_panier;
		$this->id_user = $id_user;
		$this->id_produit = $id_produit;
		$this->quantite = $quantite;
                $this->termine=$termine;
	}


	public  function charger() {

		global $connex;
		if (!$this->id_panier) return;
		$connex->req="SELECT * FROM panier WHERE id_panier={$this->id_panier}";
		return $connex->xeq()->ins($this);
	}

	public  function sauver() {

		global $connex;
		if($this->id_panier){
			$connex->req="UPDATE panier SET id_user={$this->id_user}, id_produit={$this->id_produit}, quantite={$this->quantite},termine={$this->termine}  WHERE id_panier = {$this->id_panier} ";
			return $connex->xeq();
		}
        $connex->req="INSERT INTO panier VALUES(DEFAULT,{$this->id_user},{$this->id_produit},{$this->quantite},{$this->termine})";
		$connex->xeq();
		$this->id_panier=$connex->pk();
	}


	public  function supprimer() {

		global $connex;
		if (!$this->id_panier) return;
		$connex->req="DELETE FROM panier WHERE id_panier={$this->id_panier}";
		return $connex->xeq();
	}

	public static function tab($where='1',$orderBy='1') {

		global $connex;
		$connex->req="SELECT * FROM panier WHERE {$where} ORDER BY {$orderBy}";
		return $connex->xeq()->tab(__CLASS__);
	}
	public static function select($where='1',$orderBy='1') {

		global $connex;
		$connex->req="SELECT * FROM panier WHERE {$where} ORDER BY {$orderBy}";
		return $connex->xeq()->prem(__CLASS__);
	}

	public  function existe() {

		global $connex;
		if (!$this->id_panier) return;
		$connex->req="SELECT COUNT(*) AS existe FROM panier WHERE id_panier={$this->id_panier}";
		return (bool)$connex->xeq()->prem()->existe;
	}
} 
?>