<?php
/**
* Template name: manage NJNP
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package BuddyBoss_Theme
*/

get_header();
?>

<link rel="stylesheet" id="bp-nouveau-css" href="https://njnpcommunity.org/wp-content/plugins/buddyboss-platform/bp-templates/bp-nouveau/css/buddypress.min.css?ver=1.5.7.3" type="text/css" media="screen">
<div id="primary" class="content-area bb-grid-cell">
  <main id="main" class="site-main">
    <?php if ( have_posts() ) :

do_action( THEME_HOOK_PREFIX . '_template_parts_content_top' );

while ( have_posts() ) :
the_post();?>
    <article id="manage_njnp" class="bp_group type-bp_group type-page status-publish hentry">
      <div id="buddypress" class="buddypress-wrap bp-dir-hori-nav">
        <div class="entry-content">
          <div id="buddypress" class="buddypress-wrap bp-dir-hori-nav">
            <?php

                get_template_part( 'template-parts/manage', 'header' ); ?>

            <div class="bp-wrap">
              <?php get_template_part( 'template-parts/manage', 'nav' );?>
              <div class="bb-profile-grid bb-grid">
                <div id="item-body" class="item-body">
                  <?php $pageType = $_GET['p'];
                    if(strpos($_SERVER['REQUEST_URI'], 'p') !== false){ 

                    get_template_part( 'template-parts/manage', $pageType );
                    } else {
                    get_template_part( 'template-parts/manage', 'forum' ); 
                    }?>

                </div>


              </div>

            </div><!-- // .bp-wrap -->




          </div><!-- #buddypress -->
        </div>
      </div><!-- .entry-content -->


    </article>


    <?php      endwhile; // End of the loop.
else :
get_template_part( 'template-parts/content', 'none' );
?>

    <?php endif; ?>

  </main><!-- #main -->
</div><!-- #primary -->

<div class="d-none" id="loadingContainer">
  <div id="bp-ajax-loader">
    <aside class="bp-feedback bp-messages loading">

      <span class="bp-icon" aria-hidden="true"></span>
      <p>Loading section. Please wait.</p>

    </aside>
  </div>
</div>
<script type='text/javascript'>
  /* <![CDATA[ */
  var ajaxexpense = {"ajaxurl":"https:\/\/njnpcommunity.org\/wp-admin\/admin-ajax.php"};
  /* ]]> */
</script>
<script type='text/javascript'>
  /* <![CDATA[ */
  var ajaxnjnp = {"ajaxurl":"https:\/\/njnpcommunity.org\/wp-admin\/admin-ajax.php"};
  /* ]]> */
</script>
<?php $Auser = wp_get_current_user();
$currentuser_ID = $Auser->ID; ?>
<!--<script defer>

  (function($) {
    $(document).ready(function () {
      $('#object-nav li a').click(function() {

        var  sectionToLoad = $(this).attr('data-section');
        var ajaxLoader = $('#loadingContainer').html();   
        var sectionContainer = $('#item-body');
        sectionContainer.html(ajaxLoader);
        $.ajax({
          url: ajaxnjnp.ajaxurl, 
          data: { action : 'Manage_NJNP_Ajax', sectionLoad : sectionToLoad, currentUser:'<?php echo $currentuser_ID; ?>' }, 
          type: "POST",
          dataType: "html",
          success: function (textStatus) {
            $(this).addClass('active');

            sectionContainer.html(textStatus);


          },
          error: function(MLHttpRequest, textStatus, errorThrown){    }  
        });

        return false;

      }); 


    });

  })( jQuery );


</script> -->
<?php
get_footer();
