<?php

get_header(); 
pageBanner(array(
  'title' => 'All Programs',
  'subtitle' => 'Northfield University, Where Knowledge and Experiences Converge.'
));
?>

<div class="container container--narrow page-section">

<ul class="link-list min-list">
<?php
  
  while(have_posts()) {
    the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
  <?php }
  echo paginate_links();
?>

<hr class="section-break">

</div>

<?php get_footer();

?>