<?php
require_once('inc/cfg.php');
require_once('class/Produit.php');

$tabCategorie = Categorie::tab('1', 'nom');
$id_categorie = filter_input(INPUT_GET, 'id_categorie', FILTER_VALIDATE_INT);
if ($id_categorie !== null)
    $_SESSION['id_categorie'] = $id_categorie;
else
    $_SESSION['id_categorie'] = isset($_SESSION['id_categorie']) ? $_SESSION['id_categorie'] : 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Boutique</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script>
            function supprimer(id_produit, nom) {
                if (confirm("Vraiment supprimer " + nom + " ?"))
                    location = "supprimer.php?id_produit="+id_produit;
            }
        </script>
    </head>
    <body>
        <header>
            <?php
            include('inc/entete.php');
            include('menu.php');
            if (!$userSession->loginOk)
                header("location:inscription.php");
            else {
                ?>
                <aside class="panier">
				<?php include('panier.php'); ?>
                    <button id="confirmer" onclick="location = 'paiement.php'">Confirmer ma commande</button>
                </aside>
                <select name="id_categorie" onchange="location = 'boutique.php?id_categorie=' + this.value">
                    <option value="0">Toutes</option>
                    <?php
                    foreach ($tabCategorie as $categorie) {
                        $selected = $categorie->id_categorie == $_SESSION['id_categorie'] ? 'selected="selected"' : '';
                        ?>
                        <option value="<?php echo $categorie->id_categorie ?>" <?php echo $selected ?>><?php echo $categorie->nom ?></option>
                        <?php
                    }
                    ?>
                </select>

                <div class="global">
                    <?php
                    $where = $_SESSION['id_categorie'] !== 0 ? "id_categorie={$_SESSION['id_categorie']}" : '1';
                    $tabCategorie = Categorie::tab($where, 'nom');
                    foreach ($tabCategorie as $categorie) {
                        $tabProduit = $categorie->getTabProduit();
                        ?>
                        <div class="description">
                            <h2><?php echo $categorie->nom ?></h2>
                            <?php if ($userSession->admin == 1) { ?>
                                <button onclick="location = 'ajout.php?<?php echo $categorie->id_categorie ?>'">Ajouter un produit à la vente</button>
                                <?php
                            } 
                                ?>
                            </div>
                            <?php
                            foreach ($tabProduit as $produit) {
                                $imgId = file_exists("img/prod_{$produit->id_produit}_v.jpg") ? $produit->id_produit : 0;
                                ?>

                                <div class="produit">
                                    <img src="img/prod_<?php echo $imgId ?>_v.jpg?alea=<?php echo rand() ?>"/>
                                    <p class="nom"><?php echo $produit->nom ?></p>
                                    <p class="prix"><?php echo $produit->pu ?>€</p>

                                    <div class="ajouter">
                                        <div>
                                        <button onclick="location = 'ajouter.php?id_produit=<?php echo $produit->id_produit ?>'">Ajouter</button>
                                        
                                           
                                            <button onclick="location = 'detail.php?id_produit=<?php echo $produit->id_produit ?>'">Détail du produit</button>
                                             <?php if($userSession->admin==1){
                                                ?>
                                            <a href="javascript:void()" onclick="event.stopPropagation();
                                            supprimer(<?php echo $produit->id_produit ?>, '<?php echo addslashes(str_replace('"', "'", $produit->nom)) ?>')">[Supprimer]</a>
											<a href="modifier.php?id_produit=<?php echo $produit->id_produit ?>">[Modifier]</a>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                    }
                        ?>

                    </div>
                    <div class="clearboth"></div>
            <?php
            } 
            include('footer.php')
            ?>
            </body>
        </html>
                   
