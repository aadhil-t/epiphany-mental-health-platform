<?php get_header(); ?>
<style>
    .innerBanner {
        display: none;
    }
</style>
<div class="notfound_page">
    <div class="container">
       <div class="wrap-section">
  <?php
    $group = get_field('404_section', 'option');

    $img  = $group['404_image'] ?? '';
    $btn  = $group['home_button'] ?? '';
  ?>

  <?php if (!empty($img)): ?>
    <img 
      src="<?php echo esc_url($img['url']); ?>" 
      alt="<?php echo esc_attr($img['alt'] ?: '404 Image'); ?>"
    >
  <?php endif; ?>

  <?php if (!empty($btn)): ?>
    <a 
      href="<?php echo esc_url($btn['url']); ?>" 
      class="read-btn"
      target="<?php echo esc_attr($btn['target'] ?: '_self'); ?>"
    >
      <?php echo esc_html($btn['title']); ?>
    </a>
  <?php endif; ?>
</div>
    </div>
</div>

<?php get_footer(); ?>