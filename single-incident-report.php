<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BuddyBoss_Theme
 */

get_header();
?>
	<?php 
	$share_box = buddyboss_theme_get_option( 'blog_share_box' );
	if ( !empty( $share_box ) && is_singular('post') ) :
		get_template_part( 'template-parts/share' ); 
	endif;
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            	<?php
			if ( have_posts() ) :

				do_action( THEME_HOOK_PREFIX . '_template_parts_content_top' );

				while ( have_posts() ) :
					the_post();?>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="https://njnpcommunity.org/incident-reports/">Incident Reports</a></li>
                               <?php $individuals_involved = get_field( 'individuals_involved' ); ?>
                    <?php if ( $individuals_involved ) : ?>
<?php foreach ( $individuals_involved as $user_id ) : ?>
                        <?php $user_data = get_userdata( $user_id ); ?>
                        <?php if ( $user_data ) : 
                              
$author_link = bp_core_get_user_domain( get_the_author_meta( $user_id ), get_the_author_meta( 'user_nicename' ) );?>
 <li class="breadcrumb-item"><a href="https://njnpcommunity.org/members/<?php echo esc_html( $user_data->user_login ); ?>/incident-reports/" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html( $user_data->display_name ); ?>">
<?php echo esc_html( $user_data->display_name ); ?>
     </a></li>
<?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                            <li class="breadcrumb-item active"><?php the_title();?></li>
                          </ol>
                        </nav>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 offset-lg-2 col-xl-3 offset-xl-3">
                         <ul class="nav nav-tabs float-end" id="myTab" role="tablist" style="margin-bottom: 1px;">
                            <li class="nav-item mb-0" role="presentation">
                              <button class="nav-link active" id="View-tab" data-bs-toggle="tab" data-bs-target="#View" type="button" role="tab" aria-controls="View" aria-selected="true">View</button>
                            </li>
                            <li class="nav-item mb-0" role="presentation">
                              <button class="nav-link" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab" aria-controls="edit" aria-selected="false"><i class="fas fa-edit me-1"></i>Edit</button>
                            </li>
                          </ul>
                    </div>
                </div>

		<?php

					do_action( THEME_HOOK_PREFIX . '_single_template_part_content', get_post_type() );

				endwhile; // End of the loop.

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php
get_footer();
