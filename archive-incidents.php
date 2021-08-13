<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
    <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Incident Reports</li>
                          </ol>
                        </nav>
        <div class="bp-profile-wrapper">

            <div class="bp-profile-content">
                <div class="profile p-0">
                            <header class="entry-header profile-loop-header profile-header flex align-items-center">
                                <h1 class="entry-title bb-profile-title"><?php esc_attr_e( 'Incident Reports', 'buddyboss-theme' ); ?></h1>

                                <button type="button" class="push-right button outline small" data-mdb-toggle="modal" data-mdb-target="#new-incident">
                                    Submit new <em>Incident Report</em>
                                </button>
                            </header>
                        <?php if ( have_posts() ) : ?>


                            <div class="bp-widget incident-reports">

                                <h3 class="screen-heading profile-group-title">
                                    All incidents
                                </h3>

                                           <div class="table-responsive datatable" data-striped="true" data-hover="true" data-edit="true" data-full-pagination="true" data-selectable="true" data-sm="true" data-multi="true" data-fixed-header="true">
                                          <table class="table table-striped table-hover table-sm profile-fields bp-tables-user">
                                            <thead>
                                              <tr>
                                                <th scope="col" class="col d-none d-sm-table-cell">Date</th>
                                                  
                                                <th scope="col" class="col d-none d-sm-table-cell">Status</th>
                                                <th scope="col" class="col flex-grow-1">Incident</th>
                                                <th scope="col">Incident Category</th>
                                                  
                                                <th scope="col">Location</th>
                                                <th scope="col" class="col d-none d-lg-table-cell">Submitted by</th>
                                              </tr>
                                            </thead>
                                            <tbody>

                                <?php
                                /* Start the Loop */
                                while ( have_posts() ) :
                                    the_post(); 
                                                $incident_status = get_field( 'incident_status' );
$incident_status_class = '';
if (strpos($incident_status, 'Pending') !== false) { 
$incident_status_class = 'danger';
}elseif (strpos($incident_status, 'Open') !== false) { 
$incident_status_class = 'warning';
}elseif (strpos($incident_status, 'Closed') !== false) { 
$incident_status_class = 'success';
} ?>
                                                      <tr>
        <th scope="row" class="col d-none d-sm-table-cell small"><?php echo get_the_date(); ?></th>
         <td class="col d-none small d-sm-table-cell">
             <span class="badge bg-<?php echo $incident_status_class; ?> text-dark">
                    <?php the_field( 'incident_status' ); ?>
                  </span>
                                                          </td>
             <td class="col flex-grow-1 small"><a href="<?php the_permalink();?>"><?php the_title();?></a></td>
        <td class="small"><?php the_field( 'incident_category' ); ?></td>
                                                          
        <td class="small"><?php $group_id = get_field( 'house_location' );?>
                    <?php if ( $group_id ) : ?>
            <?php  $group = groups_get_group( array( 'group_id' => $group_id ) ); ?>
<i class="fas fa-house-user mr-5"></i> 
<?php echo $group->name; ?>
    <?php endif; ?></td>
        <td class="col small d-none d-lg-table-cell"><?php the_author(); ?></td>
      </tr>


                                <?php endwhile;
                                ?>
                                              </tbody>
                                           </table>
                                </div>
                            </div>

                            <?php
                            buddyboss_pagination();

                        else :
                            get_template_part( 'template-parts/content', 'none' );
                            ?>

                        <?php endif; ?>

                    </div>

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

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
