<?php /*
Template Name: Transferir a RaveN
*/
?>
<?php get_header( ); ?>


<div id="main">


<?php

// Obtenemos el ticket a poner en espera

$transfer = $_POST['transfer'];

if ($user_ID == 1) {
	$user = 57;
}

if ($user_ID == 2) {
	$user = 58;
}

if ($user_ID == 4) {
	$user = 144;
}




// INSERT raven category->ID 

 $taxonomy_wait = $wpdb->get_var("SELECT term_taxonomy_id from $wpdb->term_taxonomy WHERE term_id = 57");
 $wpdb->query("INSERT INTO $wpdb->term_relationships (object_id, term_taxonomy_id, term_order) VALUES ($transfer, $taxonomy_wait, 0)");


// DELETE $user category->ID
// This is not valid. If you transfer a post from other user, his/her user still appears, because you are only deleting yours. Deleting all users by now.

 $taxonomy_open = $wpdb->get_var("SELECT term_taxonomy_id from $wpdb->term_taxonomy WHERE term_id = 58");
 $wpdb->query("DELETE FROM $wpdb->term_relationships WHERE object_id = '$transfer' AND term_taxonomy_id = '$taxonomy_open'");
 $taxonomy_open = $wpdb->get_var("SELECT term_taxonomy_id from $wpdb->term_taxonomy WHERE term_id = 144");
 $wpdb->query("DELETE FROM $wpdb->term_relationships WHERE object_id = '$transfer' AND term_taxonomy_id = '$taxonomy_open'");


// Y ahora enviamos un correo de notificación


	$post = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID='$transfer' LIMIT 1");
	$author = $wpdb->get_row("SELECT * FROM $wpdb->users WHERE ID='$post->post_author' LIMIT 1");
	$blogname = get_option('blogname');
	$comment_author_domain = @gethostbyaddr($comment->comment_author_IP);
	

			$notify_message .= sprintf( __('<strong>Ticket principal de %s</strong>'), $author->display_name ) . "<br /><br />";
			$contenido = nl2br($post->post_content);
			$notify_message .= sprintf( __('<p style="border: 1px solid gray; padding: 8px;">%s</p>'), $contenido ) . "<br /><br /><hr><br />";

			$notify_message .= '<strong>Ticket traspasado: '.$user_identity.' -> RaveN</strong><br />';


		$subject = sprintf( __('MLAB: TRANS:: "%1$s"'), $post->post_title );
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

Ticket transferido a RaveN

<br /><br />

Redireccionando...
<div class="form"><input type="hidden" id="comment" name="comment" value="<strong>Ticket transferido a RaveN por <?php echo $user_identity; ?>. Timestamp: <?php echo date(DATE_RFC822); ?></strong>"></div>
<div><input type="hidden" name="especial" value="no_enviar"></div>

<div><input type="hidden" name="comment_post_ID" value="<?php echo $transfer; ?>" /></div>

</form>

</div> <!-- // main -->

<?php
get_footer( );

?>
 <SCRIPT>
document.commentform.submit();

</SCRIPT> 


