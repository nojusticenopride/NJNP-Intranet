<?php
/*
 * Template name: home page group redirect
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

get_header();
?>

<?php
// Define user ID
// Replace NULL with ID of user to be queried
 $user_id = get_current_user_id();

// Define prefixed user ID
$user_acf_prefix = 'user_';
$user_id_prefixed = $user_acf_prefix . $user_id;
?>
<?php $NJNPhome = get_field( 'njnp_location', $user_id_prefixed );
$NJNPhome_slug = str_replace(' ', '-', strtolower($NJNPhome));

 ?>

<script>window.location.replace("https://njnpcommunity.org/groups/<?php echo $NJNPhome_slug; ?>");</script>
<?php
get_footer();
