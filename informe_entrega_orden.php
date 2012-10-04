<?php /*
Template Name: Informes fechas entrega ordenado
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
$odd = 0;
$date = date('m/d/Y');

$proyectos = get_option('bach_projects'); 
$projects = get_cat_id($proyectos);

$cat = $_GET['cat'];

?>


<div id="main">


 
<div align="center"><strong><span style="font-size:22px;"> <a href="http://interno.mecus.es/informes/">PRIORIDAD</a> || <a href="http://interno.mecus.es/entrega/">FECHA ENTREGA</a> || <a href="http://interno.mecus.es/timeline/">TIMELINE</a> || <a href="http://interno.mecus.es/espera/">EN ESPERA</a> || <a href="http://interno.mecus.es/sin-fecha/">SIN FECHA</a></span><!-- <br /> <span style="font-variant:small-caps;font-size:16px;"><a href="http://interno.mecus.es/category/abierto/">Abiertos</a> || <a href="http://interno.mecus.es/category/wait/">En Espera</a> || <a href="http://interno.mecus.es/category/done/">Cerrados</a> || <a href="http://interno.mecus.es/category/luis/">Luis</a> || <a href="http://interno.mecus.es/category/rocio/">Rocío</a> || <a href="http://interno.mecus.es/category/raven/">RaveN</a></span>--></strong></div>

<div style="font-size:16px;margin-top:30px;text-decoration:underline;"><a href="#actual-day">Ir al día de hoy &darr;</a></div>



<div style="display:block;float:right;height:10px;">
<div style="float:right;">

<select name="usuario" id="usuario" class="postform" tabindex="6">
	<option value="-1">Usuario</option>
	<option class="level-0" value="58">Luis</option>
	<option class="level-0" value="144">Rocío</option>
	<option class="level-0" value="57">RaveN</option>
</select>
</div>

<script type="text/javascript"><!--
    var dropdown = document.getElementById("usuario");
    function onUsrChange() {
		if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
			location.href = "<?php echo get_option('home');
?>/entrega/?cat="+dropdown.options[dropdown.selectedIndex].value;
		}
    }
    dropdown.onchange = onUsrChange;
--></script>


<div style="float:right;">
	            <?php wp_dropdown_categories( array(
                'hide_empty' => 0,
                'hide_if_empty' => false,
                'name' => 'proyecto',
                'orderby' => 'name',
                //'class' => 'catSelection',
                'hierarchical' => 1,
                'child_of' => $projects,
                'show_option_none' => __('Proyecto'),
                //'selected' => ,  // how to select default cat by default?
                'tab_index' => 5
                )
            ); ?>
</div>

<script type="text/javascript"><!--
    var dropdown = document.getElementById("proyecto");
    function onCatChange() {
		if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
			location.href = "<?php echo get_option('home');
?>/entrega/?cat="+dropdown.options[dropdown.selectedIndex].value;
		}
    }
    dropdown.onchange = onCatChange;
--></script>
</div>




<table class="informe" cellspacing="0" cellpadding="0" style="margin-top:20px;">
<!--	<tr>
		<td class="priority p1" width="90" style="font-weight:bold;text-align:center;">PRIORIDAD</td>  
		<td width="10">&nbsp;</td><td width="500">Título del ticket</td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:grey;color:white;padding:5px;">Usuario</span></td>
		<td width="100" style="text-align:center;">Fecha ticket</td>
		<td width="200"><strong>Fecha entrega</strong></td>

		
		
	</tr>-->
	<tr><td colspan="6">&nbsp;</td></tr>

<?php 
	for ( $i = 1; $i <= 3; $i++ ){
		switch ( $i ) {
			case 1 :
				$year = '2011';
				break;
			case 2 :
				$year = '2012';
				break;
			case 3 :
				$year = '2013';
				break;		
		}	// switch year	
						echo '<tr><td colspan="6"><div style="text-align:center;font-size:30px;padding: 8px;font-weight:bold;color:red;border-top:3px solid black;border-bottom:3px solid black;text-transform:uppercase;">'.$year.'</div></td></tr>';

		for ( $j = 1; $j <= 12; $j++ ){
			switch ( $j ) {
				case 1 :
					$monthnum = '01';
					$month = 'enero';
					break;
				case 2 :
					$monthnum = '02';
					$month = 'febrero';
					break;
				case 3 :
					$monthnum = '03';
					$month = 'marzo';
					break;
				case 4 :
					$monthnum = '04';
					$month = 'abril';
					break;
				case 5 :
					$monthnum = '05';
					$month = 'mayo';
					break;
				case 6 :
					$monthnum = '06';
					$month = 'junio';
					break;
				case 7 :
					$monthnum = '07';
					$month = 'julio';
					break;
				case 8 :
					$monthnum = '08';
					$month = 'agosto';
					break;
				case 9 :
					$monthnum = '09';
					$month = 'septiembre';
					break;
				case 10 :
					$monthnum = '10';
					$month = 'octubre';
					break;
				case 11 :
					$monthnum = '11';
					$month = 'noviembre';
					break;
				case 12 :
					$monthnum = '12';
					$month = 'diciembre';
					break;
			
			} // switch month
			$countermonth = 0;
		
			for ( $k = 1; $k <= 31; $k++) {

				$dia = date("D", mktime(0, 0, 0, $monthnum, $k, $year));
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
				
				if ( $k < 10 ) {
					$day = '0' . $k;
				} else {
					$day = $k;
				} 
				
				$refactord_datepicker = $monthnum . '/' . $day . '/' . $year;
				$informes = $wpdb->get_results( "SELECT *  FROM $wpdb->postmeta WHERE meta_key = '_refactord-datepicker' AND meta_value = '$refactord_datepicker' ORDER BY post_id ASC" );
				$counterinforme = 0;
				for ( $l = 1; $l <= 8; $l++ ) {
					switch ( $l ) {
						case 1:
							$priority = '215';
							$prioridad = 'EVENTO';
							$pn = 'pm';
							break;
						case 2:
							$priority = '75';
							$pn = 'p6';
							$prioridad = 'CR&Iacute;TICA';
							break;
						case 3:
							$priority = '74';
							$pn = 'p5';
							$prioridad = 'EMERGENCIA';
							break;
						case 4:
							$priority = '73';
							$pn = 'p4'; 
							$prioridad = 'URGENTE';
							break;
						case 5:
							$priority = '72';
							$pn = 'p3';
							$prioridad = 'ALTA';
							break;
						case 6:
							$priority = '71';
							$pn = 'p2'; 
							$prioridad = 'MEDIA';
							break;
						case 7:
							$priority = '70';
							$pn = 'p1';
							$prioridad = 'BAJA';
							break;
						case 8:
							$priority = '184';
							$pn = 'p0';
							 $prioridad = 'SIN PRIORIDAD';
							break;
					} // switch priority
				
					foreach ( $informes as $informe ) { 
						$cerrado = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$informe->post_id' AND term_taxonomy_id = '66'"); 
						if ( $cerrado != '0' ) {
					if ( $countermonth == 0 ) {
						echo '<tr><td colspan="6"><div style="text-align:center;font-size:20px;padding: 8px;font-weight:bold;color:red;border-top:3px solid black;border-bottom:3px solid black;text-transform:uppercase;">'.$month.'</div></td></tr>';
						$countermonth = 1;
					}	
		
						
				

							query_posts( 'p='.$informe->post_id );

							while (have_posts()) : the_post(); 
								if ( in_category( $priority ) ) {
								if (in_category('215')): $user = 'Milestone'; $color = '#000'; endif; 
								if (in_category('57')): $user = 'RaveN'; $color = '#f60'; endif; 
								if (in_category('58')): $user = 'Luis'; $color = 'blue';endif;
								if (in_category('144')): $user = 'Rocío'; $color = 'green';endif;
								if (in_category('66')): $color = '#aaa'; endif;
							if ( $cat != '' ) {
							 	if ( in_category( $cat ) ){ 
							 		$visible = '1';
									$odd++;
								} else {
									$visible = '0';
								}
							} else {
								$visible = '1';
								$odd++;
							}
?>
<?php 

	if ( $visible == '1' ) {


				if ( $counterinforme == 0 ) {
					$refactord = $monthnum . '/' . $day . '/' . $year;
								
								if ( ( 'Sábado' == $dia ) || ( 'Domingo' == $dia ) ) { $festivo = 'color:red;font-weight:bold;'; } else { $festivo = 'font-weight:100;color:black;'; }
				
				echo '<tr><td colspan="6">';
				if ( $refactord == $date ) echo '<a name="actual-day"></a>';
				echo '<div style="padding-top:20px;text-align:center;font-size:16px;border-bottom:1px solid #aaa;' . $festivo . '">' . $dia . ' '.$k . ' de ' . $month . ' de ' . $year . '</div></td></tr>';
				$counterinforme = 1;				
				}




		if ( $pn == 'p6' ) $counter6++;
		if ( $pn == 'p5' ) $counter5++;
		if ( $pn == 'p4' ) $counter4++;
		if ( $pn == 'p3' ) $counter3++;
		if ( $pn == 'p2' ) $counter2++;
		if ( $pn == 'p1' ) $counter1++;
		if ( $pn == 'p0' ) $counter0++;

?>




		<tr <?php if ( $odd % 2 == 0 ) echo 'style="background-color:#ccc;"'; ?>>
		<td class="priority <?= $pn ?>" width="90" style="font-weight:bold;text-align:center;border-bottom:2px solid #fff;"><?= $prioridad ?></td>  
		<td width="10"<?php if ($user == 'Milestone') echo ' style="border: 4px solid #fc0;padding: 0;background-color:#fc0;"'; ?>>&nbsp;</td><td width="500"<?php if ($user == 'Milestone') echo ' style="border: 4px solid #fc0;padding: 0;background-color:#fc0;"'; ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
		<td width="60" style="text-align:center;"><span style="font-weight:bold; background-color:<?= $color ?>;color:white;padding:5px;"><?php if ($user == 'Milestone') {echo 'EVENTO'; } else { echo $user; } ?></span></td>


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
		
	</tr>
	<tr id="content-<?php the_ID(); ?>" style="display:none;">
		<td colspan="6">
			<?php the_content(); ?>
			<?php comments_template(); ?>
		
		</td>
	</tr>
							
							<?php 
							} // if priority
							} // if visible
						 endwhile;
						// } // if in_category
						} // if !cerrado
					} // foreach informe
				} // for priority

			}	// day
		
		} // month

	} // year

?>


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
							if ( $cat != '' ) {
    if ( in_category( $cat ) ){ 
        $visible = '1';
    	$odd++;
    } else {
    	$visible = '0';
	}
							} else {
								$visible = '1';
								$odd++;
							}

?>

<?php	if ( $visible == '1' ) { ?>
	<tr  <?php if ( $odd % 2 == 0 ) echo 'style="background-color:#ccc;"'; ?>>
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
	<tr id="content-<?php the_ID(); ?>" style="display:none;">
		<td colspan="6">
			<?php the_content(); ?>
			<?php comments_template(); ?>
		
		</td>
	</tr>
			<?php $counter6++; ?>
	<?php } ?>
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
							if ( $cat != '' ) {
    if ( in_category( $cat ) ){ 
        $visible = '1';
    	$odd++;
    } else {
    	$visible = '0';
	}
							} else {
								$visible = '1';
								$odd++;
							}
?>



<?php	if ( $visible == '1' ) { ?>
	<tr  <?php if ( $odd % 2 == 0 ) echo 'style="background-color:#ccc;"'; ?>>
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
	<tr id="content-<?php the_ID(); ?>" style="display:none;">
		<td colspan="6">
			<?php the_content(); ?>
			<?php comments_template(); ?>
		
		</td>
	</tr>
			<?php $counter5++; ?>
	<?php } ?>
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
							if ( $cat != '' ) {
    if ( in_category( $cat ) ){ 
        $visible = '1';
    	$odd++;
    } else {
    	$visible = '0';
	}
							} else {
								$visible = '1';
								$odd++;
							}
?>



<?php	if ( $visible == '1' ) { ?>
	<tr  <?php if ( $odd % 2 == 0 ) echo 'style="background-color:#ccc;"'; ?>>
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

	<tr id="content-<?php the_ID(); ?>" style="display:none;">
		<td colspan="6">
			<?php the_content(); ?>
			<?php comments_template(); ?>
		
		</td>
	</tr>
			<?php $counter4++; ?>
	<?php } ?>
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
							if ( $cat != '' ) {
    if ( in_category( $cat ) ){ 
        $visible = '1';
    	$odd++;
    } else {
    	$visible = '0';
	}
							} else {
								$visible = '1';
								$odd++;
							}
?>



<?php	if ( $visible == '1' ) { ?>
	<tr  <?php if ( $odd % 2 == 0 ) echo 'style="background-color:#ccc;"'; ?>>
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

	<tr id="content-<?php the_ID(); ?>" style="display:none;">
		<td colspan="6">
			<?php the_content(); ?>
			<?php comments_template(); ?>
		
		</td>
	</tr>
			<?php $counter3++; ?>
	<?php } ?>
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
							if ( $cat != '' ) {
    if ( in_category( $cat ) ){ 
        $visible = '1';
    	$odd++;
    } else {
    	$visible = '0';
	}
							} else {
								$visible = '1';
								$odd++;
							}
?>



<?php	if ( $visible == '1' ) { ?>
	<tr  <?php if ( $odd % 2 == 0 ) echo 'style="background-color:#ccc;"'; ?>>
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
	<tr id="content-<?php the_ID(); ?>" style="display:none;">
		<td colspan="6">
			<?php the_content(); ?>
			<?php comments_template(); ?>
		
		</td>
	</tr>
			<?php $counter2++; ?>
	<?php } ?>
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
							if ( $cat != '' ) {
    if ( in_category( $cat ) ){ 
        $visible = '1';
    	$odd++;
    } else {
    	$visible = '0';
	}
							} else {
								$visible = '1';
								$odd++;
							}
?>



<?php	if ( $visible == '1' ) { ?>
	<tr  <?php if ( $odd % 2 == 0 ) echo 'style="background-color:#ccc;"'; ?>>
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


	<tr id="content-<?php the_ID(); ?>" style="display:none;">
		<td colspan="6">
			<?php the_content(); ?>
			<?php comments_template(); ?>
		
		</td>
	</tr>
			<?php $counter1++; ?>
	<?php } ?>
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
							if ( $cat != '' ) {
    if ( in_category( $cat ) ){ 
        $visible = '1';
    	$odd++;
    } else {
    	$visible = '0';
	}
							} else {
								$visible = '1';
								$odd++;
							}
?>



<?php	if ( $visible == '1' ) { ?>
	<tr  <?php if ( $odd % 2 == 0 ) echo 'style="background-color:#ccc;"'; ?>>
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

	<tr id="content-<?php the_ID(); ?>" style="display:none;">
		<td colspan="6">
			<?php the_content(); ?>
			<?php comments_template(); ?>
		
		</td>
	</tr>
			<?php $counter0++; ?>
	<?php } ?>
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






