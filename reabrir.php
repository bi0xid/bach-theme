<?php /*
Template Name: Reabrir
*/
?>
<?php get_header( ); ?>


<div id="main">


<?php

// Obtenemos el ticket a reabrir

$reab = $_POST['reab'];

			$closed2 = get_option('bach_closed'); 
			$closed = get_cat_id($closed2);
			$abierto = get_option('bach_open'); 
			$open = get_cat_id($abierto);


//Lo abrimos

 $taxonomy_open = $wpdb->get_var("SELECT term_taxonomy_id from $wpdb->term_taxonomy WHERE term_id = '$open'");
 $wpdb->query("INSERT INTO $wpdb->term_relationships (object_id, term_taxonomy_id, term_order) VALUES ($reab, $taxonomy_open, 0)");


// borramos el estado cerrado

 $taxonomy_closed = $wpdb->get_var("SELECT term_taxonomy_id from $wpdb->term_taxonomy WHERE term_id = '$closed'");
 $wpdb->query("DELETE FROM $wpdb->term_relationships WHERE object_id = '$reab' AND term_taxonomy_id = '$taxonomy_closed'");



// Y ahora enviamos un correo de notificación (se activará de nuevo en la versión 1.1)
	$post = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID='$reab' LIMIT 1");
	$author = $wpdb->get_row("SELECT * FROM $wpdb->users WHERE ID='$post->post_author' LIMIT 1");
	$blogname = get_option('blogname');
	$comment_author_domain = @gethostbyaddr($comment->comment_author_IP);
	
	$queryposts = 'p='.$reab;
	query_posts($queryposts);
		$notify_message .= '<strong>Categorías: </strong>';
		foreach((get_the_category()) as $category) { 
 	   $notify_message .= $category->cat_name . ' | '; 
	} 
		$notify_message .= '<br />';

			$notify_message .= sprintf( __('<strong>Ticket principal de %s</strong>'), $author->display_name ) . "<br /><br />";
			$contenido = nl2br($post->post_content);
			$notify_message .= sprintf( __('<p style="border: 1px solid gray; padding: 8px;">%s</p>'), $contenido ) . "<br /><br /><hr><br />";

			$notify_message .= '<strong>Ticket reabierto </strong><br />';


		$subject = sprintf( __('MLAB: REAB:: "%1$s"'), $post->post_title );
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

Ticket reabierto

<br /><br />

Redireccionando...
<div class="form"><input type="hidden" id="comment" name="comment" value="<strong>Ticket reabierto por <?php echo $user_identity; ?>. Timestamp: <?php echo date(DATE_RFC822); ?></strong>"></div>
<div><input type="hidden" name="especial" value="no_enviar"></div>
<div><input type="hidden" name="cerrar" value="reabrir"></div>
<div><input type="hidden" name="comment_post_ID" value="<?php echo $reab; ?>" /></div>

</form>

</div> <!-- // main -->

<?php
get_footer( );

?>
 <SCRIPT>
document.commentform.submit();

</SCRIPT> 





