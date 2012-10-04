<?php /*
Template Name: Informe sin fecha
*/

 get_header(); ?>


<?php 

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

		
		
	</tr>
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

		</div>

<?php get_footer(); ?>






