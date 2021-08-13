  <?php // Custom WP query query
$author_first_name = '';
$postexpenseID = $args['expenseID'];


$args_query = array(
'post_type' => array('expenses'),
	'p' => $postexpenseID
);

$query = new WP_Query( $args_query );?>

<?php

if ( $query->have_posts() ) {
while ( $query->have_posts() ) {
$query->the_post(); ?>


<?php
// Define user ID
// Replace NULL with ID of user to be queried
$author_id = get_the_author_meta( 'ID' );
$author_first_name = get_the_author_meta( 'first_name');
$author_user_email = get_the_author_meta( 'user_email');

// Example: Get ID of current user
// $user_id = get_current_user_id();

// Define prefixed user ID
$user_acf_prefix = 'user_';
$user_id_prefixed = $user_acf_prefix . $author_id;
?>
<?php 
    update_field('field_iq93kzuv3csdjs', 'Approved');
$Auser = wp_get_current_user();
$Auser_id = $Auser->ID;
$approver_value =  array($Auser_id);
update_field('field_fxrd9u4vqjmp0w', $approver_value);
    $PMofPay = get_field( 'preferred_method_of_payment', $user_id_prefixed );
    
    
?>

<div class="card-footer expense-card-footer bg-success d-flex justify-content-between" id="<?php the_ID();?>">
                            <h5 class="pt-2"><small>Approved! </small></h5>
    <div class="ps-4 pt-1" style="min-width: 220px;">
        <button data-expense="<?php the_ID();?>" id="set-to-paid<?php the_ID();?>" role="button" class="btn btn-lg btn-link">
            <div class="spinner-border text-success d-none" role="status" id="spinner<?php the_ID();?>">
                <span class="visually-hidden">Loading...</span>
            </div>
            <strong>Set status to paid?</strong>
        </button>
    </div>
    <?php if ( $PMofPay ) : ?>
            <div class="badge bg-primary text-wrap" style="width: 6rem;"><?php the_field( 'preferred_method_of_payment', $user_id_prefixed ); ?></div>
          <div class="chip chip-outline btn-outline-success" data-mdb-ripple-color="dark"><?php the_field( 'payment_account', $user_id_prefixed ); ?></div>
    <?php else: ?>
    <p class="note note-danger small">
  Please contact <strong><?php echo $author_first_name;?></strong> at <strong><a href="mailto:<?php echo $author_user_email?>"><?php echo $author_user_email?></a></strong> for their preferred method of payment.
</p>
       
    <?php endif; ?>
                          </div>
<div class="alert alert-success alert-dismissible fade" role="alert" id="alert<?php the_ID();?>" style="top: 0; position: absolute; width: 100%;">
  <p>
      <strong class="me-auto">Expense for <?php echo $author_first_name; ?></strong> has been paid.
    </p>
  <hr>
  <p class="mb-0">
      Tasks associated with this expense has been set to complete.
    </p>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<script defer>
 
  (function($) {
      $(document).ready(function () {
        $("#set-to-paid<?php the_ID();?>").on("click", function(){
            $('#spinner<?php the_ID();?>').removeClass('d-none');
            $('#set-to-paid > strong').addClass('visually-hidden');
               $('.expense-card-footer').addClass('fade');
           
                var  expensePostID = $(this).attr('data-expense');
                 $.ajax({
                        url: ajaxexpense.ajaxurl, 
                        data: { action : 'paid_ajax_expense', expenseID : expensePostID }, 
                            type: "POST",
                            dataType: "html",
                            success: function (textStatus) {
                                $(this).html('Expense set to paid');
                                console.log('Expense set to paid');
               $('.expense-card-footer').addClass('d-none');
 $('#alert<?php the_ID();?>').addClass('show');
                                $('#expense<?php the_ID();?>status').html('Paid');
                                 $('#expense<?php the_ID();?>status').parent('a').addClass('btn-success');
                                  var delay = 3000;
                    setTimeout(function() {$('#spinner<?php the_ID();?>').addClass('d-none');}, delay);
                                 
                            },
                        error: function(MLHttpRequest, textStatus, errorThrown){  alert(errorThrown);  }  
                    });
            
               
            }); 
      });

  })( jQuery );
    
    
</script>


<?php }
}
wp_reset_postdata(); ?>
