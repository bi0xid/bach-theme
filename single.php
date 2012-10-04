<?php 
get_header( ); 

/* Cargamos las variables que utilizaremos */

			$abierto = get_option('bach_open'); 
			$open = get_cat_id($abierto);
			$cerrado = get_option('bach_closed'); 
			$closed = get_cat_id($cerrado);
			$esperas = get_option('bach_wait'); 
			$espera = get_cat_id($esperas);
			$prioridades = get_option('bach_priorities'); 
			$priorities = get_cat_id($prioridades);
			$proyectos = get_option('bach_projects'); 
			$proyecto = get_cat_id($proyectos);
			$bach_users = get_option('bach_users');
			$users = get_cat_id($bach_users);


/* Entramos en el loop */
if( have_posts( ) ) {
	$first_post = true;

	while( have_posts( ) ) {
		the_post( );
?>

<script Language="JavaScript">
<!-- 
function Confirma()
{
// Check the value of the element named text_name
// from the form named text_form
if (add_date.fecha.value == "")
{
// If null display and alert box
alert("No has rellenado correctamente el campo de fecha");
// Place the cursor on the field for revision
add_date.fecha.focus();
// return false to stop further processing
return (false);
}
// If text_name is not null continue processing
return (true);
}
-->
</script>


<div id="postpage">
<div id="main">

<div align="center"><strong><span style="font-size:22px;"> <a href="http://interno.mecus.es/informes/">PRIORIDAD</a> || <a href="http://interno.mecus.es/entrega/">FECHA ENTREGA</a> || <a href="http://interno.mecus.es/timeline/">TIMELINE</a> || <a href="http://interno.mecus.es/espera/">EN ESPERA</a> || <a href="http://interno.mecus.es/sin-fecha/">SIN FECHA</a></span> <br /> <span style="font-variant:small-caps;font-size:16px;"><a href="http://interno.mecus.es/category/abierto/">Abiertos</a> || <a href="http://interno.mecus.es/category/wait/">En Espera</a> || <a href="http://interno.mecus.es/category/done/">Cerrados</a> || <a href="http://interno.mecus.es/category/luis/">Luis</a> || <a href="http://interno.mecus.es/category/rocio/">Rocío</a> || <a href="http://interno.mecus.es/category/raven/">RaveN</a></span></strong></div>

	<h2>
		<?php echo prologue_get_avatar( get_the_author_ID( ), get_the_author_email( ), 48 ); ?>
		<?php 		// Show the new category images and get the user who must do the task.

			foreach((get_the_category()) as $category) { 
	
				if ( get_root_category($category) == $proyecto ) {
					$cat_ID = $category->cat_ID;
					$cat_name = $category->cat_name;
				    echo '<a href="'.get_bloginfo('url').'/?cat='.$category->cat_ID.'"><img src="'.trim(ereg_replace("</p>", "", category_description($category->cat_ID)),"<p>").'" alt="' . $category->cat_name . '" class="logo single" height="48px" width="48px" style="float:right;padding-top:50px;" /></a>'; 
				} // endif 				
				if ( get_root_category($category) == $users ) {
					$usuario = $category->slug;
					$nombre = $category->name;
					echo 'Tarea de '; echo $nombre;
				} //endif 
			} // end foreach
global $current_user;
get_currentuserinfo();			
			
?>
	</h2>
	
<?php if ( $post->post_parent != '0' ) {
		$parent = $wpdb->get_row( "SELECT guid, post_title FROM $wpdb->posts WHERE ID = '$post->post_parent'" );
		echo '<div align="center" style="font-size:16px;color:red;">Esta tarea es hija de <a href="'.$parent->guid.'">' .$parent->post_title.'</a></div>'; 
}	?>
	<ul>
<li id="prologue-<?php the_ID(); ?>" class="recuadro<?php if ( in_category( $closed )): echo 'closed'; else: echo $usuario; endif; ?><?php if ( in_category( $espera ) ) { echo ' espera'; } ?>">
							<h3 class="titulillo"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>			
</h3>
						<div align="center"><?php include (TEMPLATEPATH . '/clases.php'); ?></div>	
			<h4>
				Publicado a las <?php the_time( "h:i:s a" ); ?> el día <?php the_time( "j F, Y" ); ?>
				| 
<?php if (!in_category('65')) :	?>
				
	<?php $fecha_entrega = get_post_meta($post->ID, '_refactord-datepicker'); ?>
	<?php if (!empty($fecha_entrega)) { 
			$fecha_entrega = explode('/', $fecha_entrega[0]);
			$fecha_entrega = $fecha_entrega[1].'/'.$fecha_entrega[0].'/'.$fecha_entrega[2];
		}?>
			
	<script>
           jQuery(document).ready(function() {
           jQuery( "#fecha" ).datepicker({ firstDay: 1 });
           });

    </script>

	<form id="add_date" name="add_date" method="post" action="<?php bloginfo( 'url' ); ?>/transfer/" style="float:right;" onsubmit="return Confirma()">
		<input type="hidden" name="action" value="add_date" />
		<input type="text" id="fecha" name="fecha" value="<?php if (!empty($fecha_entrega)) echo 'CAMBIAR'; ?>" size="20" />
		<input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/>
		<input id="submit" type="submit" value="<?php if (!empty($fecha_entrega)): echo 'CAMBIAR'; else : echo 'AÑADIR'; endif; ?> FECHA DE ENTREGA" style="margin-left: 30px;margin-bottom: 20px;" tabindex="1"/>
	</form>		

			<?php if (!empty($fecha_entrega)) echo '<big><strong>'.$fecha_entrega.'</strong></big>'; ?>


<?php endif; ?>				
				
				<span class="meta">
					| 
					<br />
			Categorías: <?php the_category(' • ','') ?>
				</span>
			</h4>
			<?php the_content( __( '(More ...)' ) ); ?>



		<?php if (in_category ( $closed )) { ?>
			<?php $user = get_category_by_slug( $current_user->user_login );
			$cat_id = $user->term_id; ?>

	<form id="reopen" name="reopen" method="post" action="<?php bloginfo( 'url' ); ?>/transfer/" style="float:right;">
		<input type="hidden" name="action" value="reopen" />

            <span style="padding-left: 70px;">  <?php wp_dropdown_categories( array(
                'hide_empty' => 0,
                'name' => 'prioridad',
                'orderby' => 'name',
                'class' => 'catSelection',
                'heirarchical' => 1,
                'child_of' => $priorities,
                'show_option_none' => __('Prioridad'),
                //'selected' => ,  // how to select default cat by default?
                'tab_index' => 4
                )
            ); ?>
</span>

		<input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/>
		<input type="hidden" value="<?php echo $cat_id; ?>" name="usuario">
		<input id="submit" type="submit" value="Reabrir" style="margin-left: 30px;margin-bottom: 20px;" tabindex="7"/>
	</form>		


<?php } else { //not closed 

?>		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/transfer/"><!--<span style="float:right;padding-top:5px; padding-left:5px;">
<select size="1" name="ciclos">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
<option>10</option>
</select>
</span>--><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="hidden" value="close" name="action"><input type="submit" name="submit" value="Cerrar ticket"></form></h4>



<?php
	if ( $usuario != $current_user->user_login ){ 
			$user = get_category_by_slug( $current_user->user_login );
			$cat_id = $user->term_id;

	?>
		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/transfer/"><input type="hidden" value="<?php echo $cat_id; ?>" name="usuario"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="hidden" value="claim" name="action"><input type="submit" name="submit" value="Reclamar"></form></h4>
<?php	}

	
 	// Categorías de usuario
 	$categories = get_categories( 'child_of=' . $users ); 
	foreach ( $categories as $category ) {
		if ( $category->slug != $current_user->user_login ) { 
			if ( $category->slug != $usuario ) { ?>
		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/transfer/"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="hidden" value="<?php echo $category->cat_ID; ?>" name="usuario"><input type="hidden" value="transfer" name="action"><input type="submit" name="submit" value="<?php echo $category->name; ?>"></form></h4>
		
	<?php	}}}  ?>



		<?php if (in_category ( $espera )) { ?>
		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/transfer/"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="hidden" value="reactivar" name="action"><input type="submit" name="submit" value="Reactivar"></form></h4>
		
<?php } ?>


		<?php if (in_category ( $open )) { ?>
		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/transfer/"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="hidden" value="wait" name="action"><input type="submit" name="submit" value="Poner en espera"></form></h4>
<?php } ?>

	<form id="prioridad" name="prioridad" method="post" action="<?php bloginfo( 'url' ); ?>/transfer/" style="float:right;">
		<input type="hidden" name="action" value="prioridad" />

            <span style="padding-left: 70px;">  <?php wp_dropdown_categories( array(
                'hide_empty' => 0,
                'name' => 'prioridad',
                'orderby' => 'name',
                'class' => 'catSelection',
                'heirarchical' => 1,
                'child_of' => $priorities,
                'show_option_none' => __('Prioridad'),
                //'selected' => ,  // how to select default cat by default?
                'tab_index' => 4
                )
            ); ?>
</span>

		<input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/>
		<input id="submit" type="submit" value="Modificar prioridad" style="margin-left: 30px;margin-bottom: 20px;" tabindex="7"/>
	</form>		
	
	
	<form id="hijo" name="hijo" method="post" action="<?php bloginfo( 'url' ); ?>/hijos/" style="float:right;">
		<input type="hidden" name="action" value="hijo" />
		<input type="hidden" name="post_parent" value="<?php echo $post->ID; ?>" />
		<input type="hidden" name="parent_title" value="<?php echo $post->post_title; ?>" />
		<input type="hidden" name="cat_ID" value="<?php echo $cat_ID; ?>" />
		<input type="hidden" name="cat_name" value="<?php echo $cat_name; ?>" />

		<input id="submit" type="submit" value="Crear hijo" style="margin-left: 30px;margin-bottom: 20px;" tabindex="8"/>

	</form>

<?php } //end in_category( $closed );
		?>

		

<br /><br /><br />
<?php $hijos = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_type = 'post' AND post_status='publish'" ); ?>
	
	<div class="hijos" style="background-color:white;margin-left:50px;">
		<ul>
		<?php foreach ( $hijos as $hijo ){ 	
				$ticketcerrado = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE object_id = '$hijo->ID' AND term_taxonomy_id = '66'" );	
				if ( $ticketcerrado == '0' ) {	?>
					<li><a href="<?php echo $hijo->guid; ?>"><?php echo $hijo->post_title; ?></a></li>
			<?	}
			}	?>
		</ul>
	</div>

		</li>
	</ul>

	<div class="navigation">
     	<div class="clear-page"></div>
     	<div class="alignleft"><span class="post-link-format"><?php previous_post_link('&laquo; %link') ?></span></div>
      	<div class="alignright"><span class="post-link-format"><?php next_post_link('%link &raquo;') ?></span></div>
      	<div class="clear-page"></div>
    </div>
    <br><br>
<?php

		comments_template( );
	} // while have_posts
} // if have_posts
?>
<!--<b>Número de ciclos: <?php echo get_post_meta($post->ID,'ciclos', true); ?></b>-->

</div> <!-- // main -->
</div> <!-- // postpage -->
<?php
//get_sidebar();
get_footer( );
