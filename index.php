<?php 	// get ID's

bach_init();

			$abierto = get_option('bach_open'); 
			$open = get_cat_id($abierto);
			$cerrado = get_option('bach_closed'); 
			$closed = get_cat_id($cerrado);
			$esperas = get_option('bach_wait'); 
			$espera = get_cat_id($esperas);

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'post' ) {
	if ( ! is_user_logged_in() )
		auth_redirect();

	if( !current_user_can( 'publish_posts' ) ) {
		wp_redirect( get_bloginfo( 'url' ) . '/' );
		exit;
	}

	check_admin_referer( 'new-post' );  // This executes the post form. Status = open by default

	$user_id		= $current_user->user_id;
	$post_content	= $_POST['posttext'];
	$tags			= $_POST['tags'];
	$post_title    = strip_tags($_POST['postTitle']);
	$estado = $open;
	$prioridad = $_POST['prioridad'];
	$proyecto = $_POST['proyecto'];
	$usuario = $_POST['usuario']; 
	$fecha = $_POST['fecha'];
	$post_category = array($estado,$prioridad,$proyecto,$usuario);
	global $wpdb;
		$proyecto_nombre = $wpdb->get_var("SELECT name FROM wp_terms WHERE term_id = '$proyecto'");


function generatePassword($length=9) {
	$consonants = 'BDGHJLMNPQRSTVWXZ';
	$numbers .= '123456789';
	$password = '';
	for ($i = 0; $i < 3; $i++) {
			$password .= $consonants[(rand() % strlen($consonants))];
		}
	$password .= '-';
	for ($i = 3; $i < $length; $i++) {
			$password .= $numbers[(rand() % strlen($numbers))];
		}
	
	return $password;
}
 
 	$assigned = generatepassword(7);

	$title = '#' . $assigned . ' ' . $post_title . ' ('. $proyecto_nombre . ')';



		// if no category was selected, unset it & default will be used
 /*       if ($post_category == '-1') {
            unset($post_category);
        } elseif ( isset($post_category) ) {
           $post_category = array($post_category);
        }
*/


	$post_id = wp_insert_post( array(	// Inserts the post with our options
		'post_author'	=> $user_id,
		'post_title'	=> $title,
		'post_content'	=> $post_content,
		'post_category' => $post_category,
		'post_name'		=> $assigned,
		'tags_input'	=> $tags,
		'post_status'	=> 'publish'
	) );

	update_post_meta( $post_id, '_refactord-datepicker', $fecha );
	wp_notify_mail($title,$post_content,$post_category,$assigned);
	wp_redirect( get_bloginfo( 'url' ) . '/' );
	exit;
}

get_header( ); 

?>

 <br /><div style="text-align:center;"><a href="<?php bloginfo('url'); ?>/wp-admin/">Administración</a> || <a href="<?php bloginfo('url'); ?>/wp-admin/edit.php">Edición de posts</a> || <a href="<?php bloginfo('url'); ?>/wp-admin/media-new.php"><b>Añadir a la biblioteca de medios</b></a></div>

<?php
if( current_user_can( 'publish_posts' ) ) {
	require_once dirname( __FILE__ ) . '/post-form.php';
}
?>

<div id="main">

<div align="center"><strong><span style="font-size:22px;"> <a href="http://interno.mecus.es/informes/">PRIORIDAD</a> || <a href="http://interno.mecus.es/entrega/">FECHA ENTREGA</a> || <a href="http://interno.mecus.es/timeline/">TIMELINE</a> || <a href="http://interno.mecus.es/espera/">EN ESPERA</a> || <a href="http://interno.mecus.es/sin-fecha/">SIN FECHA</a></span> <br /> <span style="font-variant:small-caps;font-size:16px;"><a href="http://interno.mecus.es/category/abierto/">Abiertos</a> || <a href="http://interno.mecus.es/category/wait/">En Espera</a> || <a href="http://interno.mecus.es/category/done/">Cerrados</a> || <a href="http://interno.mecus.es/category/luis/">Luis</a> || <a href="http://interno.mecus.es/category/rocio/">Rocío</a> || <a href="http://interno.mecus.es/category/raven/">RaveN</a></span></strong></div>
	<ul>

        <?php if ( get_query_var( 'paged') ) $paged = get_query_var( 'paged' ); elseif ( get_query_var( 'page') ) $paged = get_query_var( 'page' ); else $paged = 1; ?>

<?php

global $query_string;
query_posts( $query_string . '&cat=-215,-65,-216&order=DESC&post_parent=0&paged='.$paged );
//query_posts( array( 'cat' => -6,-216,-215, 'paged' => get_query_var('paged') ) );

update_user_meta (1,'activo','8743');

if( have_posts( ) ) {
	?>	
	<div class="navigation">
    <?php
    if(function_exists('pagination'))
        pagination(2,array("&#8592; m&#225;s recientes"," m&#225;s antiguas &#8594;"));
    ?>
		</div>
<? 	
	$previous_user_id = 0;
	
	$activo = get_user_meta(1,'activo',true);
	
	while( have_posts( ) ) {
		the_post( );

if (!in_category('216')) :

			foreach((get_the_category()) as $category) { 
	
				if ( get_root_category($category) == $users ) {
					$usuario = $category->slug;
				} //endif 
			} // end foreach

?>

<?php 

// if ( in_category( $closed ) && !is_single() ) continue; 
		// Don't show the avatar if the previous post was by the same user
		$current_user_id = get_the_author_ID( );
		//if( $previous_user_id !== $current_user_id ) {
		echo '<div style="padding-left:80px;">';
			echo prologue_get_avatar( $current_user_id, get_the_author_email( ), 48 );
		echo '</div>';
		//}
		$previous_user_id = $current_user_id;


?>


<li id="prologue-<?php the_ID(); ?>" class="recuadro<?php if ( in_category( $closed )): echo 'closed'; else: echo $usuario; endif; ?><?php if ( in_category( $espera ) ) { echo ' espera'; } ?><?php if ($post->ID == $activo) echo ' activo'; ?>">





<?php
		// Show the new category images
			$proyectos = get_option('bach_projects'); 
			$proyecto = get_cat_id($proyectos);

			foreach((get_the_category()) as $category) { 
	
				if ( get_root_category($category) == $proyecto ) {
				    echo '<a href="'.get_bloginfo('url').'/category/'.$category->slug.'"><img src="'.trim(ereg_replace("</p>", "", category_description($category->cat_ID)),"<p>").'" alt="' . $category->cat_name . '" class="logo" height="48px" width="48px" style="float:right;" /><a>'; 
			} }




?>

				<h3 class="titulillo"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div align="center"><?php include (TEMPLATEPATH . '/clases.php'); ?></div>	
	<h4>
		<span class="meta">
			Categorías: <?php the_category(' • ','') ?>

<?php if (!in_category('65')) :	?>
	<?php $fecha_entrega = get_post_meta($post->ID, '_refactord-datepicker'); ?>
	<?php if (!$fecha_entrega) { ?>
				<script>
			           jQuery(document).ready(function() {
			           jQuery( "#fecha" ).datepicker({ firstDay: 1 });
			           });
			
			    </script>
			
				<form id="add_date" name="add_date" method="post" action="<?php bloginfo( 'url' ); ?>/transfer/" style="float:right;">
					<input type="hidden" name="action" value="add_date" />
					<input type="text" id="fecha" name="fecha" value="" size="20" />
					<input type="hidden" value="<?php echo $post->ID; ?>" name="transfer"/>
					<input id="submit" type="submit" value="AÑADIR FECHA DE ENTREGA" style="margin-left: 30px;margin-bottom: 20px;" tabindex="27"/>
				</form>		
	<?php }else { 
				$fecha_entrega = explode('/', $fecha_entrega[0]);
				?> <?php echo '<div align="right"><big><strong>'.$fecha_entrega[1].'/'.$fecha_entrega[0].'/'.$fecha_entrega[2].'</strong></big></div>'; ?> 
	<?php 	} ?>
<?php endif; ?>
		</span>
	</h4>
	<div class="postcontent">
		<?php the_content( __( '(More ...)' ) ); ?>
	
	
	
	</div> <!-- // postcontent -->



<!-- Código para mostrar u ocultar los comentarios (javascript) -->


<div id="show-comments" style="text-align:center;margin-bottom:15px;font-size:12px; background-color:#eee;"><a href="javascript:void(0);" onclick="js_toggle('comments-<?php the_ID(); ?>');"><?php _e( 'Mostrar comentarios', 'bach' ); ?> (<?php comments_number('0','1','%'); ?>)</p></a></div>

<div id="comments-<?php the_ID(); ?>" style="display:none;">	
<ul style="list-style-type:none;">

<?php 
$comments = get_comments('order=ASC&post_id='.$post->ID);
  foreach($comments as $comm) : ?>

<li id="prologue-<?php the_ID(); ?>" class="comment<?php echo strtolower($comm->comment_author); ?>">
<?php echo nl2br($comm->comment_content); ?>
</li>
<?php endforeach; ?>
</ul>
</div> <!-- fin de comentarios -->

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


<?php

endif;	
	} // while have_posts
	?>	<div class="navigation">
    <?php
    if(function_exists('pagination'))
        pagination(2,array("&#8592; m&#225;s recientes"," m&#225;s antiguas &#8594;"));
    ?>
		</div>				

<?

} // if have_posts
?>
<?php wp_reset_query(); // reset the query ?>
	</ul>

</div> <!-- // main -->

<?php

//get_sidebar();
get_footer( );

?>

