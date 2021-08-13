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
<div class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">

  <a class="navbar-brand" href="index.html">
    <img alt="Pipeline" src="assets/img/logo.svg" />
  </a>
  <div class="d-flex align-items-center">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="d-block d-lg-none ml-2">
      <div class="dropdown">
        <a href="<?php echo $currentuserprofilelink; ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img alt="Image" src="<?php echo esc_url( get_avatar_url( $currentuser_ID ) ); ?>" class="avatar" />
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="nav-side-user.html" class="dropdown-item">Profile</a>
          <a href="utility-account-settings.html" class="dropdown-item">Account Settings</a>
          <a href="#" class="dropdown-item">Log Out</a>
        </div>
      </div>
    </div>
  </div>
  <div class="collapse navbar-collapse flex-column" id="navbar-collapse">
    <ul class="navbar-nav d-lg-block">

      <li class="nav-item">

        <a class="nav-link" href="/">Home</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2">Pages</a>
        <div id="submenu-2" class="collapse">
          <ul class="nav nav-small flex-column">

            <li class="nav-item">
              <a class="nav-link" href="pages-app.html">App Pages</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="pages-utility.html">Utility Pages</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="pages-layouts.html">Layouts</a>
            </li>

          </ul>
        </div>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3">Components</a>
        <div id="submenu-3" class="collapse">
          <ul class="nav nav-small flex-column">

            <li class="nav-item">
              <a class="nav-link" href="components-bootstrap.html">Bootstrap</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="components-pipeline.html">Pipeline</a>
            </li>

          </ul>
        </div>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="documentation/index.html">Documentation</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="documentation/changelog.html">Changelog</a>

      </li>



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
} elseif (strpos($bpNavID, 'activity-groups-li') !== false) { 
} elseif (strpos($bpNavID, 'invite-groups-li') !== false) { 
} elseif (strpos($bpNavID, 'photos-groups-li') !== false) { 
} elseif (strpos($bpNavID, 'albums-groups-li') !== false) { 
} elseif (strpos($bpNavID, 'documents-groups-li') !== false) { 
} elseif (strpos($bpNavID, 'nav-projects-groups-li') !== false) {?>
          <li id="<?php bp_nouveau_nav_id(); ?>" class="<?php bp_nouveau_nav_classes(); ?> nav-item">

            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-projects" aria-controls="submenu-projects"
               href="<?php bp_nouveau_nav_link(); ?>" id="<?php bp_nouveau_nav_link_id(); ?>">
              <?php bp_nouveau_nav_link_text(); ?>

              <?php if ( bp_nouveau_nav_has_count() ) : ?>
              <span class="count"><?php bp_nouveau_nav_count(); ?></span>
              <?php endif; ?>
            </a>

            <div id="submenu-projects" class="collapse">
              <ul class="nav nav-small flex-column">

                <li class="nav-item">
                  <a class="nav-link" href="<?php bp_nouveau_nav_link(); ?>" id="<?php bp_nouveau_nav_link_id(); ?>">
                    <?php bp_nouveau_nav_link_text(); ?></a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="#">All Tasks</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="#">aanother link</a>
                </li>

              </ul>
            </div>

          </li>

          <?php   } else {?> 


          <li id="<?php bp_nouveau_nav_id(); ?>" class="<?php bp_nouveau_nav_classes(); ?> nav-item">

            <a class="nav-link" href="<?php bp_nouveau_nav_link(); ?>" id="<?php bp_nouveau_nav_link_id(); ?>">
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
    <hr>

    <?php if ( have_rows( 'quick_access', 'option' ) ) : ?>
    <div class="d-none d-lg-block w-100">
      <span class="text-small text-muted">Quick Links</span>
      <ul class="nav nav-small flex-column mt-2">
        <!--Section: Shortcuts-->
        <?php while ( have_rows( 'quick_access', 'option' ) ) : the_row(); ?>
        <li class="nav-item">
          <a href="<?php the_sub_field( 'option_link' ); ?>" class="nav-link"><?php the_sub_field( 'option_name' ); ?></a>
        </li>
        <?php endwhile; ?>
      </ul>
      <hr>
    </div>
    <?php else : ?>
    <?php // no rows found ?>
    <?php endif; ?>
  </div>
  <div class="d-none d-lg-block">
    <div class="dropup">
      <a href="<?php echo $currentuserprofilelink; ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img alt="Image" src="<?php echo esc_url( get_avatar_url( $currentuser_ID ) ); ?>" class="avatar" />
      </a>
      <div class="dropdown-menu">
        <a href="nav-side-user.html" class="dropdown-item">Profile</a>
        <a href="utility-account-settings.html" class="dropdown-item">Account Settings</a>
        <a href="#" class="dropdown-item">Log Out</a>
      </div>
    </div>
  </div>

</div>

<?php else: ?>

<?php endif; ?>



