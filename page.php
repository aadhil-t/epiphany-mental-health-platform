<?php

get_header();
?>
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
                </div>z
            </div>
        </section>
        <?php endif; ?>    
<div class="default_page">
    <div class="container">
   
        <?php if (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>