<?php
/**
 * @package BuddyBoss Child
 * The parent theme functions are located at /buddyboss-theme/inc/theme/functions.php
 * Add your own functions at the bottom of this file.
 */


/****************************** THEME SETUP ******************************/

/**
 * Sets up theme for translation
 *
 * @since BuddyBoss Child 1.0.0
 */
function buddyboss_theme_child_languages()
{
  /**
   * Makes child theme available for translation.
   * Translations can be added into the /languages/ directory.
   */

  // Translate text from the PARENT theme.
  load_theme_textdomain( 'buddyboss-theme', get_stylesheet_directory() . '/languages' );

  // Translate text from the CHILD theme only.
  // Change 'buddyboss-theme' instances in all child theme files to 'buddyboss-theme-child'.
  // load_theme_textdomain( 'buddyboss-theme-child', get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'buddyboss_theme_child_languages' );

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since Boss Child Theme  1.0.0
 */
function buddyboss_theme_child_scripts_styles()
{
  /**
   * Scripts and Styles loaded by the parent theme can be unloaded if needed
   * using wp_deregister_script or wp_deregister_style.
   *
   * See the WordPress Codex for more information about those functions:
   * http://codex.wordpress.org/Function_Reference/wp_deregister_script
   * http://codex.wordpress.org/Function_Reference/wp_deregister_style
   **/

  // Styles
  wp_enqueue_style( 'buddyboss-child-css', get_stylesheet_directory_uri().'/assets/css/custom.css', '', '1.0.0' );
    
  wp_enqueue_style( 'MDB-plugins-css', get_stylesheet_directory_uri().'/assets/css/all.min.css', '', '1.0.0' );

  // Javascript
  wp_enqueue_script( 'buddyboss-child-js', get_stylesheet_directory_uri().'/assets/js/custom.js', '', '1.0.0' );
     wp_enqueue_style('bootstrap', get_stylesheet_directory_uri().'/assets/css/bootstrap.min.css', '5.0.0' , false);
        wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.15.1/css/all.css', false, '5.15.1');
        wp_enqueue_script('bootstrap', get_stylesheet_directory_uri().'/assets/js/bootstrap.bundle.min.js' , array() , '5.0.0' , true);
                wp_enqueue_script('MDbootstrap', 'https://mdbootstrap.com/api/snippets/static/download/MDB5-Pro-Advanced_3.4.0/js/mdb.min.js' , array('jquery','bootstrap','buddyboss-child-js','jquery-ui-menu') , '5.0.0' , true);
}
add_action( 'wp_enqueue_scripts', 'buddyboss_theme_child_scripts_styles', 9999 );



/****************************** CUSTOM FUNCTIONS ******************************/
function text_area_shortcode($value, $post_id, $field) {
  if (is_admin()) {
    // don't do this in the admin
    // could have unintended side effects

    // revision: return $value because we don't want to miss on the textarea content
    return $value;
  }

  return do_shortcode($value);
}
add_filter('acf/load_value/type=textarea', 'text_area_shortcode', 10, 3);
add_filter( 'register_taxonomy_args', 'my_taxonomy_args', 10, 2 );
 
function my_taxonomy_args( $args, $taxonomy_name ) {
 
    if ( 'teams' === $taxonomy_name ) {
        $args['show_in_rest'] = true;
 
        // Optionally customize the rest_base or rest_controller_class
        $args['rest_base']             = 'teams';
        $args['rest_controller_class'] = 'WP_REST_Terms_Controller';
    }
 
    return $args;
}


// Add your own custom functions here
function my_acf_prepare_field4( $field ) {
    
    if( isset($_GET['post']) ){
        $post_id = $_GET['post'];
        
        $field['value'] = $post_id->post_parent;
    }
    
    return $field;
    
}

// name
add_filter('acf/prepare_field/key=field_6000c1291aa1d', 'my_acf_prepare_field4');
function bidirectional_acf_update_value( $value, $post_id, $field  ) {
	
	// vars
	$field_name = $field['name'];
	$field_key = $field['key'];
	$global_name = 'is_updating_' . $field_name;
	
	
	// bail early if this filter was triggered from the update_field() function called within the loop below
	// - this prevents an inifinte loop
	if( !empty($GLOBALS[ $global_name ]) ) return $value;
	
	
	// set global variable to avoid inifite loop
	// - could also remove_filter() then add_filter() again, but this is simpler
	$GLOBALS[ $global_name ] = 1;
	
	
	// loop over selected posts and add this $post_id
	if( is_array($value) ) {
	
		foreach( $value as $post_id2 ) {
			
			// load existing related posts
			$value2 = get_field($field_name, $post_id2, false);
			
			
			// allow for selected posts to not contain a value
			if( empty($value2) ) {
				
				$value2 = array();
				
			}
			
			
			// bail early if the current $post_id is already found in selected post's $value2
			if( in_array($post_id, $value2) ) continue;
			
			
			// append the current $post_id to the selected post's 'related_posts' value
			$value2[] = $post_id;
			
			
			// update the selected post's value (use field's key for performance)
			update_field($field_key, $value2, $post_id2);
			
		}
	
	}
	
	
	// find posts which have been removed
	$old_value = get_field($field_name, $post_id, false);
	
	if( is_array($old_value) ) {
		
		foreach( $old_value as $post_id2 ) {
			
			// bail early if this value has not been removed
			if( is_array($value) && in_array($post_id2, $value) ) continue;
			
			
			// load existing related posts
			$value2 = get_field($field_name, $post_id2, false);
			
			
			// bail early if no value
			if( empty($value2) ) continue;
			
			
			// find the position of $post_id within $value2 so we can remove it
			$pos = array_search($post_id, $value2);
			
			
			// remove
			unset( $value2[ $pos] );
			
			
			// update the un-selected post's value (use field's key for performance)
			update_field($field_key, $value2, $post_id2);
			
		}
		
	}
	
	
	// reset global varibale to allow this filter to function as per normal
	$GLOBALS[ $global_name ] = 0;
	
	
	// return
    return $value;
    
}

add_filter('acf/update_value/key=field_6000c1291aa1d', 'bidirectional_acf_update_value', 10, 3);
class Group_Projects extends BP_Group_Extension {
    /**
     * Your __construct() method will contain configuration options for 
     * your extension, and will pass them to parent::init()
     */
    function __construct() {
        $args = array(
            'slug' => 'projects',
            'name' => 'Projects',
        );
        parent::init( $args );
    }
 
    /**
     * display() contains the markup that will be displayed on the main 
     * plugin tab
     */
    function display( $group_id = NULL ) {
        $group_id = bp_get_group_id();
        bp_get_template_part( 'groups/single/projects');
    }
 
    /**
     * settings_screen() is the catch-all method for displaying the content 
     * of the edit, create, and Dashboard admin panels
     */
    function settings_screen( $group_id = NULL ) {
        $setting = groups_get_groupmeta( $group_id, 'group_projects_setting' );
 
        ?>
        Save your plugin setting here: <input type="text" name="group_projects_setting" value="<?php echo esc_attr( $setting ) ?>" />
        <?php
    }
 
    /**
     * settings_sceren_save() contains the catch-all logic for saving 
     * settings from the edit, create, and Dashboard admin panels
     */
    function settings_screen_save( $group_id = NULL ) {
        $setting = '';
 
        if ( isset( $_POST['group_projects_setting'] ) ) {
            $setting = $_POST['group_projects_setting'];
        }
 
        groups_update_groupmeta( $group_id, 'group_projects_setting', $setting );
    }
}
bp_register_group_extension( 'group_projects' );
function profile_tab_incidents() {
      global $bp;
 
      bp_core_new_nav_item( array( 
            'name' => 'Incident Reports', 
            'slug' => 'incident-reports', 
            'screen_function' => 'yourtab_incidents', 
            'position' => 40,
            'parent_url'      => bp_loggedin_user_domain() . '/incident-reports/',
            'parent_slug'     => $bp->profile->slug,
            'default_subnav_slug' => 'incident-reports'
      ) );
}
add_action( 'bp_setup_nav', 'profile_tab_incidents' );
 
 
function yourtab_incidents() {
    
    // Add title and content here - last is to call the members plugin.php template.
    add_action( 'bp_template_title', 'yourtab_incidents_title' );
    add_action( 'bp_template_content', 'yourtab_incidents_content' );
    bp_core_load_template( 'buddypress/members/single/plugins' );
}
function yourtab_incidents_title() {
  
}

function yourtab_incidents_content() { 
   
        bp_get_template_part( 'members/single/incident-reports');
}

function bpex_hide_profile_menu_tabs() {

	if ( ! bp_is_user() ) {
		return;
	}
    $user = wp_get_current_user();
$allowed_roles = array( 'editor', 'administrator', 'author' );
		if( bp_is_active( 'xprofile' ) ) :
	// Change 'bp_moderate' with the capability of your choice
	
if ( ! array_intersect( $allowed_roles, $user->roles ) ) {
		// Remove actions
        bp_core_remove_nav_item( 'incident-reports' );
		remove_action( 'bp_template_title',   'yourtab_incidents_title'      );
		remove_action( 'bp_template_content', 'yourtab_incidents_content'    );

		// Add new ones
		add_action( 'bp_template_title',   'restrict_to_a_role_title'   );
		add_action( 'bp_template_content', 'restrict_to_a_role_content' );
	}


endif; 
}
add_action( 'bp_setup_nav', 'bpex_hide_profile_menu_tabs', 15 );


function restrict_to_a_role_title() {
	return;
}

function restrict_to_a_role_content() {
	?>
	<p>Your current role is not high enough to see incidents</p>
	<?php
}
function bbpress_enable_rest_api() {
	$types = array(
		bbp_get_reply_post_type(),
		bbp_get_forum_post_type(),
		bbp_get_topic_post_type(),
	);

	foreach ( $types as $slug ) {
		$definition = (array) get_post_type_object( $slug );
		$definition['show_in_rest'] = true;
		$definition['rest_controller_class'] = 'WP_REST_Posts_Controller';
		register_post_type( $slug, $definition );
	}
}

add_action( 'bbp_register_post_types', 'bbpress_enable_rest_api', 11 );



add_action( 'rest_api_init', 'my_json_expenses' );  
function my_json_expenses() {
    
  register_rest_route( 'njnp-json/v1', '/my-expenses', array(
    'methods' => 'GET',
    'callback' => 'my_json_expenses_callback',
  ) );
}

function my_json_expenses_callback( $request ) {
    
        $currentNJNPuser = wp_get_current_user();
$currentNJNPuser_ID = $currentNJNPuser->ID;
    // Initialize the array that will receive the posts' data. 
    $posts_data = array();
    // Receive and set the page parameter from the $request for pagination purposes
    $paged = $request->get_param( 'page' );
    $paged = ( isset( $paged ) || ! ( empty( $paged ) ) ) ? $paged : 1; 
    // Get the posts using the 'post' and 'news' post types
    $posts = get_posts( array(
            'paged' => $paged,
            'posts_per_page' => 40,
            'author' => $currentNJNPuser_ID,
            'post_type' => array( 'expenses' ) // This is the line that allows to fetch multiple post types. 
        )
    ); 
    // Loop through the posts and push the desired data to the array we've initialized earlier in the form of an object
    
    
    //set expense default fields
    $category_selected_option='';
$category_label='';
$amount='';
$receipts='';
$vendor='';
$notes='';
$expense_status='';
$receipt_date='';
$approver='';
$approver_name='';
    $account_number = '';
$urgency = '';
    
    
    
    foreach( $posts as $post ) {
        $id = $post->ID; 
        $category_selected_option = get_field('category', $post->ID);
        $category_label = $category_selected_option['label'];
        $amount = get_field( 'amount', $post->ID ); 
        if (empty($amount)) {$amount=0;}
        $receipts = get_field( 'receipts', $post->ID ); 
        $account_number = get_field( '$account_number', $post->ID ); 
        $urgency = get_field( '$urgency', $post->ID ); 
        if (empty($receipts)) {$receipts='missing';}
$vendor = get_field( 'vendor', $post->ID ); 
$notes = get_field( 'notes' , $post->ID); 
$expense_status = get_field( 'expense_status' , $post->ID); 
        if (empty($expense_status)) {$expense_status='Error - incomplete information';}
$receipt_date = get_field( 'receipt_date' , $post->ID); 
$approver = get_field( 'approver' , $post->ID); 
if ( $approver ) : 
	$expense_approver_user_data = get_userdata( $approver ); 
	if ( $expense_approver_user_data ) : 
		$approver_name= esc_html( $expense_approver_user_data->display_name ); 
	endif;  
endif; 
        $author_ID= get_userdata( $post->post_author ); 
        $author_name= esc_html( $author_ID->display_name ); 
       if (empty($vendor)) {$vender ='Not provided';} else {$vendor = $vendor;} 
        $posts_data[] = (object) array( 
            'id' => $id, 
            'amount' => $amount,
            'expense_status' => $expense_status,
            'category' => $category_label,
            'receipts' => "<a href='".$receipts."' target='_blank'><img class='thumbnail' style='width:auto; height:60px;' src='".$receipts."'/></a>",
            'vendor' => $vendor,
            'receipt_date' => $receipt_date,
            'notes' => $notes,
            'account_number' => $account_number,
            'urgency' => $urgency,
            'approver_name' => $approver_name
        );
    }                  
    return $posts_data;                   
} 



add_action( 'rest_api_init', 'njnp_json_expenses' );   


function njnp_json_expenses() {
    register_rest_route( 'njnp-json/v1', '/expenses', array(
        'methods' => 'GET',
        'callback' => 'njnp_json_expenses_callback'
    ));
}

function njnp_json_expenses_callback( $request ) {
    // Initialize the array that will receive the posts' data. 
    $posts_data = array();
    // Receive and set the page parameter from the $request for pagination purposes
    $paged = $request->get_param( 'page' );
    $paged = ( isset( $paged ) || ! ( empty( $paged ) ) ) ? $paged : 1; 
    // Get the posts using the 'post' and 'news' post types
    $posts = get_posts( array(
            'paged' => $paged,
            'posts_per_page' => 40,            
            'post_type' => array( 'expenses' ) // This is the line that allows to fetch multiple post types. 
        )
    ); 
    // Loop through the posts and push the desired data to the array we've initialized earlier in the form of an object
    
    
    //set expense default fields
    $category_selected_option='';
$category_label='';
$amount='';
$receipts='';
$vendor='';
$notes='';
$expense_status='';
$receipt_date='';
$approver='';
$approver_name='';
    
    
    
    foreach( $posts as $post ) {
        $id = $post->ID; 
        $category_selected_option = get_field('category', $post->ID);
        $category_label = $category_selected_option['label'];
        $amount = get_field( 'amount', $post->ID ); 
        if (empty($amount)) {$amount=0;}
        $receipts = get_field( 'receipts', $post->ID ); 
        
        if (empty($receipts)) {$receipts='missing';}
$vendor = get_field( 'vendor', $post->ID ); 
$notes = get_field( 'notes' , $post->ID); 
$expense_status = get_field( 'expense_status' , $post->ID); 
        if (empty($expense_status)) {$expense_status='Error - incomplete information';}
$receipt_date = get_field( 'receipt_date' , $post->ID); 
$approver = get_field( 'approver' , $post->ID); 
if ( $approver ) : 
	$expense_approver_user_data = get_userdata( $approver ); 
	if ( $expense_approver_user_data ) : 
		$approver_name= esc_html( $expense_approver_user_data->display_name ); 
	endif;  
endif; 
        $author_ID= get_userdata( $post->post_author ); 
        $author_name= esc_html( $author_ID->display_name ); 
       if (empty($vendor)) {$vender ='Not provided';} else {$vendor = $vendor;} 
        $posts_data[] = (object) array( 
            'id' => $id, 
               'link' => "<a href='https://njnpcommunity.org/expenses/".$post->post_name."'>".$post->post_title."</a>",
            'expense_status' => $expense_status,
            'category' => $category_label,
            'receipts' => "<a href='".$receipts."' target='_blank'><img class='thumbnail' style='width:auto; height:60px;' src='".$receipts."'/></a>",
            'amount' => $amount,
            'vendor' => $vendor,
            'receipt_date' => $receipt_date,
            'notes' => $notes,
            'approver_name' => $approver_name
        );
    }                  
    return $posts_data;                   
} 




function my_ajax_expense()
{ 
    $expenseID  =  $_POST['expenseID'];
    $expense_status  =  $_POST['expense_status'];
    $category  =  $_POST['category'];
    
    if ( $category ) :
        update_field('field_obfaozyisol91u', $category, $expenseID);
    endif; 
    $amount  =  $_POST['amount'];
    if ( $amount ) :
        update_field('field_7vsla6fofmaerd', $amount, $expenseID);
    endif; 
    $receipt_date  =  $_POST['receipt_date'];
    $notes =  $_POST['$notes'];
        if ( $notes ) :
        update_field('field_65nrgfesxjk5jf', $notes, $expenseID);
    endif; 
    $urgency =$_POST['urgency'];
            if ( $urgency ) :
        update_field('field_w9wm1d2eo0iuzq', $urgency, $expenseID);
    endif;
        $account_number = $_POST['account_number'];
    if ( $account_number ) :
        update_field('field_mnwyhcie91g26l', $account_number, $expenseID);
    endif;
        
    
    $Auser = wp_get_current_user();
$Auser_id = $Auser->ID;
$approver_value =  array($Auser_id);
    $approver_ID  = $approver_value;
    
    $approver_name  =  $_POST['approver_name'];
    
    if ( $approver_name ) :
        update_field('field_fxrd9u4vqjmp0w', $approver_ID, $expenseID);
    endif; 
    if ( $expense_status) :
    update_field('field_iq93kzuv3csdjs', $expense_status, $expenseID);
     endif; 
$approver_value =  array($approver_ID);
    $airpressexpenseID = get_field('expense_id',$expenseID);
    get_template_part( 'template-parts/expenses', 'approve', array(
                'expenseID'   => $_POST['expenseID']
            ) ); 
    
    
$custom_data = array(
	'Airtable ID' => $airpressexpenseID,
    'Wordpress ID' =>$expenseID,
    'send_from' => 'Wordpress',
    'send_to' => 'Airtable',
    'ApproverID'=>$approver_ID
);
$webhook_names = array(
	'15792546059992909',
    'update-expensev2'
);
$http_args = array(
	'blocking' => true //Set this to true to receive the response
);

$response = apply_filters( 'wp_webhooks_send_to_webhook_filter', array(), $custom_data, $webhook_names, $http_args );
     exit();
   
    
    
  // if($_POST['chosen']=='creditcard'){
     // get_template_part('cc');
   // } else {
   //   get_template_part('paypal');
   // }
}

// creating Ajax call for WordPress  
add_action('wp_ajax_nopriv_my_ajax_expense', 'my_ajax_expense');
add_action('wp_ajax_my_ajax_expense', 'my_ajax_expense');

function paid_ajax_expense(){
    $expenseID =  $_POST['expenseID'];
    update_field('field_iq93kzuv3csdjs', 'Paid', $expenseID);
        $Auser = wp_get_current_user();
$Auser_id = $Auser->ID;
$approver_value =  array($Auser_id);
    $airpressexpenseID = get_field('expense_id',$expenseID);
update_field('field_fxrd9u4vqjmp0w', $approver_value,$expenseID);
$custom_data = array(
	'Airtable ID' => $airpressexpenseID,
    'Wordpress ID' =>$expenseID,
    'send_from' => 'Wordpress',
    'send_to' => 'Airtable',
    'ApproverID'=>$Auser_id
);
$webhook_names = array(
	'15792546059992909',
    'update-expensev2'
);
$http_args = array(
	'blocking' => true //Set this to true to receive the response
);

$response = apply_filters( 'wp_webhooks_send_to_webhook_filter', array(), $custom_data, $webhook_names, $http_args );
     exit();
}
add_action('wp_ajax_nopriv_paid_ajax_expense', 'paid_ajax_expense');
add_action('wp_ajax_paid_ajax_expense', 'paid_ajax_expense');
wp_localize_script( 'ajax-expense', 'ajaxexpense', array(
	'ajaxurl' => admin_url( 'admin-ajax.php' )
));
function Manage_NJNP_Ajax()
{ 
 
    
    $user = $_POST['currentUser'];
     $Auser = wp_get_current_user();
$Auser_id = $Auser->ID;
  if ( $user ) :
    $user = $user;
    else:
    $user = $Auser_id;
 endif; 
    $user_data = get_userdata( $user ); 
$allowed_roles = array( 'editor', 'administrator', 'author', 'super_admin','super_admins','site_admins' );
		
	
if ( ! array_intersect( $allowed_roles, $user_data->roles ) ) {
    echo 'You need to be apart of the Board or Leadership to access this.';
} else {
    $template_partName = $_POST['sectionLoad'];
    if($_POST['sectionLoad']=='forum'){
        get_template_part( 'template-parts/manage', 'forum'); 
    } else if($_POST['sectionLoad']=='expenses'){    
        get_template_part( 'template-parts/manage', 'expenses'); 
    } else {    
        get_template_part( 'template-parts/manage', $template_partName); 
    }
    
    
}
   
  // if($_POST['chosen']=='creditcard'){
     // get_template_part('cc');
   // } else {
   //   get_template_part('paypal');
   // } 
 exit();
}
// creating Ajax call for WordPress  
add_action('wp_ajax_nopriv_Manage_NJNP_Ajax', 'Manage_NJNP_Ajax');
add_action('wp_ajax_Manage_NJNP_Ajax', 'Manage_NJNP_Ajax');

wp_localize_script( 'ajax-njnp', 'ajaxnjnp', array(
	'ajaxurl' => admin_url( 'admin-ajax.php' )
));