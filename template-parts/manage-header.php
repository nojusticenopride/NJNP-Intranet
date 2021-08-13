<div id="item-header" role="complementary" data-bp-item-id="<?php the_ID(); ?>" data-bp-item-component="groups" class="groups-header single-headers">   
          <div id="cover-image-container">



          <div id="header-cover-image" class="cover-small width-default ">


          </div>


          <div id="item-header-cover-image" class="item-header-wrap bb-enable-cover-img">
            <div id="item-header-avatar">
              <img src="https://njnpcommunity.org/wp-content/plugins/buddyboss-platform/bp-core/images/mystery-group.png" class="avatar group-22-avatar avatar-300 photo" width="300" height="300" alt="Group logo of Leadership">			</div><!-- #item-header-avatar -->


            <div id="item-header-content">

              <div class="flex align-items-center bp-group-title-wrap">
                <h2 class="bb-bp-group-title"><?php the_title(); ?></h2>
                <p class="bp-group-meta bp-group-type"><span class="group-type">Leadership</span><span class="type-separator">/</span> <span class="group-type">Board</span></p>
              </div>



              <div class="group-description">
                <p><?php the_content(); ?></p>
              </div><!-- //.group_description -->

              <div id="item-actions" class="group-item-actions">


                <h4 class="bp-title">Organizers (10)</h4>

                <dl class="moderators-lists">
                  <dt class="moderators-title">Organized by</dt>
                  <dd class="user-list admins">		<ul id="group-admins">
                    <li>
                        <?php
// Define taxonomy prefix eg. 'category'
// Use 'term' for all taxonomies
$taxonomy_prefix = 'teams';

// Define term ID
// Replace NULL with ID of term to be queried eg '123' 
$term_id = 42;

// Example: Get the term ID in a term archive template 
// $term_id = get_queried_object_id();

// Define prefixed term ID
$term_id_prefixed = $taxonomy_prefix .'_'. $term_id;
?>
                        <?php $team_members = get_field( 'team_members', $term_id_prefixed ); ?>
<?php if ( $team_members ) : ?>
	<?php foreach ( $team_members as $user_id ) : ?>
		<?php $user_data = get_userdata( $user_id ); ?>
		<?php if ( $user_data ) : ?>
                        
                        
                        <li>
                      <a href="https://njnpcommunity.org/members/<?php echo esc_url( $user_data->display_name ); ?>/" class="bp-tooltip" data-bp-tooltip-pos="up" data-bp-tooltip="<?php echo esc_html( $user_data->display_name ); ?>">
                        <img src="<?php echo esc_url( get_avatar_url( $user_id ) ); ?>" class="avatar user-15-avatar avatar-150 photo" width="150" height="150" alt="Profile photo of <?php echo esc_html( $user_data->display_name ); ?>">					</a>
                    </li> 
                       
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
                           <?php
// Define taxonomy prefix eg. 'category'
// Use 'term' for all taxonomies
$taxonomy_prefix = 'teams';

// Define term ID
// Replace NULL with ID of term to be queried eg '123' 
$term_id = 68;

// Example: Get the term ID in a term archive template 
// $term_id = get_queried_object_id();

// Define prefixed term ID
$term_id_prefixed = $taxonomy_prefix .'_'. $term_id;
?>
                        <?php $team_members = get_field( 'team_members', $term_id_prefixed ); ?>
<?php if ( $team_members ) : ?>
	<?php foreach ( $team_members as $user_id ) : ?>
		<?php $user_data = get_userdata( $user_id ); ?>
		<?php if ( $user_data ) : ?>
                        
                        
                        <li>
                      <a href="https://njnpcommunity.org/members/<?php echo esc_url( $user_data->display_name ); ?>/" class="bp-tooltip" data-bp-tooltip-pos="up" data-bp-tooltip="<?php echo esc_html( $user_data->display_name ); ?>">
                        <img src="<?php echo esc_url( get_avatar_url( $user_id ) ); ?>" class="avatar user-15-avatar avatar-150 photo" width="150" height="150" alt="Profile photo of <?php echo esc_html( $user_data->display_name ); ?>">					</a>
                    </li> 
                       
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
                        
                 
                    </ul>
                  </dd>
                </dl>


              </div><!-- .item-actions -->

              <div class="bp-generic-meta groups-meta action"><div id="groupbutton-<?php the_ID(); ?>" class="generic-button"><button class="group-button leave-group bp-toggle-action-button button" data-title="Leave group" data-title-displayed="You're an Organizer" data-bp-nonce="https://njnpcommunity.org/groups/leadership/leave-group/?_wpnonce=a386ebad69" data-bp-btn-action="leave_group">You're an Organizer</button></div></div>
            </div><!-- #item-header-content -->


          </div><!-- #item-header-cover-image -->

        </div><!-- #cover-image-container -->

      </div><!-- #item-header -->

