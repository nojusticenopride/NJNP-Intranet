<aside class="buddypanel">
  <?php
$menu = is_user_logged_in() ? 'buddypanel-loggedin' : 'buddypanel-loggedout';
$header = buddyboss_theme_get_option( 'buddyboss_header' );
?>

  <?php if ( function_exists( 'bp_is_group' ) ) { 
global $bp; 
$group_id = $bp->groups->current_group->id; 
if($group_id): 
$group_name = $bp->groups->current_group->name; 
$group_status = $bp->groups->current_group->status; 

$group_type = bp_groups_get_group_type($group_id);
$group_status_description = $bp->groups->current_group->description; 

$tooltip_position = 'down';
?>

  <div class="collapse multi-nav-collapse" id="mainnav">
    <header class="panel-head">
      <a href="#" class="bb-toggle-panel"><i class="bb-icon-menu-left"></i></a>
    </header>
    <div class="side-panel-inner invisible">
      <div class="side-panel-menu-container">

        <?php
wp_nav_menu( array(
'theme_location' => $menu,
'menu_id'		 => 'buddypanel-menu',
'container'		 => false,
'fallback_cb'	 => '',
'walker'         => new BuddyBoss_BuddyPanel_Menu_Walker(),
'menu_class'	 => 'buddypanel-menu side-panel-menu', )
);
?>
<div class="pb-0 px-3">
        <hr class="mt-0 mb-3">
          </div>
        <ul class="buddypanel-menu mt-2 side-panel-menu">
          <li class="menu-item menu-item-type-post_type menu-item-object-page">
            <a href="javascript:void(0)" class="bb-menu-item" data-balloon-pos="right" data-balloon="Open <?php echo $group_name;?> group menu" data-bs-toggle="collapse" data-bs-target=".multi-nav-collapse" aria-expanded="true" aria-controls="mainnav, groupnav"><span>Open <?php echo $group_name;?> menu</span><i class="_mi _before buddyboss fas fa-level-up-alt fa-lg ms-2" style="
    min-width: auto;
"></i></a></li>
        </ul>
      </div>

    </div>
  </div>
  <div class="collapse multi-nav-collapse show bg-dark pt-1" id="groupnav">
    <header class="panel-head bg-dark d-block" title="Return to main menu">
<a href="#" class="bb-toggle-group-panel align-self-start" data-bs-toggle="collapse" data-bs-target=".multi-nav-collapse" aria-expanded="true" aria-controls="mainnav, groupnav" title="" data-mdb-toggle="tooltip" data-mdb-placement="right" data-mdb-original-title="Return to main menu">
          <span class="d-none text-small d-lg-inline text-grey" style="
          opacity: 0.6;
          vertical-align: text-bottom;
          "><em>Return to main menu</em></span><span class="visually-hidden-focusable">Return to main menu</span><i class="fas fa-level-down-alt ms-1 fa-lg"></i>
      </a>
        <div class="pt-2 px-3">
              <h4 class="bb-bp-group-title text-light mb-0 w-100"><?php echo $group_name; ?></h4>
              <div class="flex align-items-center bp-group-title-wrap mb-0">


                <p class="bp-group-meta bp-group-status pe-2 ps-1"><span class="group-visibility <?php echo $group_status; ?>"><?php echo $group_status; ?></span> <span class="type-separator">/</span></p>
                  <p class="bp-group-meta bp-group-type">
                      <span class="group-type"><?php echo $group_type; ?></span></p>
              </div>
            <hr class="mt-1 border-light mb-3 border-top">
        </div>
    </header>

    <div class="" data-bp-item-id="<?php echo $group_id; ?>" data-bp-item-component="groups">
      <?php bp_get_template_part( 'groups/single/parts/item-nav' ); ?>
    </div>
  </div>



  <?php else: 
  if ( $header == '3' && !buddypanel_is_learndash_inner() ) {

  get_template_part( 'template-parts/site-logo' );

  } elseif ( $header == '3' && buddypanel_is_learndash_inner() ) { ?>

  <header class="panel-head">
    <a href="#" class="bb-toggle-panel"><i class="bb-icon-menu-left"></i></a>
  </header>

  <?php
if ( buddyboss_is_learndash_brand_logo() && buddyboss_theme_ld_focus_mode() ) { ?>
  <div class="site-branding ld-brand-logo"><img src="<?php echo esc_url(wp_get_attachment_url(buddyboss_is_learndash_brand_logo())); ?>" alt="<?php echo esc_attr(get_post_meta(buddyboss_is_learndash_brand_logo() , '_wp_attachment_image_alt', true)); ?>"></div>  
  <?php } else {
get_template_part( 'template-parts/site-logo' );   
}

} else { ?>

  <header class="panel-head">
    <a href="#" class="bb-toggle-panel"><i class="bb-icon-menu-left"></i></a>
  </header>

  <?php } ?>
  <div class="side-panel-inner">
    <div class="side-panel-menu-container">
      <?php
wp_nav_menu( array(
'theme_location' => $menu,
'menu_id'		 => 'buddypanel-menu',
'container'		 => false,
'fallback_cb'	 => '',
'walker'         => new BuddyBoss_BuddyPanel_Menu_Walker(),
'menu_class'	 => 'buddypanel-menu side-panel-menu', )
);
?>
    </div>
  </div>
  <?php endif;
}?>
</aside>
