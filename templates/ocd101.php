<?php
/*
    Template Name: Ocd 101 Page
    */

get_header();
$pageID = get_the_ID();

function home_scripts()
{ ?>


<?php } ?>


<?php 
$banner = get_field('banner_section');

if ($banner): 

    $image   = $banner['banner_image'] ?? '';
    $title   = $banner['title'] ?? '';
    $subtitle= $banner['subtitle'] ?? '';
    $button  = $banner['button_link'] ?? '';

    
    if (!$image && !$title && !$subtitle && !$button) {
        return;
    }
?>

<section class="sub-banner-section">

    <div class="sub-background-img"
        <?php if($image): ?>
            style="background-image:url('<?php echo esc_url($image['url']); ?>');"
        <?php endif; ?>>

        <div class="content-blk">
            <div class="container">

                <div class="sub-banner-content">

                    <?php if($title || $subtitle): ?>
                        <div>
                            
                            <?php if($title): ?>
                                <h1 data-aos="fade-right">
                                    <?php echo esc_html($title); ?>
                                </h1>
                            <?php endif; ?>

                            <?php if($subtitle): ?>
                                <p data-aos="fade-right">
                                    <?php echo esc_html($subtitle); ?>
                                </p>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>


                    <?php if($button): ?>
                        <div data-aos="fade-left">
                            <a href="<?php echo esc_url($button['url']); ?>" 
                               class="consult-btn-bnr"
                               target="<?php echo esc_attr($button['target']); ?>">
                                <?php echo esc_html($button['title']); ?>
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
$therapy = get_field('therapy_section');

if ($therapy): 

    $left_text = $therapy['left_text'] ?? '';
    $blocks    = $therapy['content_blocks'] ?? '';
    $image     = $therapy['image'] ?? '';

  
    if (!$left_text && !$blocks && !$image) {
        return;
    }
?>

<section class="therapy-types-section">
  <div class="container">

    <?php if($left_text || $blocks): ?>
    <div class="therapy-types-wrapper">

    
      <?php if($left_text): ?>
      <div class="left-content">
       <?php echo wp_kses_post($left_text); ?>
      </div>
      <?php endif; ?>


    
      <?php if($blocks): ?>
      <div class="right-content">

        <?php foreach($blocks as $block): ?>

          <?php if(!empty($block['heading'])): ?>
            <h2 data-aos="fade-left">
              <?php echo esc_html($block['heading']); ?>
            </h2>
          <?php endif; ?>

          <?php if(!empty($block['description'])): ?>
            <div data-aos="fade-left">
              <?php echo wp_kses_post($block['description']); ?>
            </div>
          <?php endif; ?>

        <?php endforeach; ?>

      </div>
      <?php endif; ?>

    </div>
    <?php endif; ?>


  
    <?php if($image): ?>
      <img class="ocd-image" 
           src="<?php echo esc_url($image['url']); ?>" 
           alt="<?php echo esc_attr($image['alt']); ?>">
    <?php endif; ?>

  </div>
</section>

<?php endif; ?>


<?php 
$section = get_field('ocd_types_section');

if ($section): 

    $title = $section['section_title'] ?? '';
    $subtitle = $section['section_subtitle'] ?? '';
    $types = $section['ocd_types'] ?? '';

    if (!$title && !$types) {
        return;
    }
?>

<section class="therapy-center-section no-before-overlay" style="padding-top: 0;">
  <div class="container">

    <?php if($title): ?>
      <div class="therapy-head-cnt" 
           data-aos="fade-up">
        <h3 data-aos="fade-up">
          <?php echo esc_html($title); ?>
        </h3>
        <?php echo $subtitle ; ?>
        
      </div>
    <?php endif; ?>


    <?php if($types): ?>
    <div class="therapy-grid-4 cell-4">

      <?php 
      $i = 0;
      foreach($types as $type): 
        $i++;
        $alt_class = ($i % 2 == 0) ? 'alt' : ''; 
      ?>

        <div class="cell <?php echo $alt_class; ?>" data-aos="fade-up">

          <?php if(!empty($type['title'])): ?>
            <h5 aria-level="4"><?php echo esc_html($type['title']); ?></h5>
          <?php endif; ?>

          <?php if(!empty($type['description'])): ?>
            <p><?php echo esc_html($type['description']); ?></p>
          <?php endif; ?>

        </div>

      <?php endforeach; ?>

    </div>
    <?php endif; ?>

  </div>
</section>

<?php endif; ?>


<?php 
$section = get_field('treatment_section');

if ($section): 

    $title   = $section['section_title'] ?? '';
    $image   = $section['section_image'] ?? '';
    $desc    = $section['main_description'] ?? '';
    $note    = $section['note_text'] ?? '';
    $button  = $section['button_link'] ?? '';

    if (!$title && !$image && !$desc && !$note && !$button) {
        return;
    }
?>

<section class="therapy-section no-before-overlay">
  <div class="container">

    <?php if($title): ?>
      <h2 class="prim" data-aos="fade-up">
        <?php echo esc_html($title); ?>
      </h2>
    <?php endif; ?>


    <div class="therapy-wrapper">

    
      <?php if($image): ?>
      <div class="therapy-image" data-aos="zoom-in">
        <img src="<?php echo esc_url($image['url']); ?>" 
             alt="<?php echo esc_attr($image['alt']); ?>">
      </div>
      <?php endif; ?>


    
      <div class="therapy-content" data-aos="fade-left">

        <?php if($desc): ?>
          <p class="thin">
            <?php echo esc_html($desc); ?>
          </p>
        <?php endif; ?>


        <?php if($note): ?>
          <p class="note">
            <?php echo nl2br(esc_html($note)); ?>
          </p>
        <?php endif; ?>


        <?php if($button): ?>
          <div>
            <a href="<?php echo esc_url($button['url']); ?>" 
               class="consult-btn"
               target="<?php echo esc_attr($button['target']); ?>">
              <span><?php echo esc_html($button['title']); ?></span>
            </a>
          </div>
        <?php endif; ?>

      </div>

    </div>
  </div>
</section>

<?php endif; ?>




<?php get_footer(); ?>