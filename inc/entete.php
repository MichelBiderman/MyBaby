 <header id="entete">
    <div class="connexion">
	<form name="form1" method="post" action="">
<?php
if(!$userSession->loginOk){
?>
    <input type="hidden" name="action" value="login"/>
    <p><label>mail <input name="mail" size="20"/></label></p>
    <p><label>Mot de passe <input type="password" name="mdp" size="10" maxlength="10"/></label></p>
    <p><input id="login" type="submit" value="S'identifier"/></p>
    <p><a href="inscription.php">[Inscription]</a></p>
<?php
}else{
?>
    <input type="hidden" name="action" value="logout"/>
    <p><?php echo $userSession->nom ?> <?php echo $userSession->prenom ?></p>
    <p><input type="submit" value="Logout"/></p>
<?php
}
?>
	</form>
    </div>
        <h1 id="site">My BABY : les produits de bébé.</h1>
        <h4 class="slogan">Maman ou Papa depuis peu, ce site est fait pour vous faciliter la vie!</h4>
</header>