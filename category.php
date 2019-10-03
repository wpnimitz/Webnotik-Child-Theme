<?php

get_header();

?>

<div id="main-content">
	<div class="ep_pb_section et_pb_gutters1 webnotik-category">
	 	<div class="et_pb_row et_pb_gutters2">
			<?php 
			// Check if there are any posts to display
			if ( have_posts() ) : ?>


			<?php
			 
			// The Loop
			$counter = 1;
			while ( have_posts() ) : the_post(); ?>

				<div class="et_pb_column et_pb_column_1_3">	
				<article>
					<div class="ep_pb_image_container">
						<a href="<?php the_permalink() ?>" class="entry-featured-image-url free-background-overlay">
							<?php 
							if ( has_post_thumbnail() ) {
							    $featured_image = get_the_post_thumbnail_url();
							} else {
								$featured_image = get_stylesheet_directory_uri() . '/assets/img/no-image.jpg';
							} ?>

							<img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>">
						</a>
					</div>
					<div class="et_pb_text_inner">
						<a href="<?php the_permalink() ?>"><h2 class="entry-title"><?php the_title(); ?></h2></a>
						<p class="entry-content">
							<?php the_excerpt(); ?>
							<a class="more-link" href="<?php the_permalink() ?>">Read More</a>
						</p>
					</div>
				</article>
				</div>			
			 
			<?php 
				if($counter % 3 == 0) {
					echo '</div><div class="et_pb_row et_pb_gutters2">';
				}
   				$counter++;
			endwhile; 
			 
			else: ?>
			<p>Sorry, no posts matched your criteria.</p>
			 
			 
			<?php endif; ?>
			<?php wp_link_pages(); ?>
		</div>
	</div>
</div> <!-- #main-content -->

<?php

get_footer();
