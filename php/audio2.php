<?php
	function lecture($q,$s) {
		$r=str_replace("%20","_",$q);
		$nom_mp3='../snd/'.$r.'.mp3';
		if(strpos($_SERVER['HTTP_USER_AGENT'],'OPR')
			|| (strpos($_SERVER['HTTP_USER_AGENT'],'Linux'))) {
			$nom='../snd/'.$r.'.wav';
			$type="x-wav";
			$nom=str_replace(" ","_",$nom);
			if(! file_exists($nom)) {
				$url='http://api.voicerss.org/?key=1baf863afafb4d04bab1a3803fc92b0a&hl=fr-fr&r=-2&src=%22'.$s.'%22&c=wav';
				$commande = 'wget --user-agent=" " "'.$url.'" -O "'.$nom.'"';
				exec($commande);
			}
		}
		else
		{
			$type="mpeg";
			$nom=str_replace(" ","_",$nom_mp3);
			if(! file_exists($nom_mp3)) {
				$url='http://translate.google.com/translate_tts?tl=fr&q=%22'.$s.'%22';
				$commande ='wget --user-agent=" " "'.$url.'" -O "'.$nom.'"';
				exec($commande);
			}
		}
		return array($nom,$type);
	}
?>

<?php
	$tmp=lecture($_GET["mot"],$_GET["son"]);
	echo "<source src=".$tmp[0]." type='audio/".$tmp[1]."' />";
?>


<!-- Voice RSS informer code 
<br />
<a href="http://www.voicerss.org" target="_blank">
<img src="http://www.voicerss.org/images/info_white.gif" width="88px" height="31" style="border: 0" alt="Voice RSS - Free online text-to-speech service" />
</a>
-->
