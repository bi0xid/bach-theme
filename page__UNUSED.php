<?php get_header( ); ?>

<div id="main">

<?php 
if( have_posts( ) ) { 
	while( have_posts( ) ) {
		the_post( ); 
?>

<div class="post" id="post-<?php the_ID( ); ?>">
	<div class="entry">
		<?php edit_post_link('Editar', '', ''); ?>
		<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

		<?php if ( comments_open() ) comments_template(); ?>

		<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

	</div> <!-- // entry -->
</div> <!-- post-<?php the_ID( ); ?> -->

<?php
	} // while have_posts

} // if have_posts
?>

	</ul>
</div> <!-- // main -->

<?php
get_footer( );
