<?php
class User implements Databasable{
	public $id_user;
    public $admin;
	public $mail;
	public $mdp;
	public $nom;
	public $prenom;
	public $adresse_postale;
	public $dateInscription;
	public $dateConnexion;
	public $dateSession;
	public $loginOk;

	public function __construct($id_user=null,
                                    $admin=null,
                                    $mail=null,
                                    $mdp=null,
                                    $nom=null,
                                    $prenom=null,
                                    $adresse_postale=null,
                                    $dateInscription=null,
                                    $dateConnexion=null,
                                    $dateSession=null,
                                    $loginOk=null){
                                    $this->id_user=$id_user;
                                    $this->mail=$mail;
                                    $this->mdp=$mdp;
                                    $this->nom=$nom;
                                    $this->prenom=$prenom;
                                    $this->adresse_postale=$adresse_postale;
                                    $this->dateInscription=$dateInscription;
                                    $this->dateConnexion=$dateConnexion;
                                    $this->dateSession=$dateSession;
                                    $this->loginOk=$loginOk;
	}
	
	public function charger(){
		global $connex;
		if(!$this->id_user)return false;
		$connex->req="SELECT * FROM user WHERE id_user={$connex->esc($this->id_user)}";
		return $connex->xeq()->ins($this);
	}
	
	public function sauver(){
		global $connex,$dt;
		if($this->id_user){
			$connex->req="UPDATE user SET mail={$connex->esc($this->mail)},
                                                            admin=".($this->admin?$this->admin:0).",
                                                            mdp={$connex->esc($this->mdp)},
                                                            nom={$connex->esc($this->nom)},
                                                            prenom={$connex->esc($this->prenom)},
                                                            adresse_postale={$connex->esc($this->adresse_postale)},
                                                            dateInscription=".($this->dateInscription?$connex->esc($this->dateInscription):'DEFAULT').",
                                                            dateConnexion=".($this->dateConnexion?$connex->esc($this->dateConnexion):'DEFAULT').",
                                                            dateSession=".($this->dateSession?$connex->esc($this->dateSession):'DEFAULT').",
                                                            loginOk=".($this->loginOk?$this->loginOk:0)."
                                                            WHERE id_user={$connex->esc($this->id_user)}";
			return $connex->xeq();
		}
		else{
			$connex->req="INSERT INTO user VALUES(DEFAULT,
                                                             admin=".($this->admin?$this->admin:0).",
                                                            {$connex->esc($this->mail)},
                                                            {$connex->esc($this->mdp)},
                                                            {$connex->esc($this->nom)},
                                                            {$connex->esc($this->prenom)},
                                                            {$connex->esc($this->adresse_postale)},
                                                            ".($this->dateInscription?$connex->esc($this->dateInscription):'NOW()').",
                                                            ".($this->dateConnexion?$connex->esc($this->dateConnexion):'NOW()').",
                                                            ".($this->dateSession?$connex->esc($this->dateSession):'NOW()').",".
                                                           ($this->loginOk?$this->loginOk:0).")";
                                                $connex->xeq();
                                                $this->id_user=$connex->pk();
		}
	}
		
	public function supprimer(){
		global $connex;
		if(!$this->id_user)return 0;
		$connex->req="DELETE FROM user WHERE id_user={$connex->esc($this->id_user)}";
		return $connex->xeq();
	}
	
	public static function tab($where='1',$orderBy='0'){
		global $connex;
		$connex->req="SELECT * FROM user WHERE {$where} ORDER BY {$orderBy}";
		return $connex->xeq()->tab(__CLASS__);
	}
	
	public function chargerSession(){
		// Recherche une session valide pour $this.
		// Si présente, charge $this et retourne true.
		// Sinon, retourne false.
		global $connex,$dt;
		if(!$this->id_user)return false;
		$dtLimite=new DateTime();
		$dtLimite->setTimezone(new DateTimeZone('UTC'));
		$dtLimite->sub(new DateInterval('PT'.DUREE_SESSION.'S'));
		$connex->req="SELECT * FROM user WHERE id_user={$connex->esc($this->id_user)} AND dateSession>{$connex->esc($dtLimite->format(DATETIME))}";
		return $connex->xeq()->ins($this);
	}
	
	public function login(){
		// Tente de charger $this d'après son id et son mdp.
		// Si ok, passe son loginOk à true, met son id_user en session puis retourne true.
		// Sinon, retourne false.
		global $connex,$dt;
		if(!$this->mail && !$this->mdp)return false;
		$connex->req="SELECT * FROM user WHERE mail={$connex->esc($this->mail)} AND mdp={$connex->esc($this->mdp)}";
		if(!$connex->xeq()->ins($this))return false;
		$this->dateConnexion=$dt->format(DATETIME);
		$this->dateSession=$dt->format(DATETIME);
		$this->loginOk=true;
		$this->sauver();
		$_SESSION['id_user']=$this->id_user;
		return true;
	}
	
	public function logout(){
		// Passe $this->loginOk à false, détruit la session puis recharge la page courante.
		$this->loginOk=false;
		$this->sauver();
		$_SESSION['id_user']=null;
		session_destroy();
		header("Location:{$_SERVER['PHP_SELF']}");
		exit;
	}
	
	public function existe(){
		// Retourne true si un user inscrit portant un id identique à celui de $this existe déjà.
		// Sinon, retourne false.
		global $connex;
		if(!$this->id_user)return false;
		$connex->req="SELECT COUNT(*) AS existe FROM user WHERE mail={$connex->esc($this->mail)}";
		
		 return (bool)$connex->xeq()->prem()->existe;
	} 
}