<?php

/*	$prioridades = get_option('bach_priorities'); 
	$priorities = get_cat_id($prioridades);

 	$categories = get_categories( 'child_of=' . $priorities ); 
	$categorias_post = get_the_category(); 
	foreach ( $categories as $category ){
		$cat_id = $category->cat_ID;
		foreach ( $categorias_post as $categoria_post ){
			if ( $categoria_post  )
		}
		$name = $category->name;
		$prior = explode(" ", $name);
		if ( $prior[0] = 'P1')
		
	}
*/

			if  (in_category( 70 )) { echo '<p class="uno"></p>'; }
		elseif (in_category( 71 )) { echo '<p class="dos"></p>'; }
		elseif (in_category( 72 )) { echo '<p class="tres"></p>'; }
		elseif (in_category( 73 )) { echo '<p class="cuatro"></p>'; }
		elseif (in_category( 74 )) { echo '<p class="cinco"></p>'; }
		elseif (in_category( 75 )) { echo '<p class="seis"></p>'; }
		else { }
 ?>