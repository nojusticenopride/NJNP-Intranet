<?php
/**
 * Template name: expenses Page
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
<?php  $currentuser_ID = get_current_user_id(); ?>

    <div id="primary" class="content-area bb-grid-cell">
        <main id="main" class="site-main">            
			<?php if ( have_posts() ) :

				while ( have_posts() ) :
					the_post();?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <p class="margin-bottom-3"><a href="/my-expenses/"><i class="fas fa-long-arrow-alt-left"></i> Return to <em>My Expenses</em></a></p>
                 <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">    
            <a class="nav-link active" id="pills-view-tab" data-mdb-toggle="tab" href="#pills-view" role="tab"
              aria-controls="pills-view" aria-selected="true">View Expense</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-edit-tab" data-mdb-toggle="tab"  href="#pills-edit" role="tab"
              aria-controls="pills-edit" aria-selected="false">Verify and Edit Expense</a>
          </li>
        </ul>


                <div class="tab-content pt-2 pl-1" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-view" role="tabpanel" aria-labelledby="pills-view-tab">
      <div class="entry-content">
          <h4><small>Amount: </small>$<?php the_field( 'amount' ); ?></h4>
         <div class="table-responsive datatable" data-striped="true" data-hover="true" data-edit="true" data-full-pagination="true" data-selectable="true" data-sm="true" data-multi="true" data-fixed-header="true">
    <table class="table table-striped table-hover table-sm profile-fields bp-tables-user">
              <thead>
                <tr>
                  <th>Expense ID</th>
                  <th>Vender</th>
                  <th>Status</th>
                  <th>receipt_date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php the_field( 'expense_id' ); ?></td>
                  <td><?php the_field( 'vendor' ); ?></td>
                  <td>
<?php the_field( 'status' ); ?></td>
                  <td>
                      <?php $receiptDate = get_field( 'receipt_date' );
              $receiptDateStrToTime = strtotime($receiptDate);

$receiptDatenewformat = date('Y-m-d',$receiptDateStrToTime);
              
              ?>
<?php echo $receiptDatenewformat; ?>
                    </td>
                </tr>
              </tbody>
          </table>
          </div>
      <p>
<?php the_field( 'notes' ); ?></p>

<?php $category_values = get_field( 'category' ); ?>
<?php if ( $category_values ) : ?>
          <p>
              <strong>Expense Type:</strong>
	<?php foreach ( $category_values as $category_value ) : ?>
          <span class="label primary"><?php echo esc_html( $category_value ); ?></span>
	<?php endforeach; ?>
              </p>
<?php endif; ?>
          <div class="entry-content">
              <strong>Receipt</strong>
      <img src="<?php the_field( 'receipts' ); ?>">
      </div>
      </div>
          </div>
          <div class="tab-pane fade" id="pills-edit" role="tabpanel" aria-labelledby="pills-edit-tab">
              <h5>Please Verify all the details below.</h5>
              <p>The image scanning service may make a mistake. Please verify the details below and correct anything missing or wrong.</p>
              <div class="container">
                  <div class="row">
                      <div class="col flex-shrink-1">
                           <div class="entry-content">
                      <p><strong> Receipt</strong></p>
                      <img src="<?php the_field( 'receipts' ); ?>" style="max-width:350px">
                      </div>
                      </div>
                      <div class="col "><?php acfe_form('edit-expense'); ?></div>
                  </div>
              </div>
   

          </div>
        </div>
             
            </article>
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
