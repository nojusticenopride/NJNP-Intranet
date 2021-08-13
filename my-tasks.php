<?php
/**
* The template for displaying current users tasks
 * Template name: current users tasks
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

get_header();
?> 

<div id="primary" class="content-area lmslifter">
  <main id="main" class="site-main">

			<?php if ( have_posts() ) :

				while ( have_posts() ) :
					the_post();?>
      
      
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      
      <header class="entry-header">
    		<h1 class="entry-title">My Tasks</h1>    	
      </header>
      <div class="accordion accordion-flush" id="Task-List_by-projects">
      
<?php 
      
      
      $currentuser_ID = get_current_user_id();
      $args_team_projects = array(
	'post_type' => array('projects'),
	'posts_per_page' => 10,
	'order' => 'DESC');

$team_projects = new WP_Query( $args_team_projects ); 
$ProjectCount = 0;
?>     
      <?php if ( $team_projects->have_posts() ) {
	while ( $team_projects->have_posts() ) {
		$team_projects->the_post();?>

      <?php $teams = get_field( 'team' ); 
               $currentUserProject = '';
          ?>
<?php if ( $teams ) : 
        $taxonomy_prefix = 'teams';
        foreach ( $teams as $team ) : 
            $term_id = $team;
         endforeach;
$term_id_prefixed = $taxonomy_prefix .'_'. $term_id;
?>
      <?php $team_members = get_field( 'team_members', $term_id_prefixed ); 
   
      ?>
        <?php if ( $team_members ) : ?>
            <?php foreach ( $team_members as $user_id ) : 
              $userProject = ($user_id == $currentuser_ID) ? 'Yes' : 'No';
               if ( $userProject == 'Yes' ) :
               $currentUserProject = 'True';
              endif;
            endforeach; ?>
        <?php endif; ?>	
<?php endif; ?>
      <?php if ( $currentUserProject ) : ?>
            <?php $ProjectCount++; ?>
      
  <div class="accordion-item mb-4">
    <h2 class="accordion-header" id="flush-heading<?php the_ID(); ?>">
      <button
        class="text-dark accordion-button<?php if($ProjectCount>1){echo ' collapsed';}?>"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#flush-collapse<?php the_ID(); ?>"
        aria-expanded="false"
        aria-controls="flush-collapse<?php the_ID(); ?>"
              style="text-align: left;background-color: transparent;border-top: 1px solid rgba(0,0,0,.125); border-radius:0;">
      <strong><?php the_title();?></strong>
      </button>
    </h2>
    <div
      id="flush-collapse<?php the_ID(); ?>"
      class="accordion-collapse<?php if($ProjectCount == 1){echo ' show';}?> show collapse"
      aria-labelledby="flush-heading<?php the_ID(); ?>"
      data-mdb-parent="#Task-List_by-projects"
    >
      <div class="accordion-body task-grid pb-4">
              <div class="content-list-body row filter-list-1612246631293 mb-md-4">
                  <?php  $project_id = get_the_ID();
$task_total = 0;
$task_completed = 0;
$args = array(
'post_type'      => 'tasks',
'posts_per_page' => -1,
'post_parent'    => $project_id,
'order'          => 'ASC',
'orderby'        => 'menu_order'
);
$parent = new WP_Query( $args );
if ( $parent->have_posts() ) : ?>
        <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
                  <div class="col-lg-6 mb-3">
                            <div class="card card-project m-2 ms-md-4 me-md-3 shadow-1">

                              <?php
 $task_status = '';
    $post_id = get_the_ID();
    $task_status = get_field( 'task_status' );
    $task_progress = '';
    $task_contexual_class = '';
    $isotope_filter = '';
    $complete_checked_values = get_field( 'complete' ); ?>
<?php if ( $complete_checked_values ) : 
        foreach ( $complete_checked_values as $complete_value ): 
    $task_status='';
    $task_status = $complete_value;
          update_field( 'task_status', $task_status, $post_id );
        $task_progress = '100%';
        $task_contexual_class = 'bg-success';
    $isotope_filter = "Completed";
    endforeach; 
    else:
      if (strpos($task_status, 'Pending') !== false) {
    $task_progress = '25%';
    $task_contexual_class = 'bg-warning'; 
          $isotope_filter = "Pending";
          
          
      } elseif (strpos($task_status, 'Not started') !== false) {
    
$isotope_filter = "Not-Started";

    $task_progress = '10%';
    $task_contexual_class = 'bg-danger'; 
      } elseif (strpos($task_status, 'In Process') !== false) {
          $isotope_filter = "In-Process";
    $task_progress = '50%';
    $task_contexual_class = 'bg-secondary';
      } elseif (strpos($task_status, 'In Review') !== false) { 
    $task_progress = '75%';
    $task_contexual_class = 'bg-info';
           $isotope_filter = "In-Review";
      } elseif (strpos($task_status, 'Completed') !== false) { 
           $isotope_filter = "Completed";
    $task_progress = '100%';
    $task_contexual_class = 'bg-success';
      } elseif (strpos($task_status, 'Complete') !== false) { 
           $isotope_filter = "Completed";
          
          update_field( 'task_status', 'Completed', $post_id );
    $task_progress = '100%';
    $task_contexual_class = 'bg-success';
      } else {
          
          $isotope_filter = "Pending";
        $task_progress = '5%';
        $task_contexual_class = 'bg-warning'; 

    
      }
     endif; ?>
   <div class="progress">
        <div class="progress-bar <?php echo $task_contexual_class; ?>" role="progressbar" style="width: <?php echo $task_progress; ?>; margin-left-5px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
      </div>

                              <div class="card-body">
                                <div class=" card-options">
                                  <a class="btn-options" id="project-dropdown-button-1" href="<?php the_permalink();?>">
                                    <i class="material-icons">more_vert</i>
                                      </a>
                                </div>
                                <div class="card-title">
                                  <a href="<?php the_permalink();?>"><h5 data-filter-by="text" class="H5-filter-by-text"><?php the_title();?></h5></a>
                                </div>
                                  <?php $ProjectTeam = get_field( 'team', $project_id ); ?>
                                  <?php if ( $ProjectTeam ) : ?>
                                <?php $getProjectTeam_terms_args = array(
                                    'taxonomy' => 'teams',
                                    'hide_empty' => 0,
                                    'include' => $ProjectTeam,
                                ); ?>
                                <?php $ProjectTeamterms = get_terms( $getProjectTeam_terms_args ); ?>
                                <?php if ( $ProjectTeamterms ) : ?>
                                      <ul class="avatars pb-0 mb-0">
                                    <?php foreach ( $ProjectTeamterms as $term ) : ?>

                                                <?php get_template_part( 'templates/users', 'team', array(
                                    'term'   => $term->term_id
                                ) ); ?>

                                    <?php endforeach; ?>   </ul>
                                  	<?php endif; ?>
                            <?php endif; ?>
                                <div class="card-meta d-flex justify-content-between">
                                   <?php if ($task_progress != '100%') { ?>
              
                  <?php acfe_form('complete-task'); ?>
              <?php }?>
                                    <?php $taskDeadline = get_field( 'deadline' ); ?>
                      <?php if ( $taskDeadline ) : ?>
                        
                                  <span class="text-small SPAN-filter-by-text" data-filter-by="text"> <i class="fas fa-calendar-times pe-1 ps-2"></i>  <?php echo $taskDeadline; ?></span>
                      <?php endif; ?> 
                                </div>
                              </div>
                                <div class="card-footer d-flex  justify-contentbetween"><h6 class="mb-0 font-weight-bold text-muted">Send to:</h6>
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>
            </div>
                            </div>
                          </div>
                  
        <?php  endwhile; 
         endif;
wp_reset_postdata();?>
                  
                   <div class="col-lg-6 mb-5 mt-md-3">
                   <div class="card card-project m-2 ms-md-4 me-md-3 shadow-1 new-task">
                          <a
  class="btn btn-outline-secondary btn-round btn-lg btn-block"
  data-mdb-toggle="collapse"
  href="#add-task"
  role="button"
  aria-expanded="false"
  aria-controls="add-task"
  style="display: block; min-height: 120px;">
                              <i class="fas fa-plus-square fa-7x"></i>
</a>

                       </div>
                  </div>
              </div>
          
 <?php get_template_part( 'templates/task', 'form'); ?>
          
          
      </div>
    </div>
  </div>

      
      	<?php endif; ?>
      
      <?php
	  
    }
} else {

}
?>
<?php wp_reset_postdata();
 ?>
  
</div>
      
      </article>

      	<?php
            endwhile; // End of the loop.
			else :
				get_template_part( 'template-parts/content', 'none' );
				?>

			<?php endif; ?>


  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
