<?php
/**
 * BuddyBoss - Groups Album
 *
 * @since BuddyBoss 1.0.0
 */
global $bp; 
$group_id = $bp->groups->current_group->id;
 $group_link = bp_get_group_permalink();
$admin_link = trailingslashit( $group_link . 'admin' );
$group_avatar = trailingslashit( $admin_link . 'group-avatar' );
$group_cover_link = trailingslashit( $admin_link . 'group-cover-image' );
$tooltip_position = bp_disable_group_cover_image_uploads() ? 'down' : 'up';
$currentuser_ID = get_current_user_id();
$group_name = bp_get_group_name();
$currentuserprofilelink = esc_url( get_author_posts_url( get_the_author_meta($currentuser_ID  ) ) );                $current_user = wp_get_current_user();
                                                  
$current_user_name = $current_user->user_login; 
$project_id = isset( $_GET['project_id'] ) ? intval( $_GET['project_id'] ) : 0;
if(strpos($_SERVER['REQUEST_URI'], 'project_id') !== false){ ?>
<?php
    
// Custom WP query single_project
$args_single_project = array(
	'post_type' => array('projects'),
	'order' => 'DESC',
	'p' => $project_id,
);

$single_project = new WP_Query( $args_single_project );

if ( $single_project->have_posts() ) {
	while ( $single_project->have_posts() ) {
		$single_project->the_post(); 
        $project_id = get_the_ID();
        
update_field('field_6022c9b9f244e', $group_id, $project_id );
?>

<div class="navbar mb-3 bg-white breadcrumb-bar p-0">
    <div class="d-flex">
    <button type="button" class="rounded-start rounded-0 btn btn-lg btn-default toggle-sidebar-left  shadow-0 mb-n0 p-3" style="margin-bottom: -1px;">
        <i class="fas fa-bars fa-lg"></i>
    </button>
    
<nav aria-label="breadcrumb" class="p-2 mb-0 pb-md-3 pt-lg-3 pb-lg-2 align-self-start">
    <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?php echo $group_link; ?>"><?php echo $group_name; ?></a>
  </li>
  <li class="breadcrumb-item"><a href="<?php echo $group_link; ?>/projects">Projects</a>
  </li>
  <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
</ol>
</nav>
    </div>
        
        <button type="button" class="rounded-end rounded-0 btn btn-lg btn-default toggle-sidebar-right  shadow-0 mb-n0 p-3" style="margin-bottom: -1px;"><i class="fas fa-comments fa-lg"></i>
    </button>

</div>
<style>

a.stretched-link.fs-4.text-decoration-none.text-dark.d-block::after {
    flex-shrink: 0;
    width: 1.25rem;
    height: 1.25rem;
    margin-left: auto;
    content: "";
    background-image: url(https://njnpcommunity.org/wp-content/uploads/2021/01/download.svg);
    background-repeat: no-repeat;
    background-size: 1.25rem;
    transition: transform .2s ease-in-out;
}

a.stretched-link.fs-4.text-decoration-none.text-dark.d-block:not(.collapsed)::after {
    background-image: url(https://njnpcommunity.org/wp-content/uploads/2021/01/download.svg);
    transform: rotate(180deg);
}
</style>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="page-header pt-2">
                <h1><?php the_title();?></h1>
                  <?php $contentvar = get_the_content();?>
<?php if ( $contentvar ) : ?>        
                    <p class="mb-0 uppercase"><strong>Project Description</strong></p>
                  <p class="lead">
                        <?php the_content(); ?>
                  </p>
                  <?php endif; ?>
<?php wp_link_pages( array(
'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buddyboss-theme' ),
'after'	 => '</div>',
) );
?>

                    
                  
                                         <div class="d-flex align-items-center">
                    <?php $team = get_field( 'team' ); ?>
<?php if ( $team ) : ?>
	<?php $get_terms_args = array(
		'taxonomy' => 'teams',
		'hide_empty' => 0,
		'include' => $team,
	); ?>
	<?php $terms = get_terms( $get_terms_args ); ?>
	<?php if ( $terms ) : ?>
                    <div>
		<?php foreach ( $terms as $term ) : ?>
		<small class="text-muted"><strong>Team:</strong> <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a></small>
                  <hr class="mt-1 mb-2 w-50 ms-0 bg-info">
                    <ul class="avatars">
                    <?php get_template_part( 'templates/users', 'team', array(
        'term'   => $term->term_id
    ) ); ?>
                  </ul>
		<?php endforeach; ?>
                        </div>
	<?php endif; ?>
<?php endif; ?>
                         <button class="mt-4 ms-2 btn btn-round flex-shrink-0"  data-mdb-toggle="collapse"
  href="#add-team"
  role="button"
  aria-expanded="false"
  aria-controls="add-team">
                    <i class="material-icons">add</i>
                  </button>
                         </div>
<div class="spinner-border load-acf text-warning mt-5" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>

                     <div class="the-acf-form invisible">
<!-- Collapsed content -->
<div class="collapse multi-collapse acfcollapse mt-3 show" id="add-team">
    <!-- Button trigger modal -->

<button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="add-team create-team"> <i class="fas fa-users-cog"></i> Create a team</button>

<?php acfe_form('add-team'); ?>
</div>
<div class="collapse multi-collapse mt-3 acfcollapse show" id="create-team">
<div class="alert alert-light alert-dismissible fade show" role="alert">
<?php acfe_form('create-team'); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

</div>
                    
                </div>
                    
                <div>
                        
<?php
         $residentID = get_field( 'resident' ); 
         $project_id = get_the_ID();
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
                    <?php 
    $task_status = get_field( 'task_status' );
        if (strpos($task_status, 'Completed') !== false) {
            $task_completed++; 
        }
       $task_total++; 
          endwhile; ?>
        <?php endif;?>
      <?php $parent->rewind_posts(); ?>
                    
                    <?php $progress_percentage = $task_completed / $task_total * 100;?>
                    <?php
        $progress_class = '';
        if($progress_percentage > 75){
              
        $progress_class = 'bg-success';
          } elseif($progress_percentage > 50){
        $progress_class = 'bg-info';
          }elseif($progress_percentage > 25){
        $progress_class = 'bg-warning';
          }else{
        $progress_class = 'bg-danger';
          } 
        $task_progress = "(".$task_completed."/".$task_total.")";
                    ?>
                  <div class="progress">
                    <div class="progress-bar <?php echo $progress_class; ?>" style="width:<?php echo $progress_percentage;?>%;"></div>
                  </div>
                  <div class="d-flex justify-content-between text-small">
                    <div class="d-flex align-items-center">
                      <i class="material-icons">playlist_add_check</i>
                      <span><?php echo $task_progress; ?></span>
                    </div>
                    <span><?php $start_date = get_field( 'start_date' ); ?>
                <?php $end_date = get_field( 'end_date' ); 
                    $projectTimline = get_field( 'project_timeline' );
                    $pt_icon = '<i class="fas fa-calendar-times pe-1 ps-0"></i>';?>
                  <?php if (!empty($end_date)) { echo $pt_icon; ?>
                  <?php if (!empty($start_date)) {?><?php the_field( 'start_date' ); ?> - <?php } ?>
                  <?php the_field( 'end_date' ); } else {   if (!empty($projectTimline)) { echo $pt_icon . ' ' .$projectTimline; } 
                                                        }?>
                </span>
                  </div>
                </div>
              </div>
                 <?php
                    $ssdirectory = get_stylesheet_directory_uri();
                    $tab_template = $ssdirectory.'/projects/tabs.php';
        
                include($_SERVER['DOCUMENT_ROOT']."/wp-content/themes/buddyboss-theme-child/projects/tabs.php")?>

              <form class="modal fade" id="user-manage-modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Manage Users</h5>
                      <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                      </button>
                    </div>
                    <!--end of modal head-->
                    <div class="modal-body">
                    </div>
                    <!--end of modal body-->
                    <div class="modal-footer">
                      <button role="button" class="btn btn-primary" type="submit">
                        Done
                      </button>
                    </div>
                  </div>
                </div>
              </form>
              <form class="modal fade" id="project-edit-modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Project</h5>
                      <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                      </button>
                    </div>
                    <!--end of modal head-->
                    <div class="modal-body">
                        <?php acfe_form('edit-project'); ?>
                    </div>
                  </div>
                </div>
              </form>

              <form class="modal fade" id="task-add-modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">New Task</h5>
                      <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                      </button>
                    </div>
                    <!--end of modal head-->
                    
                    <div class="modal-body">
                      
                    </div>
                    <!--end of modal body-->
                    <div class="modal-footer">
                      <button role="button" class="btn btn-primary" type="submit">
                        Create Task
                      </button>
                    </div>
                  </div>
                </div>
              </form>

            </div>
          </div>
</div>
</article>

 
<?php	}
} else {

}

wp_reset_postdata();
    
 } else {
    global $bp; 
    $group_id = $bp->groups->current_group->id;

$getTeamName = bp_get_group_name();

    // Custom WP query team_projects
$args_team_projects = array(
	'post_type' => array('projects'),
	'posts_per_page' => 10,
	'order' => 'DESC',
    'tax_query' => array(
		array(
			'taxonomy' => 'teams',
			'field' => 'name',
			'terms' => array($getTeamName),
		),
	),
);

$team_projects = new WP_Query( $args_team_projects ); ?>


<div class="navbar mb-3 bg-white breadcrumb-bar p-0">
    <div class="d-flex">
    <button type="button" class="rounded-start rounded-0 btn btn-lg btn-default toggle-sidebar-left  shadow-0 mb-n0 p-3" style="margin-bottom: -1px;">
        <i class="fas fa-bars fa-lg"></i>
    </button>
    
<nav aria-label="breadcrumb" class="p-2 mb-0 pb-md-3 pt-lg-3 pb-lg-2 align-self-start">
    <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?php echo $group_link; ?>"><?php echo $group_name; ?></a>
  </li>
  <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?> Active Projects</li>
</ol>
</nav>
    </div>
        <button type="button" class="rounded-end rounded-0 btn btn-lg btn-default toggle-sidebar-right  shadow-0 mb-n0 p-3" style="margin-bottom: -1px;"><i class="fas fa-comments fa-lg"></i>
    </button>
</div>
<div class="my-3 overflow-hidden datatable datatable-striped datatable-sm datatable-hover deep-purple" data-striped="true" data-edit="true" data-selectable="true" data-loading="true" data-color="deep-purple" data-fixed-header="true" data-sm="true" data-multi="true" data-hover="true" data-border-color="dark " data-loader-class="bg-secondary">
    <h2 class="bp-screen-title">
	<?php esc_html_e( 'Active Team Projects', 'buddyboss' ); ?>
</h2>
<table class="small">
    <thead>
    <tr>
        <th data-mdb-sort="false" data-mdb-fixed="true" data-mdb-width="100">Project</th>
        <th>Project Type</th>
        <th>Condition</th>
        <th>Created by</th>
    </tr>
    </thead>
    <tbody>


<?php if ( $team_projects->have_posts() ) {
	while ( $team_projects->have_posts() ) {
		$team_projects->the_post();?>

<?php
        $condition_values = get_field( 'condition' ); ?>

     <tr class="table-row" data-href="<?php echo $group_link; ?>projects/?project_id=<?php the_ID();?>">
        <td><?php the_title(); ?></td>
        <td>
            <?php $project_type = get_field( 'project_type' ); ?>
<?php $term = get_term_by( 'id', $project_type, 'project-type' ); ?>
<?php if ( $term ) : ?>
            <span class="badge bg-warning text-dark"><?php echo esc_html( $term->name ); ?></span>
<?php endif; ?>
        </td> 
        <td>
            <?php if ( $condition_values ) : ?>
                <?php foreach ( $condition_values as $condition_value ) : ?>
            <p><abbr title="Reason this project was created"> <small><em><?php echo esc_html( $condition_value ); ?></em></small></abbr></p>
                   
                <?php endforeach; ?>
            <?php endif; ?>
        </td>
        <td>
            <?php if ( $condition_values ) : ?>Auto generated <?php else:?>
                      <small><strong><?php esc_html( get_the_author() ) ?></strong></small>
                 <?php endif; ?>
        </td>
    </tr>

<?php
	  
    }
} else {

}
?>
          </tbody>
</table>
</div>  

<?php wp_reset_postdata();
} ?>