<?php
/*
    Template Name: Blog Page
*/

get_header();
$pageID = get_the_ID();
?>

<?php 
$banner = get_field('banner_section');

if ($banner):

    $image = $banner['banner_image'];
    $title = $banner['title'];
    $subtitle = $banner['subtitle'];
    $button = $banner['button_link'];

    if ($image || $title || $subtitle || $button):
?>

<section class="sub-banner-section">
    <div class="sub-background-img"
        <?php if ($image): ?>
            style="background-image:url('<?php echo esc_url($image['url']); ?>');"
        <?php endif; ?>
    >
        <div class="content-blk">
            <div class="container">
                <div class="sub-banner-content">

                    <?php if ($title || $subtitle): ?>
                    <div>
                        <?php if ($title): ?>
                            <h1><?php echo esc_html($title); ?></h1>
                        <?php endif; ?>

                        <?php if ($subtitle): ?>
                            <h3 aria-level="2"><?php echo esc_html($subtitle); ?></h3>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($button): 
                        $url = $button['url'];
                        $text = $button['title'];
                        $target = $button['target'] ? $button['target'] : '_self';
                    ?>
                    <div>
                        <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>" class="consult-btn-bnr">
                            <?php echo esc_html($text); ?>
                        </a>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; endif; ?>

<section class="blog-swiper-section">
  <div class="container">
    <div class="blog-grid"> 

        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $query = new WP_Query([
          'post_type' => 'post',
          'posts_per_page' => get_option('posts_per_page'),
          'paged' => $paged
        ]);

        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();
        ?>

        <div class="blog-card">
          <a href="<?php the_permalink(); ?>">

            <div class="icon">
              <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('full'); ?>
              <?php else: ?>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-image.png" alt="">
              <?php endif; ?>
            </div>

            <h4 aria-level="2"><?php the_title(); ?></h4>

            <div class="bottom">
              <span><?php echo get_the_date('F j, Y'); ?></span>

             
              <a class="read-btn" href="<?php the_permalink(); ?>">MORE</a>
            </div>

          </a>
        </div>

        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>

    </div>

<div class="pagination">
  <?php
  echo paginate_links([
    'total'      => $query->max_num_pages,
    'current'    => $paged,
    'prev_text'  => '<span class="arrow-prev"></span>',
    'next_text'  => '<span class="arrow-next"></span>',
  ]);
  ?>
</div>
  </div>
</section>


<?php get_footer(); ?>