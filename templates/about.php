<?php
/*
    Template Name: About Page
    */

get_header();
$pageID = get_the_ID();
wp_enqueue_script('swiper');
add_action('wp_footer', 'home_scripts', 25);
function home_scripts()
{ ?>

<script>
  const faqItems = document.querySelectorAll(".faq-item");

  faqItems.forEach((item) => {
    const btn = item.querySelector(".faq-question");

    btn.addEventListener("click", () => {
      const isActive = item.classList.contains("active");

      
      faqItems.forEach((el) => el.classList.remove("active"));

     
      if (!isActive) {
        item.classList.add("active");
      }
    });
  });
</script>

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
                    <?php if(!empty($banner['title'])): ?>
                    <div>
                        <h1 data-aos="fade-right"><?php echo $banner['title']; ?></h1>
                         <h3 data-aos="fade-right" aria-level="2"><?php echo $banner['subtitle']; ?></h3>

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



<?php
$who_we_are = get_field('about_who_we_are', $pageID);

if (!empty($who_we_are)): 
?>

<section class="ocd-treatment-section pad-115">
  <div class="container">
    <div class="ocd-treatment-wrapper">

      <div class="ocd-treat-cnt">

        <?php if(!empty($who_we_are['section_title'])): ?>
          <h2 class="section-title mar-15" data-aos="fade-up">
            <?php echo esc_html($who_we_are['section_title']); ?>
          </h2>
        <?php endif; ?>

        <?php if(!empty($who_we_are['subtitle'])): ?>
          <h3 class="second-title" data-aos="fade-up">
            <?php echo esc_html($who_we_are['subtitle']); ?>
          </h3>
        <?php endif; ?>

        <?php if(!empty($who_we_are['content'])): ?>
          <div data-aos="fade-up">
            <?php echo wp_kses_post($who_we_are['content']); ?>
          </div>
        <?php endif; ?>

      </div>

      <div class="therapy-image width-556">

        <?php if(!empty($who_we_are['image'])): ?>
          <img class="img-556" data-aos="zoom-in"  
               src="<?php echo esc_url($who_we_are['image']['url']); ?>" 
               alt="<?php echo esc_attr($who_we_are['image']['alt'] ?: ''); ?>">
        <?php endif; ?>

        <div class="img-content">

          <?php if(!empty($who_we_are['quote'])): ?>
            <h4><?php echo esc_html($who_we_are['quote']); ?></h4>
          <?php endif; ?>

          <?php if(!empty($who_we_are['quote_author'])): ?>
            <p class="img-author">
              <?php echo esc_html($who_we_are['quote_author']); ?>
            </p>
          <?php endif; ?>

        </div>

      </div>

    </div>
  </div>
</section>

<?php endif; ?>




<section class="why-epiphany no-before">
  <div class="bg-img pad-115">
    
     <?php 
     $expect = get_field('therapy_expect', $pageID);
     ?>

<div class="container">
  <div class="about-epiphany-cnt">

    <?php if(!empty($expect['section_title'])): ?>
      <h3 class="abt-section-title" data-aos="fade-up">
        <?php echo nl2br(esc_html($expect['section_title'])); ?>
      </h3>
    <?php endif; ?>

    <?php if(!empty($expect['content'])): ?>
      <div data-aos="fade-up">
        <?php echo wp_kses_post($expect['content']); ?>
      </div>
    <?php endif; ?>

    <?php if(!empty($expect['button_link'])): ?>
      <div data-aos="fade-left">
        <a href="<?php echo esc_url($expect['button_link']['url']); ?>" 
           target="<?php echo esc_attr($expect['button_link']['target'] ?: '_self'); ?>" 
           class="consult-btn">

           <span><?php echo esc_html($expect['button_link']['title']); ?></span>
        </a>
      </div>
    <?php endif; ?>

  </div>  
</div>
    
      
  <div class="team-section no-before margin-335px">
    <?php 
            $therapists = $expect['select_therapists'] ?? [];
            ?>
        <div class="container">
    
        <h2 class="team-title" data-aos="fade-up"> <?php echo nl2br(esc_html($expect['team_title'])); ?> </h2>
              

            <?php 

            if (!empty($therapists)) :
              $i = 0;
            ?>

        <div class="team-wrapper">

            <?php foreach ($therapists as $post) : 
              setup_postdata($post);
              $i++;

              $classes = ['card-left', 'card-center', 'card-right'];
              $class = $classes[($i - 1) % 3];

              $name  = get_the_title();
              $role  = get_field('short_designation');
              $image = get_field('profile_image');
            ?>


              <?php // empty flex item kept so the .team-wrapper gap spacing stays exactly as before ?>
              <span aria-hidden="true"></span>

                <div class="team-card <?php echo esc_attr($class); ?>">

                  <a href="<?php the_permalink(); ?>">
                  <div class="photo" data-aos="flip-left">
                    <span class="tape"></span>

                    <?php if ($image): ?>
                      <img src="<?php echo esc_url($image['url']); ?>" alt="">
                    <?php endif; ?>

                  </div>

                  <div class="info">
                    <h4 aria-level="3"><?php echo esc_html($name); ?></h4>
                    <p><?php echo esc_html($role); ?></p>
                  </div>
                  </a>

                  <div class="circle-btn">
                    <a href="<?php the_permalink(); ?>" class="circle-arrow" aria-label="<?php echo esc_attr('View profile of ' . $name); ?>">
                      <span class="arrow"></span>
                    </a>
                  </div>

                </div>

            <?php endforeach; wp_reset_postdata(); ?>

            </div>

            <?php endif; ?>
    
        <!-- bottom flowers -->
        <div class="team-bottom-img"></div>
    
      </div>
    
      </div> 

  </div>

</section>


<?php 
$service_section = get_field('service_section', $pageID); 

if ($service_section): 
  $cactus_image = $service_section['cactus_image'];
  $title = $service_section['title'];
?>
<section class="cactus-section">

  <?php if ($cactus_image): ?>
    <img src="<?php echo esc_url($cactus_image['url']); ?>" alt="<?php echo esc_attr($cactus_image['alt']); ?>">
  <?php endif; ?>



</section>

<?php endif; ?>



<?php 
$faq = get_field('faq_section');
?>

<?php if(!empty($faq)): ?>
<section class="faq-section">
  <div class="container">
    <div class="faq-wrapper">

      <!-- LEFT -->
      <div class="faq-left" data-aos="fade-right">
        <h2>
          <?php echo nl2br(esc_html($faq['faq_title'] ?? '')); ?>
        </h2>
      </div>

      <!-- RIGHT -->
      <div class="faq-right" data-aos="fade-left">

        <?php if(!empty($faq['faq_items'])): 
          $i = 0;
        ?>

          <?php foreach($faq['faq_items'] as $item): 
            $i++;
            $is_active = ($i === 1) ? 'active' : '';
          ?>

          <div class="faq-item <?php echo $is_active; ?>">

            <?php if(!empty($item['question'])): ?>
              <button class="faq-question">
                <span><?php echo esc_html($item['question']); ?></span>
                <i class="arrow"></i>
              </button>
            <?php endif; ?>

            <?php if(!empty($item['answer'])): ?>
              <div class="faq-answer">
                <?php echo wp_kses_post($item['answer']); ?>
              </div>
            <?php endif; ?>

          </div>

          <?php endforeach; ?>

        <?php endif; ?>

      </div>

    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>