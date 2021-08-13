<?php
/**
 * BuddyPress - Members Loop
 *
 * @since 3.0.0
 * @version 3.0.0
 */

bp_nouveau_before_loop(); ?>

<?php
$message_button_args = array(
	'link_text'         => '<i class="bb-icon-mail-small"></i>',
	'button_attr' => array(
		'data-balloon-pos' => 'down',
		'data-balloon' => __( 'Message', 'buddyboss-theme' ),
	)
);

$footer_buttons_class = ( bp_is_active('friends') && bp_is_active('messages') ) ? 'footer-buttons-on' : '';

$is_follow_active = bp_is_active('activity') && function_exists('bp_is_activity_follow_active') && bp_is_activity_follow_active();
$follow_class = $is_follow_active ? 'follow-active' : '';
?>

<?php if ( bp_get_current_member_type() ) : ?>
	<div class="bp-feedback info">
		<span class="bp-icon" aria-hidden="true"></span>
		<p><?php bp_current_member_type_message(); ?></p>
	</div>
<?php endif; ?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>

	<ul id="members-list" class="<?php bp_nouveau_loop_classes(); ?>">

	<?php while ( bp_members() ) : bp_the_member(); ?>
		<?php
		$member_id           = bp_get_member_user_id();
		$show_message_button = buddyboss_theme()->buddypress_helper()->buddyboss_theme_show_private_message_button( $member_id, bp_loggedin_user_id() );
		
		//Check if members_list_item has content
		ob_start();
		bp_nouveau_member_hook( '', 'members_list_item' );
		$members_list_item_content = ob_get_contents();
		ob_end_clean();
		$member_loop_has_content = empty($members_list_item_content) ? false : true;
		?> 
		<li <?php bp_member_class( array( 'item-entry' ) ); ?> data-bp-item-id="<?php bp_member_user_id(); ?>" data-bp-item-component="members">
			<div class="list-wrap <?php echo $footer_buttons_class; ?> <?php echo $follow_class; ?> <?php echo $member_loop_has_content ? ' has_hook_content' : ''; ?>">
			
				<div class="list-wrap-inner">
					<div class="item-avatar">
						<a href="<?php bp_member_permalink(); ?>">
							<?php bp_member_avatar( bp_nouveau_avatar_args() ); ?>
							<?php bb_user_status( bp_get_member_user_id() ); ?>
						</a>
					</div>

					<div class="item">

						<div class="item-block flex-grow-1">
							<h2 class="list-title member-name">
								<a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
							</h2>

							<?php
							if ( function_exists('bp_member_type_enable_disable') && true === bp_member_type_enable_disable() && true === bp_member_type_display_on_profile() ) {
								echo '<p class="item-meta last-activity">' . bp_get_user_member_type( bp_get_member_user_id() ) . '</p>';
							} else {
								?>
								<?php if ( bp_nouveau_member_has_meta() ) : ?>
									<p class="item-meta last-activity">
										<?php bp_nouveau_member_meta(); ?>
									</p>
								<?php endif; ?>
								<?php
							}
							?>
                            <?php
// Define user ID
// Replace NULL with ID of user to be queried
$user_id = bp_get_member_user_id();

// Example: Get ID of current user
// $user_id = get_current_user_id();

// Define prefixed user ID
$user_acf_prefix = 'user_';
$user_id_prefixed = $user_acf_prefix . $user_id;
?>
                            <?php $rolePositions = get_field( 'roleposition', $user_id_prefixed ); ?>
                            <?php $NJNPlocation = get_field( 'njnp_location', $user_id_prefixed ); ?>
									
                            <?php $teams = get_field( 'teams', $user_id_prefixed ); ?>
                         <?php if ( $NJNPlocation ) : ?> 
                            <p class="item-meta last-activity"><i class="fas fa-house-user"></i> <?php echo $NJNPlocation; ?></p>
                            <?php endif; ?>
<?php if ( $teams ) : ?>
	<?php $get_terms_args = array(
		'taxonomy' => 'teams',
		'hide_empty' => 0,
		'include' => $teams,
	); ?>
	<?php $terms = get_terms( $get_terms_args ); ?>
	<?php if ( $terms ) : ?>
                             
		<?php foreach ( $terms as $term ) : ?>
                                                            
                            <?php
                                // Define taxonomy prefix eg. 'category'
                                // Use 'term' for all taxonomies
                                $taxonomy_prefix = 'teams';

                                // Define term ID
                                // Replace NULL with ID of term to be queried eg '123' 
                                $term_id = $term->term_id;

                                // Example: Get the term ID in a term archive template 
                                // $term_id = get_queried_object_id();

                                // Define prefixed term ID
                                $term_id_prefixed = $taxonomy_prefix .'_'. $term_id;
                                
                                $expectations = get_field( 'expectations', $term_id_prefixed ); 
                                
                                ?>
                                
                                
                                <p class="item-meta last-activity"><a href="/groups/<?php echo esc_html( $term->name ); ?>"><?php echo esc_html( $term->name ); ?></a><?php if ($expectations):?> - 
                                <abbr title="<?php the_field( 'expectations', $term_id_prefixed ); ?>" class="text-break">
                                    <?php echo substr($expectations, 0, 60); ?>...
                                </abbr>
                            <?php endif;?>
                                </p>
                            <?php if ( $rolePositions ) : ?>
                             <p class="item-meta last-activity">
                                 <small class="font-weight-bold">Additional Roles: </small>
                                 <?php echo $rolePositions; ?>
                            </p>
                            <?php endif;?>
                                 

		<?php endforeach; ?>
	<?php endif; ?>
                             <?php endif; ?>
                              
						</div>

						<div class="button-wrap member-button-wrap only-list-view">
                            <?php  $user_info = get_userdata(bp_get_member_user_id());
                            $user_name = $user_info->display_name;
                            $user_email = $user_info->user_email;
							?>
                            <div class="gmail px-2 ms-4">
                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $user_email; ?>&su=NJNP%20App" target="_blank" title="Send a email to <?php echo $user_name; ?>" class="btn btn-danger p-2 text-white" style="background-color:#BB001B !important;">
                            <i class="fas fa-envelope"></i> Gmail</a>
                                </div>
							<?php buddyboss_theme_followers_count( bp_get_member_user_id() ); ?>

							<?php
							if( bp_is_active('friends') ) {
								bp_add_friend_button( bp_get_member_user_id() );
							}

							if( bp_is_active('messages') ) {
								if ( 'yes' === $show_message_button ) {
									add_filter( 'bp_displayed_user_id', 'buddyboss_theme_member_loop_set_member_id' );
									add_filter( 'bp_is_my_profile', 'buddyboss_theme_member_loop_set_my_profile' );
									bp_send_message_button( $message_button_args );
									remove_filter( 'bp_displayed_user_id', 'buddyboss_theme_member_loop_set_member_id' );
									remove_filter( 'bp_is_my_profile', 'buddyboss_theme_member_loop_set_my_profile' );
								}
							}

							if( $is_follow_active ) {
								bp_add_follow_button( bp_get_member_user_id(), bp_loggedin_user_id() );
							}
							?>
						</div>

						<?php if( $is_follow_active ) {
							$justify_class = ( bp_get_member_user_id() == bp_loggedin_user_id() ) ? 'justify-center' : '';
                            $user_info = get_userdata(bp_get_member_user_id());
                            $user_name = $user_info->display_name;
                            $user_email = $user_info->user_email;
							?>
							<div class="flex only-grid-view align-items-center follow-container <?php echo $justify_class; ?>">
                                <div class="gmail px-2">
                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $user_email; ?>&su=NJNP%20App" target="_blank" title="Send a email to <?php echo $user_name; ?>" class="btn btn-danger p-2 text-white" style="background-color:#BB001B !important;">
                            <i class="fas fa-envelope"></i> Gmail</a>
                                </div>
								<?php buddyboss_theme_followers_count( bp_get_member_user_id() ); ?>
								<?php bp_add_follow_button( bp_get_member_user_id(), bp_loggedin_user_id() ); ?>
							</div>
						<?php } ?>
					</div><!-- // .item -->

					<?php if( bp_is_active('friends') && bp_is_active('messages') && ( bp_get_member_user_id() != bp_loggedin_user_id() ) ) { ?>
						<div class="flex only-grid-view button-wrap member-button-wrap footer-button-wrap"><?php
							bp_add_friend_button( bp_get_member_user_id() );
							if ( 'yes' === $show_message_button ) {
								add_filter( 'bp_displayed_user_id', 'buddyboss_theme_member_loop_set_member_id' );
								add_filter( 'bp_is_my_profile', 'buddyboss_theme_member_loop_set_my_profile' );
								bp_send_message_button( $message_button_args );
								remove_filter( 'bp_displayed_user_id', 'buddyboss_theme_member_loop_set_member_id' );
								remove_filter( 'bp_is_my_profile', 'buddyboss_theme_member_loop_set_my_profile' );
							}
							?></div>
					<?php } ?>

					<?php if( bp_is_active('friends') && ! bp_is_active('messages') ) { ?>
						<div class="only-grid-view button-wrap member-button-wrap on-top">
							<?php bp_add_friend_button( bp_get_member_user_id() ); ?>
						</div>
					<?php } ?>

					<?php if( ! bp_is_active('friends') && bp_is_active('messages') ) { ?>
						<div class="only-grid-view button-wrap member-button-wrap on-top">
							<?php
							if ( 'yes' === $show_message_button ) {
								add_filter( 'bp_displayed_user_id', 'buddyboss_theme_member_loop_set_member_id' );
								add_filter( 'bp_is_my_profile', 'buddyboss_theme_member_loop_set_my_profile' );
								bp_send_message_button( $message_button_args );
								remove_filter( 'bp_displayed_user_id', 'buddyboss_theme_member_loop_set_member_id' );
								remove_filter( 'bp_is_my_profile', 'buddyboss_theme_member_loop_set_my_profile' );
							}
							?>
						</div>
					<?php } ?>
				</div>

				<div class="bp-members-list-hook">
					<?php 
						if($member_loop_has_content){ ?>
							<a class="more-action-button" href="#"><i class="bb-icon-menu-dots-h"></i></a>
						<?php } ?>
						<div class="bp-members-list-hook-inner">
							<?php bp_nouveau_member_hook( '', 'members_list_item' ); ?>
						</div>
				</div>
			</div>
		</li>

	<?php endwhile; ?>

	</ul>

	<?php bp_nouveau_pagination( 'bottom' ); ?>

<?php
else :

	bp_nouveau_user_feedback( 'members-loop-none' );

endif;
?>

<?php bp_nouveau_after_loop(); ?>
