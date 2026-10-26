<?php
/*
    Template Name: Service Detail Page
    */

get_header();
$pageID = get_the_ID();
wp_enqueue_script('swiper');
add_action('wp_footer', 'home_scripts', 25);
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

<?php
$ocd_treatment = get_field('sec1_ser',$pageID);
if (isset($ocd_treatment) && !empty(array_filter($ocd_treatment))): 
?>
<section class="therapy-types-section bottom-none">
  <div class="container">

    <div class="therapy-types-wrapper">

      <!-- LEFT -->
      <?php if(!empty($ocd_treatment['left_sec'])): ?>
      <div class="left-content">
        <p data-aos="fade-right">
          <?php echo $ocd_treatment['left_sec']; ?>
        </p>
      </div>
      <?php endif; ?>
      <!-- RIGHT -->
      <?php if(!empty($ocd_treatment['right_sec'])): ?>
      <div class="right-content">
        <?php echo $ocd_treatment['right_sec']; ?>
      </div>
      <?php endif; ?>
    </div>
    <?php if(!empty($ocd_treatment['image'])): ?>
    <img data-aos="fade-up"  class="ocd-image" src="<?php echo $ocd_treatment['image']['url']; ?>" alt="<?php echo $ocd_treatment['image']['alt']; ?>"  title="<?php echo $ocd_treatment['image']['title']; ?>">
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<?php $ocd_treatment_2 = get_field('sec2_ser',$pageID);
if (isset($ocd_treatment_2) && !empty(array_filter($ocd_treatment_2))): 
?>
<section class="ocd-treatment-section">
  <div class="container">
    <div class="ocd-treatment-wrapper">
      <?php if(!empty($ocd_treatment_2['title']) || !empty($ocd_treatment_2['left_content'])): ?>
        <div class="ocd-treat-cnt">
          <?php if(!empty($ocd_treatment_2['title'])): ?>
            <h2 class="section-title" data-aos="fade-up"><?php echo $ocd_treatment_2['title']; ?></h2>
          <?php endif; ?>
          <?php if(!empty($ocd_treatment_2['left_content'])): ?>
            <?php echo $ocd_treatment_2['left_content']; ?>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if(!empty($ocd_treatment_2['right_image'])): ?>
        <div  class="therapy-image">
            <img data-aos="zoom-in"  src="<?php echo $ocd_treatment_2['right_image']['url']; ?>" alt="<?php echo $ocd_treatment_2['right_image']['alt']; ?>"  title="<?php echo $ocd_treatment_2['right_image']['title']; ?>">
        </div>
        <?php endif; ?>
    </div>
  </div>
    
</section>
<?php endif; ?>

<?php $receiving_ocd_treatment = get_field('sec3_ser',$pageID);
if (isset($receiving_ocd_treatment) && !empty(array_filter($receiving_ocd_treatment))): 
?>
<section class="receiving-ocd-treatment">
  <div class="container">
    <div class="wrapper">

      <!-- LEFT -->
      <?php if(!empty($receiving_ocd_treatment['left_con_sec']) || !empty($receiving_ocd_treatment['button'])): ?>
      <div class="left" data-aos="fade-right">
          <?php echo $receiving_ocd_treatment['left_con_sec']; ?>
          <?php if(!empty($receiving_ocd_treatment['button'])): ?>
          <a href="<?php echo $receiving_ocd_treatment['button']['url']; ?>" target="<?php echo $receiving_ocd_treatment['button']['target']; ?>" class="consult-btn">
              <span><?php echo $receiving_ocd_treatment['button']['title']; ?></span>
          </a>
          <?php endif; ?>
      </div>
      <?php endif; ?>
      <!-- RIGHT -->
      <?php if(!empty($receiving_ocd_treatment['right_items'])): ?>
      <div class="right" data-aos="fade-left">
        <?php foreach($receiving_ocd_treatment['right_items'] as $item): ?>
        <div class="item">
          <?php echo preg_replace('/<h4(?=[\s>])/i', '<h4 aria-level="3"', $item['contents']); // editor h4s sit under an h2 ?>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

    </div>
  </div>
</section>
<?php endif; ?>
<?php get_footer(); ?>