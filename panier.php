<?php

require_once('inc/cfg.php');
require_once('class/Connexion.php');
require_once('class/Produit.php');
require_once('class/Categorie.php');
require_once('class/Panier.php');
if ($userSession->loginOk) {
$paniers=Panier::tab("id_user={$_SESSION['id_user']}");
$prixtotal=0;
foreach ($paniers as $ligne) {
    $prod=(new Produit($ligne->id_produit))->charger();
    echo "  " .$ligne->quantite.$prod->nom." à ".$prod->pu." € <br /><button onclick='document.location=\"supprimer_panier.php?id=".$ligne->id_panier."\";'>Retirer</button><br />";
    $prixtotal=$prixtotal+$prod->pu*$ligne->quantite;
}
?>
<p>Prix total de votre comande : <?php echo $prixtotal ?> euros</p>
<?php
}
?>
