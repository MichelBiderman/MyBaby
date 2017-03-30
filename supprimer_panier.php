<?php
require_once('inc/cfg.php');
$opt=['options'=>['default'=>0,'min_range'=>1]];
$id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT,$opt);
(new Panier($id))->supprimer();
header("Location:boutique.php");
