<?php
/**
* Template part for displaying Project tasks and details
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package BuddyBoss_Theme
*/
?>
<!--single project template-->
<div class="tab-content mt-n5" id="project-details-content">
  <div class="tab-pane fade show active" id="tasks" role="tabpanel" aria-labelledby="tasks">
      
    <div class="task-list-container pb-2 px-5 mx-1 shadow-1 pt-5">
      <?php get_template_part( 'templates/task', 'options'); ?>
<?php
$task_i = 0;
$args = array(
'post_type'      => 'tasks',
'posts_per_page' => -1,
'post_parent'    => $post->ID,
'order'          => 'ASC',
'orderby'        => 'menu_order'
);
$parent = new WP_Query( $args );
if ( $parent->have_posts() ) : ?>
      <div class="card-list task-list px-2" id="task-list">
        <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
        <?php get_template_part( 'templates/single', 'task' ); ?>
        <?php $task_i++; 
          endwhile; ?>
        <?php endif;?>
      </div>
      <?php wp_reset_postdata(); ?>

    </div>
  </div>
  <?php get_template_part( 'templates/default', 'project-pane' ); ?>
</div>
<?php get_template_part( 'templates/project', 'nav', array(
'nav-options'   => 'default'
) ); ?>
<!-- nav-options event expense request resident default -->
