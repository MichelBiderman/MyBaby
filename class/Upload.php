<?php
class Upload {
	public $nomChamp=''; // Nom du champ INPUT.
	public $tabExt=[]; // Extensions autorisées, ex : ['pdf','doc'].
	public $nomClient=''; // Nom du fichier côté client.
	public $extension=''; // Extension du fichier sans le point.
	public $cheminServeur=''; // Chemin du fichier temporaire côté serveur.
	public $codeErreur=0; // Code d'erreur éventuel.
	public $octets=0; // Nombre d'octets téléchargés.
	public $typeMime=''; // Type MIME du fichier.
	public $ok=false; // Vrai si aucun problème.
	public $messageErreur=''; // Renseigné si problème.
	
	public function __construct($nomChamp,$tabExt=[]){
		$this->nomChamp=$nomChamp;
		$this->tabExt=$tabExt;
		$this->nomClient=$_FILES[$nomChamp]['name'];
		$tab=explode('.',$this->nomClient);
		$this->extension=strtolower(end($tab));
		$this->cheminServeur=$_FILES[$nomChamp]['tmp_name'];
		$this->codeErreur=$_FILES[$nomChamp]['error'];
		$this->octets=$_FILES[$nomChamp]['size'];
		$this->typeMime=$_FILES[$nomChamp]['type'];
		if($this->octets && $this->tabExt && !in_array($this->extension,$this->tabExt)){
			$this->messageErreur="L'extension du fichier est incorrecte.";
		}
		elseif($this->codeErreur!==UPLOAD_ERR_OK){
			switch($this->codeErreur){
				case UPLOAD_ERR_INI_SIZE:
					$this->messageErreur="La taille du fichier excède le maximum permis côté serveur.";
					break;
				case UPLOAD_ERR_FORM_SIZE:
					$this->messageErreur="La taille du fichier excède le maximum permis côté client.";
					break;
				case UPLOAD_ERR_PARTIAL:
					$this->messageErreur="Le fichier n'a été que partiellement uploadé.";
					break;
				case UPLOAD_ERR_NO_FILE:
					$this->messageErreur="Aucun fichier n'a été uploadé.";
					break;
				case UPLOAD_ERR_NO_TMP_DIR:
					$this->messageErreur="Le répertoire temporaire est absent.";
					break;
				case UPLOAD_ERR_CANT_WRITE:
					$this->messageErreur="Le répertoire temporaire est inaccessible en écriture.";
					break;
				case UPLOAD_ERR_EXTENSION:
					$this->messageErreur="Une extension serveur PHP a bloqué l'upload.";
					break;
				default:
					$this->messageErreur="Erreur inconnue.";
			}
		}
		else{
			$this->ok=true;
		}
	}
	
	public function sauver($destination){
		return $this->ok && move_uploaded_file ($this->cheminServeur,$destination);
	}
}
