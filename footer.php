<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuddyBoss_Theme
 */

?>

<?php do_action( THEME_HOOK_PREFIX . 'end_content' ); ?>

</div><!-- .bb-grid -->
</div><!-- .container -->
</div><!-- #content -->

<?php do_action( THEME_HOOK_PREFIX . 'after_content' ); ?>

<?php do_action( THEME_HOOK_PREFIX . 'before_footer' ); ?>

<?php do_action( THEME_HOOK_PREFIX . 'footer' ); ?>
<?php do_action( THEME_HOOK_PREFIX . 'after_footer' ); ?>

</div><!-- #page -->

<?php do_action( THEME_HOOK_PREFIX . 'after_page' ); ?>
<!-- Compressed CSS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<!-- Compressed JavaScript -->
<?php wp_footer(); ?>
<script type="text/javascript" src="https://npmcdn.com/isotope-layout@3/dist/isotope.pkgd.js" id="isotope"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6018f9ce6964d264"></script>


<?php if ( function_exists( 'bp_is_group' ) ) { 
    global $bp; 
    $group_id = $bp->groups->current_group->id; 
    if($group_id):
 $group_type = bp_groups_get_group_type($group_id);
    else:
    $group_type = 'none';
    endif;
if (strpos($group_type, 'team') !== false) { 
    
   
}
}
?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type='text/javascript'>
/* <![CDATA[ */
var ajaxexpense = {"ajaxurl":"https:\/\/njnpcommunity.org\/wp-admin\/admin-ajax.php"};
/* ]]> */
</script>
<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl,{ boundary: 'window',container:'body'})
})
</script>
<script defer>    
    (function($) {

        $(document).ready(function($) {
            
            var bpPanelCollapsible = document.getElementById('groupnav')
            
    
    if(typeof(bpPanelCollapsible) != 'undefined' && bpPanelCollapsible != null){        
                bpPanelCollapsible.addEventListener('hidden.bs.collapse', function () {
                  // do something...
                    var delay = 100;
                        setTimeout(function() {
                    $("#mainnav .side-panel-inner" ).removeClass('invisible ');
                        }, delay);
                })
            bpPanelCollapsible.addEventListener('show.bs.collapse', function () {
                 
                     $("#mainnav .side-panel-inner" ).addClass('invisible ');
                    
                })
    }
            
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
       

 $(document).ready(function () {
       

Isotope.Item.prototype._create = function() {
  // assign id, used for original-order sorting
  this.id = this.layout.itemGUID++;
  // transition objects
  this._transn = {
    ingProperties: {},
    clean: {},
    onEnd: {}
  };
  this.sortData = {};
};

Isotope.Item.prototype.layoutPosition = function() {
  this.emitEvent( 'layout', [ this ] );
};

Isotope.prototype.arrange = function( opts ) {
  // set any options pass
  this.option( opts );
  this._getIsInstant();
  // just filter
  this.filteredItems = this._filter( this.items );
  // flag for initalized
  this._isLayoutInited = true;
};

// layout mode that does not position items
Isotope.LayoutMode.create('none');


acf.add_action('load', function( $el ){
	
    $('#acf-field_6004a30b04b4d-Completed').prop('checked', this.checked);

	 if($('.acfcollapse').hasClass('show')){
        $('.load-acf').addClass('d-none');
            $('.the-acf-form').removeClass('invisible');
         $('.acfcollapse').removeClass('show');
     }
});

        $('#taskDeadline').change(function() {
    $('.acf-date-picker.acf-input-wrap .input').val($(this).val());
            $('#acf-field_5ffdfff84d104').val($(this).val());
});
$('#taskTitle').change(function() {
    $('#acf-field_5ffdf1c3145af').val($(this).val());
});

// init Isotope
var $grid = $('#task-list').isotope({
  itemSelector: '.task-container',
  layoutMode: 'none'
});
// filter functions
var filterFns = {
  // show if number is greater than 50
  numberGreaterThan50: function() {
    var number = $(this).find('.number').text();
    return parseInt( number, 10 ) > 50;
  },
  // show if name ends with -ium
  ium: function() {
    var name = $(this).find('.name').text();
    return name.match( /ium$/ );
  }
};
// bind filter button click
$('.filter-button-group').on( 'click', 'button', function() {
  var filterValue = $( this ).attr('data-filter');
  // use filterFn if matches value
  filterValue = filterFns[ filterValue ] || filterValue;
  $grid.isotope({ filter: filterValue });
});
// change is-checked class on buttons
$('.filter-button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});
 });
 $(document).ready(function(){
     var body = $('body');
     
     if(body.hasClass('page-id-64449')){
             $(".approve-expense").on("click", function(){
                var  expenseContainerID = $(this).attr("href");
                 var expensePostID = $(this).attr('id');
                 var spinner = '#spinner'+ expensePostID;
                    $(spinner).removeClass('d-none');
                    $.ajax({
                        url: ajaxexpense.ajaxurl, 
                        data: { action : 'my_ajax_expense', expenseID : expensePostID }, 
                            type: "POST",
                            dataType: "html",
                            success: function (textStatus) {
                                $(expenseContainerID).html(textStatus);
                                console.log({ expensePostID });

                            },
                        error: function(MLHttpRequest, textStatus, errorThrown){  alert(errorThrown);  }  
                    });
                 $(spinner).addClass('d-none');
                  return false;
            }); 
     }
          if(body.hasClass('page-id-64449')){
          
     }
if(body.hasClass('incident-reports')){
   
    
acf.add_action('load', function( $el ){
	 if($('#new-incident').hasClass('show')){
        $('.load-acf').addClass('d-none');
$("#new-incident").modal('hide');
         $('#new-incident').css( "display","none").removeClass('show');
            $('#incident-modal-container').removeClass('invisible');
         
     }
});
    
}
     if(body.hasClass('post-type-archive-incident-reports')){
   
    
acf.add_action('load', function( $el ){
	 if($('#new-incident').hasClass('show')){
        $('.load-acf').addClass('d-none');
$("#new-incident").modal('hide');
         $('#new-incident').css( "display","none").removeClass('show');
            $('#incident-modal-container').removeClass('invisible');
         
     }
});
    
}
     
if(body.hasClass('page-template-request-page')){
    var pageURL = $(location).attr("href"),
		formURL = pageURL+'form';
    const myModalEl = document.getElementById('requestModal')
    myModalEl.addEventListener('shown.mdb.modal', (event) => {
        $('#modal-body-content').load(formURL, function(responseTxt, statusTxt, jqXHR){
                if(statusTxt == "success"){  
                    var delay = 3000;
                    setTimeout(function() {
                        $('#requestModal .load-acf').addClass('d-none');
                        $('#requestModal .the-acf-form').removeClass('invisible');
                    }, delay);
                }
                if(statusTxt == "error"){
                    if (window.console) console.log("Error: " + jqXHR.status + " " + jqXHR.statusText);
                }
            });
    });
}
     
if(body.hasClass('page-template-expenses-page')){
    var pageURL = $(location).attr("href"),
		formURL = pageURL+'form';
        const receiptModal = document.getElementById('receiptModal')
        receiptModal.addEventListener('show.mdb.modal', (event) => {
          // Button that triggered the modal
          const button = event.relatedTarget
          // Extract info from data-mdb-* attributes
          const formLinkPath = button.getAttribute('data-mdb-urlpath')
            const formTitle = button.getAttribute('data-mdb-mtitle')
          

          // If necessary, you could initiate an AJAX request here
          // and then do the updating in a callback.
          //
          // Update the modal's content.
          const modalTitle = receiptModal.querySelector('.modal-title')
          const modalBodyInput = receiptModal.querySelector('.modal-body #modal-body-content')
         var modalBodyLoader = $('.modal-body .load-acf')
           var modalBodyform = $('.modal-body .the-acf-form')
           var fileURL = pageURL+formLinkPath + ' #modalform';
           var modalBodyContent = $('#receiptModal #modal-body-content');
          modalTitle.textContent = formTitle
            modalBodyContent.load(fileURL, function(responseTxt, statusTxt, jqXHR){
                    if(statusTxt == "success"){
                        var delay = 3000;
                        setTimeout(function() {
                            modalBodyLoader.addClass('d-none');
                            modalBodyform.removeClass('invisible');
                        }, delay);
                    }
                    if(statusTxt == "error"){
                        if (window.console) console.log("Error: " + jqXHR.status + " " + jqXHR.statusText);
                    }
                });
        })

        }
      






 });
})( jQuery );
    
</script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '168967027949473',
      xfbml      : true,
      version    : 'v10.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>
