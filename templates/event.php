<?php
/*
    Template Name: Events 
*/
get_header();
$pageID = get_the_ID();

$now = date('Y-m-d H:i:s'); 


$paged_upcoming = isset($_GET['paged_upcoming']) ? absint($_GET['paged_upcoming']) : 1;
$paged_past     = isset($_GET['paged_past'])     ? absint($_GET['paged_past'])     : 1;
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
  'post_type'      => 'event',
  'posts_per_page' => get_option('posts_per_page'),
  'paged'          => $paged_upcoming,
  'meta_query'     => array(
    array(
      'key'     => 'event_fields_event_end',
      'value'   => $now,
      'compare' => '>='
    )
  ),
  'orderby'  => 'meta_value',
  'meta_key' => 'event_fields_event_start',
  'order'    => 'ASC'
);

$events = new WP_Query($args);

if ($events->have_posts()) : ?>

<section class="event-swiper-section event-upcoming" style="padding: 115px 0 0;" >
  <div class="container">

    <?php if (get_field('upcoming_heading')) : ?>
      <h3 class="section-title" aria-level="2"><?php the_field('upcoming_heading'); ?></h3>
    <?php endif; ?>

    <div class="event-grid">
      <?php while ($events->have_posts()) : $events->the_post();
        $group = get_field('event_fields');
        $start = $group['event_start'] ?? '';
        $end   = $group['event_end']   ?? '';
        $display_date = '';

        if ($start) {
          $start_obj    = date_create($start);
          $end_obj      = $end ? date_create($end) : null;
          $display_date = date_format($start_obj, 'F j') . ' @ ' . date_format($start_obj, 'g:i a');
          if ($end_obj) {
            $display_date .= ' - ' . date_format($end_obj, 'g:i a');
          }
        }
      ?>
      <div class="event-item">
        <div class="blog-card">
          <a href="<?php the_permalink(); ?>">
            <div class="top">
              <h4 aria-level="3"><?php the_title(); ?></h4>
              <?php if ($display_date) : ?>
                <span class="event-date"><?php echo esc_html($display_date); ?></span>
              <?php endif; ?>
            </div>
          </a>
            <div class="bottom">
              <?php // placeholder for the empty element browsers produced from the old nested link; keeps layout identical ?>
              <a aria-hidden="true"></a>
              <a href="<?php the_permalink(); ?>" class="read-btn" aria-label="<?php echo esc_attr('More about ' . get_the_title()); ?>">MORE</a>
            </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>

    <?php if ($events->max_num_pages > 1) : ?>
    <div class="pagination">
      <?php
        echo paginate_links(array(
          'base'      => add_query_arg('paged_upcoming', '%#%', get_pagenum_link(1)), 
          'format'    => '',
          'current'   => $paged_upcoming,
          'total'     => $events->max_num_pages,
          'prev_text' => '&laquo; Prev',
          'next_text' => 'Next &raquo;',
        ));
      ?>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php endif; wp_reset_postdata(); ?>


<?php
$args_all = array(
  'post_type'      => 'event',
  'posts_per_page' => get_option('posts_per_page'),
  'paged'          => $paged_past,
  'meta_query'     => array(
    array(
      'key'     => 'event_fields_event_end',
      'value'   => $now,
      'compare' => '<'
    )
  ),
  'orderby'  => 'meta_value',
  'meta_key' => 'event_fields_event_start',
  'order'    => 'DESC'
);

$events_all = new WP_Query($args_all);

if ($events_all->have_posts()) : ?>

<section class="event-swiper-section" style="padding: 115PX 0 115px;" >
  <div class="container">

    <?php if (get_field('all_events')) : ?>
      <h3 class="section-title" aria-level="2"><?php the_field('all_events'); ?></h3>
    <?php endif; ?>

    <div class="event-grid">
      <?php while ($events_all->have_posts()) : $events_all->the_post();
        $group = get_field('event_fields');
        $start = $group['event_start'] ?? '';
        $end   = $group['event_end']   ?? '';
        $display_date = '';

        if ($start) {
          $start_obj    = date_create($start);
          $end_obj      = $end ? date_create($end) : null;
          $display_date = date_format($start_obj, 'F j') . ' @ ' . date_format($start_obj, 'g:i a');
          if ($end_obj) {
            $display_date .= ' - ' . date_format($end_obj, 'g:i a');
          }
        }
      ?>
      <div class="event-item">
        <div class="blog-card">
          <a href="<?php the_permalink(); ?>">
            <div class="top">
              <h4 aria-level="3"><?php the_title(); ?></h4>
              <?php if ($display_date) : ?>
                <span class="event-date"><?php echo esc_html($display_date); ?></span>
              <?php endif; ?>
            </div>
          </a>
            <div class="bottom">
              <?php // placeholder for the empty element browsers produced from the old nested link; keeps layout identical ?>
              <a aria-hidden="true"></a>
              <a href="<?php the_permalink(); ?>" class="read-btn" aria-label="<?php echo esc_attr('More about ' . get_the_title()); ?>">MORE</a>
            </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>

    <?php if ($events_all->max_num_pages > 1) : ?>
    <div class="pagination">
      <?php
        echo paginate_links(array(
          'base'      => add_query_arg('paged_past', '%#%', get_pagenum_link(1)), 
          'format'    => '',
          'current'   => $paged_past,
          'total'     => $events_all->max_num_pages,
          'prev_text' => '&laquo; Prev',
          'next_text' => 'Next &raquo;',
        ));
      ?>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php endif; wp_reset_postdata(); ?>

<?php get_footer(); ?>