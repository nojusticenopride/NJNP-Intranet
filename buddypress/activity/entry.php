<?php
/**
 * BuddyBoss - Activity Feed (Single Item)
 *
 * This template is used by activity-loop.php and AJAX functions to show
 * each activity.
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */

bp_nouveau_activity_hook( 'before', 'entry' ); ?>

<li class="<?php bp_activity_css_class(); ?>" id="activity-<?php bp_activity_id(); ?>" data-bp-activity-id="<?php bp_activity_id(); ?>" data-bp-timestamp="<?php bp_nouveau_activity_timestamp(); ?>" data-bp-activity="<?php ( function_exists('bp_nouveau_edit_activity_data') ) ? bp_nouveau_edit_activity_data() : ''; ?>">
<?php

    
    ?>
	<div class="bp-activity-head">
	<?php
                 if (bp_get_activity_type() == 'new_activity' ) { } else {?>	<div class="activity-avatar item-avatar">
			<a href="<?php bp_activity_user_link(); ?>"><?php bp_activity_avatar( array( 'type' => 'full' ) ); ?></a>
		</div><?php } ?>

		<div class="activity-header">
            
			<?php
                 if (bp_get_activity_type() == 'new_activity' ) { 
                      $pageID = bp_get_activity_secondary_item_id();
                    
                     $feedLink =  esc_url( bp_activity_get_permalink( bp_get_activity_id() ) ); 
                                    $heading = '';
                                    $authorNameLink = '<a class="url fn n" href="' . bp_get_activity_user_link() . '">' . esc_html( get_the_author($pageID) ) . '</a>';
                                    $feedType = get_field( 'type' , $pageID);
                                    $activityType = get_field( 'activity_type', $pageID);
                                    $activityStatus = get_field( 'activity_status', $pageID);
                  
                                    $feedtitle = get_field( 'title', $pageID);
                                    if (strpos($feedType, 'Activity') !== false) { 
                                        $heading = $authorNameLink.' '.$activityStatus.' <a href="'.$feedLink.'">'.$activityType.'.</a>';
                                    }elseif (strpos($feedType, 'Documentation') !== false) {
                                        $heading = $authorNameLink.' posted new <a href="'.$feedLink.'">Documentation.</a>';
                                    }elseif (strpos($feedType, 'Memo') !== false) {  
                                        $heading =  $authorNameLink.' submitted a new NJNP <a href="'.$feedLink.'">Memo.</a>';
                                    }elseif (strpos($feedType, 'Poll') !== false) {  
                                         $heading =  $authorNameLink.' created a new <a href="'.$feedLink.'">Poll/Survey!</a>';
                                    }elseif (strpos($feedType, 'Album') !== false) {
                                         $heading =  $authorNameLink.' created a new <a href="'.$feedLink.'">Album</a>.';
                                    }elseif (strpos($feedType, 'Update') !== false) {
                                            $heading =  $authorNameLink.' posted a new <a href="'.$feedLink.'">update.</a>';
                                    } else {
                                        $heading =  'A resident posted a new <a href="'.$feedLink.'">update</a> in the <a href="https://www.facebook.com/groups/NJNPCollective" target="_blank">NJNP Houses</a> facebook group.';

                                    }

 
                      echo '<p>'.$heading. '</p>';
    //if is true
                } else {
                    bp_activity_action();
                }?>
			<p class="activity-date">
                <a href="<?php echo esc_url( bp_activity_get_permalink( bp_get_activity_id() ) ); ?>"><?php echo bp_core_time_since( bp_get_activity_date_recorded() ); ?></a>
				<?php
				if ( function_exists( 'bp_nouveau_activity_is_edited' ) ){
					bp_nouveau_activity_is_edited();
				}
				?>
            </p>
			<?php
            if ( function_exists( 'bp_nouveau_activity_privacy' ) ) {
	            bp_nouveau_activity_privacy();
            }
            ?>

		</div>
	</div>

	<?php bp_nouveau_activity_hook( 'before', 'activity_content' ); ?>

	<div class="activity-content <?php ( function_exists('bp_activity_entry_css_class') ) ? bp_activity_entry_css_class(): ''; ?>">
        <?php
                    if (bp_get_activity_type() == 'new_activity' ) { 
                      $pageID = bp_get_activity_secondary_item_id();
                        $feedtitle = get_field( 'title', $pageID); 
                        $feedContentField = get_field( 'content', $pageID);
                        $feedContent='';
                        if (!empty($feedContentField)) {
                            $feedContent = $feedContentField;
                        } else {
                            $content_post = get_post($pageID);
                            $feedContent = $content_post->post_content;
                            $feedContent = apply_filters('the_content', $feedContent);
                            $feedContent = str_replace(']]>', ']]&gt;', $feedContent);
                        }
        ?>
             <div class="activity-inner">
               <?php if (!empty($feedtitle)) {?> <h4 style="margin-bottom: 0.16875rem;"><?php echo $feedtitle ?></h4><?php } 
                        echo $feedContent; ?>
                        
   </div>
        
		<?php } else {
            if ( bp_nouveau_activity_has_content() ) : ?>
			<div class="activity-inner"><?php bp_nouveau_activity_content(); ?></div>
		<?php endif; ?>

		<?php
        if ( function_exists( 'bp_nouveau_activity_state' ) ) {
            bp_nouveau_activity_state();
        }
                 }
        ?>
	</div>

	<?php bp_nouveau_activity_hook( 'after', 'activity_content' ); ?>

	<?php bp_nouveau_activity_entry_buttons(); ?>

	<?php bp_nouveau_activity_hook( 'before', 'entry_comments' ); ?>

	<?php if ( bp_activity_get_comment_count() || ( is_user_logged_in() && ( bp_activity_can_comment() || bp_is_single_activity() ) ) ) : ?>

		<div class="activity-comments">

			<?php bp_activity_comments(); ?>

			<?php bp_nouveau_activity_comment_form(); ?>

		</div>

	<?php endif; ?>

	<?php bp_nouveau_activity_hook( 'after', 'entry_comments' ); ?>

</li>

<?php
bp_nouveau_activity_hook( 'after', 'entry' );
