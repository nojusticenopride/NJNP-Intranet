<?php
/**
* Template part for displaying page content in page.php
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package BuddyBoss_Theme
*/
$incident_status = get_field( 'incident_status' );
$incident_status_class = '';
if (strpos($incident_status, 'Pending') !== false) { 
$incident_status_class = 'danger';
}elseif (strpos($incident_status, 'Open') !== false) { 
$incident_status_class = 'warning';
}elseif (strpos($incident_status, 'Closed') !== false) { 
$incident_status_class = 'success';
} else {
$incident_status_class = 'danger';
update_field( 'field_60270c516f4b3', 'Pending');
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


 
  <div class="tab-content entry-content" id="myTabContent">
    <div class="tab-pane fade show active" id="View" role="tabpanel" aria-labelledby="View-tab">

      <div class="bp-profile-wrapper">

        <div class="bp-profile-content">
          <div class="profile p-0">

            <div class="bp-widget incident-reports">
              <header class="entry-header profile-loop-header profile-header d-flex justify-content-between">

                <?php the_title( '<h4 class="mb-0">', '</h4>' ); ?>
                <?php echo do_shortcode('[automatorwp_button trigger="53" class="small btn-sm btn btn-outline-primary" label="Start a Discussion"]'); ?>
              </header>

              <div class="d-flex justify-content-between mb-2">
                <div><strong>Status: </strong>
                  <span class="badge bg-<?php echo $incident_status_class; ?> text-dark">
                    <?php the_field( 'incident_status' ); ?>
                  </span>

                </div>
                <span class="badge bg-warning text-dark"><?php the_field( 'incident_category' ); ?></span>
                <?php $situation_location_values = get_field( 'situation_location' ); ?>
                <?php if ( $situation_location_values ) : ?>
                <?php foreach ( $situation_location_values as $situation_location_value ) : ?>
                <span class="badge bg-danger text-dark"><?php echo esc_html( $situation_location_value ); ?></span>
                <?php endforeach; ?>
                <?php endif; ?>
              </div>
              <hr>




              <div class="mb-2 note note-<?php echo $incident_status_class; ?>"><?php
the_content(); ?>
                <div class="note note-light p-0 mt-3 mb-3 small">

                  <ul class="list-group">       
                    <?php $attachments = get_field( 'attachments' ); ?>
                    <?php if ( $attachments ) : ?>
                    <li class="list-group-item">
                      <?php $attachmentURL = esc_url( $attachments['url'] );
$headers = get_headers($attachmentURL, 1);
if (strpos($headers['Content-Type'], 'image/') !== false) {?>
                      <div class="md-v-line"></div>
                      <a href="#incident-image" data-toggle="modal" data-target="#incident-image"><i class="far fa-image mr-4 pr-3"></i> Open image</a>
                      <div class="modal top fade" id="incident-image" tabindex="-1" aria-labelledby="incident-imageLabel" data-mdb-backdrop="true" data-mdb-keyboard="true"  aria-modal="true" role="dialog">
                        <div class="modal-dialog modal-xl modal-fullscreen-lg-down modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-body p-0">
                              <div class="card bg-dark text-white p-0">
                                <img
                                     src="<?php the_field( 'attachment' ); ?>"
                                     class="card-img"
                                     alt="..."
                                     />
                                <div class="card-img-overlay" style="min-height:80vh">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>

                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>


                      <?php    
} else {?>
                      <div class="md-v-line"></div>
                      <a href="<?php echo esc_url( $attachments['url'] ); ?>"><i class="fas fa-file-pdf mr-4 pr-3"></i> Download <?php echo esc_html( $attachments['filename'] ); ?></a>
                      <?php }   
?>

                    </li>
                    <?php endif; ?>
                    <?php $main_individual = get_field( 'main_individual' ); ?>
                    <?php if ( $main_individual ) : ?>
                    <li class="list-group-item">
                      <div class="md-v-line"></div><i class="fa fa-users mr-5"></i> <strong>Individuals involved: </strong>
                      <ul class="avatars mt-2">

                        <?php $user_data = get_userdata( $main_individual ); ?>
                        <?php if ( $user_data ) : ?>
                        <li class="">
                         <a href="https://njnpcommunity.org/members/<?php echo esc_html( $user_data->user_login ); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html( $user_data->display_name ); ?>">
                            <img alt="<?php echo esc_html( $user_data->display_name ); ?>" class="avatar" src="<?php echo esc_url( get_avatar_url( $user_id ) ); ?>" /> 
                            <?php echo esc_html( $user_data->display_name ); ?>
                          </a>
                        </li>

                        <?php endif; ?>
                        <?php $individuals_involved = get_field( 'individuals_involved' ); ?>
                        <?php if ( $individuals_involved ) : ?>

                        <?php foreach ( $individuals_involved as $user_id ) : ?>
                        <?php $user_data = get_userdata( $user_id ); ?>
                        <?php if ( $user_data ) : ?>
                        <li class="">
                         <a href="https://njnpcommunity.org/members/<?php echo esc_html( $user_data->user_login ); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html( $user_data->display_name ); ?>">
                            <img alt="<?php echo esc_html( $user_data->display_name ); ?>" class="avatar" src="<?php echo esc_url( get_avatar_url( $user_id ) ); ?>" /> 
                            <?php echo esc_html( $user_data->display_name ); ?>
                          </a>
                        </li>

                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                      </ul>
                    </li>
                    <?php else: ?>

                    <?php $individuals_involved = get_field( 'individuals_involved' ); ?>
                    <?php if ( $individuals_involved ) : ?>
                    <li class="list-group-item">
                      <div class="md-v-line"></div><i class="fa fa-users mr-5"></i> <strong>Individuals involved: </strong>
                      <ul class="avatars mt-2">
                        <?php foreach ( $individuals_involved as $user_id ) : ?>
                        <?php $user_data = get_userdata( $user_id ); ?>
                        <?php if ( $user_data ) : ?>
                        <li class="">
                          <a href="https://njnpcommunity.org/members/<?php echo esc_html( $user_data->user_login ); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html( $user_data->display_name ); ?>">
                            <img alt="<?php echo esc_html( $user_data->display_name ); ?>" class="avatar" src="<?php echo esc_url( get_avatar_url( $user_id ) ); ?>" /> <?php echo esc_html( $user_data->display_name ); ?>
                          </a>
                        </li>

                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                      </ul>
                    </li>

                    <?php endif; ?>
                    <?php $group_id = get_field( 'house_location' );?>
                    <?php if ( $group_id ) : ?>

                    <li class="list-group-item"><?php  $group = groups_get_group( array( 'group_id' => $group_id ) ); ?>

                      <div class="md-v-line"></div><i class="fas fa-house-user mr-5"></i> <strong>Location: </strong><?php echo $group->name; ?>
                    </li>

                    <?php endif; ?>
                    <?php if ( have_rows( 'advisors' ) ) : ?>

                    <?php while ( have_rows( 'advisors' ) ) : the_row(); ?>
                    <?php $advising_team = get_sub_field( 'advising_team' ); ?>
                    <?php $term = get_term_by( 'id', $advising_team, 'teams' ); ?>
                    <?php if ( $term ) : ?>
                    <li class="list-group-item">
                      <div class="md-v-line"></div><i class="fa fa-user-friends mr-5"></i><strong>Advising Team: </strong> <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
                      <hr class="mt-1 mb-2 w-50 ms-0 bg-info">
                      <ul class="avatars">
                        <?php get_template_part( 'templates/users', 'team', array(
'term'   => $term->term_id
) ); ?>
                      </ul>

                    </li><?php endif; ?>
                    <?php $advisors = get_sub_field( 'advisors' ); ?>
                    <?php if ( $advisors ) : ?>

                    <li class="list-group-item">
                      <div class="md-v-line"></div><i class="fa fa-user-friends mr-5"></i>Advisors (non-team): <br>
                      <?php $user_data = get_userdata( $advisors ); ?>
                      <?php if ( $user_data ) : ?>

                      <a href="<?php echo get_author_posts_url( $advisors ); ?>"><?php echo esc_html( $user_data->display_name ); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    <?php if ( have_rows( 'decision_making' ) ) : ?>
                    <?php while ( have_rows( 'decision_making' ) ) : the_row(); ?>
                    <?php $decision_making_team = get_sub_field( 'decision_making_team' ); ?>
                    <?php $term = get_term_by( 'id', $decision_making_team, 'teams' ); ?>
                    <?php if ( $term ) : ?>
                    <li class="list-group-item">
                      <div class="md-v-line"></div><i class="far fa-thumbs-up mr-5"></i><strong>Decsion Making Team: </strong> <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
                      <hr class="mt-1 mb-2 w-50 ms-0 bg-info">
                      <ul class="avatars">
                        <?php get_template_part( 'templates/users', 'team', array(
'term'   => $term->term_id
) ); ?>
                      </ul>

                    </li>
                    <?php endif; ?>
                    <?php $decision_makers = get_sub_field( 'decision_makers' ); ?>
                    <?php if ( $decision_makers ) : ?>
                    <li class="list-group-item">
                      <div class="md-v-line"></div><i class="far fa-thumbs-up mr-5"></i>Decision Makers:
                      <ul class="list-group list-group-horizontal mt-2">

                        <?php foreach ( $decision_makers as $user_id ) : ?>
                        <?php $user_data = get_userdata( $user_id ); ?><?php if ( $user_data ) : ?>
                        <li class="list-group-item">
                          <a href="https://njnpcommunity.org/members/<?php echo esc_html( $user_data->user_login ); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html( $user_data->display_name ); ?>">
                            <img alt="<?php echo esc_html( $user_data->display_name ); ?>" class="avatar" src="<?php echo esc_url( get_avatar_url( $user_id ) ); ?>" />
                          </a>
                        </li>
                        <a href="https://njnpcommunity.org/members/<?php echo esc_html( $user_data->user_login ); ?>"><?php echo esc_html( $user_data->display_name ); ?></a>
                        <?php endif; ?>
                        <?php endforeach; ?>
                      </ul>
                      <?php endif; ?>
                      <?php endwhile; ?>
                      <?php endif; ?>
                      <?php $task_id = get_field( 'task_id' ); ?>
                      <?php if ( $task_id ) : ?>
                    <li class="list-group-item">
                      <div class="md-v-line"></div><i class="fa fa-bomb mr-5"></i>Tasks:
                      <?php foreach ( $task_id as $post_ids ) : ?>
                      <a href="<?php echo get_permalink( $post_ids ); ?>"><?php echo get_the_title( $post_ids ); ?></a>
                      <?php endforeach; ?>
                    </li>
                    <?php endif; ?>


                  </ul>
                </div>

                <?php $resolution_notes = get_field( 'resolution_notes' ); 
if($resolution_notes): ?>
                <div class="mb-2 note note-<?php echo incident_status_class; ?>"><?php the_field( 'resolution_notes' ); ?></div>
                <?php endif; ?>
              </div>


              <?php wp_link_pages( array(
'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buddyboss-theme' ),
'after'	 => '</div>',
) );
?>
            </div><!-- .entry-content -->
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">

      <div class="bp-profile-wrapper">

        <div class="bp-profile-content">
          <div class="profile p-0">

            <div class="bp-widget incident-reports">
              <header class="entry-header profile-loop-header profile-header flex align-items-center">

                <h4 class="mb-0">Edit '<?php the_title( '<small>', '</small>' ); ?>'</h4>
              </header>

              <?php acfe_form('edit-incident'); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php if ( get_edit_post_link() ) : ?>
<footer class="entry-footer">
  <?php
edit_post_link(
sprintf(
wp_kses(
/* translators: %s: Name of current post. Only visible to screen readers */
__( 'Edit <span class="screen-reader-text">%s</span>', 'buddyboss-theme' ), array(
'span' => array(
'class' => array(),
),
)
), get_the_title()
), '<span class="edit-link">', '</span>'
);
?>
</footer><!-- .entry-footer -->
<?php endif; ?>

</article>
