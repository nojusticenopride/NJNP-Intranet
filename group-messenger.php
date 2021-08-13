<?php
/**
 * Template name: Template for group messages
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

?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
        <style>@import url('https://fonts.googleapis.com/css?family=Fira+Mono:700|Permanent+Marker|Poppins:200i,300,400,700,900i&display=swap');</style>

	</head>

	<body <?php body_class(); ?>>

        		<?php if ( have_posts() ) :

				while ( have_posts() ) :
					the_post();?>
      	<!---for debuging - form title:	<?php the_title(); ?>   -->
        <div id="modalform">
            <?php
            $groupID = isset( $_GET['groupID'] ) ? intval( $_GET['groupID'] ) : 0;
if(strpos($_SERVER['REQUEST_URI'], 'groupID') !== false){
    $messenger_shortcode = '[cometchat layout="embedded" width="600" height="300" guid="'.$groupID.'"]';
} else {
   $messenger_shortcode = '[cometchat layout="embedded" width="600" height="300"]'; 
}
  
     echo do_shortcode($messenger_shortcode);          
            
  ?>
        </div>
			<?php
            endwhile; // End of the loop.
			?>

			<?php endif; ?>

<?php wp_footer(); ?>
    </body>
</html>