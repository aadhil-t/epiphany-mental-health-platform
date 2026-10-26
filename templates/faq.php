<?php
$args = array(
  'post_type' => 'faq', // 👈 important
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'orderby' => 'menu_order',
  'order' => 'ASC'
);

$faq_query = new WP_Query($args);

if ($faq_query->have_posts()) :
?>

<section class="faq-section">
  <div class="container">
    <?php
        $banner = get_field('banner_section',$pageID);
        if (isset($banner) && !empty(array_filter($banner))): 
        ?>
        <section class="sub-banner-section">
            <div class="sub-background-img" style="background-image: url('<?php echo $banner['banner_image']['url']; ?>');" alt="<?php echo $banner['banner_image']['alt']; ?>"  title="<?php echo $banner['banner_image']['title']; ?>" >
                <div class="content-blk">
                    <div class="container">
                        <div class="sub-banner-content">
                            <?php if(!empty($banner['title'])): ?>
                            <div>
                                <h1 data-aos="fade-right"><?php echo $banner['title']; ?></h1>
                            </div>
                            <?php endif; ?>
                            <?php if($banner['button_link']): ?>
                            <div data-aos="fade-left">
                                <a href="<?php echo $banner['button_link']['url']; ?>" target="<?php echo $banner['button_link']['target']; ?>" class="consult-btn-bnr">
                                    <?php echo $banner['button_link']['title']; ?>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>


    <?php while ($faq_query->have_posts()) : $faq_query->the_post(); ?>

      <div class="faq-item">
        <h3 class="faq-question"><?php the_title(); ?></h3>
        <div class="faq-answer"><?php the_content(); ?></div>
      </div>

    <?php endwhile; ?>

  </div>
</section>

<?php wp_reset_postdata(); endif; ?>