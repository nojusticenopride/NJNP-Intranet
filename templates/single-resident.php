<?php
/**
* Template part for displaying resident project type tasks and details
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package BuddyBoss_Theme
*/
$Resident_user_id = $args['Resident_UserID'];
?>

<!--single project template-->
<div class="tab-content mt-n5" id="project-details-content">
      
   
<?php
        $activeTab = '';
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
        
  <div class="tab-pane fade show active" id="tasks" role="tabpanel" aria-labelledby="tasks">
       <div class="task-list-container pb-2 px-5 mx-1 shadow-1 pt-5">
      <?php get_template_part( 'templates/task', 'options'); ?>
      <div class="card-list task-list px-2" id="task-list">
        <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
        <?php get_template_part( 'templates/single', 'task' ); ?>
        <?php $task_i++; 
          endwhile; ?>
      </div>
      </div>
        <?php
      else: 
       echo '<div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks">';
      echo ' <div class="task-list-container pb-2 px-5 mx-1 shadow-1 pt-5">';
      get_template_part( 'templates/task', 'options'); 
           $activeTab = ' show active';
      echo '</div>';
           endif;?>
      <?php wp_reset_postdata(); ?>


  </div>
    
<?php
// Define user ID
// Replace NULL with ID of user to be queried


// Example: Get ID of current user
// $user_id = get_current_user_id();
$user_ID = $Resident_user_id->ID;
// Define prefixed user ID
$user_acf_prefix = 'user_';
$user_id_prefixed = $user_acf_prefix . $user_ID;
    
    
    $user_info = $Resident_user_id;
      $first_name = $user_info->first_name;
      $last_name = $user_info->last_name;
$user_name = $user_info->display_name;
$user_email = $user_info->user_email;
?>    
    

 <div class="tab-pane fade<?php echo $activeTab; ?>" id="residents" role="tabpanel" aria-labelledby="residents">
<h4 class="my-4">Resident Information</h4>
     <div class="container mb-4">
          <div class="resident-project-card card mb-3">
            <div class="card-body">
              <div class="d-flex">
                <div class="column_one flex-grow-1">
                  <div class="text">
                    <h3><span><?php echo $first_name.' '.$last_name; ?></span></h3>
                    <div class="line"></div>
                    <a href="#"><i class="fas fa-home text-muted fa-xs mx-1 fa-lg"></i></a>
                    <a href="#"><i class="fas fa-envelope text-muted fa-xs mx-1 fa-lg"></i></a>
                    <a href="#"><i class="fas fa-phone text-muted fa-xs mx-1 fa-lg"></i> <?php echo $user_email; ?></a>
                  </div>
                </div>
                <div class="column_two">
                  <img style="width:100px" class="img-fluid rounded-circle" src="<?php echo esc_url( get_avatar_url( $user_ID ) ); ?>"/>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-6 col-12 mb-4">
              <div class="card">
                <div class="card-body">
                  <p class="small mb-0"><strong>NJNP Location</strong></p>

                  <button type="button" class="btn text-muted mb-0 p-0 btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php the_field('njnp_house_address', $user_id_prefixed ); ?>"><?php the_field( 'njnp_location', $user_id_prefixed ); ?></button>


                  <hr />

                  <p class="text-uppercase text-muted small mb-2">Previous Locations</p>
                    <?php the_field( 'past_locations', $user_id_prefixed ); ?>
                </div>
              </div>
              <!-- Card -->
            </div>

            <div class="col-lg-4  col-md-6 col-12  mb-4">
              <div class="card">
                <div class="card-body">
                  <p class="text-uppercase small mb-2"><strong>NJNP Roles</strong></p>
                  <h5 class="mb-0">
                    <strong><?php the_field( 'roleposition', $user_id_prefixed ); ?> </strong>
                  </h5>

                  <hr />

                  <h5 class="text-muted mb-0">
                   <?php the_field( 'membership', $user_id_prefixed ); ?>
                  </h5>
                </div>
              </div>
            </div>
<?php $stipended = get_field( 'stipended', $user_id_prefixed ); ?>
              	<?php if ( $stipended ) : ?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <p class="text-uppercase small mb-2"><strong>Payroll</strong></p>
                  <h5 class="mb-0">
                    Annual<strong> $0000</strong> 
                    <small class="text-danger ms-2">
                      (Paid Weekly)
                    </small>
                  </h5>

                  <hr />

                  <p class="text-uppercase text-muted small mb-2">Justification</p>
                  <h5 class="text-muted mb-0">
                    Weekly Hours x Hour Rate
                  </h5>
                </div>
              </div>
            </div>
              
	<?php endif; ?>
          </div>
     </div>

     <div class="container mb-4">
          <div class="row mb-3">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Resident's Expenses</h5>

                  <div class="ratio">
                      <!--<?php the_field( 'admin_expense_link', $user_id_prefixed ); ?> -->
                    <iframe
                            src="https://app.miniextensions.com/user-portal-grid/GT9H8XvGBsCipgneQZc5/result?query=%7B%22Name%22%3A%22<?php echo $first_name; ?>%20<?php echo $last_name; ?>%22%7D"
                            title="User Expenses"
                            allowfullscreen frameborder="0" style="width:100%; min-height:200px;"
                            ></iframe>
                  </div>

                </div>

              </div>
            </div>
          </div>
         
<div class="row mb-3">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Resident's Requests</h5>
          <div class="ratio" style="--aspect-ratio: 18%;">
              
                      <!--<?php the_field( 'admin_requests_link', $user_id_prefixed ); ?> -->
            <iframe
                    src="https://app.miniextensions.com/user-portal-grid/un7I7MdNoANMpoZblsjK/result?query=%7B%22Name%22%3A%22<?php echo $first_name; ?>%20<?php echo $last_name; ?>%22%7D"
                    title="User Requests"
                    allowfullscreen frameborder="0" style="width:100%; min-height:200px;"
                    ></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="tab-pane fade" id="Applications" role="tabpanel" aria-labelledby="Applications">
<div class="row mb-3">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Resident's NJNP Intake form</h5>
            <?php $NJNPAgreement = get_field( 'njnp_agreement_doc', $user_id_prefixed ); ?>
            <?php if ( $NJNPAgreement ) : ?>
          <div class="ratio ratio-16x9">
            <iframe
                    src="<?php echo $NJNPAgreement; ?>"
                    title="NJNP INTake"
                    allowfullscreen frameborder="0" style="width:100%; min-height:100vh;"
                    ></iframe>
          </div>
            <?php else: ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>NO INTAKE ON FILE!</strong> Check Jotform for submission. If there is no submission for this resident, You should check in with them and ensure they fill out the <a href="https://form.jotform.com/200927104716147" target="_blank">NJNP Agreement</a>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
            <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

</div>
<div class="tab-pane fade" id="incidents" role="tabpanel" aria-labelledby="incidents">
<div class="row mb-3">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Resident's Incident Report</h5>
          <div class="ratio ratio-16x9">
              
                      <!--<?php the_field( 'admin_incidents_link', $user_id_prefixed ); ?> -->
            <iframe
                    src="https://app.miniextensions.com/grid-portal/W8QY7WLOWcFEa9aFISyS/result?query=%7B%22Individuals%20involved%20%28Separated%20by%20commas%29%22%3A%22<?php echo $first_name; ?>%20<?php echo $last_name; ?>%22%7D"
                    title="User Requests"
                    allowfullscreen frameborder="0" style="width:100%; min-height:100vh;"
                    ></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<?php get_template_part( 'templates/project', 'nav', array(
'nav-options'   => 'resident'
) ); ?>
<!-- nav-options event expense request resident default -->
