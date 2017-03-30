<?php
require_once('class/Connexion.php');
$connex=new Connexion($dsn="mysql:dbname=baby_commerce;host=localhost;charset=utf8",$id="root",$mdp="");
//$connex->xeq();





/**onst DB_DSN="mysql:dbname=baby_commerce;host=localhost;charset=utf8";
const DB_ID="root";
const DB_MDP="";
$db_options=[PDO::MYSQL_ATTR_INIT_COMMMAND=>"SET NAMES 'utf8'",
PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
//connexions à la base de données
try{
	$pdo=new PDO(DB_DSN,DB_ID,DB_MDP,$db_options);
}catch(PDOException $e){
	exit("Erreur ({$e->getMessage()})");
}*/
?>