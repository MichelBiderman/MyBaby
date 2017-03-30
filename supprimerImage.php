<?php
$opt=['options'=>['default'=>0,'min_range'=>1]];
$id_produit=filter_input(INPUT_GET,'id_produit',FILTER_VALIDATE_INT,$opt);
@unlink("img/prod_{$id_produit}_v.jpg");
@unlink("img/prod_{$id_produit}_p.jpg");
header("Location:boutique.php");
