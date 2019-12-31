<?php get_header(); ?>

<!-- Start the Loop -->
<?php while ( have_posts() ) : the_post(); ?>
	
	<!-- Content of blog post: -->
	<!-- title, thumb, content, nav, comments -->
	<div class="blog-single" style="margin-top: 50px">
		<?php get_template_part( 'content-single', get_post_format() );

/* End of the loop. */
endwhile; ?> 

	<!-- Sidebar of blog post -->
	<?php get_sidebar(); ?>

	</div> <!-- End of content-->

<?php get_footer(); ?>
