<?php
// Constantes globales.
const DATETIME="Y-m-d H:i:s";
const DUREE_SESSION=180; // Secondes
// Autoload.
spl_autoload_register(function($classe){
	include("class/{$classe}.php");
});
// Variable globale $connex.
const DB_DSN="mysql:dbname=baby_commerce;host=localhost;charset=utf8";
const DB_ID="root";
const DB_MDP="";
$db_options=[PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'",
		PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
try{
	$connex=new Connexion(DB_DSN,DB_ID,DB_MDP);
}catch(PDOException $e){
	exit("Erreur : connexion db impossible ({$e->getMessage()}).");
}
// Variable globale $dt.
$dt=new DateTime();
$dt->setTimezone(new DateTimeZone('UTC'));
// Variable globale $userSession.
if(!session_start())exit("Erreur : session impossible.");
$userSession=new User(isset($_SESSION['id_user'])?$_SESSION['id_user']:null);
if($userSession->chargerSession()){
	// User retrouvé avec session valide, alors maj dateSession.
	$userSession->dateSession=$dt->format(DATETIME);
	$userSession->sauver();
}
else{
	// User pas retrouvé ou session expirée, alors ajout d'un nouveau.
	$userSession->id_user=null;
	$userSession->dateSession=$dt->format(DATETIME);
	$userSession->sauver();
	$_SESSION['id_user']=$userSession->id_user;
}
// Variable globale $action.
$action=filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
// Login.
if($action=='login' && !$userSession->loginOk){
	$mail=filter_input(INPUT_POST,'mail',FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$mdp=filter_input(INPUT_POST,'mdp',FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$userSession->mail=$mail;
	$userSession->mdp=$mdp;
	$userSession->login();
}
// Logout.
if($action=='logout' && $userSession->loginOk){
	$userSession->logout();
}


