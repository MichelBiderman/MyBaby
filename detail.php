<?php
require_once('inc/cfg.php');
require_once('class/Produit.php');
$opt=['options'=>['default'=>0,'min_range'=>1]];
$id_produit=filter_input(INPUT_GET,'id_produit',FILTER_VALIDATE_INT,$opt);
$produit=new Produit($id_produit);
if(!$userSession->loginOk)header("Location:inscription.php");
if(!$produit->charger()){
	header("Location:indispo.php");
	exit($id_produit);
}
$categorie=$produit->getCategorie();
$imgId=file_exists("img/prod_{$produit->id_produit}_p.jpg")?$produit->id_produit:0;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $produit->nom ?></title>
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
	<?php include('inc/entete.php'); ?>
		<div class="global">
			
			<p class="categorie"><?php echo $categorie->nom ?></p>
			<div class="detail">
				<img src="img/prod_<?php echo $imgId ?>_p.jpg"/>
				<div class="nom"><?php echo $produit->nom ?> <span class="ref">(<?php echo $produit->ref ?>)</span></div>
				<div class="pu"><?php echo $produit->pu ?></div>
				<?php if($userSession->loginOk){ ?>
					<button onclick="location='ajouter.php?id_produit=<?php echo $produit->id_produit ?>'">Ajouter</button>
                        </div>
                                     
				<p><a href="boutique.php">[Retour]</a></p>
			
		</div>
               <aside class="panier">
                                <?php } include('panier.php'); ?>
                                        </aside>
	</body>
</html>
