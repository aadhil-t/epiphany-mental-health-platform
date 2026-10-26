<?php
get_header();
$pageID = get_the_ID();
?>

    <div id="primary" class="content-area">
        <header class="page-header">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </header><!-- .page-header -->

        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content/content', get_theme_mod('display_excerpt_or_full_post', 'excerpt'));

        endwhile;

        // Previous/next page navigation.
        twenty_twenty_one_the_posts_navigation();
        ?>
    </div>

<?php
get_footer();
