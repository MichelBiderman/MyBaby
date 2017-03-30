<?php
require_once('inc/cfg.php');
$erreur='';
$opt=['options'=>['default'=>0,'min_range'=>1]];
$id_produit=filter_input(INPUT_GET,'id_produit',FILTER_VALIDATE_INT,$opt);
$produit=new Produit($id_produit);
$produit->charger();
$refExiste=$produit->ref;
if($_POST){
	$produit->id_produit=filter_input(INPUT_POST,'id_produit',FILTER_VALIDATE_INT,$opt);
	$produit->id_categorie=filter_input(INPUT_POST,'id_categorie',FILTER_VALIDATE_INT,$opt);
	$produit->nom=filter_input(INPUT_POST,'nom',FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$produit->ref=filter_input(INPUT_POST,'ref',FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$produit->pu=filter_input(INPUT_POST,'pu',FILTER_VALIDATE_FLOAT);
	$catExiste=(new Categorie($produit->id_categorie))->existe();
	if(!$catExiste)$erreur.="La catégorie n'existe pas.<br/>";
	if($refExiste)$erreur.="La référence est déjà existante.<br/>";
	if($produit->nom==='')$erreur.="Le nom est vide.<br/>";
	if($produit->ref=='')$erreur.="La référence est vide.<br/>";
	if($produit->pu===false || $produit->pu<0)$erreur.="Le prix unitaire est vide ou incorrect.<br/>";
	if(!$erreur){
		$upload=new Upload('photo',['jpg','jpeg']);
		if($upload->nomClient && !$upload->ok)$erreur=$upload->messageErreur;
		else{
			// Upload et données POST OK donc ajout en base.
			$produit->sauver();
			$imageJPEG=new ImageJPEG($upload->cheminServeur);
			$imageJPEG->copier(150,150,"img/prod_{$produit->id_produit}_v.jpg",ImageJPEG::REDIM_COVER);
			$imageJPEG->copier(450,450,"img/prod_{$produit->id_produit}_p.jpg",ImageJPEG::REDIM_CONTAIN);
			header("Location:boutique.php");
			exit;
		}
	}
}
$imgId=file_exists("img/prod_{$produit->id_produit}_v.jpg")?$produit->id_produit:0;
$tabCategorie=Categorie::tab('1','nom');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Modifier un produit</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
	<?php include('inc/entete.php'); ?>
		<div class="global">
<?php
if($erreur){
?>
			<p class="erreur">Erreur :<br/><?php echo $erreur ?></p>
<?php
}
?>
			<form name="form1" method="post" action="modifier.php" enctype="multipart/form-data">
				<input type="hidden" name="id_produit" value="<?php echo $produit->id_produit ?>"/>
				<p>
					<label>Catégorie
						<select name="id_categorie">
<?php
foreach ($tabCategorie as $categorie){
	$selected=$categorie->id_categorie==$produit->id_categorie?'selected="selected"':'';
?>
						<option value="<?php echo $categorie->id_categorie ?>" <?php echo $selected ?>><?php echo $categorie->nom ?></option>
<?php
}
?>
						</select>
					</label>
				</p>
				<p><label>Nom <input name="nom" size="50" value="<?php echo $produit->nom ?>"/></label></p>
				<p><label>Référence <input name="ref" size="10" value="<?php echo $produit->ref ?>"/></label></p>
				<p><label>Prix unitaire <input name="pu" size="9" value="<?php echo $produit->pu ?>"/></label></p>
				<p><img src="img/prod_<?php echo $imgId ?>_v.jpg?alea=<?php echo rand() ?>"/></p>
<?php
if($imgId){
?>
				<p><a href="supprimerImage.php?id_produit=<?php echo $produit->id_produit ?>">[Supprimer l'image]</a></p>
<?php
}
?>
				<p><label>Photo JPEG <input name="photo" type="file"/></label></p>
				<p>
					<input type="submit" value="Enregistrer"/>
					<input type="button" value="Annuler" onclick="location='boutique.php'"/>
				</p>
			</form>
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>
