<?php
/**
 * Template name: resident services Page
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

 <div id="primary" class="content-area bb-grid-cell">
        <main id="main" class="site-main">            
<?php if ( have_posts() ) :

				do_action( THEME_HOOK_PREFIX . '_template_parts_content_top' );

				while ( have_posts() ) :
					the_post();

					do_action( THEME_HOOK_PREFIX . '_single_template_part_content', 'page' );
            ?>
            
            
<?php if ( have_rows( 'service' ) ) : ?>
              <div class="row">
      
      
	<?php while ( have_rows( 'service' ) ) : the_row(); ?>
                  <?php 
                  $service_title = get_sub_field( 'name_of_service' ); 
                  $service_id = uniqid();
                  $service_CTA = get_sub_field( 'cta_title' );
                   if ( $service_CTA ) : ?>
                  $service_CTA = $service_CTA;
                    <?php else: 
                  
                  $service_CTA = 'Click Here'; ?>
                     <?php endif; 
                  $service_desc = get_sub_field( 'service_description' );
                  $containerClass ='';
                  if (strlen($service_desc) >= 120){
                      $containerClass = 'col-lg-8';
                  } else{
                      
                      $containerClass = 'col-lg-4';
                  }
                  ?>
                  
        <div class="<?php echo $containerClass; ?> mb-lg-0 mb-3 mb-lg-5 position-relative" id="service_ad_<?php echo $service_id; ?>">
        <div class="d-flex justify-content-start p-2 p-lg-4 mx-2 mt-xl-2 shadow-1 hover-overlay ripple shadow-2 rounded"  data-mdb-ripple-color="light" style="height:100%">
          <div class="me-4">
		<i class="fa fas fa-wifi text-primary fa-2x <?php the_sub_field( 'service_icon' ); ?>"></i>
          </div>
          <div>
            <h5><?php the_sub_field( 'name_of_service' ); ?></h5>
            <p class="small"><?php the_sub_field( 'service_description' ); ?></p>
		<?php if ( have_rows( 'service_option' ) ): ?>
			<?php while ( have_rows( 'service_option' ) ) : the_row(); ?>
				<?php if ( get_row_layout() == 'link' ) : ?>
					<?php $page_link = get_sub_field( 'page_link' ); ?>
					<?php if ( $page_link ) : ?>
						<a  class="btn btn-primary stretched-link" href="<?php echo esc_url( $page_link); ?>"><?php echo esc_html( $page_link ); ?></a>
					<?php else: ?>
              <a class="btn btn-primary stretched-link" href="<?php the_sub_field( 'link' ); ?>"><?php echo $service_CTA; ?></a>
              <?php endif; ?>
					
				<?php elseif ( get_row_layout() == 'open_model' ) : ?>
             
					
					
					
              <!-- Button trigger modal -->
                        <button
                          type="button"
                          class="btn btn-primary stretched-link"
                          data-mdb-toggle="modal"
                          data-mdb-target="#modal_<?php echo $service_id; ?>"
                        >
                          <?php echo $service_CTA; ?>
                        </button>

                        <!-- Modal -->
                        <div
                          class="modal fade"
                          id="modal_<?php echo $service_id; ?>"
                          tabindex="-1"
                          aria-labelledby="modal_<?php echo $service_id; ?>Label"
                          aria-hidden="true"
                        >
                          <div class="modal-dialog  <?php the_sub_field( 'modal_size' ); ?> <?php the_sub_field( 'responsive_fullscreen' ); ?>">
                              <?php if ( have_rows( 'modal_options' ) ): ?>
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modal_<?php echo $service_id; ?>Label"><?php the_sub_field( 'modal_title' ); ?></h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-mdb-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                              <?php 
                              while ( have_rows( 'modal_options' ) ) : the_row(); ?>
                                <?php if ( get_row_layout() == 'iframe' ) : ?>

                                                <?php $modal_url = get_sub_field( 'modal_url' ); ?>
                            <div class="ratio ratio-1x1">
                                <iframe src="<?php echo $modal_url; ?>" class="embed-responsive-item" style="width:100%; min-height:100vh;"  allowfullscreen></iframe>
                              </div>
							<?php elseif ( get_row_layout() == 'form' ) : ?>
								<?php $service_acf_form_name = get_sub_field('add_form');?>
                            <?php acfe_form($service_acf_form_name); ?>
							<?php elseif ( get_row_layout() == 'shortcode' ) : ?>
								<?php the_sub_field( 'text_area_shortcode' ); ?>
							<?php endif; ?>
						<?php endwhile; ?>
                                  </div>
                            </div>
                        
             
					<?php else: ?>
						<?php // no layouts found ?>
					<?php endif; ?>
                                </div>
                             </div>
				<?php elseif ( get_row_layout() == 'user_field' ) : ?>
              <?php  $currentuser_ID = get_current_user_id(); ?>
              <?php
                    // Define user ID
                    // Replace NULL with ID of user to be queried
                    $user_id = $currentuser_ID;

                    // Example: Get ID of current user
                    // $user_id = get_current_user_id();

                    // Define prefixed user ID
                    $user_acf_prefix = 'user_';
                    $user_id_prefixed = $user_acf_prefix . $user_id;
                    $userLink = ''
                    ?>
					<?php $serviceACFUserField = get_sub_field( 'field_name' ); ?>
              
					<?php if ( get_sub_field( 'is_a_relationship_field_by_id' ) == 1 ) : ?>
              
						<?php $userLink = get_field( $serviceACFUserField, $user_id_prefixed ); ?>
                         <?php if ( $userLink ) : ?>
                            <?php foreach ( $userLink as $post_ids ) : ?>
                                <a class="btn btn-primary stretched-link" href="<?php echo get_permalink( $post_ids ); ?>"><?php echo get_the_title( $post_ids ); ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?>

              
              	<?php elseif ( get_sub_field( 'is_a_taxonomy' ) == 1 ) : ?>
						<?php $userLink = get_field( $serviceACFUserField, $user_id_prefixed ); ?>
                            <?php if ( $userLink ) : ?>
                                <?php $get_terms_args = array(
                                    'taxonomy' => 'teams',
                                    'hide_empty' => 0,
                                    'include' => $userLink,
                                ); ?>
                                <?php $terms = get_terms( $get_terms_args ); ?>
                                <?php if ( $terms ) : ?>
                                    <?php foreach ( $terms as $term ) : ?>
                                         <a class="btn btn-primary stretched-link" href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>
					<?php elseif ( get_sub_field( 'is_a_relationship_field_by_object' ) == 1 ) : ?>
						<?php $userLink = get_field( $serviceACFUserField, $user_id_prefixed ); ?>
                         <?php if ( $userLink ) : ?>
                            <?php foreach ( $userLink as $post ) :  ?>
                                <?php setup_postdata( $post ); ?>
                               <a class="btn btn-primary stretched-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
				<?php elseif ( get_sub_field( 'is_a_buddypress_group_field' ) == 1 ) : 
                $group_id = get_field( $serviceACFUserField, $user_id_prefixed ); 
                $group = groups_get_group( array( 'group_id' => $group_id ) );
              
						$group_permalink = bp_get_group_permalink($group);?>
 <a class="btn btn-primary stretched-link" href="<?php echo $group_permalink; ?>"><?php  echo $group->name; ?></a>
				<?php else : ?>
              <?php $userLink = get_field( $serviceACFUserField, $user_id_prefixed ); ?>
						 <a class="btn btn-primary stretched-link" href="<?php echo $userLink; ?>">
                          <?php echo $service_CTA; ?></a>
					<?php endif; ?>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php else: ?>
			<?php // no layouts found ?>
		<?php endif; ?>
                        
          </div>
        </div>
      </div>
	<?php
                   $service_CTA = '';
                  endwhile; ?>
    </div>
<?php endif; ?>
            
            
            
            
            
            <?php
            endwhile; // End of the loop.
			else :
				get_template_part( 'template-parts/content', 'none' );
				?>

			<?php endif; ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
if ( is_search() ) {
	get_sidebar( 'search' );
} else {
	get_sidebar( 'page' );
}
?>

<?php
get_footer();
