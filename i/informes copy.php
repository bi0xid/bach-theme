<?php /*
Template Name: Informes
*/
?>

<?php get_header(); ?>

<div id="main">


 
<div align="center" style="font-variant:small-caps;font-size:14px;padding-bottom:20px;"><strong><a href="http://interno.mecus.es/informes">General</a> || <a href="http://interno.mecus.es/luis">Luis</a> || <a href="http://interno.mecus.es/rocio">Rocío</a> || <a href="http://interno.mecus.es/raven">RaveN</a> || <a href="http://interno.mecus.es/informe-cerrado/">Cerrados</a> </strong></div>


<?php /* PRIORIDAD 6 */ 
query_posts('cat=66,67,'.$value.'-70,-71,-72,-73,-74,-184&showposts=-1'); ?>

<ul class="informe">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

	<li>
		<span class="priority p6">AHORA MISMO</span> || <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> || <span style="background-color:<?php $exit = 0; 	foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'): echo '#aaa'; $exit = 1; endif;
    if ($exit != 1): if ($category->cat_ID == '57') echo '#f60'; if ($category->cat_ID == '58') echo 'blue';  if ($category->cat_ID == '144') echo 'green'; endif;
 } ?>	
;color:white;padding:5px;"><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></span>
	</li>

		<?php endwhile; ?>
	<?php endif; ?>
</ul>
  <?php rewind_posts(); ?>

<?php /* PRIORIDAD 5 */
query_posts('cat=66,67,-70,-71,-72,-73,-75,-184&showposts=-1'); ?>

<ul class="informe">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

	<li>
		<span class="priority p5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HOY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> || <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> || <span style="background-color:<?php $exit = 0; 	foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'): echo '#aaa'; $exit = 1; endif;
    if ($exit != 1): if ($category->cat_ID == '57') echo '#f60'; if ($category->cat_ID == '58') echo 'blue';  if ($category->cat_ID == '144') echo 'green'; endif;
 } ?>	
;color:white;padding:5px;"><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></span>
	</li>

		<?php endwhile; ?>
	<?php endif; ?>
</ul>
  <?php rewind_posts(); ?>

<?php /* PRIORIDAD 4 */
 query_posts('cat=66,67,-70,-71,-72,-74,-75,-184&showposts=-1'); ?>

<ul class="informe">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

	<li>
		<span class="priority p4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MAÑANA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> || <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> || <span style="background-color:<?php $exit = 0; 	foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'): echo '#aaa'; $exit = 1; endif;
    if ($exit != 1): if ($category->cat_ID == '57') echo '#f60'; if ($category->cat_ID == '58') echo 'blue';  if ($category->cat_ID == '144') echo 'green'; endif;
 } ?>	
;color:white;padding:5px;"><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></span>
	</li>

		<?php endwhile; ?>
	<?php endif; ?>
</ul>
  <?php rewind_posts(); ?>

<?php /* PRIORIDAD 3 */
 query_posts('cat=66,67,-70,-71,-73,-74,-75,-184&showposts=-1'); ?>

<ul class="informe">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

	<li>
		<span class="priority p3">&nbsp;ESTA SEMANA</span> || <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> || <span style="background-color:<?php $exit = 0; 	foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'): echo '#aaa'; $exit = 1; endif;
    if ($exit != 1): if ($category->cat_ID == '57') echo '#f60'; if ($category->cat_ID == '58') echo 'blue';  if ($category->cat_ID == '144') echo 'green'; endif;
 } ?>	
;color:white;padding:5px;"><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></span>
	</li>

		<?php endwhile; ?>
	<?php endif; ?>
</ul>
  <?php rewind_posts(); ?>


<?php /* PRIORIDAD 2 */
 query_posts('cat=66,67,-70,-72,-73,-74,-75,-184&showposts=-1'); ?>

<ul class="informe">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

	<li>
		<span class="priority p2">PROX. SEMANA</span> || <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> || <span style="background-color:<?php $exit = 0; 	foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'): echo '#aaa'; $exit = 1; endif;
    if ($exit != 1): if ($category->cat_ID == '57') echo '#f60'; if ($category->cat_ID == '58') echo 'blue';  if ($category->cat_ID == '144') echo 'green'; endif;
 } ?>	
;color:white;padding:5px;"><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></span>
	</li>

		<?php endwhile; ?>
	<?php endif; ?>
</ul>
  <?php rewind_posts(); ?>


<?php /* PRIORIDAD 1 */
 query_posts('cat=66,67,-71,-72,-73,-74,-75,-184&showposts=-1'); ?>

<ul class="informe">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

	<li>
		<span class="priority p1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ESTE MES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> || <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> || <span style="background-color:<?php $exit = 0; 	foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'): echo '#aaa'; $exit = 1; endif;
    if ($exit != 1): if ($category->cat_ID == '57') echo '#f60'; if ($category->cat_ID == '58') echo 'blue';  if ($category->cat_ID == '144') echo 'green'; endif;
 } ?>	
;color:white;padding:5px;"><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></span>
	</li>

		<?php endwhile; ?>
	<?php endif; ?>
</ul>
  <?php rewind_posts(); ?>


<?php /* PRIORIDAD 0 */
 query_posts('cat=66,67,-71,-72,-73,-74,-75,-70&showposts=-1'); ?>

<ul class="informe">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

	<li>
		<span class="priority p0">&nbsp;&nbsp;&nbsp;&nbsp;SIN FECHA&nbsp;&nbsp;&nbsp;&nbsp;</span> || <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> || <span style="background-color:<?php $exit = 0; 	foreach((get_the_category()) as $category) { 
    if ($category->cat_ID == '66'): echo '#aaa'; $exit = 1; endif;
    if ($exit != 1): if ($category->cat_ID == '57') echo '#f60'; if ($category->cat_ID == '58') echo 'blue';  if ($category->cat_ID == '144') echo 'green'; endif;
 } ?>	
;color:white;padding:5px;"><?php
foreach((get_the_category()) as $category) { 
    if (($category->cat_ID == '57') || ($category->cat_ID == '58') || ($category->cat_ID == '144')) {	
    	echo $category->cat_name; 
	}
}  ?></span>
	</li>

		<?php endwhile; ?>
	<?php endif; ?>
</ul>
  <?php rewind_posts(); ?>

		</div>

<?php get_footer(); ?>






