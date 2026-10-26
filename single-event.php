<?php

get_header();
$pageID = get_the_ID();
wp_enqueue_script('swiper');
add_action('wp_footer', 'home_scripts', 25);
function home_scripts()
{ ?>



<?php } ?>  

 <section class="event-update">
  <div class="container">
    
    <?php
    $group = get_field('event_fields');

    $start = $group['event_start'] ?? '';
    $end   = $group['event_end'] ?? '';

    $display_date = '';

    if(!empty($start)){
      $start_obj = date_create($start);
      $end_obj   = !empty($end) ? date_create($end) : null;

      if($start_obj){
        $date = date_format($start_obj, 'F j');
        $start_time = date_format($start_obj, 'g:i a');
        $end_time   = $end_obj ? date_format($end_obj, 'g:i a') : '';

        if($end_time){
          $display_date = $date . " @ " . $start_time . " – " . $end_time;
        } else {
          $display_date = $date . " @ " . $start_time;
        }
      }
    }
    ?>

    
    <div class="event-head">
      <h1>
        <?php
          $title = get_the_title();

          
          $words = explode(' ', $title);
          $last_word = array_pop($words);

          echo esc_html(implode(' ', $words)) . ' ' . esc_html($last_word);
        ?>
      </h1>

      <?php if($display_date): ?>
        <p><?php echo esc_html($display_date); ?></p>
      <?php endif; ?>
    </div>

  
        <div class="event-card">
        <?php

          $img = $group['image'] ?? '';

          if (!empty($img)):
        ?>
          <img 
            src="<?php echo esc_url($img['url']); ?>" 
            alt="<?php echo esc_attr($img['alt']); ?>"
          >
        <?php endif; ?>
      </div>
    
    <div class="nav">

  <?php
  $prev_post = get_previous_post();
  $next_post = get_next_post();
  ?>

  <!-- Previous -->
  <?php if ($prev_post  ): ?>
    <a href="<?php echo get_permalink($prev_post->ID); ?>">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-detail/prev.svg" alt="Previous Event">
      <span>Back</span>
    </a>
  <?php endif; ?>

  <!-- Next -->
  <?php if ($next_post): ?>
    <a href="<?php echo get_permalink($next_post->ID); ?>">
      <span>Next</span>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-detail/next.svg" alt="Next Event">
    </a>
  <?php endif; ?>

</div>

  </div>
</section> 


<?php get_footer(); ?>