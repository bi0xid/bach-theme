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

	wp_notify_mail($title,$post_content,$post_category,$assigned);
	wp_redirect( get_bloginfo( 'url' ) . '/' );
	exit;
}

get_header( ); 

$ifdone = $_COOKIE['muestradone'];

?>

<script language="JavaScript">
/*	This function sets the cookie	*/
function done(){
   document.cookie = 'muestradone=si;'
}
function nodone(){
   document.cookie = 'muestradone=no;'
}
/*	end of cookie function	*/
</script>

<?php
if( current_user_can( 'publish_posts' ) ) {
	require_once dirname( __FILE__ ) . '/post-form.php';
}
?>


<div id="main">
	<?php if (have_posts()) : ?>


 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle">Archivo para <?php single_cat_title(); ?></h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="pagetitle"><?php single_tag_title(); ?></h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle">Archivo para <?php the_time('F jS, Y'); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle">Archivo para <?php the_time('F Y'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle">Archivo para <?php the_time('Y'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle"><?php the_author(); ?></h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">Archivo del blog</h2>
<?php } 

	?>
<div align="center"><strong><span style="font-size:22px;"> <a href="http://interno.mecus.es/informes/">PRIORIDAD</a> || <a href="http://interno.mecus.es/entrega/">FECHA ENTREGA</a> || <a href="http://interno.mecus.es/timeline/">TIMELINE</a> || <a href="http://interno.mecus.es/espera/">EN ESPERA</a> || <a href="http://interno.mecus.es/sin-fecha/">SIN FECHA</a></span> <br /> <span style="font-variant:small-caps;font-size:16px;"><a href="http://interno.mecus.es/category/abierto/">Abiertos</a> || <a href="http://interno.mecus.es/category/wait/">En Espera</a> || <a href="http://interno.mecus.es/category/done/">Cerrados</a> || <a href="http://interno.mecus.es/category/luis/">Luis</a> || <a href="http://interno.mecus.es/category/rocio/">Rocío</a> || <a href="http://interno.mecus.es/category/raven/">RaveN</a></span></strong></div>

	
	
<br /><br />
		<div class="navigation">
    <?php
    if(function_exists('pagination'))
        pagination(2,array("&#8592; m&#225;s recientes"," m&#225;s antiguas &#8594;"));
    ?>
		</div>

		<?php while (have_posts()) : the_post(); ?>
		
<?php
			$cerrados = get_option('bach_closed'); 
			$cerrado = get_cat_id($cerrados);
			$esperas = get_option('bach_wait'); 
			$espera = get_cat_id($esperas);

	if (($ifdone == 'si') && (in_category( $cerrado ))) {
	?> <?php 
	} else { ?>
			<div  class="recuadro<?php if ( in_category( 58 ) ) { echo 'luis'; } elseif ( in_category( 57 ) ) { echo 'raven'; } elseif ( in_category( 144 ) ) { echo 'rocio'; } ?><?php if ( in_category( $espera ) ) { echo ' espera'; } ?>" id="post-<?php the_ID(); ?>">
				<?php 		// Show the new category images

			foreach((get_the_category()) as $category) { 
			$proyectos = get_option('bach_projects'); 
			$proyecto = get_cat_id($proyectos);
	
				if ( get_root_category($category) == $proyecto ) {
				    echo '<a href="'.get_bloginfo('url').'/category/'.$category->slug.'"><img src="'.trim(ereg_replace("</p>", "", category_description($category->cat_ID)),"<p>").'" alt="' . $category->cat_name . '" class="logo" height="48px" width="48px" style="float:right;" /><a>'; 
			} }
?>
				
				<h3 class="titulillo"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div align="center"><?php include (TEMPLATEPATH . '/clases.php'); ?></div>	

				<div class="post-datos">
					Subido por <a href="<?php bloginfo('url'); ?>/category/usuarios/<?php the_author(); ?>/"><?php the_author() ?></a>
				<div class="post-tags">
					Propiedades: 
					<?php the_category(' • ','') ?>
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
				</div>

				</div>
				<div class="post-contenido">
					<?php the_content('Leer el resto del art&iacute;culo &raquo;'); ?>
				</div>
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

			</div>

			<br /><br />
			<?php }	?>		
			
		<?php endwhile; ?>

		<div class="navigation">
    <?php
    if(function_exists('pagination'))
        pagination(2,array("&#8592; m&#225;s recientes"," m&#225;s antiguas &#8594;"));
    ?>
		</div>

	<?php else : ?>
	
		<h2 class="center">No encontrado</h2>
		<p class="center">Lo sentimos pero la p&aacute;gina que busca no ha sido encontrada.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>
			
		</div>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>






