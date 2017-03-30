<?php
require_once('inc/cfg.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css" />
        <title>FAQ</title>
</head>
<body>
    <?php include('inc/entete.php');
          include('menu.php') ; 
    ?>
    <div class="clearboth"></div>
	<nav class="global">
    <div class="faq">
        <h2>Vos commentaires</h2>
		<p>Laissez vos avis et impressions</p>
    </div>
    <div class="faq">
        <h2>Réclamations</h2>
        <p>Vous avez des soucis avec votre produit? </br></p>
        <p>Hésitez pas à porter plainte!!lol non!</p>
        <textarea id="textarea" name="textarea" placeholder="Tapez votre message"></textarea>
		<button id="area" onclick="location='faq.php?id_user=<?php ?>'">Envoyer</button>
    </div>
	</nav>
<?php include('footer.php'); ?>
</body>
</html>