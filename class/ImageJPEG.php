<?php
class ImageJPEG {
	const REDIM_CONTAIN='REDIM_CONTAIN'; 
	const REDIM_COVER='REDIM_COVER';
	public $messageErreur=''; // Renseigné si pas JPEG ou erreur.
	private $chemin=''; // Chemin du fichier.
	private $largeur=0; // Largeur en px.
	private $hauteur=0; // Hauteur en px. 
	
	public function __construct($chemin){
		$this->chemin=$chemin;
		list($this->largeur,$this->hauteur,$type)=  getimagesize($this->chemin);
		if($type!==IMG_JPG)$this->messageErreur="Image pas JPEG.";
	}
	
	public function copier($largeurDest=0,$hauteurDest=0,
  $cheminDest,$modeRedim=ImageJPEG::REDIM_CONTAIN){
		if($this->largeur <= $largeurDest && $this->hauteur <= $hauteurDest){
			if(!copy($this->chemin,$cheminDest))$this->messageErreur="Copie impossible.";
			return;
		}
		$ratio=$this->largeur/$this->hauteur;
		if($modeRedim===ImageJPEG::REDIM_CONTAIN){
			$x=0;
			$y=0;
			if($ratio < $largeurDest/$hauteurDest){
				$h=$hauteurDest;
				$l=(int)($h*($ratio));
			}
			else{
				$l=$largeurDest;
				$h=(int)($l/($ratio));
			}			
		}
		elseif($modeRedim===ImageJPEG::REDIM_COVER){
			if($ratio < $largeurDest/$hauteurDest){
				$l=$largeurDest;
				$h=(int)($l/($ratio));
				$x=0;
				$y=(int)(($h-$hauteurDest)/2);
			}
			else{
				$h=$hauteurDest;
				$l=(int)($h*($ratio));
				$y=0;
				$x=(int)(($l-$largeurDest)/2);
			}			
		}
		else{
			$this->messageErreur="Mode de redimensionnement inconnu.";
			return;
		}
		$resSrc=imagecreatefromjpeg($this->chemin);
		if(!$resSrc){
			$this->messageErreur="Mémoire insufisante.";
			return;
		}
		$resDest=imagecreatetruecolor($l,$h);
		if(!$resDest){
			$this->messageErreur="Mémoire insufisante.";
			return;
		}
		if(!imagecopyresampled($resDest,$resSrc,0,0,0,0,$l,$h,$this->largeur,$this->hauteur)){
			$this->messageErreur="Mémoire insufisante.";
			return;
		}
		if($modeRedim===ImageJPEG::REDIM_COVER)$resDest=imagecrop($resDest,['x'=>$x,'y'=>$y,'width'=>$largeurDest,'height'=>$hauteurDest]);
		if(!$resDest){
			$this->messageErreur="Mémoire insufisante.";
			return;
		}
		if(!imagejpeg($resDest,$cheminDest,80))$this->messageErreur="Impossible d'écrire le fichier image.";
		imagedestroy($resSrc);
		imagedestroy($resDest);
	}
}
