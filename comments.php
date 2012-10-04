<?php
if( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'] ) )
	die( 'Please do not load this page directly. Thanks!' );

if( !empty( $post->post_password ) ) { // if there's a password
	if( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) { 

?>

<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

<?php
		return;
	} // if cookie
} // if post_password

bach_init();

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
			global $current_user;
			get_currentuserinfo();			


			foreach((get_the_category()) as $category) { 
				if ( get_root_category($category) == $users ) {
					$usuario = $category->slug;
					$nombre = $category->name;
				} //endif 
			} // end foreach



if( $comments ) {
	echo "<h3>Comentarios</h3>\n";
	//echo "<ul id=\"comments\" class=\"commentlist\">\n";

	foreach( $comments as $comment ) {
?>
<ul style="list-style-type:none;">

<li id="comment-<?php comment_ID( ); ?>" class="comment<?php echo strtolower($comment->comment_author); ?>">
	<?php echo prologue_get_avatar( $comment->user_id, $comment->comment_author_email, 32 ); ?>
	<h4>
		<span class="meta"><?php comment_time( ); ?> :: <?php comment_date( ); ?> | <a href="#comment-<?php comment_ID( ); ?>">permalink</a><?php edit_comment_link( __( 'editar' ), '&nbsp;|&nbsp;',''); ?></span>
	</h4>
	<?php comment_text( ); ?>
</li>

<?php
	} // foreach comments

	echo "</ul>\n";
} // if comments









if( 'open' == $post->comment_status ) {
?>


<?php
			$cerrado = get_option('bach_closed'); 
			$closed = get_cat_id($cerrado);

			if ( !in_category ( $closed ) ) {
?>


<h3>Nueva aportación</h3>

<?php
if ( get_option('comment_registration') && !$user_ID ) {
?>

<p>Debes estar <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>" title="Log in">logueado</a> para participar.</p>

<?php
} // if option comment_registration and not user_ID
else {
?>

<form id="commentform" action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post">
<?php 
if( $user_ID ) { 
?>

<p>Estás autentificado como <a href="<?php echo get_option( 'siteurl' ); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. Si no es tu usuario, <a href="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?action=logout" title="Log out">pincha aquí</a>.</p>

<?php 
} // if user_ID 
else { 
?>

<p>Debes estar registrado en el sistema para participar.</p><?php } // else user_ID ?>

<div class="form"><textarea id="comment" name="comment" cols ="80" rows="3" tabindex="1"></textarea></div>


<div><input id="submit" name="submit" type="submit" value="Añadir comentario &raquo;" tabindex="5" /><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></div>


</form>

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

<h4 style="float:left;">	<form id="add_date" name="add_date" method="post" action="<?php bloginfo( 'url' ); ?>/transfer/" style="float:left;" onsubmit="return Confirma()">
		<input type="hidden" name="action" value="add_date" />
		<input type="text" id="fecha" name="fecha" value="<?php if (!empty($fecha_entrega)) echo $fecha_entrega; ?>" size="20" />
		<input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/>
		<input id="submit" type="submit" value="<?php if (!empty($fecha_entrega)): echo 'CAMBIAR'; else : echo 'AÑADIR'; endif; ?> FECHA DE ENTREGA" style="margin-left: 30px;margin-bottom: 20px;" tabindex="1"/>
	</form>		</h4>
<h4 style="float:left;"><form method="post" action="<?php bloginfo('url'); ?>/transfer/"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="hidden" value="close" name="action"><input type="submit" name="submit" value="Cerrar ticket"></form></h4>
<?php
	if ( $usuario != $current_user->user_login ){ 
			$user = get_category_by_slug( $current_user->user_login );
			$cat_id = $user->term_id;

	?>
		<h4 style="float:left;"><form method="post" action="<?php bloginfo('url'); ?>/transfer/"><input type="hidden" value="<?php echo $cat_id; ?>" name="usuario"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="hidden" value="claim" name="action"><input type="submit" name="submit" value="Reclamar"></form></h4>
<?php	}

	
 	// Categorías de usuario
 	$categories = get_categories( 'child_of=' . $users ); 
	foreach ( $categories as $category ) {
		if ( $category->slug != $current_user->user_login ) { 
			if ( $category->slug != $usuario ) { ?>
		<h4 style="float:left;"><form method="post" action="<?php bloginfo('url'); ?>/transfer/"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="hidden" value="<?php echo $category->cat_ID; ?>" name="usuario"><input type="hidden" value="transfer" name="action"><input type="submit" name="submit" value="<?php echo $category->name; ?>"></form></h4>
		
	<?php	}}}  ?>



		<?php if (in_category ( $espera )) { ?>
		<h4 style="float:left;"><form method="post" action="<?php bloginfo('url'); ?>/transfer/"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="hidden" value="reactivar" name="action"><input type="submit" name="submit" value="Reactivar"></form></h4>
		
<?php } ?>


		<?php if (in_category ( $open )) { ?>
		<h4 style="float:left;"><form method="post" action="<?php bloginfo('url'); ?>/transfer/"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="hidden" value="wait" name="action"><input type="submit" name="submit" value="Poner en espera"></form></h4>
<?php } ?>

<h4 style="float:left;">	<form id="prioridad" name="prioridad" method="post" action="<?php bloginfo( 'url' ); ?>/transfer/" style="float:right;">
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
	</form></h4>


<?php
} // if in category $closed
} // else option comment_registration and not user_ID
} // if open comment_status
