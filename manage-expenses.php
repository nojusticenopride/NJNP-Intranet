<?php
/**
* Template name: Manage Expenses Page
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

get_header();
?> 
<style>
    .table-editor.sm td, .table-editor.sm th {
    padding: .35rem .64rem;
}
  select#acf-field_5ffc72eea3d81-field_5ffc72eea3d81_field_obfaozyisol91u {
    height: 50px;
  }

  .acf-field.acf-field-select.acf-field-obfaozyisol91u.is-required.-r0 {
    min-height: auto !important;
    padding-top: 0;
    padding-bottom: 0;
  }

  .acf-field.acf-field-image.acf-field-ks9zhijinbn8vr.is-required.-r0 {
    min-height: auto !important;

    padding-top: 0;
    padding-bottom: 0;
  }

  input.acf-button.button.button-primary.button-large {
    width: 56%;
    text-align: center;
    margin: 18px auto 0!important;
  }

  @media only screen and (min-width: 992px) {
    div#panel { 
      margin:0 auto;
      width:75%;
    }
  }
</style>
<?php  $currentuser_ID = get_current_user_id(); ?>

<div id="primary" class="content-area bb-grid-cell">
  <main id="main" class="site-main">            
    <?php if ( have_posts() ) :

while ( have_posts() ) :
the_post();?>
      
    <div class="row">
      <div class="columns">
        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
        <p>	<?php
the_content();?></p>
<div class="container">
  
    <div class="d-flex justify-content-between mb-4">
  <button id="async_data_btn" class="btn btn-primary btn-sm">
    Load data
  </button>
  <div class="d-flex">
    <div class="form-outline">
      <input
        type="text"
        data-mdb-search
        data-mdb-target="#table_async_data"
        id="search_async"
        class="form-control"
      />
      <label class="form-label" for="search_async">Search</label>
    </div>
    <button
      class="btn btn-primary btn-sm ms-3"
      data-mdb-add-entry
      data-mdb-target="#table_async_data"
    >
      <i class="fa fa-plus"></i>
    </button>
  </div>
</div>
<hr />
<div id="table_async_data"></div>
          </div>
          </div>
         
        </div>


    <?php
endwhile; // End of the loop.
else :
get_template_part( 'template-parts/content', 'none' );
?>

    <?php endif; ?>


  </main><!-- #main -->
</div><!-- #primary -->

<?php
if ( is_search() ) {
get_sidebar( 'search' );
} else {
get_sidebar( 'page' );
}
?>

<?php
get_footer();
