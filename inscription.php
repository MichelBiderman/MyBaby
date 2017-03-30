<?php
require_once('inc/cfg.php');
$erreur='';
$opt=['options'=>['default'=>0,'min_range'=>1]];
if($_POST){
	$userSession->mail=filter_input(INPUT_POST,'mail',FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$userSession->mdp=filter_input(INPUT_POST,'mdp',FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$userSession->nom=filter_input(INPUT_POST,'nom',FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$userSession->prenom=filter_input(INPUT_POST,'prenom',FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$userSession->adresse_postale=filter_input(INPUT_POST,'adresse_postale',FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	if($userSession->existe())$erreur.="Adresse mail déjà existante.<br/>";
	if($userSession->mail==='')$erreur.="Adresse mail vide.<br/>";
	if($userSession->mdp==='')$erreur.="Le mot de passe est vide.<br/>";
	if($userSession->nom==='')$erreur.="Le nom est vide.<br/>";
	if($userSession->prenom==='')$erreur.="Le prénom est vide.<br/>";
	if($userSession->adresse_postale==='')$erreur.="L'adresse_postale est vide.<br/>";
	if(!$erreur){
		$userSession->mdp=$userSession->mdp;
		$userSession->dateInscription=$dt->format(DATETIME);
		$userSession->dateConnexion=$dt->format(DATETIME);
		$userSession->dateSession=$dt->format(DATETIME);
		$userSession->loginOk=true;
		$userSession->sid=session_id();
		$userSession->sauver();
		$_SESSION['vues']=0;
		header("Location:index.php");
		exit;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Inscription</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div id="global">
<?php
require('inc/entete.php');
if($erreur){
?>
			<p class="erreur">Erreur :<br/><?php echo $erreur ?></p>
<?php
}
?>
<div id="contenu">
        <h1>Inscription</h1>
        <form name="form1" method="post" action="">
                <p><label>mail <input name="mail" size="40" value="<?php echo $userSession->mail ?>"/></label></p>
                <p><label>Mot de passe <input name="mdp" type="password" size="20"/></label></p>
                <p><label>Nom <input name="nom" size="30" value="<?php echo $userSession->nom ?>"/></label></p>
                <p><label>Prénom <input name="prenom" size="25" value="<?php echo $userSession->prenom ?>"/></label></p>
                <p><label>adresse postale<input name="adresse_postale" size="30" value="<?php echo $userSession->adresse_postale ?>"/></label></p>
                <p>
                        <input type="submit" value="Enregistrer"/>
                        <input type="button" value="Annuler" onclick="location='index.php'"/>
                </p>
        </form>
        <div class="retour">
        <a href="index.php">Retour à l'accueil</a>

        </div>
</div>
<?php include('footer.php'); ?>
    </body>
</html>
