<!-- loads elements of blog post -->

<div class="entry-content blog-post-single">

	<!-- Title of blog post -->
	<h1 class="blog-post-title-single"><?php the_title(); ?></h1>

		<?php // array with parameters
		$args = array(
			'post_parent' => $post->ID,
			'post_type' => 'attachment',
			'orderby' => 'menu_order', // you can also sort images by date or be name
			'order' => 'ASC',
			'numberposts' => 20, // number of images (slides)
			'post_mime_type' => 'image'
			);

			$blog_slides = get_post_meta( get_the_ID( ), 'rnr_blogitemslides', false );

			if(!empty($blog_slides)) { ?>
				<div id="slider4" class="swiper-container4">
					<div class="swiper-wrapper">

		                <?php global $wpdb, $post;

		                if ( !is_array( $blog_slides ) )
		                    $blog_slides = ( array ) $blog_slides;

		                if ( !empty( $blog_slides ) ) {

		                    $blog_slides = implode( ',', $blog_slides );
		                    $images = $wpdb->get_col( "
		                    SELECT ID FROM $wpdb->posts
		                    WHERE post_type = 'attachment'
		                    AND ID IN ( $blog_slides )
		                    ORDER BY menu_order ASC
		                    " );

		                    foreach ( $images as $att ) {
		                        // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
		                        $image_src = wp_get_attachment_image_url( $att, $size = 'large' ); ?>
		                        <div class="swiper-slide"><img class="swiper-lazy" data-src="<?php echo $image_src;?>"></div>
		                    <?php
		                    } // ends foreach loop
		                } // ends if block (!empty $blogs_slides)
		                ?>

		            </ul>
		        </div><!-- Ends Swiper Container -->
		    </div><!-- Ends Swiper Wrapper -->
		    <?php } else if ( sizeof($images) > 1  ) {
				$images = get_children( $args ); ?>

				<div id="slider4" class="swiper-container4">
					<div class="swiper-wrapper">

						<?php foreach( $images as $image ) { ?>
							<div class="swiper-slide"><img src="<?php echo wp_get_attachment_image_url( $image->ID, $size = 'full');?>"></img></div>
						<?php } ?>

					</div>
			</div>
		<?php }  else { ?>
				<div class="blog-post-thumbnail-single"><?php the_post_thumbnail();?></div>
		<?php } ?>

		<!-- Loads neccessary javascript for slider functionality -->
		<script src="<?php echo get_template_directory_uri(); ?>/js/swiper.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/swiper.js"></script>


	<!-- loads content -->
	<div class="blog-post-content-single shadow"><?php the_content(); ?></div>

	<!-- loads content previous/next post navigation -->
	<!-- (only if a previous/next post exists) -->
	<?php if ( is_singular( 'post' ) ) {
			the_post_navigation(
				array(
					'next_text' => 'Volgende &rarr;',
					'prev_text' => '&larr; Vorige',
				)
			);
		}
	?>

	<!-- Loads up the comment template -->
	<!-- (only if comments are open or a comment exists) -->
	<?php if ( comments_open() || get_comments_number() ) {
	comments_template();
	}
	?>

</div>
