<?php

function creamenu( $nav, $num, $navclass ){
?>
		<nav class="<?php  echo $navclass;  ?>"> 
			<ul>
				<?php		// solution 3
						$nb_menu = count($nav);
						$last_menu = $nb_menu-1;
						
					
					foreach( $nav as $key => $value ){
					
					
					$classe ="";  //variable class
					
					if ($key == 0){
						$classe="first";
					}
					
					elseif($key == $last_menu){
							$classe="last";
					}
					
					if($key == $num){
							$classe .=" active";  //$classe = $classe . "active"
					}
					
						echo (" <li class='$classe'><a href='". $value["lien"] ."'>"); 
						echo $value["texte"];
						echo ( "</a></li>" );
					
					}
					
				?>
			</ul>
		</nav>
<?php
}

?>