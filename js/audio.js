


function makePlayer(audio, playerDiv){

	/*
	Création des balises du player
	*/
	playerDiv.append("<div class='infos titre'></div>");
	playerDiv.append("<div class='infos artiste'></div>");
	playerDiv.append("<div class='infos album'></div>");
	playerDiv.append("<div class='controls playpause'></div>");
	playerDiv.append("<div class='controls stop'></div>");
	playerDiv.append("<div class='controls duration'><div class='listened'><div class='d-cursor'></div></div></div>");
	playerDiv.append("<div class='controls vol-icon'></div>");
	playerDiv.append("<div class='controls volume'><div class='volzone'><div class='cursor'></div></div></div>");
var duration = audio[0].duration;
audio[0].addEventListener("loadedmetadata", function(_event) {
    var duration = audio[0].duration;


}
	var playpause = "play";
	var listened = 0;
	var duration = audio[0].duration;
	var volWidth = playerDiv.find(".volzone").width()- playerDiv.find(".cursor").outerWidth();
console.log( duration );
	audio[0].volume = 0.5;
	var volAudio = audio[0].volume;
	var volPos = volWidth * volAudio;

	var dCursorWidth = playerDiv.find('.duration .listened .d-cursor').width();
	var dWidth = playerDiv.find('.duration').width();


	function testVolAudio(){
		$(".vol-icon").removeClass("high medium low mute mute2");
		if(volAudio >= 0.75){
			$(".vol-icon").addClass("high");
			audio[0].muted = false;
		}
		else if(volAudio >= 0.5 & volAudio < 0.75){
			$(".vol-icon").addClass("medium");
			audio[0].muted = false;
		}
		else if(volAudio >= 0.25 & volAudio < 0.5){
			$(".vol-icon").addClass("low");
			audio[0].muted = false;
		}
		else if(volAudio > 0 &   volAudio < 0.25){
			$(".vol-icon").addClass("mute");
			audio[0].muted = false;
		}
		else if(volAudio == 0 ){
			$(".vol-icon").addClass("mute2");
			audio[0].muted = true;
		}
	}



	////Play, pause, stop

	//Play et Pause
	playerDiv.find(".playpause").click(function() {
		if (playpause == "play"){
			audio[0].play();
			$(this).addClass("pause");
			playpause = "pause";
		}else{
			audio[0].pause();
			$(this).removeClass("pause");
			playpause = "play";
			}
	});

	//Stop

	function stop(){
		audio[0].pause();
		audio[0].currentTime=0;
		playerDiv.find(".playpause").removeClass("pause");
		playpause = "play";
	}



	playerDiv.find(".stop").click(function(){
		stop();
	});



	////Barre de lecture
	audio[0].addEventListener("timeupdate", function() {
					listened = ((audio[0].currentTime)/duration*dWidth)+dCursorWidth;

					$(".listened").width(listened+"px");

					$(".listened .d-cursor").css({
						"right" : "0",
						"left" : "auto"
					});

					if( audio[0].currentTime == duration){
						stop();
					}

                }, true);

	$('.duration').click(function(e){
		leftMargin = parseFloat($(this).css('border-left-width')) + parseFloat($(this).css('padding-left'));
		xPos = e.pageX - $(this).offset().left - leftMargin;

		audio[0].currentTime = xPos / dWidth * duration;

	});


	////Volume

	//initialiser curseur
	playerDiv.find(".volume .cursor" ).css('left',volPos);
	//initialiser icone
	testVolAudio();

	//curseur audio
	playerDiv.find(".volume .cursor" ).draggable({
		containment: ".volzone" ,
		drag: function( event, ui )
			{
			var vol =ui.position.left/38;
			audio[0].volume = vol;
			volAudio = vol;
			testVolAudio();
			}
	});


	playerDiv.find(".duration .listened .d-cursor" ).draggable({

		containment : ".duration",
		scroll:false,
		drag: function(event, ui) {
			audio[0].currentTime = (ui.position.left) / dWidth * duration;
			audio[0].muted = true;
		},
		stop : function() {
			audio[0].muted = false;

		}
	});

	//mute icone
	playerDiv.find(".vol-icon").click(function(){
		if($(this).hasClass('mute2') == true){
			$(this).removeClass('mute2');
			audio[0].muted = false;
		}else{
			$(this).addClass('mute2');
			audio[0].muted = true;
		}
	});

	//Affichage des infos liées au morceau
	$('.infos.titre').	html(playerDiv.data('titre'));
	$('.infos.artiste').html(playerDiv.data('artiste'));
	$('.infos.album').	html(playerDiv.data('album'));

}

