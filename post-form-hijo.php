<script>
                        jQuery(document).ready(function() {
                                jQuery( "#datepicker-field" ).datepicker();
                        });
                    </script>

<?php
		// Get ID's
	
		$user			= get_userdata( $current_user->ID );
		$first_name		= attribute_escape( $user->first_name );

			$prioridades = get_option('bach_priorities'); 
			$priorities = get_cat_id($prioridades);
			$proyectos = get_option('bach_projects'); 
			$projects = get_cat_id($proyectos);
			$usuarios = get_option('bach_users'); 
			$users = get_cat_id($usuarios);



?>
<div align="center">
<div id="postbox">
	<div style="color:blue;font-weight:bold;font-size:16px;">Creando hijo de <?php echo $parent_title; ?></div>

	<form id="new_post" name="new_post" method="post" action="<?php bloginfo( 'url' ); ?>/hijos/">

		<input type="hidden" name="action" value="post" />
		<?php wp_nonce_field( 'new-post' ); ?>

		<?php echo prologue_get_avatar( $user->ID, $user->user_email, 48 ); ?>

            <input type="text" name="postTitle" id="postTitle" tabindex="1" size="60" />
<br />
		<textarea name="posttext" id="posttext" rows="3" cols="60" tabindex="2" ></textarea>


<?php if (!in_category('65')) :	?>
							
	<script>
           jQuery(document).ready(function() {
           jQuery( "#fecha" ).datepicker({ firstDay: 1 });
           });

    </script>

		<div style="float:right;clear:left;">	Fecha de entrega &nbsp;&nbsp;	<input type="text" id="fecha" name="fecha" value="<?php if (!empty($fecha_entrega)) echo 'CAMBIAR'; ?>" size="20" tabindex="7" /></div>

			<?php if (!empty($fecha_entrega)) echo '<big><strong>'.$fecha_entrega.'</strong></big>'; ?>

<?php endif; ?>
			
		<div style="float:left; width:600px;padding-left:200px;">	<label for="cats" id="tags">Categorías</label>
            <span style="padding-left: 20px;">  <?php wp_dropdown_categories( array(
                'hide_empty' => 0,
                'name' => 'prioridad',
                'orderby' => 'name',
                'class' => 'catSelection',
                'hierarchical' => 1,
                'child_of' => $priorities,
                'show_option_none' => __('Prioridad'),
                //'selected' => ,  // how to select default cat by default?
                'tab_index' => 4
                )
            ); ?>
	<?php //wp_dropdown_categories(array('hide_empty' => 0, 'hide_if_empty' => false, 'taxonomy' => $taxonomy, 'name' => 'parent', 'orderby' => 'name', 'hierarchical' => true, 'show_option_none' => __('None'))); ?>
            <span style="padding: 0 15px;"><?php echo $cat_name; ?></span>
            <?php wp_dropdown_categories( array(
                'hide_empty' => 0,
                'name' => 'usuario',
                'orderby' => 'name',
                'class' => 'catSelection',
                'hierarchical' => 1,
                'child_of' => $users,
                'show_option_none' => __('Usuario'),
                //'selected' => ,  // how to select default cat by default?
                'tab_index' => 6
                )
            ); ?></span>

		<input type="hidden" name="cat_ID" value="<?php echo $cat_ID; ?>" />
		<input type="hidden" name="cat_name" value="<?php echo $cat_name; ?>" />
		<input type="hidden" name="post_parent" value="<?php echo $post_parent; ?>" />
		<input type="hidden" name="action" value="crear_hijo" />
		<input id="submit" type="submit" value="Publicar" style="margin-left: 20px;margin-bottom: 30px;margin-top:20px;" tabindex="8"/>
	</div></form>
</div> <!-- // postbox -->
</div><!-- // center -->
<?php echo $post_category; ?>

