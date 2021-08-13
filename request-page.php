<?php
/**
 * Template name: request Page
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

$platform_author_link = buddyboss_theme_get_option( 'blog_platform_author_link' );

get_header();
?> 
<style>

</style>
<?php  $currentuser_ID = get_current_user_id(); ?>

    <div id="primary" class="content-area bb-grid-cell">
        <main id="main" class="site-main">            
			<?php if ( have_posts() ) :

				while ( have_posts() ) :
					the_post();?>
             <div class="row">
  <div class="columns">
      		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
    <p>	<?php
		the_content();?></p>
    <table class="stack margin-bottom-2 small-child">
      <thead>
        <tr>
          <th>Title</th>
          <th>Type</th>
            <th>Date</th>
            <th width="300">Description</th>
            <th><strong>Status</strong></th>
            <th class="padding-horizontal-1">Assigned to  </th>
        </tr>
      </thead>
      <tbody>
        
            <?php // Custom WP query query
            $args_query = array(
                'post_type' => array('requests'),
                'order' => 'DESC',
                'author' => $currentuser_ID,
            );

            $query = new WP_Query( $args_query );

            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post(); ?>
          <tr>
            <?php $requestTitle = get_the_title();?>
             <?php if ($requestTitle == 'Post') {?>
              
              <td colspan="2" class="padding-horizontal-1"> <?php the_field( 'type' ); ?></td>
              <td  class="padding-horizontal-1"><?php echo get_the_date(); ?></td>
              <td class="padding-horizontal-1">
              <?php $requestDate = get_field( 'request_date' ); 
                $requestContent = get_field( 'content' ); ?>
              <?php if (!empty($requestDate)) {?>
                  <p><strong>Scheduled for: </strong><?php the_field( 'request_date' );?></p>
                  <?php }?>
               <?php if (!empty($requestContent)) {?>
                <p>  <?php the_field( 'content' ); ?></p>
                  <?php } ?>
              
              <?php if ( have_rows( 'item' ) ) : ?>
	<?php while ( have_rows( 'item' ) ) : the_row(); ?>
		<span class="label warning">
            <?php the_sub_field( 'description_of_the_item_you_need' ); ?></span>, 
	<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
              </td>
            
            <td class="padding-horizontal-1" colspan="3">This request is still processing and should be finished shortly.</td>
               <?php } else {?>
              <td class="padding-horizontal-1"> <?php the_title(); ?></td>
              <td class="padding-horizontal-1"> <?php the_field( 'type' ); ?></td>
              <td class="padding-horizontal-1"><?php echo get_the_date(); ?></td>
              <td class="padding-horizontal-1">
              <?php $requestDate = get_field( 'request_date' ); 
                $requestContent = get_field( 'content' ); ?>
              <?php if (!empty($requestDate)) {?>
                  <p><strong>Scheduled for: </strong><?php the_field( 'request_date' );?></p>
                  <?php }?>
               <?php if (!empty($requestContent)) {?>
                <p>  <?php the_field( 'content' ); ?></p>
                  <?php } ?>
              
              <?php if ( have_rows( 'item' ) ) : ?>
	<?php while ( have_rows( 'item' ) ) : the_row(); ?>
		<span class="label warning">
            <?php the_sub_field( 'description_of_the_item_you_need' ); ?></span>, 
	<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
              </td>
              <td class="padding-horizontal-1"><?php the_field( 'status' ); ?></td>
              <td class="padding-horizontal-1">
              
              
              <?php if ( $assigned ) : ?>
	<?php $user_data = get_userdata( $assigned ); 
 if ( function_exists( 'bp_core_get_user_domain' ) && $platform_author_link ) {
    $author_link = bp_core_get_user_domain( get_the_author_meta( $assigned ), get_the_author_meta( 'user_nicename' ) );
} else {
    $author_link = get_author_posts_url( get_the_author_meta( $assigned ), get_the_author_meta( 'user_nicename' ) );
}
$author_link = esc_url( $author_link );?>
	<?php if ( $user_data ) : ?>
		<a href="<?php echo $author_link; ?>"><?php echo esc_html( $user_data->display_name ); ?></a>
	<?php endif; ?>
<?php endif; ?>
              
              
              </td>
              
              
  


         
              <?php } ?>
                      </tr>
            <?php	}
} else {

}

wp_reset_postdata(); ?>

      </tbody>
    </table>
      <p class="text-center">
          <button
  type="button"
  class="btn btn-outline-primary mt-4"
  data-mdb-toggle="modal"
  data-mdb-target="#requestModal"
>
  <span style="vertical-align: text-bottom;">Submit a new service request</span>
</button>
          </p>
     </div>
</div>

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
