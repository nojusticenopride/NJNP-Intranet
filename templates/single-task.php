<?php
/**
* Template part for displaying individual tasks and details
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package BuddyBoss_Theme
*/
?>

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
    <div class="task-container <?php echo $isotope_filter; ?>"  >
    <div class="card  card-task" id="task-<?php the_ID(); ?>">

      <div class="progress">
        <div class="progress-bar <?php echo $task_contexual_class; ?>" role="progressbar" style="width: <?php echo $task_progress; ?>; margin-left-5px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <div class="card-body d-flex position-relative">
          <?php if ($task_progress != '100%') { ?>
              
                  <?php acfe_form('complete-task'); ?>
              <?php } ?>
              
                  <div class="card-title flex-grow-1">
                    <a class="stretched-link  text-decoration-none text-dark d-block collapsed" data-bs-toggle="collapse" href="#task-ID<?php the_ID(); ?>" role="button" aria-expanded="false" aria-controls="task-ID<?php the_ID(); ?>"> <h6 class="mb-0" data-filter-by="text"><?php the_title();?></h6></a>
                    <?php $taskDeadline = get_field( 'deadline' ); ?>
                      <?php if ( $taskDeadline ) : ?>
                         <span class="text-small small"><i class="fas fa-calendar-times pe-1 ps-2"></i>  <?php echo $taskDeadline; ?></span>
                      <?php endif; ?> 
                  </div>
                  
                    <div class="card-meta flex-fill">
                            <?php $assigned_to = get_field( 'assigned_to' ); ?>
              <?php if ( $assigned_to ) : ?>
                        <ul class="avatars">
              <?php foreach ( $assigned_to as $user_id ) : ?>
              <?php $user_data = get_userdata( $user_id ); ?>
              <?php if ( $user_data ) : ?>
                      
                          <li>
              <a href="#" data-toggle="tooltip" title="Assigned to <?php echo esc_html( $user_data->display_name ); ?>">
                <img alt="Assigned to <?php echo esc_html( $user_data->display_name ); ?>" class="avatar" src="<?php echo esc_url( get_avatar_url( $user_id ) ); ?>" alt="<?php echo esc_html( $user_data->display_name ); ?>" />
              </a>
                          </li>
                        
                        
              <?php endif; ?>
              <?php endforeach; ?>
                            </ul>
              <?php endif; ?>
                  </div>

            
          
          </div>
          <div class="collapse" id="task-ID<?php the_ID(); ?>">
              <div class="card-body">
                  <div class="container">
                      <div class="row position-relative">
  <?php $contentvar = get_the_content();?>
                            <div class="col-8"><h6 class="mb-0">Additional information</h6>
                                <div class="row">
                                                  <?php if ( get_field( 'attachment' ) ) : ?>

                              <div class="col-12 col-md-4">
                                <img class="travel-feature-card-image" src="<?php the_field( 'attachment' ); ?>" alt="">
                              </div>
                              <?php endif ?>
                              <div class="<?php if ( get_field( 'attachment' ) ) : ?>col-md-8 <?php endif; ?>col-12"><?php if ( $contentvar ) : ?><?php the_content(); ?><?php endif; ?><p><?php the_field( 'additional_info' ); ?></p>
                                </div>
                                    </div>
                                <?php $actionsteps = get_field( 'text_area_shortcode' ); ?>
                              <?php if ( $actionsteps ) : ?>
                                <h6 class="mt-4 mb-0">Additional information</h6>
                                <p class="mb-4"><?php the_field( 'text_area_shortcode' ); ?></p>                          <?php endif; ?> 
                            <a href="<?php the_permalink();?>" class="">Go to task <i class="fas fa-long-arrow-alt-right"></i></a>
                          </div>
                          <div class="col-4"> <small><strong>Status: </strong></small>
                            <p class="travel-feature-card-price-subtext"> <i class="fas fa-thermometer-half"></i> 
                              <?php the_field( 'task_status' ); ?>
                            </p>
                            <?php $taskDeadline = get_field( 'deadline' ); ?>
                            <?php if ( $taskDeadline ) : ?>
                            <small><strong>Deadline: </strong></small>
                            <p class="travel-feature-card-price-subtext"> <i class="fas fa-stopwatch"></i>
                              <?php echo $taskDeadline; ?>
                            </p>
                            <?php endif; ?>  
                          </div>
                        <div class="col-12">
                            <?php if ( function_exists( 'bp_is_group' ) ) { 
    global $bp; 
    $group_id = $bp->groups->current_group->id; 
    if($group_id):
 $group_type = bp_groups_get_group_type($group_id);
    else:
    $group_type = 'none';
    endif;
if (strpos($group_type, 'team') !== false) {?>
 <a href="javascript:void(0)" onclick="javascript:jqcc.cometchat.sendGroupMessage('<?php echo $group_id; ?>','Task:<?php the_title();?> - <?php the_permalink(); ?>');">Send Message In This Group</a>
<?php }
}?>
                            
                            
                         
     <button data-message="Task:<?php the_title();?> - <?php the_permalink(); ?>" data-sender="" type="button" class="send-to-messenger btn btn-outline-info    btn-lg" data-mdb-ripple-color="#000000" style="background-color:;color:;border-color:;"> Send to messenger <i class="fas fa-download ms-1"></i></button>
                          </div>  
                      </div>
                    </div>
            </div>
      </div>
    </div>
</div>
    <script>(function($) {
            $(window).load(function() {
                $('#task-<?php the_ID(); ?> form.complete-task').attr("id","complete-task-<?php the_ID(); ?>")
            });
})( jQuery );</script>