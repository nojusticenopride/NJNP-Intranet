<?php
/**
 * Get team members for the Post
 */
//var_dump( $args );  // Everything
// Define taxonomy prefix eg. 'category'
// Use 'term' for all taxonomies
$taxonomy_prefix = 'teams';

$term_id = $args['term'];
//$term = $args['term'];
// Define term ID
// Replace NULL with ID of term to be queried eg '123' 
//$term_id = get_term_by('name', $term->name , 'teams');

// Example: Get the term ID in a term archive template 
// $term_id = get_queried_object_id();

// Define prefixed term ID
$term_id_prefixed = $taxonomy_prefix .'_'. $term_id;

$platform_author_link = buddyboss_theme_get_option( 'blog_platform_author_link' );

$team_members = get_field( 'team_members', $term_id_prefixed ); ?>
<?php if ( $team_members ) : ?>
	<?php foreach ( $team_members as $user_id ) : ?>
		<?php $user_data = get_userdata( $user_id ); ?>
		<?php if ( $user_data ) : 
            if ( function_exists( 'bp_core_get_user_domain' ) && $platform_author_link ) {
                $author_link = bp_core_get_user_domain( get_the_author_meta( $user_id ), get_the_author_meta( 'user_nicename' ) );
            } else {
                $author_link = get_author_posts_url( get_the_author_meta( $user_id ), get_the_author_meta( 'user_nicename' ) );
            }
            if (!empty($author_link)) {
                $author_link = esc_url( $author_link );
            } else {
                $author_link = get_author_posts_url( $user_id ); 
            }
?>
    <li>
      <a href="<?php echo esc_url( $author_link ); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html( $user_data->display_name ); ?>">
        <img alt="<?php echo esc_html( $user_data->display_name ); ?>" class="avatar" src="<?php echo esc_url( get_avatar_url( $user_id ) ); ?>" />
      </a>
    </li>

		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>