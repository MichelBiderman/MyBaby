<?php
require_once('inc/cfg.php');
$opt=['options'=>['default'=>0,'min_range'=>1]];
$id_produit=filter_input(INPUT_GET,'id_produit',FILTER_VALIDATE_INT,$opt);
(new Produit($id_produit))->supprimer();
$tableauPanier=Panier::tab("id_produit={$id_produit}");
foreach ($tableauPanier as $panier) {
    $panier->supprimer();
}
header("Location:supprimerImage.php?id_produit={$id_produit}");
