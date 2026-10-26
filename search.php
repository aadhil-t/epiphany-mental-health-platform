<?php get_header();
add_action('wp_footer', 'scripts', 25);
function scripts()
{ ?>
	<script>
		

		
	</script>
	<?php
			}
				?>

<div class="search_page">
	<section class="page-wrap clearfix">
		<div class="container">
			<div class="search-sec clearfix" style="margin-top: 30px;">
				<?php if (have_posts()) :
					while (have_posts()) : the_post(); ?>
						<div class="search_post" style="height: auto !important;">
							<?php if (has_post_thumbnail()) {
								// $thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');

								// $thumb_params = array('width' => 460, 'height' => 460);
								// $thumb_crp = bfi_thumb($thumb, $thumb_params);

								// if ($thumb_crp) { 
							?>
								<div class="search-thumb">
									<?php the_post_thumbnail(); ?>
								</div>
							<?php }
							?>
							<div class="text-box">
								<h2 class="search-post-title">
									<a href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(), 0, 20); ?><?php if (strlen(get_the_title()) > 20) {
																															echo '...';
																														} ?></a>
								</h2>
								<p class="sear_cont <?php if (has_post_thumbnail()) {
															echo 'sear_cont_thum';
														} ?>">
									<?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
													</p>
								<div class="view-more"><a class="sear_read" href="<?php echo get_the_permalink(); ?>"><?php _e('Read More', 'acodez'); ?></a></div>
							</div>
						</div>
					
					<?php endwhile; ?>
					<div class="navigation row">
						<div class="alignleft"><?php next_posts_link('&laquo; Previous') ?></div>
						<div class="alignright"><?php previous_posts_link('Next &raquo;') ?></div>
					</div>
				<?php else : ?>
					<h2 class="center"><?php _e('Not Found', 'acodez'); ?></h2>
					<p class="center"><?php _e('Sorry, but you are looking for something that isn\'t here.', 'acodez'); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>
</div>
<?php get_footer(); ?>