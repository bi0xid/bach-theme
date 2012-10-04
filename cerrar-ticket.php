<?php /*
Template Name: Cerrar ticket
*/
?>
<?php get_header( ); ?>


<div id="main">


<?php

// Obtenemos el ticket a cerrar

$cerrado = $_POST['id_cerrar'];

// Código de parametrización

			$closed2 = get_option('bach_closed'); 
			$closed = get_cat_id($closed2);
			$espera = get_option('bach_wait'); 
			$wait = get_cat_id($espera);
			$abierto = get_option('bach_open'); 
			$open = get_cat_id($abierto);

 $taxonomy_closed = $wpdb->get_var("SELECT term_taxonomy_id from $wpdb->term_taxonomy WHERE term_id = '$closed'");
 $wpdb->query("INSERT INTO $wpdb->term_relationships (object_id, term_taxonomy_id, term_order) VALUES ($cerrado, $taxonomy_closed, 0)");


// Borramos todos los datos de prioridad y usuarios y dejamos el ticket cerrado

// prioridad

	 		$priorities = get_option('bach_priorities'); 
			$priority = get_cat_id($priorities);
 			global $wpdb;
		    $children = $wpdb->get_results( "SELECT term_id FROM $wpdb->term_taxonomy WHERE parent = '$priority'");	
			foreach ($children as $child){
				 $taxonomy_child = $wpdb->get_var("SELECT term_taxonomy_id from $wpdb->term_taxonomy WHERE term_id = '$child->term_id'");
				$wpdb->query("DELETE FROM $wpdb->term_relationships WHERE object_id = '$cerrado' AND term_taxonomy_id = '$taxonomy_child'");
			}
// usuarios

	 		$users = get_option('bach_users'); 
			$user = get_cat_id($users);
 			global $wpdb;
		    $children = $wpdb->get_results( "SELECT term_id FROM $wpdb->term_taxonomy WHERE parent = '$user'");	
			foreach ($children as $child){
				 $taxonomy_child = $wpdb->get_var("SELECT term_taxonomy_id from $wpdb->term_taxonomy WHERE term_id = '$child->term_id'");
				$wpdb->query("DELETE FROM $wpdb->term_relationships WHERE object_id = '$cerrado' AND term_taxonomy_id = '$taxonomy_child'");
			}

// cambiar estado ticket
 $taxonomy_wait = $wpdb->get_var("SELECT term_taxonomy_id from $wpdb->term_taxonomy WHERE term_id = '$wait'");
 $taxonomy_open = $wpdb->get_var("SELECT term_taxonomy_id from $wpdb->term_taxonomy WHERE term_id = '$open'");


$wpdb->query("DELETE FROM $wpdb->term_relationships WHERE object_id = '$cerrado' AND term_taxonomy_id = '$taxonomy_wait'");
$wpdb->query("DELETE FROM $wpdb->term_relationships WHERE object_id = '$cerrado' AND term_taxonomy_id = '$taxonomy_open'");





// Y ahora enviamos un correo de notificación (se activará de nuevo en la versión 1.1)

	$post = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID='$cerrado' LIMIT 1");
	$author = $wpdb->get_row("SELECT * FROM $wpdb->users WHERE ID='$post->post_author' LIMIT 1");
	$blogname = get_option('blogname');
	$comment_author_domain = @gethostbyaddr($comment->comment_author_IP);
	
	$queryposts = 'p='.$cerrado;
	query_posts($queryposts);
		$notify_message .= '<strong>Categorías: </strong>';
		foreach((get_the_category()) as $category) { 
 	   $notify_message .= $category->cat_name . ' | '; 
	} 
		$notify_message .= '<br />';

			$notify_message .= sprintf( __('<strong>Ticket principal de %s</strong>'), $author->display_name ) . "<br /><br />";
			$contenido = nl2br($post->post_content);
			$notify_message .= sprintf( __('<p style="border: 1px solid gray; padding: 8px;">%s</p>'), $contenido ) . "<br /><br /><hr><br />";

			$notify_message .= '<strong>Ticket cerrado</strong><br />';


		$subject = sprintf( __('MLAB: CLOSED:: "%1$s"'), $post->post_title );
			$from = "From: Bach Mecus <bach@mecus.es>";
			$message_headers = "MIME-Version: 1.0\n"
				. "$from\n"
				. "Content-Type: text/html; charset=\"" . get_option('blog_charset') . "\"\n";
				
$email = 'raven@mecus.es' . ', ';
$email .= 'rocio@mecus.es' . ', ';
$email .= 'luis@mecus.es';

wp_mail($email, $subject, $notify_message, $message_headers);


?>


<form name="commentform" id="commentform" action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post">

<br /><br />

Ticket cerrado

<br /><br />

Redireccionando...
<div class="form"><input type="hidden" id="comment" name="comment" value="<strong>Ticket cerrado por <?php echo $user_identity; ?>. Timestamp: <?php echo date(DATE_RFC822); ?></strong>"></div>
<div><input type="hidden" name="especial" value="no_enviar"></div>
<div><input type="hidden" name="cerrar" value="cerrar"></div>
<div><input type="hidden" name="comment_post_ID" value="<?php echo $cerrado; ?>" /></div>

</form>

</div> <!-- // main -->

<?php
get_footer( );

?>
 <SCRIPT>
document.commentform.submit();

</SCRIPT> 





