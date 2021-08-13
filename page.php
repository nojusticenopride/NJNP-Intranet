`<?php
/**
 * The template for displaying all pages
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
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-12">
			<?php if ( have_posts() ) :

				do_action( THEME_HOOK_PREFIX . '_template_parts_content_top' );

				while ( have_posts() ) :
					the_post();

					do_action( THEME_HOOK_PREFIX . '_single_template_part_content', 'page' );

				endwhile; // End of the loop.
			else :
				get_template_part( 'template-parts/content', 'none' );
				?>

			<?php endif; ?>
                        </div>               
                </div>
                </div>

        </main><!-- #main -->
    </div><!-- #primary -->


<?php
get_footer();
