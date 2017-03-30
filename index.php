<?php
    require_once('inc/cfg.php');
    require_once('class/User.php');
    require_once('class/Categorie.php');
    require_once('class/Produit.php');
	
	$tabGrandeCategorie=GrandeCategorie::tab(1,'nom');
	

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MyBaby</title>
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
    </head>
    <body>
       <?php
	    require('inc/entete.php');
		include('menu.php');
	   ?>
        <div class="clearboth"></div>
		<nav id="global">
		<?php foreach($tabGrandeCategorie as $grandeCategorie){
			$tabCategorie=$grandeCategorie->getTabCategorie();
		?>
		<div class="grande_categorie">
		<a href="boutique.php"><h3><?php echo $grandeCategorie->nom ?></h3></a>
                <div class="box_accueil">
		<?php
                
		foreach($tabCategorie as $categorie){
		?>
		<h6><?php echo $categorie->nom ?></h6>
		<p><?php echo $categorie->description ?></p> 		
		<?php
		} ?>
                </div>
		</div>
                <?php
		}
		?>
		</nav>
		<?php include('footer.php'); ?>
    </body>
</html>