<?php
/**
 * BuddyBoss - Users Plugins Template
 *
 * 3rd-party plugins should use this template to easily add template
 * support to their plugins for the members component.
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */
$profile_link = trailingslashit( bp_displayed_user_domain() . bp_get_profile_slug() );
 global $bp;
$bpProfileID = bp_displayed_user_id();

?>

<div class="bp-profile-wrapper">

	<div class="bp-profile-content">
<?php 
bp_nouveau_member_hook( 'before', 'plugin_template' ); ?>
        <div class="profile ">
            <header class="entry-header profile-loop-header profile-header flex align-items-center">
                <h1 class="entry-title bb-profile-title"><?php esc_attr_e( 'Incident Reports', 'buddyboss-theme' ); ?></h1>

                <button type="button" class="push-right button outline small" data-mdb-toggle="modal" data-mdb-target="#new-incident">
                    Submit new <em>Incident Report</em>
                </button>
            </header>
            
			<div class="bp-widget incident-reports">
                    <?php
         $pageID_id = get_the_ID();
$task_total = 0;
$task_completed = 0;
$args = array(
'post_type'      => 'incident-reports',
'posts_per_page' => -1,
'post_parent'    => $pageID_id,
'order'          => 'ASC',
'orderby'        => 'menu_order'
);
$parent = new WP_Query( $args );
if ( $parent->have_posts() ) : ?>   
                
				<h3 class="screen-heading profile-group-title">
					All incidents
				</h3>

                       <div class="table-responsive">
  <table class="table table-striped table-hover table-sm profile-fields bp-tables-user">
    <thead>
      <tr>
        <th scope="col" class="col d-none d-sm-table-cell">Date</th>
        <th scope="col" class="col flex-grow-1">Incident</th>
        <th scope="col">Incident Category</th>
        <th scope="col" class="col d-none d-lg-table-cell">Submitted by</th>
      </tr>
    </thead>
    <tbody>
  
        <?php while ( $parent->have_posts() ) : $parent->the_post(); 
       $individuals_involved = get_field( 'individuals_involved' );         
 $incident_user_IDs = '';
        $incident_user_is_bp ='';
 if ( $individuals_involved ) : ?>
	<?php foreach ( $individuals_involved as $user_id ) :
                if($bpProfileID == $user_id){
        $incident_user_is_bp ='true';
                }
        endforeach;
    endif;
    $main_individual = get_field( 'main_individual' );
    if ( $main_individual ) : 
         
               if($bpProfileID == $main_individual){
                    
        $incident_user_is_bp ='true';
                }
    endif;
        
if (strpos($incident_user_is_bp, 'true') !== false) { ?>
         <tr>
        <th scope="row" class="col d-none d-sm-table-cell small"><?php echo get_the_date(); ?></th>
             <td class="col flex-grow-1 small"><a href="<?php the_permalink();?>"><?php the_title();?></a></td>
        <td class="small"><?php the_field( 'incident_category' ); ?></td>
        <td class="col small d-none d-lg-table-cell"><?php the_author(); ?></td>
      </tr>

<?php } else { 
        ?>
  <?php }     
        endwhile;
				?>
                    </tbody>

  </table>
</div>
                
		<?php else :?>
                <p class="lead">We're sorry but no incident reports have been filed for this resident.</p>
	<?php endif; ?>
                
<?php wp_reset_postdata(); ?>
            </div>


		

			
		</div><!-- .profile -->

		<?php bp_nouveau_member_hook( 'after', 'plugin_template' ); ?>

	</div>

</div>
<!-- Button trigger modal -->
<div id="incident-container">
    <div class="spinner-border load-acf text-warning mt-2 mb-3" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
    <div id="incident-modal-container" class="the-acf-form invisible">
    <!-- Modal -->
    <div class="modal top fade show " id="new-incident" tabindex="-1" aria-labelledby="new-incidentLabel" data-mdb-backdrop="true" data-mdb-keyboard="true" style="padding-right: 17px; display: block;" aria-modal="true" role="dialog">
      <div class="modal-dialog modal-xl modal-fullscreen-lg-down modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
                    <h5 class="modal-title" id="new-incidentLabel">New Incident</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <?php acfe_form('new-incident'); ?>
          </div>
        </div>
      </div>
    </div>
    </div>
</div>