 
              <?php the_field( 'type' ); ?>
<?php the_field( 'request_date' ); ?>
<?php the_field( 'request_date' ); ?>
<?php // The buddypress_groups field type is not supported in this version of the plugin. ?>
<?php // Contact http://www.hookturn.io to request support for this field type. ?>
<?php if ( have_rows( 'item' ) ) : ?>
	<?php while ( have_rows( 'item' ) ) : the_row(); ?>
		<?php the_sub_field( 'description_of_the_item_you_need' ); ?>
		<?php if ( get_sub_field( 'attachment' ) ) : ?>
			<img src="<?php the_sub_field( 'attachment' ); ?>" />
		<?php endif ?>
	<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
<?php if ( get_field( 'submitted_a_complaint' ) == 1 ) : ?>
	<?php // echo 'true'; ?>
<?php else : ?>
	<?php // echo 'false'; ?>
<?php endif; ?>
<?php // The acfe_dynamic_message field type is not supported in this version of the plugin. ?>
<?php // Contact http://www.hookturn.io to request support for this field type. ?>
<?php the_field( 'content' ); ?>
<?php $assigned = get_field( 'assigned' ); ?>
<?php if ( $assigned ) : ?>
	<?php $user_data = get_userdata( $assigned ); ?>
	<?php if ( $user_data ) : ?>
		<a href="<?php echo get_author_posts_url( $assigned ); ?>"><?php echo esc_html( $user_data->display_name ); ?></a>
	<?php endif; ?>
<?php endif; ?>
<?php $priority = get_field( 'priority' ); ?>
<?php $term = get_term_by( 'id', $priority, 'request_priority' ); ?>
<?php if ( $term ) : ?>
	<a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
<?php endif; ?>
<?php the_field( 'status' ); ?>
<?php the_field( 'wp_task_link' ); ?>