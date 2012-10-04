<?php /*
Template Name: Informe Cerrados
*/

 get_header(); ?>


<div id=main>

<div align="center"><strong><span style="font-size:22px;"> <a href="http://interno.mecus.es/informes/">PRIORIDAD</a> || <a href="http://interno.mecus.es/entrega/">FECHA ENTREGA</a> || <a href="http://interno.mecus.es/timeline/">TIMELINE</a> || <a href="http://interno.mecus.es/espera/">EN ESPERA</a> || <a href="http://interno.mecus.es/sin-fecha/">SIN FECHA</a></span> <br /> <span style="font-variant:small-caps;font-size:16px;"><a href="http://interno.mecus.es/category/abierto/">Abiertos</a> || <a href="http://interno.mecus.es/category/wait/">En Espera</a> || <a href="http://interno.mecus.es/category/done/">Cerrados</a> || <a href="http://interno.mecus.es/category/luis/">Luis</a> || <a href="http://interno.mecus.es/category/rocio/">Rocío</a> || <a href="http://interno.mecus.es/category/raven/">RaveN</a></span></strong></div>

	<table>
	<tr style=font-weight:bold;><td width="40%">Ticket</td><td width="30%">Enlace</td><td width="30%">Fecha de cierre</td></tr>
	

<?php 

	$condicional = $_GET['proj'];

	$artis = $wpdb->get_results("SELECT DISTINCT comment_post_ID FROM $wpdb->comments WHERE comment_content LIKE '%cerrado%' ORDER BY comment_date DESC");
		foreach ($artis as $article){
				$post = $wpdb->get_row( "SELECT * FROM $wpdb->posts WHERE $wpdb->posts.ID = $article->comment_post_ID" ); 
			//$post = $wpdb->get_row( "SELECT * FROM $wpdb->posts, $wpdb->term_relationships WHERE $wpdb->posts.ID = $article->comment_post_ID AND $wpdb->posts.ID = $wpdb->term_relationships.object_id AND $wpdb->term_relationships.term_taxonomy_id = 208" ); 

?>

<?php if ( $condicional != '' ) {
		 if ( strpos( $post->post_title, $condicional ) !== false )  { ?>

			<tr><td><?= $post->post_title; ?></td><td><a href="<?= $post->guid; ?>"><?= $post->guid; ?></a></td><td><?php echo $wpdb->get_var("SELECT comment_date FROM $wpdb->comments WHERE comment_post_ID = $post->ID ORDER BY comment_date DESC LIMIT 1 "); ?></td></tr>

		
<?php		}//if strpos

		} else { ?>
		
					<tr><td><?= $post->post_title; ?></td><td><a href="<?= $post->guid; ?>"><?= $post->guid; ?></a></td><td><?php echo $wpdb->get_var("SELECT comment_date FROM $wpdb->comments WHERE comment_post_ID = $post->ID ORDER BY comment_date DESC LIMIT 1 "); ?></td></tr>

		
		<? }

		}//foreach
?>




</table>

		</div>





<?php get_footer(); ?>






