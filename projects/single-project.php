<?php
/**
* The template for displaying single Project
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package BuddyBoss_Theme
*/

get_header();
?>
<style>
header#masthead.site-header--bb {
    position: absolute !important;
}
  .travel-feature-card-header {
    margin-top: 30px;
    background-color: #56524b;
    padding: 10px 15px 5px;
    position: relative;
    margin-top: 15px;
  }

  .travel-feature-card-header.icon:after {
    font: normal normal normal 14px/1 FontAwesome;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    position: absolute;
    left: 20px;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    color: #fefefe;
  }

  .travel-feature-card-header.hotel-icon:after {
    content: "\f236";
  }

  .travel-feature-card-header.car-icon:after {
    content: "\f1b9";
  }

  .travel-feature-card-header .travel-feature-card-subtitle {
    float: left;
    font-weight: 800;
    letter-spacing: 1px;
    font-size: 1em;
    text-transform: uppercase;
    color: #fff;
  }

  .travel-feature-card-header-controls a {
    color: #fefefe;
  }

  .travel-feature-card-header-controls i {
    height: 20px;
    width: 20px;
    margin-left: 10px;
  }

  .travel-feature-card-image {
    margin-top: 5px;
  }

  .travel-feature-card-details {
    background: #f0f0f0;
    border-left: 1px solid #ddd;
    border-right: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    padding: 20px;
    color: #8a8a8a;
  }

  .travel-feature-card-details button.added-button {
    color: #505050;
    font-weight: 700;
    letter-spacing: 0.5px;
    font-size: 0.8em;
  }

  .travel-feature-card-details button.added-button img {
    margin-right: 5px;
  }

  .travel-feature-card-details button.added-button:hover {
    color: #505050;
    border: 1px solid #747474;
  }

  .travel-feature-card-details button.add-button {
    color: #fff;
    font-weight: 700;
    letter-spacing: 0.5px;
    font-size: 0.8em;
  }

  @media screen and (max-width: 39.9375em) {
    .travel-feature-card-content {
      padding-bottom: 15px;
      border-bottom: 1px solid #cacaca;
    }
  }

  .travel-feature-card-price {
    text-align: right;
  }

  @media screen and (max-width: 39.9375em) {
    .travel-feature-card-price {
      padding-top: 15px;
    }
    .travel-feature-card-price .price-subtext {
      margin-bottom: 0px;
    }
  }

  .travel-feature-card-price h6 {
    font-weight: 600;
    font-size: 1.3em;
    color: #0a0a0a;
    padding: 0;
    margin: 0;
  }

  .travel-feature-card-title {
    font-weight: 500;
    font-size: 1.25em;
    color: #0a0a0a;
  }

  .travel-feature-card-date-range {
    font-size: 0.9em;
    font-weight: 700;
    color: #0a0a0a;
  }

  .travel-feature-card-header-controls {
    float: right;
  }

  .travel-feature-card-header-controls i {
    height: 20px;
    width: 20px;
    margin-left: 10px;
  }


  .circle-graph {
    width: 11.25rem;
    height: 11.25rem;
    border-radius: 50%;
    background-color: #8a8a8a;
    position: relative;
  }

  .circle-graph.gt-50 {
    background-color: #1779ba;
  }

  .circle-graph-progress {
    content: "";
    position: absolute;
    border-radius: 50%;
    left: calc(50% - 5.625rem);
    top: calc(50% - 5.625rem);
    width: 11.25rem;
    height: 11.25rem;
    clip: rect(0, 11.25rem, 11.25rem, 5.625rem);
  }

  .circle-graph-progress .circle-graph-progress-fill {
    content: "";
    position: absolute;
    border-radius: 50%;
    left: calc(50% - 5.625rem);
    top: calc(50% - 5.625rem);
    width: 11.25rem;
    height: 11.25rem;
    clip: rect(0, 5.625rem, 11.25rem, 0);
    background: #1779ba;
    -webkit-transform: rotate(60deg);
    -ms-transform: rotate(60deg);
    transform: rotate(60deg);
  }

  .gt-50 .circle-graph-progress {
    clip: rect(0, 5.625rem, 11.25rem, 0);
  }

  .gt-50 .circle-graph-progress .circle-graph-progress-fill {
    clip: rect(0, 11.25rem, 11.25rem, 5.625rem);
    background: #8a8a8a;
  }

  .circle-graph-percents {
    content: "";
    position: absolute;
    border-radius: 50%;
    left: calc(50% - 7.75862rem/2);
    top: calc(50% - 7.75862rem/2);
    width: 7.75862rem;
    height: 7.75862rem;
    background: #e6e6e6;
    text-align: center;
    display: table;
    z-index: 4;
  }

  .circle-graph-percents .circle-graph-percents-number {
    display: block;
    font-size: 1.5rem;
    font-weight: bold;
    color: #1779ba;
  }

  .circle-graph-percents .circle-graph-percents-units {
    display: block;
    font-size: 1rem;
    font-weight: bold;
  }

  .circle-graph-percents-wrapper {
    display: table-cell;
    vertical-align: middle;
    line-height: 0;
  }

  .circle-graph-percents-wrapper span {
    line-height: 1;
  }


  .stats-list {
    list-style-type: none;
    clear: left;
    margin: 0;
    padding: 0;
    text-align: center;
    margin-bottom: 30px;
  }

  .stats-list .stats-list-positive {
    color: #3adb76;
  }

  .stats-list .stats-list-negative {
    color: #cc4b37;
  }

  .stats-list > li {
    display: inline-block;
    margin-right: 10px;
    padding-right: 10px;
    border-right: 1px solid #cacaca;
    text-align: center;
    font-size: 1.1em;
    font-weight: bold;
  }

  .stats-list > li:last-child {
    border: none;
    margin: 0;
    padding: 0;
  }

  .stats-list > li .stats-list-label {
    display: block;
    margin-top: 2px;
    font-size: 0.9em;
    font-weight: normal;
  }

a.stretched-link.fs-4.text-decoration-none.text-dark.d-block::after {
    flex-shrink: 0;
    width: 1.25rem;
    height: 1.25rem;
    margin-left: auto;
    content: "";
    background-image: url(https://njnpcommunity.org/wp-content/uploads/2021/01/download.svg);
    background-repeat: no-repeat;
    background-size: 1.25rem;
    transition: transform .2s ease-in-out;
}

a.stretched-link.fs-4.text-decoration-none.text-dark.d-block:not(.collapsed)::after {
    background-image: url(https://njnpcommunity.org/wp-content/uploads/2021/01/download.svg);
    transform: rotate(180deg);
}
</style>
<div id="primary" class="content-area lmslifter">
  <main id="main" class="site-main">

    <?php

while ( have_posts() ) :
the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="card mb-4 shadow-1-strong">
      <div class="card-header my-0 py-0 pe-0 text-end"> 
        <ul class="nav nav-tabs nav-justified me-0 ms-auto" id="project" role="tablist" style="
                                                                                               width: auto;
                                                                                               display: inline-flex;
                                                                                               ">
          <li class="nav-item mx-0 px-0" role="presentation" style="
                                                                    ">
            <a class="nav-link active " id="tab-View-Project" data-mdb-toggle="pill" href="#View-Project" role="tab" aria-controls="View-Project" aria-selected="true">
              <i class="fas fa-eye"></i></a>
          </li>
          <li class="nav-item px-0 mx-0" role="presentation">
            <a class="nav-link " id="tab-edit-project" data-mdb-toggle="pill" href="#edit-project" role="tab" aria-controls="edit-project" aria-selected="false"><i class="fa fa-edit"></i></a>
          </li>
        </ul>
      </div>
      <div class="card-body">

        <div class="tab-content" id="project-content">
          <div
               class="tab-pane fade show active"
               id="View-Project"
               role="tabpanel"
               aria-labelledby="View-Project"
               >
            <h3 class="card-title"><?php the_title();?></h3>

            <div class="row">
              <div class="col-md-6 mb-4 mb-md-0 text-start text-md-start">
                <p class="mb-0"><strong>Project Description</strong></p>
                <?php the_content(); 
wp_link_pages( array(
'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buddyboss-theme' ),
'after'	 => '</div>',
) );
?>

                <?php $start_date = get_field( 'start_date' ); ?>
                <?php $end_date = get_field( 'end_date' ); ?>
                <p class="mt-5"><strong><small>Project Timeline: </small></strong><br><i class="fas fa-calendar-times pe-1 ps-0"></i>
                  <?php if (!empty($end_date)) {?>
                  <?php if (!empty($start_date)) {?><?php the_field( 'start_date' ); ?> - <?php } ?>
                  <?php the_field( 'end_date' ); } else {?> <?php the_field( 'project_timeline' ); } ?>
                </p>
                    <p class="mt-3">
          <a
  class="btn btn-lg btn mx-auto btn-outline-dark"
  data-mdb-toggle="collapse"
  href="#add-task"
  role="button"
  aria-expanded="false"
  aria-controls="add-task"
>

<i class="fas fa-tasks pe-1"></i> Create a new task

</a>
      </p>
              </div>

              <div class="col-md-6">
                  <div class="spinner-border load-acf text-warning mt-5" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                <div class="note note-info mb-1 the-acf-form invisible">
                    <?php $team = get_field( 'team' ); ?>
<?php if ( $team ) : ?>
	<?php $get_terms_args = array(
		'taxonomy' => 'teams',
		'hide_empty' => 0,
		'include' => $team,
	); ?>
	<?php $terms = get_terms( $get_terms_args ); ?>
	<?php if ( $terms ) : ?>
		<?php foreach ( $terms as $term ) : ?>
		<small class="text-muted"><strong>Team:</strong> <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a></small>
                  <hr class="mt-1 mb-2 w-50 ms-0 bg-info">
                  <div class="d-flex flex-wrap pe-2 mb-2">
                    <?php get_template_part( 'templates/users', 'team', array(
        'term'   => $term->term_id
    ) ); ?>
                  </div>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endif; ?>
<a
  class="btn btn-sm btn-link"
  data-mdb-toggle="collapse"
  href="#add-team"
  role="button"
  aria-expanded="false"
  aria-controls="add-team"
>

<i class="fas fa-users"></i> <i class="fas fa-plus fa-xs pe-1"></i> Add team

</a>

<!-- Collapsed content -->
<div class="collapse multi-collapse acfcollapse mt-3 show" id="add-team">
    <!-- Button trigger modal -->

<button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="add-team create-team"> <i class="fas fa-users-cog"></i> Create a team</button>

<?php acfe_form('add-team'); ?>
</div>
<div class="collapse multi-collapse mt-3 acfcollapse show" id="create-team">
<div class="alert alert-light alert-dismissible fade show" role="alert">
<?php acfe_form('create-team'); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

</div>
                    
                </div>
                  

                <?php $project_type = get_field( 'project_type' ); ?>
                <?php $term = get_term_by( 'id', $project_type, 'project-type' ); ?>
                <?php if ( $term ) : ?>
                <p class=""><strong><small> Project Type:</small></strong><br><i class="fas fa-layer-group"></i> <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a></p>
                <?php endif; ?>



              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="edit-project" role="tabpanel" aria-labelledby="edit-project">
            <?php acfe_form('edit-project'); ?>
          </div>

        </div>
        <!-- Tabs content -->
      </div>
    </div>    


    <?php
$projectTemplateType = '';
$project_type = get_field( 'project_type' ); 
 $term = get_term_by( 'id', $project_type, 'project-type' ); 
    if ( $term ) : 
        if ($term == '36') {
            $projectTemplateType = 'resident';
        }elseif ($term == '37') {

            $projectTemplateType = 'request';
        }elseif ($term == '38') {

            $projectTemplateType = 'expense';
        }elseif ($term == '39') {

            $projectTemplateType = 'event';
        }elseif ($term == '40') {
            $projectTemplateType = 'default';
        } else {
             $post = $wp_query->post;
            if ( in_category('default') ) {  
             $projectTemplateType = 'default';
            }elseif ( in_category('event')) {
          $projectTemplateType = 'event';
            }elseif ( in_category('expense')) {
            $projectTemplateType = 'expense';
            }elseif ( in_category('request')) {
            $projectTemplateType = 'request';
            }elseif ( in_category('resident-intake-management')) {
           $projectTemplateType = 'resident';
            } else {

             $projectTemplateType = 'default';
            }
        }
    else:
              $post = $wp_query->post;
            if ( in_category('default') ) {  
             $projectTemplateType = 'default';
            }elseif ( in_category('event')) {
          $projectTemplateType = 'event';
            }elseif ( in_category('expense')) {
            $projectTemplateType = 'expense';
            }elseif ( in_category('request')) {
            $projectTemplateType = 'request';
            }elseif ( in_category('resident-intake-management')) {
           $projectTemplateType = 'resident';
            } else {

             $projectTemplateType = 'default';
            }
    endif;
$resident = get_field( 'resident' ); 
if ( $resident ) : 
           $projectTemplateType = 'resident';

          endif;
        $residentID='';
      if ( $resident ) : 
	   $user_data = get_userdata( $resident ); 
        if ( $user_data ) : 

            $residentID = $user_data;
        else:
            $residentID = $resident;
         endif; 
     endif; 
        if($projectTemplateType == 'default') {
             get_template_part( 'templates/single', 'project' );
        } elseif($projectTemplateType == 'event') {
            get_template_part( 'templates/single', 'event' );
        } elseif($projectTemplateType == 'expense') {
            get_template_part( 'templates/single', 'expense' );
        } elseif($projectTemplateType == 'request') {
            get_template_part( 'templates/single', 'request' );
      } elseif($projectTemplateType == 'resident') {
            get_template_part( 'templates/single', 'resident', array(
                'Resident_UserID'   => $residentID
            ) ); 
        }
?>   
    </article>
  <?php
endwhile; // End of the loop.

?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
