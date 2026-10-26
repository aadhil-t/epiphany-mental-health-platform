<?php
get_header();
$pageID = get_the_ID();
?>

    <div id="primary" class="content-area">
        <header class="page-header">
            <section class="sub-banner-section">
           <div class="sub-background-img" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/service-detail/banner.png');">
            <div class="content-blk">
            <div class="container">
                <div class="sub-banner-content">
                    <div>
                        <h1 data-aos="fade-right"></h1>
                    </div>
                    <div data-aos="fade-left">
                        <a href="https://ocdandptsdtherapy.com/contact/" class="consult-btn-bnr">
                            SCHEDULE A CONSULTATION
                        </a>
                    </div>
                </div>
            </div>
            </div>
            </div>
           </section>
            <?php
            the_archive_title('<h1 class="page-title" style="padding:100px 60px 50px 60px;">', '</h1>');
            the_archive_description('<div class="archive-description" style="padding:0px 60px 60px 60px";>', '</div>');
            ?>
        </header>

        <?php
        while (have_posts()) :
            the_post();
        

        endwhile;

      
        ?>
    </div>

<?php
get_footer();?>
