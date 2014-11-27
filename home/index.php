<?php
include ("../inc/top.inc.php");

require_once('../inc/getid3/getid3.php');

// Initialize getID3 engine
$getID3 = new getID3;
$mp3 = "../music/zik2.mp3";
// Analyze file and store returned data in $ThisFileInfo
$ThisFileInfo = $getID3->analyze($mp3);

getid3_lib::CopyTagsToComments($ThisFileInfo);


$titre =  $ThisFileInfo['tags_html']['id3v1']['title'][0];  // title from ID3v2
$artiste =  $ThisFileInfo['tags_html']['id3v1']['artist'][0];  // title from ID3v2
$album =  $ThisFileInfo['tags_html']['id3v1']['album'][0];  // title from ID3v2


?>
	

	
	<div id="content" class="clearfix">
		
		<audio id="audio" >
			<source src="<?= $mp3 ?>" type="audio/mpeg" />
			Ca marche pas
		</audio>
		
		<div id="player" 
			data-titre="<?= $titre ?>" 
			data-artiste="<?= $artiste ?>"
			data-album="<?= $album ?>">
		</div>

		<h2>RESTE A FAIRE</h2>
		<ul>
			<li>curseur sur timeline</li>
			<li>Créer balises Player par JS</li>
			<li>Récup données par PhP</li>
			<li>Les récup en JSON</li>
			<li>Les afficher par JS</li>
			
		</ul>
		
		
		
	</div> <!-- /#content -->

	

	
<?php
include ("../inc/bottom.inc.php");
?>
