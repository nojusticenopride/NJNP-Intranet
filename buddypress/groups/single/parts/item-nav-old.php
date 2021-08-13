<?php
/**
* BuddyPress Single Groups item Navigation
*
* @since BuddyPress 3.0.0
* @version 3.0.0
*/



global $bp; 
$group_id = $bp->groups->current_group->id;

$group_type = bp_groups_get_group_type($group_id);
$navType ='';

if (strpos($group_type, 'team') !== false) { 
$navType='teams';
} else{ 
}
?>
<?php if ( $navType ) :?>

<ul id="buddypanel-group-menu" class="buddypanel-menu side-panel-menu">
      <?php else: ?>
      <nav class="<?php bp_nouveau_single_item_nav_classes(); ?>" id="object-nav" role="navigation" aria-label="<?php esc_attr_e( 'Group menu', 'buddyboss' ); ?>">
        <ul>
          <?php endif; ?>
          <?php if ( bp_nouveau_has_nav( array( 'object' => 'groups' ) ) ) : ?>




          <?php
while ( bp_nouveau_nav_items() ) :
bp_nouveau_nav_item();
?>
          <?php if ( $navType ) :
$bpNavID = bp_nouveau_get_nav_id();
if (strpos($bpNavID, 'members-groups-li') !== false) { 
} elseif (strpos($bpNavID, 'invite-groups-li') !== false) { 
} elseif (strpos($bpNavID, 'photos-groups-li') !== false) { 
} elseif (strpos($bpNavID, 'albums-groups-li') !== false) {  } else {?> 

  

          <li id="<?php bp_nouveau_nav_id(); ?>" class="bp-menu bp-public-sub-nav <?php bp_nouveau_nav_classes(); ?> nav-item">

            <a href="<?php bp_nouveau_nav_link(); ?>" id="<?php bp_nouveau_nav_link_id(); ?>" class="nav-link bb-menu-item" data-balloon-pos="right" data-balloon="<?php bp_nouveau_nav_link_text(); ?>">
              <?php bp_nouveau_nav_link_text(); ?>

              <?php if ( bp_nouveau_nav_has_count() ) : ?>
              <span class="count"><?php bp_nouveau_nav_count(); ?></span>
              <?php endif; ?>
            </a>

          </li>
          <?php } ?>
          <?php else: ?>
          <li id="<?php bp_nouveau_nav_id(); ?>" class="<?php bp_nouveau_nav_classes(); ?>">
            <a href="<?php bp_nouveau_nav_link(); ?>" id="<?php bp_nouveau_nav_link_id(); ?>">
              <?php bp_nouveau_nav_link_text(); ?>

              <?php if ( bp_nouveau_nav_has_count() ) : ?>
              <span class="count"><?php bp_nouveau_nav_count(); ?></span>
              <?php endif; ?>
            </a>
          </li>
          <?php endif; ?>
          <?php endwhile; ?>

          <?php bp_nouveau_group_hook( '', 'options_nav' ); ?>



          <?php endif; ?>


          <?php if ( $navType ) :?>
          <?php else:?>
        </ul>
      </nav>
      <?php endif;?>
      <?php if ( $navType ) :?>
    </ul>

        <div class="pt-2 px-3">
   <hr class="mt-2 border-light mb-4 border-top">
</div>

    <?php if ( have_rows( 'quick_access', 'option' ) ) : ?>

<ul id="buddypanel-group-quick-options" class="buddypanel-menu side-panel-menu d-none d-lg-flex">

    <li class="bp-menu  text-muted text-small bp-public-sub-nav disabled pb-2" aria-disabled="true"><strong>Quick Links</strong>
        <hr class="w-25 mt-1 mb-0">
</li>
        <?php while ( have_rows( 'quick_access', 'option' ) ) : the_row(); ?>
        <li class="bp-menu bp-public-sub-nav nav-item">
             <a href="<?php the_sub_field( 'option_link' ); ?>" class="nav-link bb-menu-item" data-balloon-pos="right" data-balloon="<?php the_sub_field( 'option_name' ); ?>">
                 <?php the_sub_field( 'option_name' ); ?>
            </a>
        </li>
        <?php endwhile; ?>
      </ul>
    <?php else : ?>
    <?php // no rows found ?>
    <?php endif; ?>

  

<?php else: ?>

<?php endif; ?>



