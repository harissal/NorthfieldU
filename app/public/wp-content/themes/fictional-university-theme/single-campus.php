<?php
  
  get_header();

  while(have_posts()) {
    the_post();
    pageBanner();
     ?>

    <div class="container container--narrow page-section">
          <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Campuses</a> <span class="metabox__main"><?php the_title(); ?></span></p>
      </div>

      <div class="generic-content"><?php the_field('main_body_content'); ?></div>

      <div class="acf-map">
<?php
$mapLocation = get_field('map_location') ?>
<div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>">
    <h3><?php the_title(); ?></h3>
    <?php echo $mapLocation['address'] ?>
    </div>
  <?php 
?>

<hr class="section-break">

</div>

      <?php 
        $relatedPrograms = new WP_Query(array(
          'posts_per_page' => -1,
          'post_type' => 'program',
          'orderby' => 'title',
          'order' => 'ASC',
          'meta_query' => array(
            array(
              'key' => 'related_campuses',
              'compare' => 'LIKE',
              'value' => '"' . get_the_ID() . '"'
            )
          )
        ));

        if ($relatedPrograms->have_posts()) {
          echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Programs Available at this Campus</h2>';

        echo '<ul class="min-list link-list">';
        while($relatedPrograms->have_posts()) {
          $relatedPrograms->the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </li>
        <?php }
        echo '</ul>';
        }

        wp_reset_postdata();
        $relatedCampuses = get_field('related_campus');

        if ($relatedCampuses) {
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">' . get_the_title() . ' is Available At These Campuses:</h2>';

          echo '<ul class="min-list link-list">';
          foreach($relatedCampuses as $campus) {
            ?> <li><a href="<?php echo get_the_permalink($campus); ?>"><?php echo get_the_title($campus) ?></a></li> <?php
          }
          echo '</ul>';

        }

      ?>

    </div>
    

    
  <?php }

  get_footer();

?>