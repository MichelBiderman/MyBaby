<?php
require_once('inc/cfg.php');
require_once('class/Upload.php');
require_once('class/Produit.php');
require_once('class/ImageJPEG.php');
$erreur = '';
$opt = ['options' => ['default' => 0, 'min_range' => 1]];
$id_categorie = filter_input(INPUT_GET, 'id_categorie', FILTER_VALIDATE_INT, $opt);
$produit = new Produit();
if(!$userSession->admin==1) header("Location:index.php");
else{
if ($_POST) {
    $produit->id_categorie = filter_input(INPUT_POST, 'id_categorie', FILTER_VALIDATE_INT, $opt);
    $produit->nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $produit->ref = filter_input(INPUT_POST, 'ref', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $produit->pu = filter_input(INPUT_POST, 'pu', FILTER_VALIDATE_FLOAT);
    $catExiste = (new Categorie($produit->id_categorie))->existe();
    // $refExiste=$produit->refExiste();
    if (!$catExiste)
        $erreur.="La catégorie n'existe pas.<br/>";
    //if($refExiste)$erreur.="La référence est déjà existante.<br/>";
    if ($produit->nom === '')
        $erreur.="Le nom est vide.<br/>";
    if ($produit->ref == '')
        $erreur.="La référence est vide.<br/>";
    if ($produit->pu === false || $produit->pu <= 0)
        $erreur.="Le prix unitaire est vide ou incorrect.<br/>";
    if (!$erreur) {
        $upload = new Upload('photo', ['jpg', 'jpeg']);
        if ($upload->nomClient && !$upload->ok)
            $erreur = $upload->messageErreur;
        else {
            // Upload et données POST OK donc ajout en base.
            $produit->sauver();
            if ($upload->ok) {
                $imageJPEG = new ImageJPEG($upload->cheminServeur);
                $imageJPEG->copier(150, 150, "img/prod_{$produit->id_produit}_v.jpg", ImageJPEG::REDIM_COVER);
                $imageJPEG->copier(450, 450, "img/prod_{$produit->id_produit}_p.jpg", ImageJPEG::REDIM_CONTAIN);
            }
            header("Location:ajout.php");
            exit;
        }
    }
    $id_categorie = $produit->id_categorie;
}
$tabCategorie = Categorie::tab('1', 'nom');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ajouter un produit</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
            <?php
            include('inc/entete.php');
            include ('menu.php');
            ?>
    <body>
        <nav class="global">
                <?php
                if ($erreur) {
                    ?>
                <p class="erreur">Erreur :<br/><?php echo $erreur ?></p>
    <?php
}
?>
            <form name="form1" method="post" action="ajout.php" enctype="multipart/form-data">
                <input name="MAX_FILE_SIZE" type="hidden" value="20971520"/>
                <p>
                    <label>Categorie</label>
                    <select name="id_categorie">
                        <?php
                        foreach ($tabCategorie as $categorie) {
                            $selected = $categorie->id_categorie == $id_categorie ? 'selected="selected"' : '';
                            ?>
                            <option value="<?php echo $categorie->id_categorie ?>" <?php echo $selected ?>><?php echo $categorie->nom ?></option>
    <?php
}
?>
                    </select>

                </p>
                <p><label>Nom <input name="nom" size="50" value="<?php echo $produit->nom ?>"/></label></p>
                <p><label>Reference <input name="ref" size="10" value="<?php echo $produit->ref ?>"/></label></p>
                <p><label>Prix unitaire <input name="pu" size="9" value="<?php echo $produit->pu ?>"/></label></p>
                <p><label>Photo JPEG <input name="photo" type="file"/></label></p>
                <p>
                    <input type="submit" value="Enregistrer"/>
                    <input type="button" value="Annuler" onclick="location = 'boutique.php'"/>
                </p>
            </form>
        </nav>
    </body>
</html>
<?php
}
?>