<?php /*
Template Name: Tema para hijos
*/

// get ID's

bach_init();

			$abierto = get_option('bach_open'); 
			$open = get_cat_id($abierto);
			$cerrado = get_option('bach_closed'); 
			$closed = get_cat_id($cerrado);
			$esperas = get_option('bach_wait'); 
			$espera = get_cat_id($esperas);


	$action = $_POST['action'];
	$parent_title = $_POST['parent_title'];
	$cat_ID = $_POST['cat_ID'];
	$cat_name = $_POST['cat_name'];
	$post_parent = $_POST['post_parent'];
	$fecha = $_POST['fecha'];

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'crear_hijo' ) {
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
	$proyecto = $_POST['cat_ID'];
	$usuario = $_POST['usuario']; 
	$post_category = array($estado,$prioridad,$proyecto,$usuario);
	$post_parent = $_POST['post_parent'];
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
		'post_status'	=> 'publish',
		'post_parent'	=>	$post_parent
	) );

update_post_meta( $post_id, '_refactord-datepicker', $fecha );

	wp_notify_mail($title,$post_content,$post_category,$assigned);
	wp_redirect( get_bloginfo( 'url' ) . '/' );
	exit;
}

get_header( ); 

?>

<br /><br /><br /><br /><br /><br />
<?php
if( current_user_can( 'publish_posts' ) ) {
	require_once dirname( __FILE__ ) . '/post-form-hijo.php';
}
?>
	

<?php

//get_sidebar();
get_footer( );

?>

