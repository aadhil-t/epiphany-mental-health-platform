<?php
/*
    Template Name: Service Page
    */

get_header();
$pageID = get_the_ID();

function home_scripts()
{ ?>


<?php } ?>

<?php
$banner = get_field('banner_section',$pageID);
if (isset($banner) && !empty(array_filter($banner))): 
?>
<section class="sub-banner-section">
    <div class="sub-background-img" style="background-image: url('<?php echo $banner['banner_image']['url']; ?>');" alt="<?php echo $banner['banner_image']['alt']; ?>"  title="<?php echo $banner['banner_image']['title']; ?>" >
        <div class="content-blk">
            <div class="container">
                <div class="sub-banner-content">
                    <div>
                      <?php if($banner['title']): ?>
                        <h1 data-aos="fade-right"><?php echo $banner['title']; ?></h1>
                      <?php endif; ?>
                      <?php if($banner['subtitle']): ?>
                        <h3 data-aos="fade-right" aria-level="2"><?php echo $banner['subtitle']; ?></h3>
                      <?php endif; ?>
                    </div>
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

<?php 
$args = array(
    'post_type' => 'service',
    'posts_per_page' => -1,
);
$query = new WP_Query($args);
if ($query->have_posts()): ?>
<section class="services-section">
  <div class="container">
    <h2 class="section-title" data-aos="fade-up">See Our Services</h2>

    <div class="services-grid">
      <?php 
      $i=1;
      while ($query->have_posts()): $query->the_post(); ?>
      <div class="service-card  card-<?php echo $i; ?>" data-aos="zoom-in" style="background-color: <?php echo get_field('sev_bg_cl'); ?>;">
        <div>
          <h3><?php the_title(); ?></h3>
          <p>
            <?php echo wp_trim_words(get_the_content(), 20); ?>
          </p>
        </div>
        <a href="<?php echo get_permalink(); ?>" class="read-btn">Learn More</a>
      </div>
      <?php $i++; endwhile; ?>
      <?php wp_reset_postdata(); ?>

    </div>
  </div>
</section>
<?php endif; ?>

<?php $therapy = get_field('lft_img_co',$pageID); 
if(isset($therapy) && !empty(array_filter($therapy))): ?>
<section class="therapy-section">
  <div class="container">
    <?php if($therapy['main_tit_ser']): ?>
      <h2 data-aos="fade-up"><?php echo $therapy['main_tit_ser']; ?></h2>
    <?php endif; ?>
    <div class="therapy-wrapper">

    
       <?php if($therapy['image']): ?>
      <div class="therapy-image" data-aos="zoom-in">
        <img src="<?php echo $therapy['image']['url']; ?>" alt="<?php echo $therapy['image']['alt']; ?>"  title="<?php echo $therapy['image']['title']; ?>">
      </div>
      <?php endif; ?>

    
      <div class="therapy-content" data-aos="fade-left">

        <?php if($therapy['content_section']): ?>
          <p>
            <?php echo $therapy['content_section']; ?>
          </p>
        <?php endif; ?>

        <?php if($therapy['text_abv']): ?>
        <p class="note">
          <?php echo $therapy['text_abv']; ?>
        </p>
        <?php endif; ?>

        <?php if($therapy['button']): ?>
        <div>
          <a href="<?php echo $therapy['button']['url']; ?>" target="<?php echo $therapy['button']['target']; ?>" class="consult-btn">
            <span><?php echo $therapy['button']['title']; ?></span>
          </a>
        </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
<?php endif; ?>

<?php $img_sec = get_field('fl_img', $pageID); ?>

<?php if ($img_sec): ?>
<section class="image-section">
    <div class="image-blk">
        <img src="<?php echo esc_url($img_sec['url']); ?>" 
             alt="<?php echo esc_attr($img_sec['alt']); ?>"  
             title="<?php echo esc_attr($img_sec['title']); ?>">
    </div>
</section>
<?php endif; ?>


<?php get_footer(); ?>