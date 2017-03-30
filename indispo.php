<?php
require_once('inc/cfg.php');
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<title>Produit indisponible</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php include ('inc/entete.php'); ?>

    <div class="global">
        <div id="indispo"
        <p class="indispo">Désolé, ce produit n'existe plus.</p>
        <p><a href="boutique.php">[Retour au catalogue]</a></p>
        </div>
    </div>
    <div class="clearboth"></div>
    <?php
    include('footer.php');
    ?>
</body>
</html>
