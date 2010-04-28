<?php 
get_header( ); 

			$abierto = get_option('bach_open'); 
			$open = get_cat_id($abierto);
			$cerrado = get_option('bach_closed'); 
			$closed = get_cat_id($cerrado);
			$esperas = get_option('bach_wait'); 
			$espera = get_cat_id($esperas);


if( have_posts( ) ) {
	$first_post = true;

	while( have_posts( ) ) {
		the_post( );

		$email_md5		= md5( get_the_author_email( ) );
		$default_img	= urlencode( 'http://use.perl.org/images/pix.gif' );
?>

<div id="postpage">
<div id="main">
	<h2>
		<?php echo prologue_get_avatar( get_the_author_ID( ), get_the_author_email( ), 48 ); ?>
		<?php 		// Show the new category images

			foreach((get_the_category()) as $category) { 
			$proyectos = get_option('bach_projects'); 
			$proyecto = get_cat_id($proyectos);
	
				if ( get_root_category($category) == $proyecto ) {
				    echo '<a href="'.get_bloginfo('url').'/?cat='.$category->cat_ID.'"><img src="'.trim(ereg_replace("</p>", "", category_description($category->cat_ID)),"<p>").'" alt="' . $category->cat_name . '" class="logo" height="48px" width="48px" style="float:right;" /><a>'; 
			} }
?>
		<?php the_author_posts_link( ); ?>
	</h2>
	
	<ul>
<li id="prologue-<?php the_ID(); ?>" class="recuadro<?php if ( in_category( 58 ) ) { echo 'luis'; } elseif ( in_category( 57 ) ) { echo 'raven'; } elseif ( in_category( 144 ) ) { echo 'rocio'; } ?><?php if ( in_category( $espera ) ) { echo ' espera'; } ?>">
							<h3 class="titulillo"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>			
</h3>
						<div align="center"><?php include (TEMPLATEPATH . '/clases.php'); ?></div>	
			<h4>
				Publicado a las <?php the_time( "h:i:s a" ); ?> el día <?php the_time( "j F, Y" ); ?>
				| <?php edit_post_link( __( 'modificar' ) ); ?> <?php echo $user_ID; ?>
				<span class="meta">
					<?php comments_popup_link( __( 'no hay aportaciones' ), __( 'una respuesta' ), __( '% respuestas' ) ); ?> |
					<br />
			Categorías: <?php the_category(' • ','') ?>
				</span>
			</h4>
			<?php the_content( __( '(More ...)' ) ); ?>


		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/claim/"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="submit" name="submit" value="Reclamar"></form></h4>


		<?php if (in_category ( 57 ) || (in_category ( 144 ))) { 
			if ($user_ID != 2) {?>
		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/trans-luis/"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="submit" name="submit" value="Luis"></form></h4>
<?php }} ?>

		<?php if (in_category ( 58 ) || (in_category ( 144 ))) {
			if ($user_ID != 1) {?>
		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/trans-raven/"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="submit" name="submit" value="RaveN"></form></h4>
<?php }} ?>

		<?php if (in_category ( 57 ) || (in_category ( 58 ))) { 
			if ($user_ID != 4) {?>
		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/trans-rocio/"><input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/><input type="submit" name="submit" value="Rocío"></form></h4>
<?php }} ?>


		<?php if (in_category ( $espera )) { ?>
		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/reactivar/"><input type="hidden" value="<?php echo $post->ID; ?>" name="reac"/><input type="submit" name="submit" value="Reactivar"></form></h4>
<?php } ?>

		<?php if (in_category ( $closed )) { ?>
		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/reabrir/"><input type="hidden" value="<?php echo $post->ID; ?>" name="reab"/><input type="submit" name="submit" value="Reabrir"></form></h4>
<?php } ?>

		<?php if (in_category ( $open )) { ?>
		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/en-espera/"><input type="hidden" value="<?php echo $post->ID; ?>" name="en_espera"/><input type="submit" name="submit" value="Poner en espera"></form></h4>
<?php } ?>

		<?php if (in_category ( $espera ) || (in_category ( $open ))) { ?>
		<h4 style="float:right;"><form method="post" action="<?php bloginfo('url'); ?>/cerrar-ticket/"><input type="hidden" value="<?php echo $post->ID; ?>" name="id_cerrar"/><input type="submit" name="submit" value="Cerrar ticket"></form></h4>
<?php } ?>




		</li>
	</ul>
	<br>
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
</div> <!-- // main -->
</div> <!-- // postpage -->
<?php
get_sidebar();
get_footer( );
