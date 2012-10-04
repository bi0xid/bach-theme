<?php
			$prioridades = get_option('bach_priorities'); 
			$priorities = get_cat_id($prioridades);
			$proyectos = get_option('bach_projects'); 
			$projects = get_cat_id($proyectos);
			$usuarios = get_option('bach_users'); 
			$users = get_cat_id($usuarios);
			$abierto = get_option('bach_open'); 
			$open = get_cat_id($abierto);
			$padre = $wpdb->get_var("SELECT parent from $wpdb->term_taxonomy WHERE term_id = '$open'");
?>

<div id="sidebar">
	<div style="float:left;"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>

<ul>
<?php 
if( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) { 
	$before = "<li><h2>Proyectos recientes</h2>\n";
	$after = "</li>\n";

	$num_to_show = 35;

	echo prologue_recent_projects( $num_to_show, $before, $after );
} // if dynamic_sidebar
?>
</ul>


<?

// Projects list idea

global $wpdb;


// Prioridad
	echo '<div style="padding-bottom:10px;padding-top:10px;font-weight:bold;font-size:2em;"><strong>Prioridad</strong></div>';
	$categories = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = 68 ORDER BY term_id DESC");
	foreach ($categories as $cat) {
		$estatus = status($cat);
		$berre = '<br />';
		echo $estatus;
		echo $berre;
	}
	
	
// 	Estado
	echo '<div style="padding-bottom:10px;padding-top:10px;font-weight:bold;font-size:2em;"><strong>Estado</strong></div>';
		$contopen = $wpdb->get_var("SELECT count  FROM wp_term_taxonomy WHERE term_taxonomy_id = 68");
		$contwait = $wpdb->get_var("SELECT count  FROM wp_term_taxonomy WHERE term_taxonomy_id  = 67");
		$contclosed = $wpdb->get_var("SELECT count  FROM wp_term_taxonomy WHERE term_taxonomy_id  = 66");

	echo '<a href="http://interno.mecus.es/?cat=67">Abierto</a> &nbsp;&nbsp;&nbsp;  ';
	echo '<font color="green"><strong>('.$contopen.')</strong></font>';
		echo $berre;
	echo '<a href="http://interno.mecus.es/?cat=66">En Espera</a> &nbsp;&nbsp;&nbsp;  ';
	echo '<font color="grey"><strong>('.$contwait.')</strong></font>';
		echo $berre;
	echo '<a href="http://interno.mecus.es/?cat=65">Cerrado</a> &nbsp;&nbsp;&nbsp;  ';
	echo '<font color="red"><strong>('.$contclosed.')</strong></font>';
		echo $berre;
		
		
// Usuarios
	echo '<div style="padding-bottom:10px;padding-top:10px;font-weight:bold;font-size:2em;"><strong>Usuarios</strong></div>';
	$categories = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = 56");
	foreach ($categories as $cat) {
		$estatus = status($cat);
		$berre = '<br />';
		echo $estatus;
		echo $berre;
	}

   
// Organización interna
/*	echo '<div style="padding-bottom:10px;padding-top:10px;font-weight:bold;font-size:2em;"><strong>Organización interna</strong></div>';
	$categories = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = 143");
	foreach ($categories as $cat) {
		$estatus = status($cat);
		$berre = '<br />';
		echo $estatus;
		echo $berre;
		$isparent = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = '$cat'");
		echo '<div style="padding-left:10px;">';				
		foreach ($isparent as $parent) {
			echo '<div style="padding-left:15px;background:url(http://interno.mecus.es/wp-content/themes/bach/i/flechita.png) no-repeat;">';
			$estatus = status($parent);
			$berre = '<br />';
			echo $estatus;
			echo $berre;
			echo '</div>';
			$categories = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = '$parent'");
			echo '<div style="padding-left:20px;">';			
			foreach ($categories as $cat) {
				echo '<div style="padding-left:15px;background:url(http://interno.mecus.es/wp-content/themes/bach/i/flechita.png) no-repeat;">';
				$estatus = status($cat);
				$berre = '<br />';
				echo $estatus;
				echo $berre;
				echo '</div>';
			}
			echo '</div>';
		}
		echo '</div>';
	}
*/
// Proyectos en desarrollo
/*	echo '<div style="padding-bottom:10px;padding-top:10px;font-weight:bold;font-size:2em;"><strong>Desarrollo</strong></div>';
	$categories = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = 99");
	foreach ($categories as $cat) {
		$estatus = status($cat);
		$berre = '<br />';
		echo $estatus;
		echo $berre;
		$isparent = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = '$cat'");
		echo '<div style="padding-left:10px;">';				
		foreach ($isparent as $parent) {
			echo '<div style="padding-left:15px;background:url(http://interno.mecus.es/wp-content/themes/bach/i/flechita.png) no-repeat;">';
			$estatus = status($parent);
			$berre = '<br />';
			echo $estatus;
			echo $berre;
			echo '</div>';
			$categories = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = '$parent'");
			echo '<div style="padding-left:20px;">';			
			foreach ($categories as $cat) {
				echo '<div style="padding-left:15px;background:url(http://interno.mecus.es/wp-content/themes/bach/i/flechita.png) no-repeat;">';
				$estatus = status($cat);
				$berre = '<br />';
				echo $estatus;
				echo $berre;
				echo '</div>';
			}
			echo '</div>';
		}
		echo '</div>';
	}*/

// Proyectos en mantenimiento
/*	echo '<div style="padding-bottom:10px;padding-top:10px;font-weight:bold;font-size:2em;"><strong>Mantenimiento</strong></div>';
	$categories = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = 141");
	foreach ($categories as $cat) {
		$estatus = status($cat);
		$berre = '<br />';
		echo $estatus;
		echo $berre;
		$isparent = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = '$cat'");
		echo '<div style="padding-left:10px;">';				
		foreach ($isparent as $parent) {
			echo '<div style="padding-left:15px;background:url(http://interno.mecus.es/wp-content/themes/bach/i/flechita.png) no-repeat;">';
			$estatus = status($parent);
			$berre = '<br />';
			echo $estatus;
			echo $berre;
			echo '</div>';
			$categories = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = '$parent'");
			echo '<div style="padding-left:20px;">';			
			foreach ($categories as $cat) {
				echo '<div style="padding-left:15px;background:url(http://interno.mecus.es/wp-content/themes/bach/i/flechita.png) no-repeat;">';
				$estatus = status($cat);
				$berre = '<br />';
				echo $estatus;
				echo $berre;
				echo '</div>';
			}
			echo '</div>';
		}
		echo '</div>';
	}
*/
// Proyectos cerrados
/*	echo '<div style="padding-bottom:10px;padding-top:10px;font-weight:bold;font-size:2em;"><strong>Cerrados</strong></div>';
	$categories = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = 142");
	foreach ($categories as $cat) {
		$estatus = status($cat);
		$berre = '<br />';
		echo $estatus;
		echo $berre;
		$isparent = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = '$cat'");
		echo '<div style="padding-left:10px;">';				
		foreach ($isparent as $parent) {
			echo '<div style="padding-left:15px;background:url(http://interno.mecus.es/wp-content/themes/bach/i/flechita.png) no-repeat;">';
			$estatus = status($parent);
			$berre = '<br />';
			echo $estatus;
			echo $berre;
			echo '</div>';
			$categories = $wpdb->get_col("SELECT term_id FROM wp_term_taxonomy WHERE parent = '$parent'");
			echo '<div style="padding-left:20px;">';			
			foreach ($categories as $cat) {
				echo '<div style="padding-left:15px;background:url(http://interno.mecus.es/wp-content/themes/bach/i/flechita.png) no-repeat;">';
				$estatus = status($cat);
				$berre = '<br />';
				echo $estatus;
				echo $berre;
				echo '</div>';
			}
			echo '</div>';
		}
		echo '</div>';
	}
*/

?>
<br /><br />
<ul>

		<li class="credits">
			<p><a href="http://mecus.es/">Mecus Track System</a><br /> Original Prologue Theme modified by <a href="http://mecus.es/">Mecus</a></p>
		</li>
	</ul>



</div> <!-- // sidebar -->
