<?php /*
Template Name: Informe Rocío
*/

 get_header(); ?>


<div id="main">
<div align="center"><strong><span style="font-size:22px;"> <a href="http://interno.mecus.es/informes/">PRIORIDAD</a> || <a href="http://interno.mecus.es/entrega/">FECHA ENTREGA</a> || <a href="http://interno.mecus.es/timeline/">TIMELINE</a> || <a href="http://interno.mecus.es/espera/">EN ESPERA</a> || <a href="http://interno.mecus.es/sin-fecha/">SIN FECHA</a></span> <br /> <span style="font-variant:small-caps;font-size:16px;"><a href="http://interno.mecus.es/category/abierto/">Abiertos</a> || <a href="http://interno.mecus.es/category/wait/">En Espera</a> || <a href="http://interno.mecus.es/category/done/">Cerrados</a> || <a href="http://interno.mecus.es/category/luis/">Luis</a> || <a href="http://interno.mecus.es/category/rocio/">Rocío</a> || <a href="http://interno.mecus.es/category/raven/">RaveN</a></span></strong></div>

	<table>
	<tr style=font-weight:bold;><td>Prioridad</td><td>Proyecto</td><td>Ticket</td><td>Enlace</td><td>Usuario</td><td>Wait</td><td>Entrega</td></tr>
<?php 

$halfday = 60;
$completeday = 24*60*60;
?>
	

<?php query_posts('cat=66,67,-57,-58,-70,-71,-72,-73,-74,-184&showposts=-1'); ?>

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>



	<tr style="background-color:<?php
$exit = 0;
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'):
    	echo '#aaa';
    	$exit = 1;
    endif;
    if ($exit != 1):
 	   if ($category->cat_ID == '57') echo '#FFF3EB';
 	   if ($category->cat_ID == '58') echo '#EBEBFF'; 
 	   if ($category->cat_ID == '144') echo '#EBFFEB';
	endif;
 } ?>	
;"><td style="background-color:<?php foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '70') echo '#0f0';
    if ($category->cat_ID == '71') echo '#0f6'; 
    if ($category->cat_ID == '72') echo '#0ff';
    if ($category->cat_ID == '73') echo '#f0f';
    if ($category->cat_ID == '74') echo '#f06';
    if ($category->cat_ID == '75') echo '#f00'; 
}  ?>">
<?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '70') || ($category->cat_ID == '71') || ($category->cat_ID == '72') || ($category->cat_ID == '73') || ($category->cat_ID == '74') || ($category->cat_ID == '75') || ($category->cat_ID == '184')) {	
    	echo $category->cat_name; 
	}
}  ?>	
	
	</td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID != '67') && ($category->cat_ID != '66') && ($category->cat_ID != '57') && ($category->cat_ID != '58') && ($category->cat_ID != '144') && ($category->cat_ID != '70') && ($category->cat_ID != '71') && ($category->cat_ID != '72') && ($category->cat_ID != '73') && ($category->cat_ID != '74') && ($category->cat_ID != '75') && ($category->cat_ID != '184')) {	
    	echo $category->cat_name . ' '; 
    }
}  ?></td><td><?php the_title(); ?></td><td><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></td><td><?php
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66') {	
    	echo $category->cat_name; 
	}
}  ?></td><td>	<?php 
			$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			$entrega = $entrega[0];
			$entrega = explode('/', $entrega);
			if ($entrega[0] != ''){
				$entregado = $entrega[2].'-'.$entrega[0].'-'.$entrega[1];
				$entrega = $entrega[1].'/'.$entrega[0].'/'.$entrega[2];

				$date1 = $entregado;
				$date2 = time();
				$dateArr  = explode("-",$date1);
				$date1Int = mktime(0,0,0,$dateArr[1],$dateArr[2],$dateArr[0]) ;
				$diff = $date2-$date1Int;
					if (($diff > $halfday) && ($diff < $completeday)) {
						echo '<span style="font-weight:bold;color:red;border:1px solid black;padding:1px;">'.$entrega.'</span>';
					} 
					
					elseif ($diff > $completeday){
						echo '<span style="font-weight:bold;color:white;border:1px solid black;padding:1px;background-color:red;">'.$entrega.'</span>';
					} 
					
					else {
						echo '<span style="font-weight:bold;padding:1px;">'.$entrega.'</span>';
					}
					


			}



			?>
</td></tr>
		<?php endwhile; ?>
	<?php endif; ?>

  <?php rewind_posts(); ?>
<?php query_posts('cat=66,67,-57,-58,-70,-71,-72,-73,-75,-184&showposts=-1'); ?>

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>



	<tr style="background-color:<?php
$exit = 0;
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'):
    	echo '#aaa';
    	$exit = 1;
    endif;
    if ($exit != 1):
 	   if ($category->cat_ID == '57') echo '#FFF3EB';
 	   if ($category->cat_ID == '58') echo '#EBEBFF'; 
 	   if ($category->cat_ID == '144') echo '#EBFFEB';
	endif;
 } ?>	
;"><td style="background-color:<?php foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '70') echo '#0f0';
    if ($category->cat_ID == '71') echo '#0f6'; 
    if ($category->cat_ID == '72') echo '#0ff';
    if ($category->cat_ID == '73') echo '#f0f';
    if ($category->cat_ID == '74') echo '#f06';
    if ($category->cat_ID == '75') echo '#f00'; 
}  ?>">
<?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '70') || ($category->cat_ID == '71') || ($category->cat_ID == '72') || ($category->cat_ID == '73') || ($category->cat_ID == '74') || ($category->cat_ID == '75') || ($category->cat_ID == '184')) {	
    	echo $category->cat_name; 
	}
}  ?>	
	
	</td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID != '67') && ($category->cat_ID != '66') && ($category->cat_ID != '57') && ($category->cat_ID != '58') && ($category->cat_ID != '144') && ($category->cat_ID != '70') && ($category->cat_ID != '71') && ($category->cat_ID != '72') && ($category->cat_ID != '73') && ($category->cat_ID != '74') && ($category->cat_ID != '75') && ($category->cat_ID != '184')) {	
    	echo $category->cat_name . ' '; 
    }
}  ?></td><td><?php the_title(); ?></td><td><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></td><td><?php
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66') {	
    	echo $category->cat_name; 
	}
}  ?></td><td>	<?php 
			$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			$entrega = $entrega[0];
			$entrega = explode('/', $entrega);
			if ($entrega[0] != ''){
				$entregado = $entrega[2].'-'.$entrega[0].'-'.$entrega[1];
				$entrega = $entrega[1].'/'.$entrega[0].'/'.$entrega[2];

				$date1 = $entregado;
				$date2 = time();
				$dateArr  = explode("-",$date1);
				$date1Int = mktime(0,0,0,$dateArr[1],$dateArr[2],$dateArr[0]) ;
				$diff = $date2-$date1Int;
					if (($diff > $halfday) && ($diff < $completeday)) {
						echo '<span style="font-weight:bold;color:red;border:1px solid black;padding:1px;">'.$entrega.'</span>';
					} 
					
					elseif ($diff > $completeday){
						echo '<span style="font-weight:bold;color:white;border:1px solid black;padding:1px;background-color:red;">'.$entrega.'</span>';
					} 
					
					else {
						echo '<span style="font-weight:bold;padding:1px;">'.$entrega.'</span>';
					}
					


			}



			?>
</td></tr>
		<?php endwhile; ?>
	<?php endif; ?>

  <?php rewind_posts(); ?>
<?php query_posts('cat=66,67,-57,-58,-70,-71,-72,-74,-75,-184&showposts=-1'); ?>

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>



	<tr style="background-color:<?php
$exit = 0;
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'):
    	echo '#aaa';
    	$exit = 1;
    endif;
    if ($exit != 1):
 	   if ($category->cat_ID == '57') echo '#FFF3EB';
 	   if ($category->cat_ID == '58') echo '#EBEBFF'; 
 	   if ($category->cat_ID == '144') echo '#EBFFEB';
	endif;
 } ?>	
;"><td style="background-color:<?php foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '70') echo '#0f0';
    if ($category->cat_ID == '71') echo '#0f6'; 
    if ($category->cat_ID == '72') echo '#0ff';
    if ($category->cat_ID == '73') echo '#f0f';
    if ($category->cat_ID == '74') echo '#f06';
    if ($category->cat_ID == '75') echo '#f00'; 
}  ?>">
<?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '70') || ($category->cat_ID == '71') || ($category->cat_ID == '72') || ($category->cat_ID == '73') || ($category->cat_ID == '74') || ($category->cat_ID == '75') || ($category->cat_ID == '184')) {	
    	echo $category->cat_name; 
	}
}  ?>	
	
	</td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID != '67') && ($category->cat_ID != '66') && ($category->cat_ID != '57') && ($category->cat_ID != '58') && ($category->cat_ID != '144') && ($category->cat_ID != '70') && ($category->cat_ID != '71') && ($category->cat_ID != '72') && ($category->cat_ID != '73') && ($category->cat_ID != '74') && ($category->cat_ID != '75') && ($category->cat_ID != '184')) {	
    	echo $category->cat_name . ' '; 
    }
}  ?></td><td><?php the_title(); ?></td><td><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></td><td><?php
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66') {	
    	echo $category->cat_name; 
	}
}  ?></td><td>	<?php 
			$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			$entrega = $entrega[0];
			$entrega = explode('/', $entrega);
			if ($entrega[0] != ''){
				$entregado = $entrega[2].'-'.$entrega[0].'-'.$entrega[1];
				$entrega = $entrega[1].'/'.$entrega[0].'/'.$entrega[2];

				$date1 = $entregado;
				$date2 = time();
				$dateArr  = explode("-",$date1);
				$date1Int = mktime(0,0,0,$dateArr[1],$dateArr[2],$dateArr[0]) ;
				$diff = $date2-$date1Int;
					if (($diff > $halfday) && ($diff < $completeday)) {
						echo '<span style="font-weight:bold;color:red;border:1px solid black;padding:1px;">'.$entrega.'</span>';
					} 
					
					elseif ($diff > $completeday){
						echo '<span style="font-weight:bold;color:white;border:1px solid black;padding:1px;background-color:red;">'.$entrega.'</span>';
					} 
					
					else {
						echo '<span style="font-weight:bold;padding:1px;">'.$entrega.'</span>';
					}
					


			}



			?>
</td></tr>
		<?php endwhile; ?>
	<?php endif; ?>
  <?php rewind_posts(); ?>
<?php query_posts('cat=66,67,-57,-58,-70,-71,-73,-74,-75,-184&showposts=-1'); ?>

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>



	<tr style="background-color:<?php
$exit = 0;
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'):
    	echo '#aaa';
    	$exit = 1;
    endif;
    if ($exit != 1):
 	   if ($category->cat_ID == '57') echo '#FFF3EB';
 	   if ($category->cat_ID == '58') echo '#EBEBFF'; 
 	   if ($category->cat_ID == '144') echo '#EBFFEB';
	endif;
 } ?>	
;"><td style="background-color:<?php foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '70') echo '#0f0';
    if ($category->cat_ID == '71') echo '#0f6'; 
    if ($category->cat_ID == '72') echo '#0ff';
    if ($category->cat_ID == '73') echo '#f0f';
    if ($category->cat_ID == '74') echo '#f06';
    if ($category->cat_ID == '75') echo '#f00'; 
}  ?>">
<?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '70') || ($category->cat_ID == '71') || ($category->cat_ID == '72') || ($category->cat_ID == '73') || ($category->cat_ID == '74') || ($category->cat_ID == '75') || ($category->cat_ID == '184')) {	
    	echo $category->cat_name; 
	}
}  ?>	
	
	</td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID != '67') && ($category->cat_ID != '66') && ($category->cat_ID != '57') && ($category->cat_ID != '58') && ($category->cat_ID != '144') && ($category->cat_ID != '70') && ($category->cat_ID != '71') && ($category->cat_ID != '72') && ($category->cat_ID != '73') && ($category->cat_ID != '74') && ($category->cat_ID != '75') && ($category->cat_ID != '184')) {	
    	echo $category->cat_name . ' '; 
    }
}  ?></td><td><?php the_title(); ?></td><td><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></td><td><?php
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66') {	
    	echo $category->cat_name; 
	}
}  ?></td><td>	<?php 
			$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			$entrega = $entrega[0];
			$entrega = explode('/', $entrega);
			if ($entrega[0] != ''){
				$entregado = $entrega[2].'-'.$entrega[0].'-'.$entrega[1];
				$entrega = $entrega[1].'/'.$entrega[0].'/'.$entrega[2];

				$date1 = $entregado;
				$date2 = time();
				$dateArr  = explode("-",$date1);
				$date1Int = mktime(0,0,0,$dateArr[1],$dateArr[2],$dateArr[0]) ;
				$diff = $date2-$date1Int;
					if (($diff > $halfday) && ($diff < $completeday)) {
						echo '<span style="font-weight:bold;color:red;border:1px solid black;padding:1px;">'.$entrega.'</span>';
					} 
					
					elseif ($diff > $completeday){
						echo '<span style="font-weight:bold;color:white;border:1px solid black;padding:1px;background-color:red;">'.$entrega.'</span>';
					} 
					
					else {
						echo '<span style="font-weight:bold;padding:1px;">'.$entrega.'</span>';
					}
					


			}



			?>
</td></tr>
		<?php endwhile; ?>
	<?php endif; ?>
  <?php rewind_posts(); ?>
<?php query_posts('cat=66,67,-57,-58,-70,-72,-73,-74,-75,-184&showposts=-1'); ?>

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>



	<tr style="background-color:<?php
$exit = 0;
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'):
    	echo '#aaa';
    	$exit = 1;
    endif;
    if ($exit != 1):
 	   if ($category->cat_ID == '57') echo '#FFF3EB';
 	   if ($category->cat_ID == '58') echo '#EBEBFF'; 
 	   if ($category->cat_ID == '144') echo '#EBFFEB';
	endif;
 } ?>	
;"><td style="background-color:<?php foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '70') echo '#0f0';
    if ($category->cat_ID == '71') echo '#0f6'; 
    if ($category->cat_ID == '72') echo '#0ff';
    if ($category->cat_ID == '73') echo '#f0f';
    if ($category->cat_ID == '74') echo '#f06';
    if ($category->cat_ID == '75') echo '#f00'; 
}  ?>">
<?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '70') || ($category->cat_ID == '71') || ($category->cat_ID == '72') || ($category->cat_ID == '73') || ($category->cat_ID == '74') || ($category->cat_ID == '75') || ($category->cat_ID == '184')) {	
    	echo $category->cat_name; 
	}
}  ?>	
	
	</td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID != '67') && ($category->cat_ID != '66') && ($category->cat_ID != '57') && ($category->cat_ID != '58') && ($category->cat_ID != '144') && ($category->cat_ID != '70') && ($category->cat_ID != '71') && ($category->cat_ID != '72') && ($category->cat_ID != '73') && ($category->cat_ID != '74') && ($category->cat_ID != '75') && ($category->cat_ID != '184')) {	
    	echo $category->cat_name . ' '; 
    }
}  ?></td><td><?php the_title(); ?></td><td><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></td><td><?php
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66') {	
    	echo $category->cat_name; 
	}
}  ?></td><td>	<?php 
			$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			$entrega = $entrega[0];
			$entrega = explode('/', $entrega);
			if ($entrega[0] != ''){
				$entregado = $entrega[2].'-'.$entrega[0].'-'.$entrega[1];
				$entrega = $entrega[1].'/'.$entrega[0].'/'.$entrega[2];

				$date1 = $entregado;
				$date2 = time();
				$dateArr  = explode("-",$date1);
				$date1Int = mktime(0,0,0,$dateArr[1],$dateArr[2],$dateArr[0]) ;
				$diff = $date2-$date1Int;
					if (($diff > $halfday) && ($diff < $completeday)) {
						echo '<span style="font-weight:bold;color:red;border:1px solid black;padding:1px;">'.$entrega.'</span>';
					} 
					
					elseif ($diff > $completeday){
						echo '<span style="font-weight:bold;color:white;border:1px solid black;padding:1px;background-color:red;">'.$entrega.'</span>';
					} 
					
					else {
						echo '<span style="font-weight:bold;padding:1px;">'.$entrega.'</span>';
					}
					


			}



			?>
</td></tr>
		<?php endwhile; ?>
	<?php endif; ?>
  <?php rewind_posts(); ?>
<?php query_posts('cat=66,67,-57,-58,-71,-72,-73,-74,-75,-184&showposts=-1'); ?>

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>



	<tr style="background-color:<?php
$exit = 0;
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'):
    	echo '#aaa';
    	$exit = 1;
    endif;
    if ($exit != 1):
 	   if ($category->cat_ID == '57') echo '#FFF3EB';
 	   if ($category->cat_ID == '58') echo '#EBEBFF'; 
 	   if ($category->cat_ID == '144') echo '#EBFFEB';
	endif;
 } ?>	
;"><td style="background-color:<?php foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '70') echo '#0f0';
    if ($category->cat_ID == '71') echo '#0f6'; 
    if ($category->cat_ID == '72') echo '#0ff';
    if ($category->cat_ID == '73') echo '#f0f';
    if ($category->cat_ID == '74') echo '#f06';
    if ($category->cat_ID == '75') echo '#f00'; 
}  ?>">
<?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '70') || ($category->cat_ID == '71') || ($category->cat_ID == '72') || ($category->cat_ID == '73') || ($category->cat_ID == '74') || ($category->cat_ID == '75') || ($category->cat_ID == '184')) {	
    	echo $category->cat_name; 
	}
}  ?>	
	
	</td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID != '67') && ($category->cat_ID != '66') && ($category->cat_ID != '57') && ($category->cat_ID != '58') && ($category->cat_ID != '144') && ($category->cat_ID != '70') && ($category->cat_ID != '71') && ($category->cat_ID != '72') && ($category->cat_ID != '73') && ($category->cat_ID != '74') && ($category->cat_ID != '75') && ($category->cat_ID != '184')) {	
    	echo $category->cat_name . ' '; 
    }
}  ?></td><td><?php the_title(); ?></td><td><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></td><td><?php
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66') {	
    	echo $category->cat_name; 
	}
}  ?></td><td>	<?php 
			$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			$entrega = $entrega[0];
			$entrega = explode('/', $entrega);
			if ($entrega[0] != ''){
				$entregado = $entrega[2].'-'.$entrega[0].'-'.$entrega[1];
				$entrega = $entrega[1].'/'.$entrega[0].'/'.$entrega[2];

				$date1 = $entregado;
				$date2 = time();
				$dateArr  = explode("-",$date1);
				$date1Int = mktime(0,0,0,$dateArr[1],$dateArr[2],$dateArr[0]) ;
				$diff = $date2-$date1Int;
					if (($diff > $halfday) && ($diff < $completeday)) {
						echo '<span style="font-weight:bold;color:red;border:1px solid black;padding:1px;">'.$entrega.'</span>';
					} 
					
					elseif ($diff > $completeday){
						echo '<span style="font-weight:bold;color:white;border:1px solid black;padding:1px;background-color:red;">'.$entrega.'</span>';
					} 
					
					else {
						echo '<span style="font-weight:bold;padding:1px;">'.$entrega.'</span>';
					}
					


			}



			?>
</td></tr>
		<?php endwhile; ?>
	<?php endif; ?>

  <?php rewind_posts(); ?>
<?php query_posts('cat=66,67,-57,-58,-71,-72,-73,-74,-75,-70&showposts=-1'); ?>

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>



	<tr style="background-color:<?php
$exit = 0;
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'):
    	echo '#aaa';
    	$exit = 1;
    endif;
    if ($exit != 1):
 	   if ($category->cat_ID == '57') echo '#FFF3EB';
 	   if ($category->cat_ID == '58') echo '#EBEBFF'; 
 	   if ($category->cat_ID == '144') echo '#EBFFEB';
	endif;
 } ?>	
;"><td style="background-color:<?php foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '70') echo '#0f0';
    if ($category->cat_ID == '71') echo '#0f6'; 
    if ($category->cat_ID == '72') echo '#0ff';
    if ($category->cat_ID == '73') echo '#f0f';
    if ($category->cat_ID == '74') echo '#f06';
    if ($category->cat_ID == '75') echo '#f00'; 
}  ?>">
<?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '70') || ($category->cat_ID == '71') || ($category->cat_ID == '72') || ($category->cat_ID == '73') || ($category->cat_ID == '74') || ($category->cat_ID == '75') || ($category->cat_ID == '184')) {	
    	echo $category->cat_name; 
	}
}  ?>	
	
	</td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID != '67') && ($category->cat_ID != '66') && ($category->cat_ID != '57') && ($category->cat_ID != '58') && ($category->cat_ID != '144') && ($category->cat_ID != '70') && ($category->cat_ID != '71') && ($category->cat_ID != '72') && ($category->cat_ID != '73') && ($category->cat_ID != '74') && ($category->cat_ID != '75') && ($category->cat_ID != '184')) {	
    	echo $category->cat_name . ' '; 
    }
}  ?></td><td><?php the_title(); ?></td><td><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></td><td><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></td><td><?php
foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66') {	
    	echo $category->cat_name; 
	}
}  ?></td><td>	<?php 
			$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			$entrega = $entrega[0];
			$entrega = explode('/', $entrega);
			if ($entrega[0] != ''){
				$entregado = $entrega[2].'-'.$entrega[0].'-'.$entrega[1];
				$entrega = $entrega[1].'/'.$entrega[0].'/'.$entrega[2];

				$date1 = $entregado;
				$date2 = time();
				$dateArr  = explode("-",$date1);
				$date1Int = mktime(0,0,0,$dateArr[1],$dateArr[2],$dateArr[0]) ;
				$diff = $date2-$date1Int;
					if (($diff > $halfday) && ($diff < $completeday)) {
						echo '<span style="font-weight:bold;color:red;border:1px solid black;padding:1px;">'.$entrega.'</span>';
					} 
					
					elseif ($diff > $completeday){
						echo '<span style="font-weight:bold;color:white;border:1px solid black;padding:1px;background-color:red;">'.$entrega.'</span>';
					} 
					
					else {
						echo '<span style="font-weight:bold;padding:1px;">'.$entrega.'</span>';
					}
					


			}



			?>
</td></tr>
		<?php endwhile; ?>
	<?php endif; ?>






</table>
		</div>


<?php get_footer(); ?>






