<?php

	require_once('../inc/getid3/getid3.php');

	// Initialize getID3 engine
	$getID3 = new getID3;
	$mp3 = "../music/zik2.mp3";
	// Analyze file and store returned data in $ThisFileInfo
	$ThisFileInfo = $getID3->analyze($mp3);

	getid3_lib::CopyTagsToComments($ThisFileInfo);

	$titre =  $ThisFileInfo['tags_html']['id3v1']['title'][0];  // title from ID3v1
	$artiste =  $ThisFileInfo['tags_html']['id3v1']['artist'][0];  // title from ID3v1
	$album =  $ThisFileInfo['tags_html']['id3v1']['album'][0];  // title from ID3v1

?><!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">

	<title>Test Audio</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../style/normalize.css">
	<link rel="stylesheet" href="../style/style.css">
	<link rel="stylesheet" href="../style/audio.css">
</head>
<body>
<div id="wrapper" class="clearfix">


	<header>
		<h1>Player Audio MP3</h1>
		<h2>Utilise l'élément html5 'audio', du JS pour les contrôle, et du PhP pour les infos ID3 Tag</h2>
		<h2>Use html5 'audio' element, JS for controls, and PhP to get the ID3 Tags</h2>
	</header>
	
	<main id="content" class="clearfix">
		
		<audio id="audio" >
			<source src="<?= $mp3 ?>" type="audio/mpeg" />
			Ca marche pas
		</audio>
		
		<div id="player" 
			data-titre="<?= $titre ?>" 
			data-artiste="<?= $artiste ?>"
			data-album="<?= $album ?>">
		</div>
		
		
	</main> <!-- /#content -->

	<footer>

	</footer>


</div><!-- /#wrapper -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
	<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js" ></script>
	<script src="../js/jquery.ui.touch-punch.min.js" ></script>
	<script src="../js/audio.js" ></script>
	
	<script>
	$(document).ready(function() {
		makePlayer($("#audio"), $("#player"));
	});
	</script>

</body>
</html>

