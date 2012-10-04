<?php /*
Template Name: Informe RaveN entrega
*/

 get_header(); ?>


<?php // Variables globales

$halfday = 60;
$completeday = 24*60*60;
$twodays = 24*2*60*60;
$week = 5*24*60*60;
$month = 28*24*60*60;
$nweek = 10*24*60*60;
$counterpast = 0;
$counter6 = 0;
$counter5 = 0;
$counter4 = 0;
$counter3 = 0;
$counter2 = 0;
$counter1 = 0;
$counter0 = 0;
?>


<div id="main">


 
<div align="center"><strong><span style="font-size:22px;"> <a href="http://interno.mecus.es/informes/">PRIORIDAD</a> || <a href="http://interno.mecus.es/entrega/">FECHA ENTREGA</a> || <a href="http://interno.mecus.es/timeline/">TIMELINE</a> || <a href="http://interno.mecus.es/espera/">EN ESPERA</a> || <a href="http://interno.mecus.es/sin-fecha/">SIN FECHA</a></span> <br /> <span style="font-variant:small-caps;font-size:16px;"><a href="http://interno.mecus.es/category/abierto/">Abiertos</a> || <a href="http://interno.mecus.es/category/wait/">En Espera</a> || <a href="http://interno.mecus.es/category/done/">Cerrados</a> || <a href="http://interno.mecus.es/category/luis/">Luis</a> || <a href="http://interno.mecus.es/category/rocio/">Rocío</a> || <a href="http://interno.mecus.es/category/raven/">RaveN</a></span></strong></div>


<table class="informe">
	<tr>
		<td class="priority p1" width="90" style="font-weight:bold;text-align:center;">PRIORIDAD</td>  
		<td width="10">&nbsp;</td><td width="500">Título del ticket</td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:grey;color:white;padding:5px;">Usuario</span></td>
		<td width="100" style="text-align:center;">Fecha ticket</td>
		<td width="200"><strong>Fecha entrega</strong></td>

		
		
	</tr>
	<tr><td colspan="6">&nbsp;</td></tr>

<?php $informes = $wpdb->get_results("SELECT *  FROM $wpdb->postmeta WHERE meta_key = '_refactord-datepicker' ORDER BY meta_value ASC"); ?>

<?php foreach ( $informes as $informe ){ 

		$cerrado = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$informe->post_id' AND term_taxonomy_id = '66'"); 
		if ( $cerrado != '0' ){
			$ent = $informe->meta_value;
			$ent = explode('/', $ent);
			if ( ( $ent[0] != '' ) && ( '2011' == $ent[2] ) ) {

	query_posts('p='.$informe->post_id); // el artículo ?> 

<?php while (have_posts()) : the_post(); ?>

<?php 
// CATEGORÍAS Y COLORES
	if (in_category('57')): $user = 'RaveN'; $color = '#f60'; endif; 
	if (in_category('58')): $user = 'Luis'; $color = 'blue';endif;
	if (in_category('144')): $user = 'Rocío'; $color = 'green';endif;
	if (in_category('66')): $color = '#aaa'; endif;
	
	if (in_category('70')): $pn = 'p1'; $prioridad = 'BAJA'; endif;
	if (in_category('71')): $pn = 'p2'; $prioridad = 'MEDIA'; endif;
	if (in_category('72')): $pn = 'p3'; $prioridad = 'ALTA'; endif;
	if (in_category('73')): $pn = 'p4'; $prioridad = 'URGENTE'; endif;
	if (in_category('74')): $pn = 'p5'; $prioridad = 'EMERGENCIA'; endif;
	if (in_category('75')): $pn = 'p6'; $prioridad = 'CR&Iacute;TICA'; endif;
	if (in_category('184')): $pn = 'p0'; $prioridad = 'SIN PRIORIDAD'; endif;
	if (in_category('215')): $user = 'Milestone'; $color = 'black'; $pn = 'pm'; $prioridad = 'MILESTONE'; endif;
?>

<?php// if (!in_category('215')): ?>

	<tr>
		<td class="priority <?= $pn ?>" width="90" style="font-weight:bold;text-align:center;"><?= $prioridad ?></td>  
		<td width="10">&nbsp;</td><td width="500"<?php if ($user == 'Milestone') echo ' style="border: 1px solid black;padding: 0 0 0 2px;"'; ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:<?= $color ?>	
			;color:white;padding:5px;"><?= $user ?></span></td>


		<td width="100" style="text-align:center;"><?php
		$fecha = explode(" ", $post->post_date);
		$mostrar = explode('-',$fecha[0]);
		$mostrar = $mostrar[2].'/'.$mostrar[1].'/'.$mostrar[0];
		 echo $mostrar; ?></td>


		<td width="200"><?php 
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
						echo '<span style="font-weight:bold;color:red;border:1px solid black;padding:4px;">'.$entrega.'</span>';
					} 
					
					elseif ($diff > $completeday){
						echo '<span style="font-weight:bold;color:white;border:1px solid black;padding:4px;background-color:red;">'.$entrega.'</span>';
					} 
					
					else {
						echo '<span style="font-weight:bold;padding:4px;">'.$entrega.'</span>';
					}
					


			}



			?></td>
		<?php //endif; ?>
		
	</tr>
	
<?php endwhile;


			} // if $entrega
		} // if $cerrado

?> 
<?php } ?>

	<tr><td colspan="6">&nbsp;</td></tr>
<?php $linear = '00';?>
<?php $lineardb = '00'; 
 foreach ($informes as $informe){ ?>

<?php $cerrado = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$informe->post_id' AND term_taxonomy_id = '66'"); ?>
<?php	 if ($cerrado != '0'): 
			$ent = $informe->meta_value;
			$ent = explode('/', $ent);
			if ( ( $ent[0] != '' ) && ( '2012' == $ent[2] ) ) {
			$linear2 = $ent[0];
			$linearday = $ent[1];
			if ( $linear2 != $linear ){
				switch ($linear2) {
				    case '01':
				        $mes = 'enero';
				        break;
				    case '02':
				        $mes = 'febrero';
				        break;
				    case '03':
				        $mes = 'marzo';
				        break;
				    case '04':
				        $mes = 'abril';
				        break;
				    case '05':
				        $mes = 'mayo';
				        break;
				    case '06':
				        $mes = 'junio';
				        break;
				    case '07':
				        $mes = 'julio';
				        break;
				    case '08':
				        $mes = 'agosto';
				        break;
				    case '09':
				        $mes = 'septiembre';
				        break;
				    case '10':
				        $mes = 'octubre';
				        break;
				    case '11':
				        $mes = 'noviembre';
				        break;
				    case '12':
				        $mes = 'diciembre';
				        break;
				} // switch case

				echo '<tr><td colspan="6"><div style="text-align:center;font-size:20px;padding: 8px;font-weight:bold;color:red;border-top:3px solid black;border-bottom:3px solid black;text-transform:uppercase;">'.$mes.'</div></td></tr>';
				$linear = $linear2;
			} // if linear
			
			if ( $linearday != $lineardb ){
				$dia = $linearday;
				$dia = date("D", mktime(0, 0, 0, $ent[0], $ent[1], $ent[2]));
				switch ($dia){
					case 'Mon':
						$dia = 'Lunes';
						break;
					case 'Tue':
						$dia = 'Martes';
						break;
					case 'Wed':
						$dia = 'Miércoles';
						break;
					case 'Thu':
						$dia = 'Jueves';
						break;
					case 'Fri':
						$dia = 'Viernes';
						break;
					case 'Sat':
						$dia = 'Sábado';
						break;
					case 'Sun':
						$dia = 'Domingo';
						break;
				} // switch
				
				if ( ( 'Sábado' == $dia ) || ( 'Domingo' == $dia ) ) { $festivo = 'color:red;font-weight:bold;'; } else { $festivo = 'font-weight:100;color:black;'; }
				
				echo '<tr><td colspan="6"><div style="padding-top:20px;text-align:center;font-size:10px;border-bottom:1px solid #aaa;'.$festivo.'">'.$dia.' '.$ent[1].' de '.$mes.' de '.$ent[2].'</div></td></tr>';
				$lineardb = $linearday;
			} // if $linearday    


	query_posts( 'p=' . $informe->post_id . '&cat=' . $cat_priority ); // el artículo ?> 

<?php while (have_posts()) : the_post(); ?>

<?php 
// CATEGORÍAS Y COLORES
	if (in_category('57')): $user = 'RaveN'; $color = '#f60'; endif; 
	if (in_category('58')): $user = 'Luis'; $color = 'blue';endif;
	if (in_category('144')): $user = 'Rocío'; $color = 'green';endif;
	if (in_category('66')): $color = '#aaa'; endif;
	
	if (in_category('70')): $pn = 'p1'; $prioridad = 'BAJA'; endif;
	if (in_category('71')): $pn = 'p2'; $prioridad = 'MEDIA'; endif;
	if (in_category('72')): $pn = 'p3'; $prioridad = 'ALTA'; endif;
	if (in_category('73')): $pn = 'p4'; $prioridad = 'URGENTE'; endif;
	if (in_category('74')): $pn = 'p5'; $prioridad = 'EMERGENCIA'; endif;
	if (in_category('75')): $pn = 'p6'; $prioridad = 'CR&Iacute;TICA'; endif;
	if (in_category('184')): $pn = 'p0'; $prioridad = 'SIN PRIORIDAD'; endif;
	if (in_category('215')): $user = 'Milestone'; $color = 'black'; $pn = 'pm'; $prioridad = 'EVENTO'; endif;
?>

<?php //if (!in_category('215')): ?>
	<tr>
		<td class="priority <?= $pn ?>" width="90" style="font-weight:bold;text-align:center;"><?= $prioridad ?></td>  
		<td width="10">&nbsp;</td><td width="500"<?php if ($user == 'Milestone') echo ' style="border: 1px solid black;padding: 0 0 0 2px;background-color:#aaa;"'; ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:<?= $color ?>	
			;color:white;padding:5px;"><?php if ($user == 'Milestone') {echo 'EVENTO'; } else { echo $user; } ?></span></td>


		<td width="100" style="text-align:center;"><?php
		$fecha = explode(" ", $post->post_date);
		$mostrar = explode('-',$fecha[0]);
		$mostrar = $mostrar[2].'/'.$mostrar[1].'/'.$mostrar[0];
		
		if ( $user == 'Milestone' ) { 
			$hora = $wpdb->get_var( "SELECT meta_value FROM $wpdb->postmeta WHERE post_id = '$informe->post_id' and meta_key = 'hora'" ); 
			echo $hora;
		} else { 
			echo $mostrar; 
		} ?></td>


		<td width="200"><?php 
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
				if ( $user == 'Milestone' ) { 
					echo '<span style="font-weight:bold;border: 1px solid black;padding: 4px;background-color:#aaa;">'.$entrega.'</span>';
				
				} else {
					$diff = $date2-$date1Int;
						if (($diff > $halfday) && ($diff < $completeday)) {
							echo '<span style="font-weight:bold;color:red;border:1px solid black;padding:4px;">'.$entrega.'</span>';
						} 
						
						elseif ($diff > $completeday){
							echo '<span style="font-weight:bold;color:white;border:1px solid black;padding:4px;background-color:red;">'.$entrega.'</span>';
						} 
						
						else {
							echo '<span style="font-weight:bold;padding:4px;">'.$entrega.'</span>';
						}
				}


			}



			?></td>
		<?php //endif; ?>
		
	</tr>
	
<?php endwhile; 

} ?>

<?php endif; ?>	


<?php } ?>

	<tr><td colspan="6">&nbsp;</td></tr>
<?php $linear = '00';?>
<?php $lineardb = '00'; 
 foreach ($informes as $informe){ ?>

<?php $cerrado = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$informe->post_id' AND term_taxonomy_id = '66'"); ?>
<?php	 if ($cerrado != '0'): 
			$ent = $informe->meta_value;
			$ent = explode('/', $ent);
			if ( ( $ent[0] != '' ) && ( '2013' == $ent[2] ) ) {
			$linear2 = $ent[0];
			$linearday = $ent[1];
			if ( $linear2 != $linear ){
				switch ($linear2) {
				    case '01':
				        $mes = 'enero';
				        break;
				    case '02':
				        $mes = 'febrero';
				        break;
				    case '03':
				        $mes = 'marzo';
				        break;
				    case '04':
				        $mes = 'abril';
				        break;
				    case '05':
				        $mes = 'mayo';
				        break;
				    case '06':
				        $mes = 'junio';
				        break;
				    case '07':
				        $mes = 'julio';
				        break;
				    case '08':
				        $mes = 'agosto';
				        break;
				    case '09':
				        $mes = 'septiembre';
				        break;
				    case '10':
				        $mes = 'octubre';
				        break;
				    case '11':
				        $mes = 'noviembre';
				        break;
				    case '12':
				        $mes = 'diciembre';
				        break;
				} // switch case

				echo '<tr><td colspan="6"><div style="text-align:center;font-size:20px;padding: 8px;font-weight:bold;color:red;border-top:3px solid black;border-bottom:3px solid black;text-transform:uppercase;">'.$mes.'</div></td></tr>';
				$linear = $linear2;
			} // if linear
			
			if ( $linearday != $lineardb ){
				$dia = $linearday;
				$dia = date("D", mktime(0, 0, 0, $ent[0], $ent[1], $ent[2]));
				switch ($dia){
					case 'Mon':
						$dia = 'Lunes';
						break;
					case 'Tue':
						$dia = 'Martes';
						break;
					case 'Wed':
						$dia = 'Miércoles';
						break;
					case 'Thu':
						$dia = 'Jueves';
						break;
					case 'Fri':
						$dia = 'Viernes';
						break;
					case 'Sat':
						$dia = 'Sábado';
						break;
					case 'Sun':
						$dia = 'Domingo';
						break;
				} // switch
				
				if ( ( 'Sábado' == $dia ) || ( 'Domingo' == $dia ) ) { $festivo = 'color:red;font-weight:bold;'; } else { $festivo = 'font-weight:100;color:black;'; }
				
				echo '<tr><td colspan="6"><div style="padding-top:20px;text-align:center;font-size:10px;border-bottom:1px solid #aaa;'.$festivo.'">'.$dia.' '.$ent[1].' de '.$mes.' de '.$ent[2].'</div></td></tr>';
				$lineardb = $linearday;
			} // if $linearday




	query_posts('p='.$informe->post_id); // el artículo ?> 

<?php while (have_posts()) : the_post(); ?>

<?php 
// CATEGORÍAS Y COLORES
	if (in_category('57')): $user = 'RaveN'; $color = '#f60'; endif; 
	if (in_category('58')): $user = 'Luis'; $color = 'blue';endif;
	if (in_category('144')): $user = 'Rocío'; $color = 'green';endif;
	if (in_category('66')): $color = '#aaa'; endif;
	
	if (in_category('70')): $pn = 'p1'; $prioridad = 'BAJA'; endif;
	if (in_category('71')): $pn = 'p2'; $prioridad = 'MEDIA'; endif;
	if (in_category('72')): $pn = 'p3'; $prioridad = 'ALTA'; endif;
	if (in_category('73')): $pn = 'p4'; $prioridad = 'URGENTE'; endif;
	if (in_category('74')): $pn = 'p5'; $prioridad = 'EMERGENCIA'; endif;
	if (in_category('75')): $pn = 'p6'; $prioridad = 'CR&Iacute;TICA'; endif;
	if (in_category('184')): $pn = 'p0'; $prioridad = 'SIN PRIORIDAD'; endif;
	if (in_category('215')): $user = 'Milestone'; $color = 'black'; $pn = 'pm'; $prioridad = 'EVENTO'; endif;
?>

<?php //if (!in_category('215')): ?>
	<tr>
		<td class="priority <?= $pn ?>" width="90" style="font-weight:bold;text-align:center;"><?= $prioridad ?></td>  
		<td width="10">&nbsp;</td><td width="500"<?php if ($user == 'Milestone') echo ' style="border: 1px solid black;padding: 0 0 0 2px;background-color:#aaa;"'; ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:<?= $color ?>	
			;color:white;padding:5px;"><?php if ($user == 'Milestone') {echo 'EVENTO'; } else { echo $user; } ?></span></td>


		<td width="100" style="text-align:center;"><?php
		$fecha = explode(" ", $post->post_date);
		$mostrar = explode('-',$fecha[0]);
		$mostrar = $mostrar[2].'/'.$mostrar[1].'/'.$mostrar[0];
		
		if ( $user == 'Milestone' ) { 
			$hora = $wpdb->get_var( "SELECT meta_value FROM $wpdb->postmeta WHERE post_id = '$informe->post_id' and meta_key = 'hora'" ); 
			echo $hora;
		} else { 
			echo $mostrar; 
		} ?></td>


		<td width="200"><?php 
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
				if ( $user == 'Milestone' ) { 
					echo '<span style="font-weight:bold;border: 1px solid black;padding: 4px;background-color:#aaa;">'.$entrega.'</span>';
				
				} else {
					$diff = $date2-$date1Int;
						if (($diff > $halfday) && ($diff < $completeday)) {
							echo '<span style="font-weight:bold;color:red;border:1px solid black;padding:4px;">'.$entrega.'</span>';
						} 
						
						elseif ($diff > $completeday){
							echo '<span style="font-weight:bold;color:white;border:1px solid black;padding:4px;background-color:red;">'.$entrega.'</span>';
						} 
						
						else {
							echo '<span style="font-weight:bold;padding:4px;">'.$entrega.'</span>';
						}
				}


			}



			?></td>
		<?php //endif; ?>
		
	</tr>
	
<?php endwhile; 

} ?>

<?php endif; ?>	


<?php } ?>

	<tr><td colspan="6">&nbsp;</td></tr>
	<tr><td colspan="6">&nbsp;</td></tr>
	<tr style><td colspan="6" style="font-size:30px;text-align:center;font-weight:bold;">Sin fecha, ordenados por prioridad</td></tr>
	<tr><td colspan="6">&nbsp;</td></tr>
	<tr><td colspan="6">&nbsp;</td></tr>


<?php /* PRIORIDAD 6 */ 
query_posts('cat=67,'.$value.'-70,-71,-72,-73,-74,-184&showposts=-1'); ?>
<a name="prioridad6"></a>	


	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

	<?php	$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			if (!$entrega) :
	?>


<?php 
// CATEGORÍAS Y COLORES
	if (in_category('57')): $user = 'RaveN'; $color = '#f60'; endif; 
	if (in_category('58')): $user = 'Luis'; $color = 'blue';endif;
	if (in_category('144')): $user = 'Rocío'; $color = 'green';endif;
	if (in_category('66')): $color = '#aaa'; endif;
	
	if (in_category('70')): $pn = 'p1'; $prioridad = 'BAJA'; endif;
	if (in_category('71')): $pn = 'p2'; $prioridad = 'MEDIA'; endif;
	if (in_category('72')): $pn = 'p3'; $prioridad = 'ALTA'; endif;
	if (in_category('73')): $pn = 'p4'; $prioridad = 'URGENTE'; endif;
	if (in_category('74')): $pn = 'p5'; $prioridad = 'EMERGENCIA'; endif;
	if (in_category('75')): $pn = 'p6'; $prioridad = 'CR&Iacute;TICA'; endif;
	if (in_category('184')): $pn = 'p0'; $prioridad = 'SIN PRIORIDAD'; endif;
	if (in_category('215')): $user = 'Milestone'; $color = 'black'; $pn = 'pm'; $prioridad = 'MILESTONE'; endif;


?>


	<tr>
		<td class="priority <?= $pn ?>" width="90" style="font-weight:bold;text-align:center;"><?= $prioridad ?></td>  
		<td width="10">&nbsp;</td><td width="500"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:<?= $color ?>	
			;color:white;padding:5px;"><?= $user ?></span></td>


		<td width="100" style="text-align:center;"><?php
		$fecha = explode(" ", $post->post_date);
		$mostrar = explode('-',$fecha[0]);
		$mostrar = $mostrar[2].'/'.$mostrar[1].'/'.$mostrar[0];
		 echo $mostrar; ?></td>

		
		
	</tr>
			<?php $counter6++; ?>
		<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>
  <?php rewind_posts(); ?>





<?php /* PRIORIDAD 5 */
query_posts('cat=67,-70,-71,-72,-73,-75,-184&showposts=-1'); ?>
<a name="prioridad5"></a>	

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<?php	$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			if (!$entrega) :
	?>

<?php 
// CATEGORÍAS Y COLORES
	if (in_category('57')): $user = 'RaveN'; $color = '#f60'; endif; 
	if (in_category('58')): $user = 'Luis'; $color = 'blue';endif;
	if (in_category('144')): $user = 'Rocío'; $color = 'green';endif;
	if (in_category('66')): $color = '#aaa'; endif;
	
	if (in_category('70')): $pn = 'p1'; $prioridad = 'BAJA'; endif;
	if (in_category('71')): $pn = 'p2'; $prioridad = 'MEDIA'; endif;
	if (in_category('72')): $pn = 'p3'; $prioridad = 'ALTA'; endif;
	if (in_category('73')): $pn = 'p4'; $prioridad = 'URGENTE'; endif;
	if (in_category('74')): $pn = 'p5'; $prioridad = 'EMERGENCIA'; endif;
	if (in_category('75')): $pn = 'p6'; $prioridad = 'CR&Iacute;TICA'; endif;
	if (in_category('184')): $pn = 'p0'; $prioridad = 'SIN PRIORIDAD'; endif;
	if (in_category('215')): $user = 'Milestone'; $color = 'black'; $pn = 'pm'; $prioridad = 'MILESTONE'; endif;
?>


	<tr>
		<td class="priority <?= $pn ?>" width="90" style="font-weight:bold;text-align:center;"><?= $prioridad ?></td>  
		<td width="10">&nbsp;</td><td width="500"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:<?= $color ?>	
			;color:white;padding:5px;"><?= $user ?></span></td>


		<td width="100" style="text-align:center;"><?php
		$fecha = explode(" ", $post->post_date);
		$mostrar = explode('-',$fecha[0]);
		$mostrar = $mostrar[2].'/'.$mostrar[1].'/'.$mostrar[0];
		 echo $mostrar; ?></td>


		
		
	</tr>
			<?php $counter5++; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>

  <?php rewind_posts(); ?>

<?php /* PRIORIDAD 4 */
 query_posts('cat=67,-70,-71,-72,-74,-75,-184&showposts=-1'); ?>
<a name="prioridad4"></a>	

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<?php	$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			if (!$entrega) :
	?>

<?php 
// CATEGORÍAS Y COLORES
	if (in_category('57')): $user = 'RaveN'; $color = '#f60'; endif; 
	if (in_category('58')): $user = 'Luis'; $color = 'blue';endif;
	if (in_category('144')): $user = 'Rocío'; $color = 'green';endif;
	if (in_category('66')): $color = '#aaa'; endif;
	
	if (in_category('70')): $pn = 'p1'; $prioridad = 'BAJA'; endif;
	if (in_category('71')): $pn = 'p2'; $prioridad = 'MEDIA'; endif;
	if (in_category('72')): $pn = 'p3'; $prioridad = 'ALTA'; endif;
	if (in_category('73')): $pn = 'p4'; $prioridad = 'URGENTE'; endif;
	if (in_category('74')): $pn = 'p5'; $prioridad = 'EMERGENCIA'; endif;
	if (in_category('75')): $pn = 'p6'; $prioridad = 'CR&Iacute;TICA'; endif;
	if (in_category('184')): $pn = 'p0'; $prioridad = 'SIN PRIORIDAD'; endif;
	if (in_category('215')): $user = 'Milestone'; $color = 'black'; $pn = 'pm'; $prioridad = 'MILESTONE'; endif;
?>


	<tr>
		<td class="priority <?= $pn ?>" width="90" style="font-weight:bold;text-align:center;"><?= $prioridad ?></td>  
		<td width="10">&nbsp;</td><td width="500"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:<?= $color ?>	
			;color:white;padding:5px;"><?= $user ?></span></td>


		<td width="100" style="text-align:center;"><?php
		$fecha = explode(" ", $post->post_date);
		$mostrar = explode('-',$fecha[0]);
		$mostrar = $mostrar[2].'/'.$mostrar[1].'/'.$mostrar[0];
		 echo $mostrar; ?></td>


		
		
	</tr>

			<?php $counter4++; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>

  <?php rewind_posts(); ?>

<?php /* PRIORIDAD 3 */
 query_posts('cat=67,-70,-71,-73,-74,-75,-184&showposts=-1'); ?>

<a name="prioridad3"></a>	

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<?php	$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			if (!$entrega) :
	?>

<?php 
// CATEGORÍAS Y COLORES
	if (in_category('57')): $user = 'RaveN'; $color = '#f60'; endif; 
	if (in_category('58')): $user = 'Luis'; $color = 'blue';endif;
	if (in_category('144')): $user = 'Rocío'; $color = 'green';endif;
	if (in_category('66')): $color = '#aaa'; endif;
	
	if (in_category('70')): $pn = 'p1'; $prioridad = 'BAJA'; endif;
	if (in_category('71')): $pn = 'p2'; $prioridad = 'MEDIA'; endif;
	if (in_category('72')): $pn = 'p3'; $prioridad = 'ALTA'; endif;
	if (in_category('73')): $pn = 'p4'; $prioridad = 'URGENTE'; endif;
	if (in_category('74')): $pn = 'p5'; $prioridad = 'EMERGENCIA'; endif;
	if (in_category('75')): $pn = 'p6'; $prioridad = 'CR&Iacute;TICA'; endif;
	if (in_category('184')): $pn = 'p0'; $prioridad = 'SIN PRIORIDAD'; endif;
	if (in_category('215')): $user = 'Milestone'; $color = 'black'; $pn = 'pm'; $prioridad = 'MILESTONE'; endif;
?>


	<tr>
		<td class="priority <?= $pn ?>" width="90" style="font-weight:bold;text-align:center;"><?= $prioridad ?></td>  
		<td width="10">&nbsp;</td><td width="500"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:<?= $color ?>	
			;color:white;padding:5px;"><?= $user ?></span></td>


		<td width="100" style="text-align:center;"><?php
		$fecha = explode(" ", $post->post_date);
		$mostrar = explode('-',$fecha[0]);
		$mostrar = $mostrar[2].'/'.$mostrar[1].'/'.$mostrar[0];
		 echo $mostrar; ?></td>


		
		
	</tr>

			<?php $counter3++; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>

  <?php rewind_posts(); ?>


<?php /* PRIORIDAD 2 */
 query_posts('cat=67,-70,-72,-73,-74,-75,-184&showposts=-1'); ?>

<a name="prioridad2"></a>	

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<?php	$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			if (!$entrega) :
	?>

<?php 
// CATEGORÍAS Y COLORES
	if (in_category('57')): $user = 'RaveN'; $color = '#f60'; endif; 
	if (in_category('58')): $user = 'Luis'; $color = 'blue';endif;
	if (in_category('144')): $user = 'Rocío'; $color = 'green';endif;
	if (in_category('66')): $color = '#aaa'; endif;
	
	if (in_category('70')): $pn = 'p1'; $prioridad = 'BAJA'; endif;
	if (in_category('71')): $pn = 'p2'; $prioridad = 'MEDIA'; endif;
	if (in_category('72')): $pn = 'p3'; $prioridad = 'ALTA'; endif;
	if (in_category('73')): $pn = 'p4'; $prioridad = 'URGENTE'; endif;
	if (in_category('74')): $pn = 'p5'; $prioridad = 'EMERGENCIA'; endif;
	if (in_category('75')): $pn = 'p6'; $prioridad = 'CR&Iacute;TICA'; endif;
	if (in_category('184')): $pn = 'p0'; $prioridad = 'SIN PRIORIDAD'; endif;
	if (in_category('215')): $user = 'Milestone'; $color = 'black'; $pn = 'pm'; $prioridad = 'MILESTONE'; endif;
?>


	<tr>
		<td class="priority <?= $pn ?>" width="90" style="font-weight:bold;text-align:center;"><?= $prioridad ?></td>  
		<td width="10">&nbsp;</td><td width="500"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:<?= $color ?>	
			;color:white;padding:5px;"><?= $user ?></span></td>


		<td width="100" style="text-align:center;"><?php
		$fecha = explode(" ", $post->post_date);
		$mostrar = explode('-',$fecha[0]);
		$mostrar = $mostrar[2].'/'.$mostrar[1].'/'.$mostrar[0];
		 echo $mostrar; ?></td>


		
		
	</tr>
			<?php $counter2++; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>

  <?php rewind_posts(); ?>


<?php /* PRIORIDAD 1 */
 query_posts('cat=67,-71,-72,-73,-74,-75,-184&showposts=-1'); ?>

<a name="prioridad1">&nbsp;</a>	

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<?php	$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			if (!$entrega) :
	?>

<?php 
// CATEGORÍAS Y COLORES
	if (in_category('57')): $user = 'RaveN'; $color = '#f60'; endif; 
	if (in_category('58')): $user = 'Luis'; $color = 'blue';endif;
	if (in_category('144')): $user = 'Rocío'; $color = 'green';endif;
	if (in_category('66')): $color = '#aaa'; endif;
	
	if (in_category('70')): $pn = 'p1'; $prioridad = 'BAJA'; endif;
	if (in_category('71')): $pn = 'p2'; $prioridad = 'MEDIA'; endif;
	if (in_category('72')): $pn = 'p3'; $prioridad = 'ALTA'; endif;
	if (in_category('73')): $pn = 'p4'; $prioridad = 'URGENTE'; endif;
	if (in_category('74')): $pn = 'p5'; $prioridad = 'EMERGENCIA'; endif;
	if (in_category('75')): $pn = 'p6'; $prioridad = 'CR&Iacute;TICA'; endif;
	if (in_category('184')): $pn = 'p0'; $prioridad = 'SIN PRIORIDAD'; endif;
	if (in_category('215')): $user = 'Milestone'; $color = 'black'; $pn = 'pm'; $prioridad = 'MILESTONE'; endif;
?>


	<tr>
		<td class="priority <?= $pn ?>" width="90" style="font-weight:bold;text-align:center;"><?= $prioridad ?></td>  
		<td width="10">&nbsp;</td><td width="500"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:<?= $color ?>	
			;color:white;padding:5px;"><?= $user ?></span></td>


		<td width="100" style="text-align:center;"><?php
		$fecha = explode(" ", $post->post_date);
		$mostrar = explode('-',$fecha[0]);
		$mostrar = $mostrar[2].'/'.$mostrar[1].'/'.$mostrar[0];
		 echo $mostrar; ?></td>


		
		
	</tr>


			<?php $counter1++; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>

  <?php rewind_posts(); ?>


<?php /* PRIORIDAD 0 */
 query_posts('cat=67,-71,-72,-73,-74,-75,-70&showposts=-1'); ?>

<a name="prioridad0"></a>	

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<?php	$entrega = get_post_meta($post->ID, '_refactord-datepicker');  
			if (!$entrega) :
	?>

<?php 
// CATEGORÍAS Y COLORES
	if (in_category('57')): $user = 'RaveN'; $color = '#f60'; endif; 
	if (in_category('58')): $user = 'Luis'; $color = 'blue';endif;
	if (in_category('144')): $user = 'Rocío'; $color = 'green';endif;
	if (in_category('66')): $color = '#aaa'; endif;
	
	if (in_category('70')): $pn = 'p1'; $prioridad = 'BAJA'; endif;
	if (in_category('71')): $pn = 'p2'; $prioridad = 'MEDIA'; endif;
	if (in_category('72')): $pn = 'p3'; $prioridad = 'ALTA'; endif;
	if (in_category('73')): $pn = 'p4'; $prioridad = 'URGENTE'; endif;
	if (in_category('74')): $pn = 'p5'; $prioridad = 'EMERGENCIA'; endif;
	if (in_category('75')): $pn = 'p6'; $prioridad = 'CR&Iacute;TICA'; endif;
	if (in_category('184')): $pn = 'p0'; $prioridad = 'SIN PRIORIDAD'; endif;
	if (in_category('215')): $user = 'Milestone'; $color = 'black'; $pn = 'pm'; $prioridad = 'MILESTONE'; endif;
?>


	<tr>
		<td class="priority <?= $pn ?>" width="90" style="font-weight:bold;text-align:center;"><?= $prioridad ?></td>  
		<td width="10">&nbsp;</td><td width="500"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:<?= $color ?>	
			;color:white;padding:5px;"><?= $user ?></span></td>


		<td width="100" style="text-align:center;"><?php
		$fecha = explode(" ", $post->post_date);
		$mostrar = explode('-',$fecha[0]);
		$mostrar = $mostrar[2].'/'.$mostrar[1].'/'.$mostrar[0];
		 echo $mostrar; ?></td>


		
		
	</tr>

			<?php $counter0++; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>

  <?php rewind_posts(); ?>
</table>

<table class="informe">

		<td class="priority p6" width="90" style="font-weight:bold;text-align:center;"><?php echo $counter6; ?></td>  
		<td class="priority p5" width="90" style="font-weight:bold;text-align:center;"><?php echo $counter5; ?></td>
		<td class="priority p4" width="90" style="font-weight:bold;text-align:center;"><?php echo $counter4; ?></td>
		<td class="priority p3" width="90" style="font-weight:bold;text-align:center;"><?php echo $counter3; ?></td>
		<td class="priority p2" width="90" style="font-weight:bold;text-align:center;"><?php echo $counter2; ?></td>
		<td class="priority p1" width="90" style="font-weight:bold;text-align:center;"><?php echo $counter1; ?></td>
		<td class="priority p0" width="90" style="font-weight:bold;text-align:center;"><?php echo $counter0; ?></td>
</table>



<?php get_footer(); ?>






