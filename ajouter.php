<?php
require_once('inc/cfg.php');
require_once('class/Connexion.php');
require_once('class/Produit.php');
require_once('class/Categorie.php');
require_once('class/Panier.php');
if($userSession->loginOk){
$panier=Panier::select("id_user={$_SESSION['id_user']} AND id_produit={$_GET['id_produit']}");
if ($panier) {
$panier->quantite=$panier->quantite+1;
}
else {
    $panier=new Panier();
    $panier->quantite=1;
    $panier->id_user=$_SESSION['id_user'];
    $panier->id_produit=$_GET['id_produit'];
}
$panier->sauver();
}
header('location: boutique.php');
?>