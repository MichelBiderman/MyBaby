<?php
require_once('inc/cfg.php');
require_once('class/Categorie.php');
require_once('class/Produit.php');
require_once('class/Panier.php');
$tabCategorie = Categorie::tab('1', 'nom');
?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Paiement</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body>
        <?php
        include('inc/entete.php');
        include('menu.php');
        ?>
        <div class="clearboth"></div>
        <div id="paiment">
            <h2>Voici la liste de vos achats :</h2>
            <?php include('panier.php'); ?>
           
                
    </form>
    </div>
    </body>
    </html>
  